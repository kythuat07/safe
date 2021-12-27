<?php


error_reporting();
@include "../lib/config.php";
@include "../lib/function.php";
	
global $d;
$d = new func_index($config['database']);

include '../php/PHPExcel/IOFactory.php';



$inputFileName = $_FILES['file']['tmp_name'];
echo 'Loading file ',pathinfo($inputFileName,PATHINFO_BASENAME),' using IOFactory to identify the format<br />';
$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);


//echo '<hr />';
//echo '<br>Data: <table width="100%" cellpadding="3" cellspacing="0"><tr>';

$id = (isset($_REQUEST['id'])) ? addslashes($_REQUEST['id']) : "";


$d->setTable('#_sanpham');

$data =array();
foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
    $worksheetTitle     = $worksheet->getTitle();
    $highestRow         = $worksheet->getHighestRow(); // e.g. 10
    $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
    
   /* for ($row = 1; $row <= $highestRow; ++ $row) {

        echo '<tr>';
        for ($col = 0; $col < $highestColumnIndex; ++ $col) {
            $cell = $worksheet->getCellByColumnAndRow($col, $row);
            $val = $cell->getValue();
            if($row === 1)
            echo '<td style="background:#000; color:#fff;">' . $val . '</td>';
            else
                echo '<td>' . $val . '</td>';
        }
        echo '</tr>';
    }*/
	
	for ($row = 2; $row <= $highestRow; ++ $row) {
		
		$val		= array();
		$file_name	= $d->fns_Rand_digit(0,9,12);
		
		for ($col = 0; $col < $highestColumnIndex; ++ $col) {
		   $cell = $worksheet->getCellByColumnAndRow($col, $row);
		   $val[] = $cell->getValue();
		   
			if(@$file = $d->upload_image($val['3'], '', '../img_data/images/',$file_name)){
				
				$data['hinh_anh'] = $file;
			}
		   
			$data['id_loai'] 	= addslashes($_POST['id_loai']);
			$data['ma_sp']   	= $d->chuoird(4);
			
			$data['ten_vn']  		= $val['0'];
			$data['mo_ta_vn'] 		= $val['1'];
			$data['thong_tin_vn']   = $val['2'];
			$data['thong_so_vn'] 	= $val['3'];
			$data['thong_tai_vn'] 	= $val['4'];
			$data['thong_chon_vn'] 	= $val['5'];
			
			$data['ma_sp'] 			= $val['6'];

			$data['gia'] 			= $val['7'];
			
			$data['alias_vn'] = $d->bodautv($data['ten_vn']);
			if($d->checkLink($data['alias_vn'],"alias_vn",$id ) && $data['alias_vn']!='') {
			$data['alias_vn'].="-".rand(0,99);
			}

			$data['title_vn'] = $val['8'];
			$data['keyword']  = $val['9'];
			$data['des'] 	  = $val['10'];
			
		
			$data['extra0'] = addslashes($_POST['thuonghieu']);
			$data['extra1'] = addslashes($_POST['model']);
			$data['extra2'] = addslashes($_POST['nam']);
	
			$data['style'] = 0;
			
			$data['hien_thi'] = isset($_POST['hien_thi']) ? 1 : 0;
			$data['tieu_bieu'] = isset($_POST['tieu_bieu']) ? 1 : 0;
			$data['sp_moi'] = isset($_POST['sp_moi']) ? 1 : 0;
			$data['sp_hot'] = isset($_POST['sp_hot']) ? 1 : 0;
	
			$data['ngay_dang'] = time();
		}
		
		 $d->insert($data);

	}
	
    
}
$d->redirect(urladmin."index.php?p=san-pham&a=man");

//echo '</table>';





?>
