<?php
function return500() {
	header ( 'HTTP/1.1 500 Internal Server Error' );
	var_dump ( $error );
	exit ();
}
if ($_SERVER ['REQUEST_METHOD'] === "GET") {
	$m = new MongoClient (); // ← 从连接池请求连接
		$collection = $m->demo->mtime;
		var_dump($collection->findOne());
} else {
	$data = json_decode ( file_get_contents ( 'php://input' ), true );
	$error = json_last_error ();
	if ($error === JSON_ERROR_NONE) {
		$m = new MongoClient (); // ← 从连接池请求连接
		$collection = $m->demo->mtime;
		$collection->batchInsert ( $data );
	} else {
		return500 ();
	}
}
