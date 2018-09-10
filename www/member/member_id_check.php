<?php
 
    require_once $_SERVER['DOCUMENT_ROOT'].'/function/db_connect.php';
	$db = new DBC;
	$db->DBI();
 
    $memberId = $_POST['memberId'];
 
    $db->query = "select * from member where id='".$memberId."'";
	$db->DBQ();
    $num = $db->result->num_rows;
	if($num >=1)
	{
		echo json_encode(array('res'=>'bad'));
    }else{
        echo json_encode(array('res'=>'good'));
    }
 
 
?>
