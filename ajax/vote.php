<?php
$vid=(int)$_GET["vid"];
$vote=(int)$_GET["vote"]; if($vote) $vote=$vote/abs($vote);
require_once($_SERVER['DOCUMENT_ROOT']."/wp-config.php");
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ( !$mysqli->query("SHOW TABLES LIKE `votes`") ) create_table_votes($mysqli);

$res=$mysqli->query( "SELECT `ID` FROM `wp_posts` WHERE `ID`=".$vid );
if( !($res->num_rows) ) exit("WTF"); //Не существующие посты не оцениваем

$res=$mysqli->query( "SELECT `ID`, `vote` FROM `votes` WHERE `IP`='".$_SERVER['REMOTE_ADDR']."' AND `postID`=".$vid );
if($vote){
 if( !($res->num_rows) ) $mysqli->query( "INSERT INTO `votes` SET `IP`='".$_SERVER['REMOTE_ADDR']."', `postID`=".$vid.", `vote`=".$vote );
 else $mysqli->query( "UPDATE `votes` SET `vote`=".$vote." WHERE `IP`='".$_SERVER['REMOTE_ADDR']."' AND `postID`=".$vid );
}

$res=$mysqli->query( "SELECT SUM(`vote`) AS vot FROM `votes` WHERE `postID`=".$vid );
$a=$res->fetch_row();
exit($vid.":".(int)$a[0]);

function create_table_votes($mysqli){
 $mysqli->query("
CREATE TABLE `votes` (
  `ID` int(11) UNSIGNED NOT NULL,
  `IP` varchar(40) NOT NULL,
  `postID` int(11) UNSIGNED NOT NULL,
  `vote` TINYINT(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;");
 $mysqli->query("ALTER TABLE `votes` ADD PRIMARY KEY (`ID`);");
 $mysqli->query("ALTER TABLE `votes` MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;");
} //function create_table_votes()
?>