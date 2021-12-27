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
    <li class="active"><a href="./index.php?p=timkiem&a=man">Tìm kiếm</a></li>
    <li class="active"><a href="#"><?php if(isset($_GET['id'])) echo "Sửa ảnh"; else echo "Tìm kiếm" ?></a></li>
</ol>
<div class="col-xs-12">
    <form name="frm" method="post" action="index.php?p=timkiem&a=save&id=<?=@$_REQUEST['id']?>&page=<?=@$_REQUEST['page']?>" enctype="multipart/form-data">
        <div class="ar_admin">
            <div class="title_thongtinchung">
                Thông tin chung
            </div>
            <table class="table table-bordered table-hover them_dt" style="border:none">
                
                <tbody>
                    <tr>
                        <td class="td_left">
                            Danh mục:
                        </td>
                        <td class="td_right">
                            <select class="input width400 form-control" name="parent">
                                <option value="0">Danh mục chính</option>
                                <?php foreach ($parent as $key => $value) {?>
                                <option <?php if($items[0]['parent'] == $value['id']){echo "selected";} ?> value="<?=$value['id']?>"><?=$value['ten_vn']?></option>
                                <?php } ?>
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
                                    <input class="input width400 form-control" OnkeyUp="addText(this,'#alias_vn','#title_vn')" id="ten_vn" type="text" name="ten_vn" value="<?php echo @$items[0]['ten_vn']?>"  />
                                </td>
                            </tr>
                            <tr>
                                <td class="td_left">
                                    Đường dẫn:
                                </td>
                                <td class="td_right">
                                        <input class="input width400 form-control" name="alias_vn" id="alias_vn" value="<?php echo @$items[0]['alias_vn']?>"   OnkeyUp="addText(this,'#alias_vn')" />
                                </td>
                            </tr>
                            <!--tr>
                                <td class="td_left">
                                    Phân loại:
                                </td>
                                <td class="td_right">
                                    <select class="input width400 form-control" name="danh_muc" id="danhmuc">
                                        <option <?php if($items[0]['danh_muc'] == 0){echo "selected";} ?> value="0">Tìm kiếm chung</option>
                                        <option <?php if($items[0]['danh_muc'] == 1){echo "selected";} ?> value="1">Tiện ích</option>
                                        <option <?php if($items[0]['danh_muc'] == 2){echo "selected";} ?> value="2">Loại bất động sản</option>
                                        <option <?php if($items[0]['danh_muc'] == 3){echo "selected";} ?> value="3">Địa điểm</option>
                                    </select>
                                </td>
                            </tr-->
                            <!--tr id="tien_ich" style="opacity: <?php if($items[0]['danh_muc'] == 2){echo "1";}else{echo "0";}?>;">
                                <td class="td_left">
                                    Tiện ích:
                                </td>
                                <td class="td_right">
                                    <select class="select2 input width400 form-control" name="tien_ich[]" multiple="multiple">
                                        <?php 
                                        $tienich=$d->o_fet("select * from #_timkiem where danh_muc=1 and hide = 1");
                                        foreach ($tienich as $key => $value) {?>
                                        <option <?php  if (strlen(strstr($items[0]['tien_ich'], ','.$value['id'].',')) > 0) {echo "selected";}?> value="<?=$value['id']?>"><?=$value['ten_vn']?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr-->
                            
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
                            Số thứ tự:
                        </td>
                        <td class="td_right">
                            <input type="text" name="stt" value="<?php if(isset($items[0]['stt'])) echo $items[0]['stt']; else echo @count($soluong)+1; ?>" class="input width400 form-control" style="width:60px">
                        </td>
                    </tr>
                    <tr>
                        <td class="td_left">
                            Hiển thị:
                        </td>
                        <td class="td_right">
                            <input type="checkbox" class="chkbox" name="hide" <?php if(isset($items[0]['hide'])){	if(@$items[0]['hide']==1) echo 'checked="checked"';	else echo'';}else echo 'checked="checked"';	?>>
                        </td>
                    </tr>
                    <tr>
                        <td class="td_left" style="text-align:right">
                            <input type="submit" value="Lưu" class="btn btn-primary" />
                        </td>
                        <td class="td_right">
                            <input type="button" value="Thoát" onclick="javascript:window.location='index.php?p=timkiem&a=man'" class="btn btn-primary" />
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