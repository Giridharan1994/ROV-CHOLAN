
<?php
// Example 
$myfile = fopen("data.txt", "r") or die("Unable to open file!");
$str =fgets($myfile);
fclose($myfile);
$pieces = explode(" ", $str);
print_r(json_encode($pieces));
// echo $pieces[0];

$f = fopen("/home/pi/hel.txt","w");
if ($_POST['ch']=="U")     fwrite($f,"UP");
if ($_POST['ch']=="D")   fwrite($f,"DOWN");
if ($_POST['ch']=="L")   fwrite($f,"LEFT");
if ($_POST['ch']=="R")  fwrite($f,"RIGHT");
if ($_POST['ch']=="CU")  fwrite($f,"CAMUP");
if ($_POST['ch']=="CD")fwrite($f,"CAMDOWN");
fclose($f);


?>

