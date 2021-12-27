<?php

	class func_index{
		// global $rf;
		var $db = "";
		var $result = "";
		var $insert_id = "";
		var $sql = "";
		var $table = "";
		var $where = "";
		var $order = "";
		var $limit = "";

		var $servername = "";
		var $username = "";
		var $password = "";
		var $database = "";
		var $refix = "";

		function func_index($config = array())
		{
			if(!empty($config))
			{
				$this->init($config);
				$this->connect();
			}
		}

		function init($config = array()){
		foreach($config as $k=>$v)
			$this->$k = $v;
		}

		function connect(){
			try {
			    $this->db = new PDO("mysql:host=$this->servername;dbname=$this->database;charset=utf8", $this->username, $this->password);
			    // set the PDO error mode to exception
			    $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			    $this->db->exec("set names utf8");
			     // echo "Connected successfully"; 

			}
			catch(PDOException $e){
			    echo "Connection failed: " . $e->getMessage();
			}

			// mysql_query('SET NAMES "utf8"',$this->db);
		}

		function disconnect()
		{
			$this->db = null;
		}

		function catchuoi($chuoi,$gioihan)
		{
			$chuoi = strip_tags($chuoi);
			if(strlen($chuoi)<=$gioihan)
			{
				return $chuoi;
			}
			else{
				if(strpos($chuoi," ",$gioihan) > $gioihan){
					$new_gioihan=strpos($chuoi," ",$gioihan);
					$new_chuoi = substr($chuoi,0,$new_gioihan)." ...";
					return $new_chuoi;
				}
				$new_chuoi = substr($chuoi,0,$gioihan);
				return $new_chuoi;
			}
		}

		function catchuoi_new($text, $n=80)
	    {
	        // string is shorter than n, return as is
	        if (strlen($text) <= $n) {
	            return $text;
	        }
	        $text= substr($text, 0, $n);
	        if ($text[$n-1] == ' ') {
	            return trim($text)."...";
	        }
	        $x  = explode(" ", $text);
	        $sz = sizeof($x);
	        if ($sz <= 1)   {
	            return $text."...";}
	        $x[$sz-1] = '';
	        return trim(implode(" ", $x))."...";
	    }

		function bodautv($str)
		{
		$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|�� �|ắ|ặ|ẳ|ẵ)/", 'a', $str);
		$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
		$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
		$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|�� �|ợ|ớ|ở|ỡ)/", 'o', $str);
		$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
		$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
		$str = preg_replace("/(đ)/", 'd', $str);
		$str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|�� �|Ặ|Ẳ|Ẵ)/", 'A', $str);
		$str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
		$str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
		$str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|�� �|Ợ|Ở|Ớ|Ỡ)/", 'O', $str);
		$str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
		$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
		$str = preg_replace("/(Đ)/", 'D', $str);
		$str = preg_replace("/( )/", '-', $str);
		$str = preg_replace("/(\?)/", '-', $str);
		$str = preg_replace("/(:)/", '-', $str);
		$str = preg_replace("/(&)/", '', $str);
		$str = preg_replace("/,/", '-', $str);
		$str = preg_replace("/-+-/",'-',$str);

		$str = trim($str,'-');
		return $str;
		}


		function select($str = "*"){
			$this->sql = "select " . $str;
			$this->sql .= " from " . $this->refix .$this->table;
			$this->sql .=  $this->where;
			$this->sql .=  $this->order;
			$this->sql .=  $this->limit;
			$this->sql = str_replace('#_', $this->refix, $this->sql);
			return $this->query();
		}

		function query($sql)
		{
			$this->sql = str_replace('#_', $this->refix, $sql);
			$stmt = $this->db->prepare($this->sql); 
    		// $stmt->execute();
			return $stmt->execute();
		}
		

		function fetch_array($sql)
		{

			$arr = array();
			$this->sql = str_replace('#_', $this->refix, $sql);
			$stmt = $this->db->prepare($this->sql); 
    		$stmt->execute();
    		return $stmt->fetchAll();
		}



		public function fetch()
		{

			$arr = array();
			$this->sql = str_replace('#_', $this->refix, $this->sql);
			$stmt = $this->db->prepare($this->sql); 
    		$stmt->execute();
    		return $stmt->fetchAll();
		}

		public function o_fet($sql){
			$this->sql = $sql;
			return $this->fetch();
		}

		public function o_fet_class($sql){
			$this->sql = $sql;
			return $this->fetch_class();
		}

		public function fetch_class()
		{
			$arr = array();
			$this->sql = str_replace('#_', $this->refix, $this->sql);
			$stmt = $this->db->prepare($this->sql); 
    		$stmt->execute();
    		return $stmt->fetchAll(PDO::FETCH_CLASS);
		}

		public function o_sel($sel,$table, $where = "", $order = "", $limit = ""){
			if( $where <> '')  $where = " where ". $where;
			else $where = "";

			if( $order <> '')  $order = " order by ". $order;
			else $order = "";

			if( $limit <> '')  $limit = " limit ". $limit;
			else $limit = "";

			$sql = "select ".$sel. " from ".$table." ".$where.$order.$limit;
			$this->sql = $sql;
			return $this->fetch();
			// return $sql;
		}

		public function o_que($sql){
			$this->sql = $sql;
			return $this->que();
		}

		function assoc_array($sql)
		{
			$this->sql = str_replace('#_', $this->refix,$sql);
			$stmt = $this->db->prepare($this->sql); 
    		$stmt->execute();
    		return $stmt->fetchAll();
		}

		function num_rows($sql)
		{
			$this->sql = str_replace('#_', $this->refix, $sql);
			$stmt = $this->db->prepare($this->sql); 
    		$stmt->execute();
    		return $stmt->rowCount(); 
		}

		function num()
		{
			$this->sql = str_replace('#_', $this->refix, $this->sql);
			$stmt = $this->db->prepare($this->sql); 
    		$stmt->execute();
    		return $stmt->rowCount(); 
		}

		function que()
		{
			$this->sql = str_replace('#_', $this->refix, $this->sql);
			$stmt = $this->db->prepare($this->sql); 
			return $stmt->execute();
    		// return $stmt->fetchAll();
		}

		function setTable($str)
		{
			$this->table = $str;
		}

		function setWhere($col,$dk)
		{
			if($this->where == "")
			{
				$this->where = " where ".$col." = '".$dk."'";
			}
			else
			{
				$this->where .= " and ".$col." = '".$dk."'";
			}
		}

		function setWhereOrther($col,$dk)
		{
			if($this->where == "")
			{
				$this->where = " where ".$col." <> '".$dk."'";
			}
			else
			{
				$this->where .= " and ".$col." <> '".$dk."'";
			}
		}

		function setWhereOr($col,$dk)
		{
			if($this->where == "")
			{
				$this->where = " where ".$col." = '".$dk."'";
			}
			else
			{
				$this->where .= " or ".$col." = '".$dk."'";
			}
		}

		function setOrder($str)
		{
			$this->order = " order by " . $str;
		}

		function setLimit($str)
		{
			$this->limit = " limit " . $str;
		}

		function reset()
		{
			$this->sql = "";
			$this->result = "";
			$this->where = "";
			$this->order = "";
			$this->limit = "";
			$this->table = "";
		}

		function insert($data = array())
		{
			$into = "";
			$values = "";
			foreach ($data as $int => $val) {
				$into .= ",".$int;
				$values .= ",'".$val."'";
			}
			if($into{0} == ",") $into{0} = "(";
			$into .=")";
			if($values{0} == 0) $values{0} = "(";
			$values .= ")";

			$this->sql = "insert into ".$this->table.$into." values ".$values;			
			$this->sql = str_replace('#_', $this->refix, $this->sql);

			$stmt = $this->db->prepare($this->sql); 
			$stmt->execute();
			return $this->db->lastInsertId();
		}

		function update($data = array())
		{
			$values = "";
			foreach ($data as $col => $val) {
				$values .= ",".$col." = '".$val."' ";
			}
			if($values{0} == ",") $values{0} = " ";
			$this->sql = "update ".$this->table." set ".$values.$this->where;

			$this->sql = str_replace('#_', $this->refix, $this->sql);
			$this->result = $this->query($this->sql);
			return $this->result;

		}

		function delete()
		{
			$this->sql = "delete from ".$this->table.$this->where;

			$this->sql = str_replace('#_', $this->refix, $this->sql);
			return $this->query($this->sql);
		}
		// other-----------------------------
		function replaceHTMLCharacter($str)
		{
			$str  = preg_replace('/&/',		'&amp;',	$str);
			$str  = preg_replace('/</',		'&lt;',		$str);
			$str  = preg_replace('/>/',		'&gt;',		$str);
			$str  = preg_replace('/\"/',	'&quot;',	$str);
			$str  = preg_replace('/\'/',	'&apos;',	$str);
			return $str;
		}

		function alert($str)
		{
			echo '<script language="javascript"> alert("'.$str.'") </script>';
		}

		function location($url)
		{
			echo '<script language="javascript">window.location = "'.$url.'" </script>';
		}

		function themdau($str)
		{
			$str = addslashes($str);
			return $str;
		}

		function bodau($str)
		{
			$str = stripslashes($str);
			return $str;
		}

		function vnd($money)
		{
			return number_format($money,0,'.','.'). ' VND';
		}

		function dolla_vnd($money)
		{
			return "$".number_format($money,0,'.','.');
		}

		function usd($money)
		{
			return number_format($money,2,',','.'). ' USD';
		}
		function chuoird($length) {
			$str ='';
			$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			$size = strlen( $chars );
			for( $i = 0; $i < $length; $i++ ) {
			$str .= $chars[ rand( 0, $size - 1 ) ];
			}
			return $str;
		}

	
		function phantrang($r, $url='', $curPg=1, $mxR=5, $mxP=5,$classunlink='', $classlink='',$getName)
		{
			if($curPg<1) $curPg=1;
			if($mxR<1) $mxR=5;
			if($mxP<1) $mxP=5;
			$totalRows=count($r);
			if($totalRows==0)
				return array('source'=>NULL, 'paging'=>NULL);
			$totalPages=ceil($totalRows/$mxR);
			if($curPg > $totalPages) $curPg=$totalPages;

			$_SESSION['maxRow']=$mxR;
			$_SESSION['curPage']=$curPg;

			$r2=array();
			$paging="";

			//-------------tao array------------------
			$start=($curPg-1)*$mxR;
			$end=($start+$mxR)<$totalRows?($start+$mxR):$totalRows;

			$j=0;
			for($i=$start;$i<$end;$i++)
				$r2[$j++]=$r[$i];

			//-------------tao chuoi------------------
			$curRow = ($curPg-1)*$mxR+1;
			if($totalRows > $mxR)
			{
				$start=1;
				$end=1;
				$paging1 ="";
				for($i=1;$i<=$totalPages;$i++)
				{
					
						if($start==1) $start=$i;

						if($curPg < 2){
							if($i == $curPg){
								$paging1.="<span page='$i' class=\"{$classunlink}\">".$i."</span>";//dang xem
							}
							else if($i > ( $curPg - 3) && $i < ( $curPg + 5)) 
							{
								$paging1 .= " <a page='$i' href='".$url."&".$getName."=".$i."'  class=\"{$classlink}\"><span >".$i."</span></a> ";
							}
						}
						else if($curPg == 2){
							if($i == $curPg){
								$paging1.="<span page='$i' class=\"{$classunlink}\">".$i."</span>";//dang xem
							}
							else if($i > ( $curPg - 3) && $i < ( $curPg + 4)) 
							{
								$paging1 .= " <a page='$i' href='".$url."&".$getName."=".$i."'  class=\"{$classlink}\"><span >".$i."</span></a> ";
							}
						}
						else if(($curPg + 1) == $totalPages) {
							if($i == $curPg){
								$paging1.="<span page='$i' class=\"{$classunlink}\">".$i."</span>";//dang xem
							}
							else if($i > ( $curPg - 4) && $i < ( $curPg + 2)) 
							{
								$paging1 .= " <a page='$i' href='".$url."&".$getName."=".$i."'  class=\"{$classlink}\"><span >".$i."</span></a> ";
							}
						}
						else if($curPg  == $totalPages) {
							if($i == $curPg){
								$paging1.="<span class=\"{$classunlink}\">".$i."</span>";//dang xem
							}
							else if($i > ( $curPg - 5) && $i < ( $curPg + 1)) 
							{
								$paging1 .= " <a page='$i' href='".$url."&".$getName."=".$i."'  class=\"{$classlink}\"><span >".$i."</span></a> ";
							}
						}
						else{
							if($i == $curPg){
								$paging1.="<span class=\"{$classunlink}\">".$i."</span>";//dang xem
							}
							else if($i > ( $curPg - 3) && $i < ( $curPg + 3)) 
							{
								$paging1 .= " <a page='$i' href='".$url."&".$getName."=".$i."'  class=\"{$classlink}\"><span >".$i."</span></a> ";
							}
						}
						
	
						$end=$i;
	
				}//tinh paging

				$paging .=" <a  href='".$url."' page='1' class=\"{$classlink}\" >&laquo;</a> "; //ve dau

				$paging .=" <a page='".($curPg-1)."' href='".$url."&".$getName."=".($curPg-1)."' class=\"{$classlink}\" >&#8249;</a> "; //ve truoc
				#}
				$paging.=$paging1;

				$paging .=" <a page='".($curPg+1)."' href='".$url."&".$getName."=".($curPg+1)."' class=\"{$classlink}\" >&#8250;</a> "; //ke

				$paging .=" <a page='$totalPages' href='".$url."&".$getName."=".($totalPages)."' class=\"{$classlink}\" >&raquo;</a> "; //ve cuoi
			}
			$r3['curPage']=$curPg;
			$r3['source']=$r2;
			$r3['paging']=$paging;
			return $r3;
		}

		function fullAddress(){
		    $adr = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 'https://' : 'http://';
		    $adr .= isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : getenv('HTTP_HOST');
		    $adr .= isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : getenv('REQUEST_URI');
		    $adr2 = explode('&page=', $adr);
			return $adr2[0];
		}

		function fullAddress1(){
		    $adr = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 'https://' : 'http://';
		    $adr .= isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : getenv('HTTP_HOST');
		    $adr .= isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : getenv('REQUEST_URI');
		    $adr2 = explode('&page=', $adr);
		    $adr3 = explode('&sort=', $adr2[0]);
			return $adr3[0];
		}
		function fullAddress2(){
		    $adr = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 'https://' : 'http://';
		    $adr .= isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : getenv('HTTP_HOST');
		    $adr .= isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : getenv('REQUEST_URI');
		    $adr2 = explode('&page=', $adr);
		    $adr3 = explode('&limit=', $adr2[0]);
			return $adr3[0];
		}

		function fns_Rand_digit($min,$max,$num)
		{
			$result='';
			for($i=0;$i<$num;$i++){
				$result.=rand($min,$max);
			}
			return $result;
		}

		function upload_image($file, $extension, $folder, $newname=''){
			if(isset($_FILES[$file]) && !$_FILES[$file]['error']){

				$ext = end(explode('.',$_FILES[$file]['name']));
				$name = basename($_FILES[$file]['name'], '.'.$ext);

				// if(strpos($extension, $ext)===false){
				// 	alert('Chỉ hỗ trợ upload file dạng '.$extension);
				// 	return false; // không hỗ trợ
				// }

				if($newname=='' && file_exists($folder.$_FILES[$file]['name']))
					for($i=0; $i<100; $i++){
						if(!file_exists($folder.$name.$i.'.'.$ext)){
							$_FILES[$file]['name'] = $name.$i.'.'.$ext;
							break;
						}
					}
				else{
					$_FILES[$file]['name'] = $this->bodautv($name).$newname.'.'.$ext;
				}

				if (!copy($_FILES[$file]["tmp_name"], $folder.$_FILES[$file]['name']))	{
					if ( !move_uploaded_file($_FILES[$file]["tmp_name"], $folder.$_FILES[$file]['name']))	{
						return false;
					}
				}
				return $_FILES[$file]['name'];
			}
			return false;
		}

		function upload_image_2($file, $extension, $folder, $newname=''){
			if(isset($_FILES[$file]) && !$_FILES[$file]['error']){
				
				if (!copy($_FILES[$file]["tmp_name"], $folder.$_FILES[$file]['name']))	{
					if ( !move_uploaded_file($_FILES[$file]["tmp_name"], $folder.$_FILES[$file]['name']))	{
						return false;
					}
				}
				return $_FILES[$file]['name'];
			}
			return false;
		}

		function upfile($file, $folder, $newname=''){
			if(isset($_FILES[$file]) && !$_FILES[$file]['error']){

				$ext = end(explode('.',$_FILES[$file]['name']));
				$name = basename($_FILES[$file]['name'], '.'.$ext);

				if($newname=='' && file_exists($folder.$_FILES[$file]['name']))
					for($i=0; $i<100; $i++){
						if(!file_exists($folder.$name.$i.'.'.$ext)){
							$_FILES[$file]['name'] = $name.$i.'.'.$ext;
							break;
						}
					}
				else{
					$_FILES[$file]['name'] = $newname.'.'.$ext;
				}

				if (!copy($_FILES[$file]["tmp_name"], $folder.$_FILES[$file]['name']))	{
					if ( !move_uploaded_file($_FILES[$file]["tmp_name"], $folder.$_FILES[$file]['name']))	{
						return false;
					}
				}
				return $_FILES[$file]['name'];
			}
			return false;
		}

		function mutil_upload_image($tenfile , $folder){
			$name = array();
            $tmp_name = array();
            $tenhinh = array();
            $type = array();
            foreach ($_FILES[$tenfile]['name'] as $file) {
                $name[] = $file;
            }
            foreach ($_FILES[$tenfile]['tmp_name'] as $file){
                $tmp_name[] = $file;
            }

            foreach ($_FILES[$tenfile]['type'] as $file){
                $type[] = $file;
            }

            $count  =  count($name);
            for ($i=0;$i<$count;$i++){

            	if($type[$i] == "image/jpeg"
		        || $type[$i] == "image/jpg"
		        || $type[$i] == "image/png"
		        || $type[$i] == "image/JPG"
		        || $type[$i] == "image/PNG"
		        || $type[$i] == "image/GIF"
		        || $type[$i] == "image/gif"){
					$filename = $this->fns_Rand_digit(0,9,3).'_'.$this->bodautv($name[$i]);

					if (move_uploaded_file($tmp_name[$i], $folder.$filename))	{
						$tenhinh[] = $filename;
					}
				}
            }
            return $tenhinh;
        }

        function create_thumb($file, $width, $height, $folder,$file_name,$folder_new,$zoom_crop='1'){
				$new_width   = $width;
				$new_height   = $height;

				 if ($new_width && !$new_height) {
				        $new_height = floor ($height * ($new_width / $width));
				    } else if ($new_height && !$new_width) {
				        $new_width = floor ($width * ($new_height / $height));
				    }
					
				$image_url = $folder.$file;
				$origin_x = 0;
				$origin_y = 0;
				// GET ORIGINAL IMAGE DIMENSIONS
				$array = getimagesize($image_url);
				if ($array)
				{
				    list($image_w, $image_h) = $array;
				}
				else
				{
				     die("NO IMAGE $image_url");
				}
				$width=$image_w;
				$height=$image_h;

				// ACQUIRE THE ORIGINAL IMAGE
				$image_ext = trim(strtolower(end(explode('.', $image_url))));
				switch(strtoupper($image_ext))
				{
				     case 'JPG' :
				     case 'JPEG' :
				         $image = imagecreatefromjpeg($image_url);
						 $func='imagejpeg';
				         break;
				     case 'PNG' :
				         $image = imagecreatefrompng($image_url);
						 $func='imagepng';
				         break;
					 case 'GIF' :
					 	 $image = imagecreatefromgif($image_url);
						 $func='imagegif';
						 break;

				     default : die("UNKNOWN IMAGE TYPE: $image_url");
				}

				// scale down and add borders
					if ($zoom_crop == 3) {

						$final_height = $height * ($new_width / $width);

						if ($final_height > $new_height) {
							$new_width = $width * ($new_height / $height);
						} else {
							$new_height = $final_height;
						}

					}

					// create a new true color image
					$canvas = imagecreatetruecolor ($new_width, $new_height);
					imagealphablending ($canvas, false);

					// Create a new transparent color for image
					$color = imagecolorallocatealpha ($canvas, 255, 255, 255, 127);

					// Completely fill the background of the new image with allocated color.
					imagefill ($canvas, 0, 0, $color);

					// scale down and add borders
					if ($zoom_crop == 2) {

						$final_height = $height * ($new_width / $width);
						
						if ($final_height > $new_height) {
							
							$origin_x = $new_width / 2;
							$new_width = $width * ($new_height / $height);
							$origin_x = round ($origin_x - ($new_width / 2));

						} else {

							$origin_y = $new_height / 2;
							$new_height = $final_height;
							$origin_y = round ($origin_y - ($new_height / 2));

						}

					}

					// Restore transparency blending
					imagesavealpha ($canvas, true);

					if ($zoom_crop > 0) {

						$src_x = $src_y = 0;
						$src_w = $width;
						$src_h = $height;

						$cmp_x = $width / $new_width;
						$cmp_y = $height / $new_height;

						// calculate x or y coordinate and width or height of source
						if ($cmp_x > $cmp_y) {

							$src_w = round ($width / $cmp_x * $cmp_y);
							$src_x = round (($width - ($width / $cmp_x * $cmp_y)) / 2);

						} else if ($cmp_y > $cmp_x) {

							$src_h = round ($height / $cmp_y * $cmp_x);
							$src_y = round (($height - ($height / $cmp_y * $cmp_x)) / 2);

						}

						// positional cropping!
						if ($align) {
							if (strpos ($align, 't') !== false) {
								$src_y = 0;
							}
							if (strpos ($align, 'b') !== false) {
								$src_y = $height - $src_h;
							}
							if (strpos ($align, 'l') !== false) {
								$src_x = 0;
							}
							if (strpos ($align, 'r') !== false) {
								$src_x = $width - $src_w;
							}
						}

						imagecopyresampled ($canvas, $image, $origin_x, $origin_y, $src_x, $src_y, $new_width, $new_height, $src_w, $src_h);

				    } else {

				        // copy and resize part of an image with resampling
				        imagecopyresampled ($canvas, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

				    }
					


				$new_file=$file_name.'_'.$new_width.'x'.$new_height.'.'.$image_ext;
				// SHOW THE NEW THUMB IMAGE
				if($func=='imagejpeg') $func($canvas, $folder_new.$file,95);
				else $func($canvas, $folder_new.$file,floor (95 * 0.09));

				return $new_file;
		}
		function transfer($msg,$page="index.php")
		{
			 $showtext = $msg;
			 $page_transfer = $page;
			 include("./templates/transfer_tpl.php");
			 exit();
		}

		function redirect($url=''){
			echo '<script language="javascript">window.location = "'.$url.'" </script>';
			exit();
		}

		function lay_show_hienthi($i){
			if($i == 1) return 15;
			else if($i == 2) return 25;
			else if($i == 3) return 50;
			else if($i == 4) return 75;
			else if($i == 5) return 100;
			else if($i == 6) return 200;
			else if($i == 7) return 300;
		}
		function cv_html($toptip){
			$toptip = preg_replace('/[\n\r\t]/', ' ', $toptip);
            $toptip = str_replace("<br/>","",$toptip);
            $toptip = str_replace("@[\s]{2,}@","",$toptip);
            $toptip = str_replace("\\n","&nbsp;",$toptip);
            $toptip = str_replace("\\r","&nbsp;",$toptip);
            $toptip = str_replace("\\r\\n","",$toptip);
            $toptip = str_replace("\"","&quot;",$toptip);
            $toptip = str_replace("<","&lt;",$toptip);
            $toptip = str_replace(">","&gt;",$toptip);
            $toptip = str_replace("&","&amp;",$toptip);
            $toptip = str_replace(",","&#44;",$toptip);
            $toptip = str_replace("(","&#40;",$toptip);
            $toptip = str_replace(")","&#41;",$toptip);
            $toptip = str_replace(";","&#59;",$toptip);
            $toptip = str_replace("\\","&#92;",$toptip);
            $toptip = str_replace("'","&#39;",$toptip);
            return $toptip;
		}
		function check_id_arr($id, $arr){
			$arr = explode(",", $arr);
			foreach ($arr as $ar) {
				if($id == $ar) {
					return true;
				}
			}
			return false;
		}

		function lay_nd_col($col, $table, $whe){
			$rs = $this->o_fet("select ".$col." from ".$table." where " .$whe);
			if(count($rs) > 0) return $rs[0][$col];
			else return "";
		}
		
		function show_menu_tt($menus_tt = array(), $lang, $parrent = 0, $link)
        {
            $i = 0;
            foreach ($menus_tt as $val)
            {
                global $d;
                if ($val['id_loai'] == $parrent)
                {
                	$i++; if($i == 1) echo '<ul class="nhom_tt_hide nhom_tt_'.$val['id_loai'].'">';
                    echo '<li>
                        <span class="span_nav" onclick="aj_showmn_mb_tt(this,\''.$val['id'].'\')">►</span><a href="'.URLPATH.$lang.$link.'/'.$val['alias_'.$_SESSION['lang']].'/">'.$val['ten_'.$_SESSION['lang']].'</a>';
                        $this->show_menu_tt($menus_tt,$lang, $val['id'],$link, false);
                    echo '</li>';
                }

            }
            if($i <> 0)  echo '</ul>';
        }

        function show_menu_tt_dt($menus_tt = array(), $lang, $parrent = 0, $link)
        {
            $i = 0;
            foreach ($menus_tt as $val)
            {
                global $d;
                if ($val['id_loai'] == $parrent)
                {
                	$i++; if($i == 1) echo '<ul class="nhom_tt_hide nhom_tt_'.$val['id_loai'].'">';
                    echo '<li>
                        <a href="'.URLPATH.$lang.$link.'/'.$val['alias_'.$_SESSION['lang']].'/">'.$val['ten_'.$_SESSION['lang']].'</a>';
                        $this->show_menu_tt_dt($menus_tt,$lang, $val['id'],$link, false);
                    echo '</li>';
                }

            }
            if($i <> 0)  echo '</ul>';
        }

        function show_menu_dl($menus_dl = array(),  $lang, $parrent = 0)
        {
               $i = 0;
                // echo '<ul>';
                foreach ($menus_dl as $val)
                {
                    global $d;
                    if ($val['id_loai'] == $parrent)
                    {
                        $i++;
                        if($i == 1) echo '<ul class="nhom_sp_hide nhom_sp_'.$val['id_loai'].'">';
                        echo '<li>

                        <span class="span_nav" onclick="aj_showmn_mb_sp(this,\''.$val['id'].'\')">►</span><a href="'.URLPATH.$lang._linksanpham."/".$val['alias_'.$_SESSION['lang']].'/">'.$val['ten_'.$_SESSION['lang']].'</a>';
                        $this->show_menu_dl($menus_dl, $lang,  $val['id'], false);
                        echo '</li>';
                    }

                }
                if($i <> 0)  echo '</ul>';
        }

        function show_menu_dl_sp_dt($menus_dl = array(), $lang, $parrent = 0)
        {
	           $i = 0;
	            // echo '<ul>';
	            foreach ($menus_dl as $val)
	            {
	                global $d;
	                if ($val['id_loai'] == $parrent)
	                {
	                    $i++;
	                    if($i == 1) echo '<ul>';
	                    echo '<li>';
	                    if($val['alias_'.$_SESSION['lang']] == 'pin-sac-du-phong-chinh-hang'){
	                    	echo '
	                    		<a href="'.URLPATH.'">'.$val['ten_'.$_SESSION['lang']].'</a>';
	                    }
	                    else echo '
	                    <a href="'.URLPATH.$lang._linksanpham."/".$val['alias_'.$_SESSION['lang']].'/">'.$val['ten_'.$_SESSION['lang']].'</a>';
	                    $this->show_menu_dl_sp_dt($menus_dl, $lang, $val['id'], false);
	                    echo '</li>';
	                }

	            }
	            if($i <> 0)  echo '</ul>';
	    }

	    function show_menu_tintuc_hd($menus = array(), $parrent = 0 ,&$chuoi = '')
	    {
	      foreach ($menus as $val)
	      {
	          if ($val['id_loai'] == $parrent)
	          {
	             $chuoi .= $val['id'].',';
	              $this->show_menu_tintuc_hd($menus, $val['id'],$chuoi);
	          }
	      }
	      return $chuoi;
	    }

	    function lay_alias_sp($id, $lang, $linksp){
    		$lsp = $this->o_sel('alias_vn, alias_us','#_loaisanpham', 'id = "'.$id.'"');
    		if(count($lsp) > 0) return $lsp[0]['alias_'.$lang]."/";
    		else return $linksp."/";
	    }

	    function lay_ten_sp($id, $lang, $linksp){
    		$lsp = $this->o_sel('ten_vn, ten_us','#_loaisanpham', 'id = "'.$id.'"');
    		if(count($lsp) > 0) return $lsp[0]['ten_'.$lang];
    		else return $linksp;
	    }

	    function lay_ten_tintuc($alias, $lang){
    		$lsp = $this->o_sel('ten_vn, ten_us','#_loaitintuc', 'alias_'.$lang.' = "'.$alias.'"');
    		if(count($lsp) > 0) return $lsp[0]['ten_'.$lang];
    		else return "";
	    }
	    function show_menu_2($menus = array(), $parrent = 0 ,&$chuoi = '')
        {
            foreach ($menus as $val)
            {
                if ($val['id_loai'] == $parrent)
                {
                   $chuoi .= $val['id'].',';
                    $this->show_menu_2($menus, $val['id'],$chuoi);
                }
            }
            return $chuoi;
        }
        function check_ptram($giacu, $giamoi){
        	return round((($giacu - $giamoi) * 100 / $giacu));
        }
		
		
		
		function simple_fetch($sql) {
			$arr = array();
			$this->sql = str_replace('#_', $this->refix, $sql);
			$stmt = $this->db->prepare($this->sql); 
    		$stmt->execute();
    		// $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    		$result = $stmt->fetchAll();	
    		if(!empty($result)){
    			return $result[0];
    		}
    		return array();
		}
		
		function create_long_link($alias,$lang) {
			$str="";
			if($this->num_rows("select * from #_category where alias_{$lang}='$alias' and hien_thi=1 ") > 0) {
				$link=$this->o_fet("select * from #_category where alias_{$lang}='$alias' and hien_thi=1 ");
				$str=$link[0]['alias_'.$lang];				
			}
			else if($this->num_rows("select * from #_tintuc where alias_{$lang}='$alias'") > 0) {
				$link=$this->o_fet("select * from #_tintuc where alias_{$lang}='$alias'");
				$str=$link[0]['alias_'.$lang];
			}
			else if($this->num_rows("select * from #_sanpham where alias_{$lang}='$alias'") > 0) {
				$link=$this->o_fet("select * from #_sanpham where alias_{$lang}='$alias'");
				$str=$link[0]['alias_'.$lang];			
			}
			return $str;
		}
		
		function getTemplates($id) {
			$str=$this->simple_fetch("select * from #_setting where hien_thi=1 and id=$id");
			return $str;
		}
		
		function getImg($parent,$limit,$and) {
			$str = $this -> o_fet("select * from #_gallery where hide = 1 and parent = $parent $and order by stt asc, id asc $limit");
			return $str;
		}
		function getSlider() {
			$result = $this -> o_fet("select * from #_gallery where hide = 1 and parent = 1130 order by id desc");
			return $result;
		}
		
		function findIdSub($id,$level=0) {
			$str="";
			$query=$this->o_fet("select * from #_category where id_loai=$id and hien_thi=1 order by so_thu_tu asc, id desc");
			if(count($query>0)) {
				foreach($query as $item) {
					$str.=",".$item['id'];
					$check=$this->o_fet("select * from #_category where id_loai={$item['id']} and hien_thi=1 order by so_thu_tu asc, id desc");
					if(count($check)>0 && $level==0) {
						$str.=$this->findIdSub($item['id']);
					}
				}
			}
			return $str;
		}
		
		
		function getActive($alias,$lang) {
			if($alias!='') {
				$query=$this->simple_fetch("select * from #_category where alias_$lang = '$alias' ");
				
				if(count($query)>0) {

					$_SESSION['nav'][$query['level']]=$query['id'];
					if($query['level']>0) {
						
						$sub=$this->simple_fetch("select * from #_category where id = {$query['id_loai']} ");
						$this->getActive($sub['alias_'.$lang],$lang);
					}
				}
				$query1=$this->o_fet("select id,id_loai from #_tintuc where alias_$lang = '$alias' ");
				$query2=$this->o_fet("select id,id_loai from #_sanpham where alias_$lang = '$alias' ");
				if(count($query1)>0 || count($query2)>0) {
					if(count($query1)>0){
						$id_loai=$query1[0]['id_loai'];
					}else if(count($query2)>0){
						$id_loai=$query2[0]['id_loai'];	
					}					
					$nav=$this->simple_fetch("select * from #_category where id = $id_loai ");
					$_SESSION['nav'][$nav['level']]=$nav['id'];
					$this->getActive($nav['alias_'.$lang],$lang);
				}
			}

		}
		
		function breadcrumb($id,$lang,$path) {
			$str="";
			$query=$this->simple_fetch("select * from #_category where id=$id and hien_thi=1");
			$str.="<li><a href='".$path.$this->create_long_link($query['alias_'.$lang],$lang).".html' title='{$query['ten_'.$lang]}'>{$query['ten_'.$lang]}</a></li>";
			if($query['id_loai']>0) {
				$str=$this->breadcrumb($query['id_loai'],$lang).$str;
			}
			return $str;
		}
		function breadcrumbid($id,$lang,$path) {
			$str="";
			$query=$this->simple_fetch("select * from #_category where id=$id and hien_thi=1");
			$str.=$query['id'].",";
			if($query['id_loai']>0) {
                            $i++;
                            $str=$this->breadcrumbid($query['id_loai'],$lang).$str;
			}
			return $str;
		}
		function breadcrumblist($id,$lang,$path) {
			$BreadcrumbList =  trim($this->breadcrumbid($id,$lang,$path),',');
			$arrBrceList = explode(',', $BreadcrumbList);
                        $dem = count($arrBrceList);
			$j=2;
			$itemBrcelist="";
			for($i=0;$i<count($arrBrceList);$i++){ 
                            if($i+1 == $dem ){
                                $act = 'class="active"';
                            }else{
                                $act="";
                            }
				$row=$this->simple_fetch("select * from #_category where id = '".$arrBrceList[$i]."'");
				$itemBrcelist.=' 
                                    <li property="itemListElement" typeof="ListItem"> 
                                        <a '.$act.' property="item" typeof="WebPage" href="'.$path.$row['alias_vn'].'.html"> 
                                            <span property="name">'.$row['ten_vn'].'</span>
                                        </a> <meta property="position" content="'.$j.'"> 
                                    </li>';
				$j++;
			}
			
			$Brcelist='
				<ol vocab="https://schema.org/" typeof="BreadcrumbList" class="breadcrumb"> 
                                    <li property="itemListElement" typeof="ListItem"> 
                                        <a property="item" typeof="WebPage" href="'.$path.'"> 
                                                <span property="name">Trang chủ</span>
                                        </a> <meta property="position" content="1"> 
                                    </li>
                                    '.$itemBrcelist.'
				</ol>';
			return $Brcelist;
		}
		function checkLink($text,$field,$id) {
			$and="";
			if($id!='') {
				$and.=" and id!=$id";
			}
			
			$count=$this->num_rows("select id from #_category where $field='{$text}' $and");
			$count1=$this->num_rows("select id from #_sanpham where $field='{$text}' $and");
			$count2=$this->num_rows("select id from #_tintuc where $field='{$text}' $and");
			
			if($count==0 && $count1==0 && $count2==0) {
				return false;
			}
			else {
				return true;
			}

		}
		
		function clear($html) {
			$str="";
			$str = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $html);
			return $str;
		}
		
		function generateUniqueToken($username) {
			$token = time() . rand(10, 5000) . sha1(rand(10, 5000)) . md5(__FILE__);
			$token = str_shuffle($token);
			$token = sha1($token) . md5(microtime()) . md5($username);
			return $token;
		}
		function getPassHash($token,$password) {
			$password_hash=md5(md5($token) . md5($password));
			return $password_hash;
		}			
		
		function clean($str) {
			$str = @trim($str);
			if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
			}
			return strip_tags($str);
		}

		function subText($text,$num) {
			$str_len = strlen($text);
			if($str_len<$num) {
				$str = $text;
			}
			else {
				$str = mb_substr($text, 0,$num,'UTF-8')."...";
			}
			return $str;
		}

		function link_redirect($alias = ''){
			$link_web = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			$link_goc = URLPATH.$alias;
			   
			if($link_web != $link_goc){
			    $this->redirect($link_goc);
			}
		}
		
		function array_category($id_loai=0,$plit="=",$select_="",$module=0,$notshow=0) {

			$str="";
			$and = ($notshow>0) ? " and id!=$notshow" : '';

			if($id_loai==0) {
				$query = $this->o_fet("select * from #_category where id_loai=0 $and order by so_thu_tu asc, id desc");	
				echo $d->sql;
				$plit="";
			}
			else {
				$query = $this->o_fet("select * from #_category where id_loai=$id_loai $and order by so_thu_tu asc, id desc");
				echo $d->sql;
				$plit.="= ";
			}
			
			foreach($query as $item) {	
				if($item['id']==$select_){ $selected="selected='selected'";} else{ $selected="";}
				if($module>0) {
					if($item['module']==$module) {
						$str.="<option value='".$item['id']."' ".$selected.">".$plit." ".$item['ten_vn']."</option>";
					}
				}
				else {
					$str.="<option value='".$item['id']."' ".$selected.">".$plit." ".$item['ten_vn']."</option>";
				}
				
				$check_sub = $this->num_rows("select * from #_category where id_loai='{$item['id']}'");

				if($check_sub>0) {
					$str.=$this->array_category($item['id'],$plit,$select_,$module,$notshow);
				}
			}
			return $str;
		}
		
		function showEx($id,$lang){
			$query = $this->simple_fetch("select * from #_extra where id=$id");
			return $query['title_'.$lang];
		}

		function many_extra($post) {
			$str = "";
			$post = $this->clear($post);
			foreach($post as $item) {
				$str.=",".$item;
			}
			return $str;
		} 
		
		public function checkUserPermission($id_user, $page) {
			$count = 0;
			$array_temp = array();
			$query = $this->o_fet("select * from #_user_permission_group where id_user=$id_user");
			if(!empty($query)){
				foreach ($query as $key => $value) {
					$result = $this->o_fet("select * from #_permission_group where id={$value['id_permission']}");
					if(!empty($result)){
						foreach ($result as $k => $v) {
							if($v['id_loai'] == 0){
								array_push($array_temp, $v['page']);
								$listChild = $this->o_fet("select * from #_permission_group where id_loai={$v['id']}");
								foreach ($listChild as $child) {
									array_push($array_temp, $child['page']);
								}
							}
							else{
								array_push($array_temp, $v['page']);
							}
						}
					}
				}								
			}
			if(in_array($page, $array_temp)){
				$count = 1;
			}
			return $count;
	    }

	    public function checkChildPermission ($id_user, $page){
	    	$count = 0;
			$array_temp = array();
			$query = $this->simple_fetch("select * from #_permission_group where page='".$page."'");
			if(!empty($query)){
				$check_parent = $this->simple_fetch("select * from #_user_permission_group where id_user = '".$id_user."' and id_permission ='".$query['id']."'");
				if(!empty($check_parent)){
					return 1;
				}
				$check = $this->o_fet("select * from #_permission_group where id_loai={$query['id']}");
				if(!empty($check)){
					foreach ($check as $key => $value) {
						$check_id = $this->simple_fetch("select * from #_user_permission_group where id_user = '".$id_user."' and id_permission ='".$value['id']."'");
						if(!empty($check_id)){
							return 1;
						}
					}
				}								
			}
			
			return $count;
	    }

	      function token() {
		   return sha1(time().rand(0,99999));
		  }
		  
		  function tag_img($text) {
		   preg_match_all('/<img[^>]+>/i',$text, $str);
		   return $str[0][0];
		  }
		  
		  function generate_username_from_text($strText) {
		   $strText=preg_replace('/[^A-Za-z0-9-]/',' ',$strText);
		   $strText=preg_replace('/ +/',' ',$strText);
		   $strText=trim($strText);
		   $strText=str_replace(' ','',$strText);
		   $strText=preg_replace('/-+/','',$strText);
		   $strText=preg_replace("/-$/","",$strText);
		   return $strText;
		  } 
		  
		  function stripUnicode($str) {
		   if(!$str) return false;
		   $str=strip_tags($str);
		   $unicode=array('a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ','d' => 'đ','e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ','i' => 'í|ì|ỉ|ĩ|ị','o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ','u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự','y' => 'ý|ỳ|ỷ|ỹ|ỵ','A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ','D' => 'Đ','E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ','I' => 'Í|Ì|Ỉ|Ĩ|Ị','O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ','U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự','Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',);
		   foreach($unicode as $nonUnicode => $uni) {
		    $str=preg_replace("/($uni)/i",$nonUnicode,$str);
		   }
		   return $str;
		  }
		  
		  function username($strText) {
		   return  strtolower($this->generate_username_from_text($this->stripUnicode($strText)));
		  }
                function showthongtin() {
			$url = URLPATH;
			$logo       =   $this->simple_fetch("select * from #_gallery where id = 103");
			$lienhe     =   $this->simple_fetch("select * from #_setting where id = 10");
			$hotro      =   $this->simple_fetch("select * from #_hotro where id = 18");
			$mxh        =   $this->simple_fetch("select * from #_thongtin where id = 1");
			$myArray = array
			(
				'logo'      =>  $url.'img_data/icon/'.$logo['ic_share'], 
				'favicon'   =>  $url.'img_data/icon/'.$logo['favicon'],
				'bando'     =>  $mxh['map'],
				'backlink'  =>  '<a href="http://phuongnamvina.vn/" rel="nofollow" target="_blank" title="Design Web: PhuongNamVina">Design Web: PhuongNamVina</a>',
				'lienhe'    =>   array
				(
					'ten_cong_ty'   =>  $lienhe['ten_cong_ty'],
					'dia_chi'       =>  $lienhe['address'],
					'email'         =>  $lienhe['email'],
					'dien_thoai'    =>  $lienhe['hotline'],
					'website'       =>  $lienhe['website'],
					'copyright'     =>  $lienhe['copyright'],
				),
				'hotro'   =>   array
				(
					'zalo'          =>  $hotro['zalo'],
					'messenger'     =>  $hotro['messenger'],
					'skype'         =>  $hotro['skype'],
					'dien_thoai'    =>  $hotro['sdt'],
				),
				'mxh'   =>   array
				(
					'facebook'      =>  $mxh['facebook'],
					'linkedin'      =>  $mxh['linkedin'],
					'youtube'       =>  $mxh['youtube'],
					'pinterest'     =>  $mxh['pinterest'],
					'instagram'     =>  $mxh['instagram'],
					'twitter'       =>  $mxh['twitter'],
				),
				
			);
			return $myArray;
		}
  
	}
?>