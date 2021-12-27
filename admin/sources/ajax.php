<?php
	define('_lib','../lib/');
	@include _lib."config.php";
	@include_once _lib."function.php";
	$d = new func_index($config['database']);

	$do = addslashes($_POST['do']);
	
	if($do=='update_stt') {
		$table = $_POST['table'];
		$col = $_POST['col'];
		$val = $_POST['val'];
		$id = $_POST['id'];
		$d->o_que("update $table set $col=$val where id=$id");
	}
	else if($do=='get_list_extra') {

		$id = $_POST['id'];
		$id =implode(", ", $id);
		$list = $d->o_fet("select * from #_extra where id IN ($id) order by stt asc,id desc");
		//$selected="selected='selected'";
		//echo $str1 ='<option></option>';
		foreach($list as $a) {
			
			echo $str = "<option value='{$a['id']}' >{$a['title_vn']}</option>";
		}

	}
	if($do =='check_key'){
        $key1 = md5(trim($_SERVER["SERVER_NAME"],'www.'));
		$key2 = $d->simple_fetch("select * from #_thongtin");
		if (!empty($key2['code'])){
			$arr = explode('-',$key2['code']);
			$c=0;
			foreach ($arr as $key){
				$key=trim($key,'');
				if ($key1==$key)
					$c++;
			}
			if ($c==0)
			echo 'ok';
		}else{
			echo 'ok';
		}
    }

?>