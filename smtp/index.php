<?php

    require('class.phpmailer.php');

    function sendmail($tieude,$noidung,$nguoigui,$nguoinhan,$tennguoigui){

            $mail             = new PHPMailer();

            $body = $noidung;

            $mail->IsSMTP();

            $mail->SMTPAuth   = true;

            $mail->SMTPSecure = "ssl";
            $mail->Host       = "smtp.gmail.com";
            $mail->Port       = 465;
            $mail->Username   = "kythuatpnvn@gmail.com";
            $mail->Password   = "aczwnmfxpfiiumpu";
			
            $mail->SetFrom($nguoigui,$tennguoigui);

            $mail->Subject    = $tieude;

            $mail->MsgHTML($body);

            $address = $nguoinhan;

            $mail->AddAddress($address, $tieude);

            if(!$mail->Send()) return false;

            else return true;

    }

?>