<ol class="breadcrumb">
    <li><a href="<?=urladmin ?>"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
    <li class="active"><a href="<?=urladmin ?>">Danh mục</a></li>
    <li class="active"><a href="<?=urladmin ?>index.php?p=flash-sale&a=man">Flash sale</a></li>
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
            <select id="action" onchange="seach(this,'flash-sale')" name="action" class="form-control">
                <option value="0" selected>Tìm theo</option>
                <option value="1">ID</option>
                <option value="2">Tên</option>
            </select>
        </div>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
            
                $('input#search').keypress(function (e) {
            
                 var key = this.value;
            
                   if (e.which == 13) {
            
                     window.location = "index.php?p=flash-sale&a=man&seach=name&key="+key; 
                   }
                });        
            }); 
            
        </script>
        <div class="btn-group">
            <select id="action" onchange="show(this,'flash-sale')" name="action" class="form-control">
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
        <a href="index.php?p=flash-sale&a=add" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-plus"></i> Thêm mới</a>
    </div>
    <form id="form" method="post" action="index.php?p=flash-sale&a=delete_all" role="form">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th style="width:3%"><input class="chk_box checkall" type="checkbox" name="chk" value="0"  id="check_all"></th>
                    <th style="width:17%; text-align:left">Danh mục</th>
                    <th style="width:12%">Ngày bắt đầu</th>
                    <th style="width:12%">Ngày kết thúc</th>
                    <th style="width:12%">Ngày tạo</th>
                    <th style="width:7%">Hiển thị</th>
                    <th style="width:7%">Tác vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php $count=count($items); for($i=0; $i<$count; $i++){ ?>
                <tr>
                    <td>
                        <input class="chk_box" type="checkbox" name="chk_child[]" value="<?=$items[$i]['id']?>">
                    </td>
                    <td style="text-align:left">
                        <?php 
                            if($items[$i]['id_category']==0){
                                echo "DEALS GIỜ VÀNG";
                            }else{
                                echo "KHUYẾN MÃI";
                            }
                            ?>
                    </td>
                    <td>
                        <?=$items[$i]['star_time']?>
                    </td>
                    <td><?=$items[$i]['end_time']?></td>
                    <td><?=date('d-m-Y h:i:s', $items[$i]['ngay_tao'])?></td>
                    <td>
                        <input class="chk_box" type="checkbox" onclick="on_check(this,'#_sale_code','status','<?=$items[$i]['id']?>')" <?php if($items[$i]['status'] == 1) echo 'checked="checked"'; ?>>
                    </td>
                    <td>
                        <a href="index.php?p=flash-sale&a=edit&id=<?=$items[$i]['id']?>" class="text-danger" title="Sửa"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;&nbsp;&nbsp;
                        <a href="index.php?p=flash-sale&a=delete&id=<?=$items[$i]['id']?>" onClick="if(!confirm('Xác nhận xóa?')) return false;" class="text-danger" title="Xóa"><i class="glyphicon glyphicon-remove"></i></a>
                    </td>
                </tr>
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