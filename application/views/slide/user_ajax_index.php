<?php if (!empty($slide)) { ?>
    <table class="table table-striped table-bordered table-hover" id="table_user">
        <thead>
            <tr>
                <th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /></th>
                <th>Tiêu đề</th>
                <th class="hidden-480">Tên ảnh</th>
                <th class="hidden-480">Ngày tạo</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($slide as $key => $value):
                ?> 
                <tr class="odd gradeX">
                    <td style="width:8px;"><input type="checkbox" class="checkboxes" value="1" /></td>
                    <td style="width:8px;"><?php echo $value["title"]; ?></td>
                    <td class="hidden-480"><?php echo $value["file_name"]; ?></td>
                    <td class="center hidden-480"><?php echo $value["create_on"]; ?></td>
                    <td data-id="<?php echo $value['id']?>">
                        <span class="icon-edit"></span>
                    </td>
                    <td data-id="<?php echo $value['id']?>">
                        <span class="icon-trash"></span>
                    </td>
                </tr>
            <?php endforeach; ?>
    </table>
    <div class="row-fluid">
        <div class="" id="ajax_paging">
            <span style="float: right;" class="dataTables_info" id="sample_1_info">Có tất cả <?php echo $count; ?> dòng dữ liệu</span>
            <?php echo $pagination; ?>
        </div>

    </div>
<?php }else { ?>
    <div id="data">
        <p>Không tìm thấy kết quả nào!</p>
    </div>
<?php } ?>

