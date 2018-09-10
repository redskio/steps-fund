<meta charset="utf-8">
<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/function/db_connect.php';
$db = new DBC;
$db->DBI();
 
$file_name = $_FILES['upload_file']['name'];
$tmp_file = $_FILES['upload_file']['tmp_name'];
 
$file_path = $_SERVER['DOCUMENT_ROOT'].'/upload/'.$file_name;
 
$r = move_uploaded_file($tmp_file, $file_path);
 
$db->query = "SELECT * FROM album_image WHERE id='kstbook' and album_no='0'";
$db->DBQ();

$image_no = $db->result->num_rows;
$image_no=$image_no+1;
 
$id = 'kstbook';
$album_no = '0';

$db->query = "insert into album_image values (DEFAULT,'".$id."','".$album_no."', '".$image_no."', '".$file_name."', '".$file_path."')";
$db->DBQ();

$db->DBO();

if(!$db->result)
{
	echo "<script>alert('DB 오류 발생.');</script>";
} else
{
	$_SESSION['_id'] = $id;
	$HTTP_REFERER = $_SERVER['HTTP_REFERER'];    // $_SERVER['HTTP_REFERER']는 이전 페이지 주소를 가져옴
    if(!$HTTP_REFERER) $HTTP_REFERER = "../";    // 이전 페이지 값없을 때 ../로(메인 페이지로 가기)
    echo "<script>document.location.href='".$HTTP_REFERER."';</script>";    // 페이지 이동

} 
?>