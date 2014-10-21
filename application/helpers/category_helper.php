<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


if (!function_exists('compare')) {

    function category_initialize() {
        $ci = & get_instance();
        $ci->load->library('Nested_set');
        $new_nested_set = new Nested_set();
        $new_nested_set->setControlParams('nested_set_tree', 'lft', 'rgt', 'id', 'parent_id', 'name');
        return $new_nested_set;
    }

}
/*
 * so sánh 2 mảng item (so sánh từ trên xuống) lấy ra vi trí đã di chuyển 
 */

if (!function_exists('compare')) {

    function compare($array_old, $array_new) {
        for ($i = 0; $i < count($array_old); $i++) {
            $old = $array_old[$i];
            $new = $array_new[$i];
            if ($new != $old) {
                $return = array(
                    'old' => $old,
                    'new' => $new,
                    'i' => $i + 1,
                );
                return $return;
            }
        }
        return FALSE;
    }

}



if (!function_exists('multiarray_values')) {

    function multiarray_values($ar, $key = 'id') {
        $values = array();
        foreach ($ar as $k => $v) {
            if ($k === $key) {
                $values[] = $v;
            }
            if (is_array($ar[$k]))
                $values = array_merge($values, $this->multiarray_values($ar[$k], $key));
        }
        return $values;
    }

}


if (!function_exists('multiarray_values')) {

    function multiarray_children($temps, $id) {
        $children = array();
        foreach ($temps as $k => $v) {
            $children[$id][] = $v['id'];
        }
        foreach ($temps as $k => $v) {
            if (isset($v["children"])) {
                $children = $children + $this->multiarray_children($v["children"], $v['id']);
            }
        }
        return $children;
    }

}

/*
 * lấy ra giá trị node mẹ (key và value) của node mới dc di chuyển
 */
if (!function_exists('parents_compare')) {

    function parents_compare($array_old, $array_new, $khac, $items) {
        foreach ($array_old as $key => $value) {
            $k = array_search($khac['old'], $value);
            $h = array_search($khac['new'], $value);
            if (isset($k) && $k !== FALSE) {
                $parent_odl1 = $key;
            }
            if (isset($h) && $h !== FALSE) {
                $parent_new1 = $key;
            }
        }
        foreach ($array_new as $key => $value) {
            $k = array_search($khac['old'], $value);
            $h = array_search($khac['new'], $value);
            if (isset($k) && $k !== FALSE) {
                $parent_odl2 = $key;
            }
            if (isset($h) && $h !== FALSE) {
                $parent_new2 = $key;
            }
        }
        $item = null;
        if ($parent_new1 == $parent_new2)
            $item = $khac['old'];
        if ($parent_odl1 == $parent_odl2)
            $item = $khac['new'];
        if (($parent_new1 == $parent_new2) && ($parent_odl1 == $parent_odl2)) {
            $k_old = array_search($khac['old'], $items);
            $k_new = array_search($khac['new'], $items);
            $item = ($k_old > $k_new) ? $khac['old'] : $khac['new'];
        }
        foreach ($array_new as $key => $value) {
            foreach ($value as $k => $v) {
                if ($item == $v)
                    return array(
                        'key' => $key,
                        'value' => $value,
                        'id' => $item
                    );
            }
        }
    }

}

if (!function_exists('update_cat')) {

    function update_cat($parents_compare) {
        $return = array();
        if (count($parents_compare['value']) == 1) {
            $return =
                    array(
                        'id' => $parents_compare['id'],
                        'parents' => $parents_compare['key']
            );
        }

        if (count($parents_compare['value']) > 1) {
            foreach ($parents_compare['value'] as $key => $value) {
                if (($parents_compare['id'] == $value) && ((int) $key == 0)) {
                    $return =
                            array(
                                'id' => $parents_compare['id'],
                                'parents' => $parents_compare['key']
                    );
                }
                if (($parents_compare['id'] == $value) && ((int) $key > 0)) {
                    $return =
                            array(
                                'id' => $parents_compare['id'],
                                'next' => $parents_compare['value'][$key - 1]
                    );
                }
            }
        }
        return $return;
    }

}
/*
 * Trường hợp 2 mảng item ko thay đổi. So sánh 2 mảng children 
 * return : node đã được kéo đi, và kéo đi là cắt đi hay thêm vào node mới
 */
if (!function_exists('children_compare')) {

    function children_compare($array_old, $array_new, $item_old) {
        $return = array();
        foreach ($array_old as $key => $value) {
            if (isset($array_new[$key]) && (count($array_old[$key]) != count($array_new[$key]))) {
                $old = $this->array_compare($array_old[$key]);
                $new = $this->array_compare($array_new[$key]);
                if (count($old) > count($new))
                    $khac = array_diff($old, $new);
                else
                    $khac = array_diff($new, $old);
                $khac = $this->array_compare($khac);
                $k = array();
                $parent_n = array();
                if (count($array_old[$key]) > count($array_new[$key])) {
                    foreach ($array_new as $key => $value) {
                        $k = array_search($khac['0'], $value);
                        if (isset($k) && $k !== FALSE) {
                            $parent_n = $key;
                        }
                    }
                    if (count($array_new[$parent_n]) > 1) {
                        $k_next = array_search($khac['0'], $array_new[$parent_n]) - 1;
                        $return = array(
                            'id' => $khac,
                            'next' => $array_new[$parent_n][$k_next]
                        );
                    } else {
                        $return = array(
                            'id' => $khac,
                            'parent' => $parent_n
                        );
                    }
                } else {
                    foreach ($array_new as $key => $value) {
                        $k = array_search($khac['0'], $value);
                        if (isset($k) && $k !== FALSE) {
                            $parent_n = $key;
                        }
                    }
                    $k_next = array_search($khac['0'], $array_new[$parent_n]) - 1;
                    $return = array(
                        'id' => $khac,
                        'next' => $array_new[$parent_n][$k_next]
                    );
                }
            }
        }
        return $return;
    }

}

/*
 * lấy ra dạng mảng [1,2,3,4,5]
 */
if (!function_exists('array_compare')) {

    function array_compare($array) {
        $array_new = array();
        foreach ($array as $key => $value) {
            $array_new[] = $value;
        }
        return $array_new;
    }

}
?>