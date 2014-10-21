<h4 class="widgettitle">Danh Ảnh Slide</h4>
                <table id="dyntable" class="table table-bordered">
                    <colgroup>
                        <col class="con0" style="align: center; width: 4%" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con1" />
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="head0 nosort"><input type="checkbox" class="checkall" /></th>
                            <th class="head0">Tiêu đề</th>
                            <th class="head0">Text 1</th>
                            <th class="head0">Text 2</th>
                            <th class="head0">Text 3</th>
                            <th class="head0"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($slide))foreach ($slide as $sli) {  ?>
                        <tr class="gradeX">
                          <td class="aligncenter"><span class="center">
                            <input type="checkbox" />
                          </span></td>
                            <td><?php echo $sli['title'];?></td>
                            <td><?php echo $sli['text1'];?></td>
                            <td><?php echo $sli['text2'];?></td>
                            <td><?php echo $sli['text3'];?></td>
                            <td class="center"><?php echo btn_delete('Admin/Slide/delete/' .$sli['id'].'/'.$sli['file_name']); ?></td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>