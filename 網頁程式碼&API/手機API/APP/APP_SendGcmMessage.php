<?php

// �}��MySQL����Ʈw�s��
   $link = @mysqli_connect("localhost","nhu1403","XWXKM188") 
         or die("�L�k�}��MySQL��Ʈw�s��!");
   mysqli_select_db($link, "nhu1403");  // ��ܸ�Ʈw
   
	$state = $_GET['state'];
	
    $sql = "UPDATE `GcmMessageState` SET `state`= '$state'";
	//$sql = "INSERT INTO Date (Days) VALUES('$_GET['Days']')";
	//$sql ="INSERT INTO `Date` (`Days`)";
   //$sql.="VALUES ('".$_GET['Days']."')";
   $file = fopen("GCMstate.txt","w+"); //�}���ɮ�
	fwrite($file,$state);
	fclose($file);
   echo "SQL���O: ".$sql;
   //�e�XUTF8�s�X��MySQL���O
   mysqli_query($link, 'SET NAMES utf8'); 
   if ( mysqli_query($link, $sql) ) // ����SQL���O
      echo "��Ʈw�s�W�O�����\, �v�T�O����: ". 
           mysqli_affected_rows($link);
		   
   else
      die("��Ʈw�s�W�O������");
   mysqli_close($link);      // ������Ʈw�s��*/
   
//�ӽЪ�API���_
$API_KEY = "AIzaSyBFF3lLoovM5VFDvKfWcSwqZ6qTFZEyflM";
//�w����APP�����ѧOID
$APP_ID = "APA91bFOgi3dlh-RY_m3BoNRneg2suOksi7O_nh4O53c0qLT8UTvAk93LrZ_ZL2jfhBKFI83ME1y6tsQJMIneYIJWSyjjAxRebZugSLCWNKwPmAWjato9n9PQJ2W3-kAc_EnIgrLcOAu";
//$APP_ID = "APA91bHLUpTAy2P-5fbsPHmMRXqqVygvcGa3OtQFSqMXF-sjp30kgpqnEWI_0uEOyr7MI_I7WOT2DvqIBL3SjdXOS_Q_CJsCyaHLmmKy_oX3JcCwSNJWqyGabIrMPqtSL26eKzjDjoWh";
 //������
//�����T��
if($state == 1){
	//�]�w�ѧOID
	$registatoin_ids = array($APP_ID);
	//�]�w���e
    //$message = array("message" => $_POST['message']);
    $message = array("message" => "Warming!");
	
	$url = 'https://android.googleapis.com/gcm/send';
	$json = array(
            'to' => $APP_ID,
            'data' => $message,
        );
	
	$headers = array(
            'Authorization: key=' . $API_KEY,
            'Content-Type: application/json'
        );
		
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);	//����SSL����
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($json));
	$result = curl_exec($curl);
	curl_close($curl);
    echo $result;
}
?>
