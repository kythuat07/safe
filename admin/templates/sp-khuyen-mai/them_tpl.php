<?php @include "sources/editor.php" ?>
<style>
    .select2-container--default .select2-selection--multiple{
        height: 30px;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice{
        padding: 3px 5px;
        line-height: 17px;
        margin-top: 3px;
    }
    .select2-container--default .select2-search--inline .select2-search__field{
        margin-top: 0px;
    }
</style>
<ol class="breadcrumb">
    <li><a href="."><i class="glyphicon glyphicon-home"></i> Trang chủ</a></li>
    <li class="active"><a href="./index.php">Danh mục</a></li>
    <li class="active"><a href="./index.php?p=sp-khuyen-mai&a=man">Tìm kiếm</a></li>
    <li class="active"><a href="#"><?php if(isset($_GET['id'])) echo "Sửa ảnh"; else echo "Tìm kiếm" ?></a></li>
</ol>
<div class="col-xs-12">
    <form name="frm" method="post" action="index.php?p=sp-khuyen-mai&a=save&id=<?=@$_REQUEST['id']?>&page=<?=@$_REQUEST['page']?>" enctype="multipart/form-data">
        <div class="ar_admin">
            <div class="title_thongtinchung">
                Thông tin chung
            </div>
            <table class="table table-bordered table-hover them_dt" style="border:none">
                
                <tbody>
                    <tr class="show_1">
                        <td class="td_left">
                            Hình ảnh:
                        </td>
                        <td class="td_right">
                            <input type="file" name="file" class="input width400 form-control"/>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
            <ul id="myTabs" class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#id_viet" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Ngôn ngữ VN</a>
                </li>
                <!-- <li role="presentation" class="">
                    <a href="#id_us" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Ngôn ngữ EN</a>
                    </li>
                    <li role="presentation" class="">
                    <a href="#id_ch" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Ngôn ngữ Japan</a>
                    </li> -->
            </ul>
        </div>
        <div id="myTabContent" class="tab-content">
            <div role="tabpanel" class="tab-pane fade active in" id="id_viet" aria-labelledby="home-tab">
                <!-- //lang viet -->
                <div class="ar_admin">
                    <table class="table table-bordered table-hover them_dt" style="border:none">
                        <tbody>
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
                                    Giá trị:
                                </td>
                                <td class="td_right">
                                    <input class="input width400 form-control" name="gia_tri" id="gia_tri" value="<?php echo @$items[0]['gia_tri']?>"  />
                                </td>
                            </tr>
                            <tr>
                                <td class="td_left">
                                    Mô tả:
                                </td>
                                <td class="td_right">
                                    <textarea  name="mo_ta" id="thong_tin_vn"><?=@$items[0]['mo_ta']?></textarea>
                                    <?php $ckeditor->replace('mo_ta'); ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="id_us" aria-labelledby="profile-tab">
                <div class="ar_admin">
                    <table class="table table-bordered table-hover them_dt" style="border:none">
                        <tbody>
                            <tr >
                                <td class="td_left">
                                    Tên ảnh (en):
                                </td>
                                <td class="td_right">
                                    <input class="input width400 form-control" type="text" name="title_us" value="<?php echo @$items[0]['title_us']?>"  />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="id_ch" aria-labelledby="profile-tab">
                <div class="ar_admin">
                    <table class="table table-bordered table-hover them_dt" style="border:none">
                        <tbody>
                            <tr >
                                <td class="td_left">
                                    Tên ảnh (Ja):
                                </td>
                                <td class="td_right">
                                    <input class="input width400 form-control" type="text" name="title_ch" value="<?php echo @$items[0]['title_ch']?>"  />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="ar_admin last">
            <table class="table table-bordered table-hover them_dt" style="border:none">
                <tbody>
                    <tr>
                        <td class="td_left">
                            Hiển thị:
                        </td>
                        <td class="td_right">
                            <input type="checkbox" class="chkbox" name="trang_thai" <?php if(isset($items[0]['trang_thai'])){	if(@$items[0]['trang_thai']==1) echo 'checked="checked"';	else echo'';}else echo 'checked="checked"';	?>>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_left" style="text-align:right">
                            <input type="submit" value="Lưu" class="btn btn-primary" />
                        </td>
                        <td class="td_right">
                            <input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=sp-khuyen-mai&a=man'" class="btn btn-primary" />
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
</div>
</form>
</div>
<script>
    $( "#danhmuc" ).change(function() {
        var num = $(this).val();
        if(num === '2'){
           $('#tien_ich').css('opacity','1'); 
        }else{
            $('#tien_ich').css('opacity','0'); 
        }
    });
    function addText(text,target,title) {
        var str=$(text).val();
        var link=locdau(str);
        $(target).val(link);
        $(title).val(str);
    }
</script>