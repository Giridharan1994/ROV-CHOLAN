
<?php

session_start();
$myfile = fopen("servergps.txt", "r") or die("Unable to open file!");
$cmdfile = fopen("xboxcontrolcmd.txt", "r") or die("Unable to open file!");
$cmd = fgets($cmdfile);
$str = fgets($myfile);
fclose($myfile);
fclose($cmdfile);


if (!isset($_SESSION["cmd"])) $_SESSION["cmd"] = $cmd;
//unset($_SESSION["cmd"]);
if (!isset($_SESSION["str"])) $_SESSION["str"] = $str;

if($cmd!= "") $_SESSION["cmd"] = $cmd;
else $cmd=$_SESSION["cmd"];


if($str!= "") $_SESSION["str"] = $str;
else $str=$_SESSION["str"];




$data = $str."%";
$data = $data.$cmd;
echo $data;
?>

