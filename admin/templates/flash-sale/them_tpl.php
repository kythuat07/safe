    <?php @include "sources/editor.php"; 
?>
<link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">

<ol class="breadcrumb">
    <li><a href="<?=urladmin ?>"><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
    <li class="active"><a href="<?=urladmin ?>index.php">Danh mục</a></li>
    <li class="active"><a href="<?=urladmin ?>index.php?p=flash-sale&a=man">Flash sale</a></li>
    <li class="active"><a href="#"><?php if(isset($_GET['id'])) echo "Sửa "; else echo "Thêm mới" ?></a></li>
</ol>
<div class="col-xs-12">
    <form name="frm" method="post" action="index.php?p=flash-sale&a=save&id=<?=@$_REQUEST['id']?>&page=<?=@$_REQUEST['page']?>&loaitin=<?=@$_GET['loaitin']?>" enctype="multipart/form-data">
        <div class="ar_admin">
            <div class="title_thongtinchung">
                Deals giờ vàng
            </div>
            <table class="table table-bordered table-hover them_dt" style="border:none">
                <tbody>
                    <tr>
                        <td class="td_left">
                            Danh mục:
                        </td>
                        <td class="td_right" colspan="2">
                            <select name="id_category" class="input width400 form-control" style="border-radius:4px">
                                <option value="0">Deals giờ vàng</option>
                                <option value="1">Chương trinh khuyến mãi</option>
                            </select>
                        </td>
                    </tr>
                    <tr class="show_1">
                        <td class="td_left">
                            Hình ảnh:
                        </td>
                        <td class="td_right">
                            <input type="file" name="file" class="input width400 form-control"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_left">
                            Tên:
                        </td>
                        <td class="td_right">
                            <input class="input width400 form-control" id="ten" type="text" name="ten" value="<?php echo @$items[0]['ten']?>"  />
                        </td>
                    </tr>
                    <tr>
                        <td class="td_left">
                            Thời gian bắt đầu:
                        </td>
                        <td class="td_right" colspan="2">
                            <div class="form-group">
                                <div class='input-group date' id='datetimepicker1' style="width: 500px;">
                                    <input required value="<?php echo @$items[0]['star_time']?>" type='text' name="star_time" class="form-control width400" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_left">
                            Thời gian kết thúc:
                        </td>
                        <td class="td_right" colspan="2">
                            <div class="form-group">
                                <div class='input-group date' id='datetimepicker2' style="width: 500px;">
                                    <input required value="<?php echo @$items[0]['end_time']?>" type='text' name="end_time" class="form-control width400" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>

                        <td class="td_left">Tác vụ:</td>
                        <td class="td_right" colspan="2">
                            <input type="checkbox" class="chkbox" name="status" <?php if(isset($items[0]['hien_thi'])) { if(@$items[0]['hien_thi']==1) echo 'checked="checked"';} else echo'checked="checked"'; ?> id="hien_thi"><label class="lb_nut" for="hien_thi">Hiển thị</label>
                        </td>
                    </tr>
                    <tr>

                        <td class="td_left" style="text-align:right">
                        </td>
                        <td class="td_right">
                            <div class="luu">
                                <input type="submit" value="Lưu"  class="btn btn-primary" />

                            </div>
                            <div class="luu thoat">
                                <input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=bai-viet&a=man'" class="btn btn-primary" />
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
    </form>
</div>
<script>
    
    function addText(text,target,title) {
    
    	var str=$(text).val();
    
    	var link=locdau(str);
    
    	$(target).val(link);
    
    	$(title).val(str);
    
    }
    
    
    
    function xoa_anh_sp(id,idsp){
    
    	$.ajax({
    
    	  url: "./sources/ajax_xoaanh_bv.php",
    
    	  type:'POST',
    
    	  data:"id="+id+"&idsp="+idsp,
    
    	  success: function(data){
    
    		  $(".td_hinhanh").html(data);
    
    	  }
    
    	})
    
    }
    
    
    
    var fs_img = 0;
    
    function them_anh(){
    
    	fs_img++;
    
    	if(fs_img < 16){
    
    		$(".add_img").append('<div class="dv-img-ad hide_js_'+fs_img+'"><input type="hidden" name="txt_up_'+fs_img+'" class="txt_up_'+fs_img+'"  value="1"><input type="file" name="file_'+fs_img+'"><input type="text" name="title'+fs_img+'" placeholder="Tên sản phẩm" style="margin-top:5px;"/><a class="delete-img" href="javascript:;" onclick="xoa_anh_up(\''+fs_img+'\')"> Xóa </a></div>');
    
    	}else{
    
    		alert("Mỗi lần up tối đa 15 ảnh.");
    
    	}
    
    }
    
    
    
    function xoa_anh_up(id){
    
    	$(".hide_js_"+id).hide();
    
    	$(".txt_up_"+id).val("0");
    
    
    
    jQuery(document).ready(function($) {
    
    	$('.datepicker').datepicker({
    
            format: 'dd-mm-yyyy'
    
    	});
    
    });
    
</script>
<style type="text/css">
    .luu{ float: left; }
    .luu input{ margin-left: 0; margin-right: 10px; }
    .width150{ width: 150px; float: left;margin-right: 10px; }
    .sl-gio{ float: left; width: 150px; }
</style>
