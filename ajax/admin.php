<?php
$vid=(int)$_GET["vid"];
require_once($_SERVER['DOCUMENT_ROOT']."/wp-config.php");
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$res=$mysqli->query( "SELECT SUM(`vote`) AS vot FROM `votes` WHERE `vote`<0 AND `postID`=".$vid );
$a=$res->fetch_row();
$minus=(int)$a[0];
$res=$mysqli->query( "SELECT SUM(`vote`) AS vot FROM `votes` WHERE `vote`>0 AND `postID`=".$vid );
$a=$res->fetch_row();
$plus=(int)$a[0];


exit( $vid.":".$plus.":".($minus*-1) );

?>