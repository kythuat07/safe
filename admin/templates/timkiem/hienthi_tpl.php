<ol class="breadcrumb">
    <li><a href="."><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
    <li class="active"><a href="./">Danh mục</a></li>
    <li class="active"><a href="./index.php?p=timkiem&a=man">Tìm kiếm</a></li>
</ol>
<div class="col-xs-12">
    <div class="form-group tac-vu">
        <div class="btn-group">
            <select id="action" name="action" onclick="form_submit(this)" class="form-control">
                <option selected>Tác vụ</option>
                <option value="delete">Xóa</option>
            </select>
        </div>
        <div class="btn-group">
            <input id="search" name="search" type="text" class="form-control" placeholder="Tìm kiếm"/>
        </div>
        <div class="btn-group">
            <select id="action" onchange="seach(this,'timkiem')" name="action" class="form-control">
                <option value="0" selected>Tìm theo</option>
                <option value="1">ID</option>
                <option value="2">Tên</option>
            </select>
        </div>
        <div class="btn-group">
            <select id="action" onchange="show(this,'timkiem')" name="action" class="form-control">
                <option value="0" selected>Số hiển thị</option>
                <option value="1">15</option>
                <option value="2">25</option>
                <option value="3">50</option>
                <option value="4">75</option>
                <option value="5">100</option>
                <option value="6">200</option>
                <option value="7">300</option>
            </select>
        </div>
        <div class="btn-group">
            <select id="action" onchange="loc_tin(this,'timkiem')" name="action" class="form-control">
                <option value="0">Xem tất cả hình ảnh</option>
                <?php if(count($parent)>0){foreach ($parent as $lsp) {
                    ?>
                <option value="<?php echo $lsp['id'] ?>" <?php if($lsp['id'] == @$_GET['loaitin']) echo "selected"; ?>>
                    <?php echo $lsp['ten_vn'] ?>
                </option>
                <!-- /// -->
                <?php
                    $sp_child1 = $d->o_fet("select * from #_category where id_loai = '".$lsp['id']."' order by so_thu_tu asc");
                    if(count($sp_child1)>0){foreach ($sp_child1 as $lsp1) {
                    ?>
                <option value="<?php echo $lsp1['id'] ?>" <?php if($lsp1['id'] == @$_GET['loaitin']) echo "selected"; ?>>&nbsp;&nbsp;&nbsp;&nbsp;|__ <?php echo $lsp1['ten_vn'] ?></option>
                <!-- // -->
                <!-- /// -->
                <?php
                    $sp_child2 = $d->o_fet("select * from #_category where id_loai = '".$lsp1['id']."' order by so_thu_tu asc");
                     if(count($sp_child2)>0){foreach ($sp_child2 as $lsp2) {
                    ?>
                <option value="<?php echo $lsp2['id'] ?>" <?php if($lsp2['id'] == @$_GET['loaitin']) echo "selected"; ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|__ <?php echo $lsp2['ten_vn'] ?></option>
                <?php }} ?>
                <!-- /// -->
                <!-- / -->
                <?php }} ?>
                <!-- /// -->
                <?php }} ?>
            </select>
        </div>
        <a href="index.php?p=timkiem&a=add" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-plus"></i> Thêm mới</a>
    </div>
    <form id="form" method="post" action="index.php?p=timkiem&a=delete_all" role="form">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th style="width:5%"><input  class="chk_box"  type="checkbox" name="chk" value="0" class="checkall" id="check_all"></th>
                    <th style="width:5%">STT</th>
                    <th style="width:20%">Danh mục</th>
                    <th style="width:20%">Tên ảnh</th>
                    <th style="width:20%">Hình ảnh</th>
                    <th style="width:10%">Hiển thị</th>
                    <th style="width:10%">Tác vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php $count=count($items); for($i=0; $i<$count; $i++){ ?>
                <tr>
                    <td>
                        <?php if($items[$i]['id']!='103'){ ?>
                        <input type="checkbox" class="chk_box"  name="chk_child[]" value="<?=$items[$i]['id']?>">
                        <?php } ?>
                    </td>
                    <td>
                        <?=$items[$i]['stt']?>
                    </td>
                    <td>
                        <?php if($items[$i]['danh_muc']==0){
                            echo "Tìm kiếm chung";
                        }elseif($items[$i]['danh_muc']==1){
                            echo "Tiện ích";
                        }elseif($items[$i]['danh_muc']==2){
                            echo "Loại BĐS";
                        }else {
                            echo "Địa điểm";
                        } 
                        ?>
                    </td>
                    <td style="text-align: left;">
                        <b><?=$items[$i]['ten_vn']?></b>
                    </td>
                    <td>
                        <a href="index.php?p=timkiem&a=edit&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>">
                        <img src="../img_data/images/<?=$items[$i]['picture']?>" alt="" style="max-width:30px; max-height:30px">
                        </a>
                    </td>
                    <td>
                        <input class="chk_box" type="checkbox" onclick="on_check(this,'#_timkiem','hide','<?=$items[$i]['id']?>')" <?php if($items[$i]['hide'] == 1) echo 'checked="checked"'; ?>>
                    </td>
                    <td>
                        <a href="index.php?p=timkiem&a=edit&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>" class="text-danger" title="Sửa"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;
                        <?php if($items[$i]['id']!='103'){ ?>
                        <a href="index.php?p=timkiem&a=delete&id=<?=$items[$i]['id']?>&page=<?=@$_GET['page']?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
                        <?php }  ?>
                    </td>
                </tr>
                <?php 
                $items2 = $d->o_fet("select * from #_timkiem where parent = ".$items[$i]['id']." order by stt asc");
                foreach ($items2 as $key => $value) { ?>
                <tr>
                    <td>
                        <input type="checkbox" class="chk_box"  name="chk_child[]" value="<?=$value['id']?>">
                    </td>
                    <td>
                        <?=$value['stt']?>
                    </td>
                    <td>
                        <?php $category=$d->simple_fetch("select * from #_timkiem where id = ".$value['parent']." "); echo $category['ten_vn']?>
                    </td>
                    <td style="text-align: left;">
                        |__<?=$value['ten_vn']?>
                    </td>
                    <td>
                        <a href="index.php?p=timkiem&a=edit&id=<?=$value['id']?>&page=<?=@$_GET['page']?>">
                        <img src="../img_data/images/<?=$value['hinh_anh']?>" alt="" style="max-width:50px; max-height:50px">
                        </a>
                    </td>
                    <td>
                        <input class="chk_box" type="checkbox" onclick="on_check(this,'#_timkiem','hide','<?=$value['id']?>')" <?php if($value['hide'] == 1) echo 'checked="checked"'; ?>>
                    </td>
                    <td>
                        <a href="index.php?p=timkiem&a=edit&id=<?=$value['id']?>&page=<?=@$_GET['page']?>" class="text-danger" title="Sửa"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;
                        <?php if($items[$i]['id']!='103'){ ?>
                        <a href="index.php?p=timkiem&a=delete&id=<?=$value['id']?>&page=<?=@$_GET['page']?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
                        <?php }  ?>
                    </td>
                </tr>
                <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </form>
</div>
<div class="pagination">
    <?php echo @$paging['paging']?>
</div>
<script type="text/javascript">
    function loc_tin (obj,tenp) {
    	var show = $(obj).val();
    	window.location.href = "index.php?p="+tenp+"&a=man&loaitin="+show;
    }
</script>