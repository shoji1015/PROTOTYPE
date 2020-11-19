<?php
$dbhost = "yuito.naviiiva.work";
$dbuser = "naviiiva_user";
$dbpass = "!Samurai1234";
$dbname = "yuito";
$link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$room = $_POST["room"];
	$user = $_POST["user"];
	$msg = $_POST["msg"];
	$insert = "insert into chatMessage(roomid,email,msg) values(\"$room\",\"$user\",\"$msg\")";
	if ($result = mysqli_query($link, $insert)) {
//		header("Location: chat.php");
	}
} else {
	$query = "SELECT * from chatMessage where roomid = ".$_GET['room']." order by id desc";
	if ($result = mysqli_query($link, $query)) {
		$msg = array();
		foreach($result as $row) {
			$msg[] = array(
				'user'=>$row['email'],
				'msg'=>$row['msg']
			);
		}
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($msg);
	}
}
?>
