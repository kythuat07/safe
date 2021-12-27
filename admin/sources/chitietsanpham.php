<?php
	if(!isset($_SESSION))
    {
        session_start();
    }
    if(!isset($_SESSION["user"]))
    {
        header("location: ../login.php");
    }
	@define('_template','../templates/');
	@define('_source','../sources/');
	@define('_lib','../lib/');


	@include _lib."config.php";
	@include_once _lib."function.php";
	$d = new func_index($config['database']);
	@include _lib."oop.php";
	$sel = new sel();
	@include _lib."file_router_admin.php";

	$idsp = (isset($_GET['id'])) ? addslashes($_GET['id']) : "";
	$idmau = (isset($_GET['idmau'])) ? addslashes($_GET['idmau']) : "";
	$idsize = (isset($_GET['idsize'])) ? addslashes($_GET['idsize']) : "";
	$idhinh = (isset($_GET['idhinh'])) ? addslashes($_GET['idhinh']) : "";
	if(isset($_POST['xoa_all']))
	{

		if(isset($_POST['chk_child'])){//xoa theo muc
			$chuoi='';
			foreach ($_POST['chk_child'] as $val) {
				$chuoi .=$val.',';
			}
			$chuoi = trim($chuoi,',');
			//xoa bang ctsp
			$sel->xoa_mang_chi_tiet_san_pham_mau($chuoi,$idsp);
			//xoa hinhanh
			$hinhanh = $sel->lay_danh_sach_hinh_anh_mau_sp($chuoi,$idsp);
			foreach ($hinhanh as $ha) {
				@unlink('../../img_data/images/'.$ha['hinh_lon']);
				@unlink('../../img_data/images/'.$ha['hinh_nho']);
			}
			//xoa bang hinh anh voi mau hien tại
			$sel->delete_hinh_anh_chuoi_mau($chuoi,$idsp);
			$d->location("chitietsanpham.php?id=".$idsp."");
		}

	}
	if($idsize <> ''){
		$d->reset();
		$d->setTable('tbl_chitietsanpham');
		$d->setWhere('id_sp',$idsp);
		$d->setWhere('id_size',$idsize);
		$d->setWhere('id_mau',$idmau);
		$d->delete();
		$d->location("chitietsanpham.php?id=".$idsp."");
	}
	else if($idhinh <> ''){
		//xoa hinh
		$hinhanh = $sel->lay_hinh_anh_theo_id($idhinh);
		@unlink('../../img_data/images/'.$hinhanh[0]['hinh_lon']);
		@unlink('../../img_data/images/'.$hinhanh[0]['hinh_nho']);
		//xoa csdl hinh
		$d->reset();
		$d->setTable('tbl_hinhanh');
		$d->setWhere('id',$idhinh);
		$d->delete();
		$d->location("chitietsanpham.php?id=".$idsp."");
	}
	else if($idmau <> ''){
		//xoa bang ctsp
		$d->reset();
		$d->setTable('tbl_chitietsanpham');
		$d->setWhere('id_mau',$idmau);
		$d->setWhere('id_sp',$idsp);
		$d->delete();
		//xoa hinh bang mau
		$hinhanh = $sel->lay_ds_hinh_anh_mau_sp($idsp,$idmau);
		foreach ($hinhanh as $ha) {
			@unlink('../../img_data/images/'.$ha['hinh_lon']);
			@unlink('../../img_data/images/'.$ha['hinh_nho']);
		}
		//xoa du lieu bang hinh anh
		$d->reset();
		$d->setTable('tbl_hinhanh');
		$d->setWhere('id_mau',$idmau);
		$d->setWhere('id_sp',$idsp);
		$d->delete();
		$d->location("chitietsanpham.php?id=".$idsp."");
	}
	else if($idsp != ''){
		$mau = $sel->sel_all_col_wh_col_sort('tbl_mau','hien_thi','1','id','asc');



?>
<html>
<head>
    <script type="text/javascript" src="../ctsp/jquery.js"></script>
	<link href="../ctsp/style.css" rel="stylesheet" type="text/css" />


	<script language="javascript">
	$(function () {
		$('.checkall').click(function () {
		$(this).parents('chk').find(':checkbox').attr ('checked', this.checked);
		});
	});
	</script>
</head>
<body>
<h3><a href="#">Thông tin sản phẩm: </a></h3>
<div style="text-align:left;font-size:13px; margin:7px 0px;font-weight:bold;color:#006699">Chi tiết sản phẩm</div>
<form action="" method="post">
<div style="text-align:left;margin:4px 0"><input type="submit" name="xoa_all" class="imgxoa" onClick="if(!confirm('Xác nhận xóa?')) return false;" value=""></div>
	<chk>
	<div id="begin">
	<table class="blue_table" style="width:100%">
    	<tr>
		    <th style="width:10%"><input type="checkbox" name="ckh" value="0" class="checkall"></th>
		    <th style="width:15%">Tên màu</th>
		    <th style="width:270px">Size</th>
		    <th style="width:270px">Hình ảnh</th>
		    <th style="width:10%">Xóa</th>
    	</tr>
    	<?php
    		$j = 0; foreach ($mau as $m) {
    			$j++;
    			$count_hinhanh = count($sel->lay_ds_hinh_anh_mau_sp($idsp,$m['id']));
    			$count_size = count($sel->load_size_ctsp_mau($idsp,$m['id']));
    			if($count_hinhanh <> 0 || $count_size <> 0){
    	?>
		<tr style="background-color:#fff">
			<td><input type="checkbox" name="chk_child[]" value="<?php echo $m['id'] ?>"></td>

			<td  style="color:<?php echo $m['ma_mau'] ?>"><?php echo $m['ten_vn']?></td>
			<td valign="top">
				<!--size -->
				        <div class="_caro">
				            <div style="line-height:100%;margin-top:0px;">
				                <img class="cursor _caro_prev" src="../ctsp/caro_p.png" style="display: inline;">&nbsp;
				                <img class="cursor _caro_next" src="../ctsp/caro_n.png" style="display: inline;">
				            </div>
				            <div class="clearing shadow" style="height: 115px;margin-top:-5px;overflow: hidden;">
				                <div class="caroufredsel_wrapper" style="text-align: start; float: none; position: relative; top: auto; right: auto; bottom: auto; left: auto; width: 267px; height: 115px;; margin: 0px; overflow: hidden;">
				                    <div class="_caro_cont" style="text-align: left; float: none; position: absolute; top: 0px; left: 0px; margin: 0px; width: 2562px; height: 115px;;">
				                    <!-- begin -->
				    				<?php
										$size = $sel->load_size_ctsp_mau($idsp,$m['id']);
										$i=0;
									foreach ($size as $si) {
										$i++;
										if($i%3 ==0){
									?>
				                        <div class="fl">
				                            <div class="product-box  mt10">
				                                <div class="tensize_">
													<?php echo $si['size_ten'] ?>
				                                </div>
				                                <div class="soluong_ctsp">

				                                </div>
				                                <div class="xoa">
				                                	<a onClick="if(!confirm('Xác nhận xóa?')) return false;" href="chitietsanpham.php?id=<?php echo $idsp ?>&idmau=<?php echo $m['id'] ?>&idsize=<?php echo $si['size_id'] ?>" title="Xóa size hiện tại!"><img src="../ctsp/delete.png"></a>
				                                </div>
				                            </div>
				                        </div>
				                        <?php }else{ ?>
				                        <div class="fl" style="padding-right:10px;">
				                            <div class="product-box  mt10">
				                                <div class="tensize_" style="color:#006699 !important">
													<?php echo $si['size_ten'] ?>
				                                </div>
				                                <div class="soluong_ctsp">

				                                </div>
				                                <div class="xoa">
				                                	<a onClick="if(!confirm('Xác nhận xóa?')) return false;" href="chitietsanpham.php?id=<?php echo $idsp ?>&idmau=<?php echo $m['id'] ?>&idsize=<?php echo $si['size_id'] ?>" title="Xóa size hiện tại!"><img src="../ctsp/delete.png"></a>
				                                </div>
				                            </div>
				                        </div>
				                       <?php }} ?>
				                    <!-- end -->
				<!-- end size -->

				<div style="clear:both">&nbsp;</div>
			</td>

			<td style="text-align:center" valign="top">
				<!-- hinh anh -->
				        <div class="_caro">
				            <div style="line-height:100%;margin-top:0px;">
				                <img class="cursor _caro_prev" src="../ctsp/caro_p.png" style="display: inline;">&nbsp;
				                <img class="cursor _caro_next" src="../ctsp/caro_n.png" style="display: inline;">
				            </div>
				            <div class="clearing shadow" style="height: 115px;margin-top:-5px;overflow: hidden;">
				                <div class="caroufredsel_wrapper" style="text-align: start; float: none; position: relative; top: auto; right: auto; bottom: auto; left: auto; width: 267px; height: 115px;; margin: 0px; overflow: hidden;">
				                    <div class="_caro_cont" style="text-align: left; float: none; position: absolute; top: 0px; left: 0px; margin: 0px; width: 2562px; height: 115px;;">
				                    <!-- begin -->
				    				<?php
										$hinhanh = $sel->lay_ds_hinh_anh_mau_sp($idsp,$m['id']);
										$i=0;
										foreach ($hinhanh as $ha) {
											$i++;
											if($i%3 == 0){
									?>
				                        <div class="fl">
				                            <div class="product-box  mt10" style="background:url('../../img_data/images/<?php echo $ha['hinh_lon'] ?>');background-size:80px 100px;">
				                                <div class="xoa_">
				                                	<a onClick="if(!confirm('Xác nhận xóa?')) return false;" href="chitietsanpham.php?id=<?php echo $idsp ?>&idhinh=<?php echo $ha['id'] ?>" title="Xóa hình ảnh hiện tại!"><img src="../ctsp/delete.png"></a>
				                                </div>
				                            </div>
				                        </div>
				                        <?php }else{ ?>
				                        <div class="fl" style="padding-right:10px">
				                            <div class="product-box  mt10" style="background:url('../../img_data/images/<?php echo $ha['hinh_lon'] ?>');background-size:80px 100px;">

				                                <div class="xoa_">
				                                	<a onClick="if(!confirm('Xác nhận xóa?')) return false;" href="chitietsanpham.php?id=<?php echo $idsp ?>&idhinh=<?php echo $ha['id'] ?>" title="Xóa hình ảnh hiện tại!"><img src="../ctsp/delete.png"></a>
				                                </div>
				                            </div>
				                        </div>
				                       <?php }} ?>
				                    <!-- end -->
				<!-- end hinh anh -->
				<div style="clear:both">&nbsp;</div>
			</td>
			<td><a onClick="if(!confirm('Xác nhận xóa?')) return false;" href="chitietsanpham.php?idmau=<?php echo $m['id']?>&id=<?php echo $idsp?>" title=""><img src="../ctsp/delete.png"></td>
		</tr>
		<?php }} ?>
   </table>
</div>
<chk>
</form>
<div id="one" class="jGrowl bottom-right"></div>
<link href="../ctsp/sptb.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../ctsp/sptb.js"></script>

<script type="text/javascript">
    function loadBegin(ele){

        $(ele).find('._more').click(function(){

            var me = this;

            $(this).unbind('click').html('<b>Đang tải...</b>');


            $.ajax({

                    type: 'POST',

                    url: '',

                    data: 'm='+$(this).attr('m'),

                    success: function(msg){

                        $(me).remove();

                        var div = $('<div />');

                        $(ele).after($(div).append(msg));

                        loadBegin(div);

                    }

            });

        });

        $(ele).find('._caro').each(function(index){

            var me = this;

            var direction;

            if (index % 2 == 0){

                direction = 'left';

            }else{

                direction = 'right';

            }

            $(me).find('._caro_cont').carouFredSel({

                auto    : {

                    play            :false,

                    items           : 5,

                    duration        : 7500,

                    easing          : "linear",

                    pauseDuration   : 0,

                    pauseOnHover    : "immediate"

                },

                direction: direction,

                prev    : {

                    button  : $(me).find('._caro_prev'),

                    key     : 'left'

                },

                next    : {

                    button  : $(me).find('._caro_next'),

                    key     : 'right'

                }

            });

        });

    }

    loadBegin($('#begin'));

</script>
</body>
</html>
<?php } ?>