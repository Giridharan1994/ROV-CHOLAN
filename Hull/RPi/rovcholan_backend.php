
<?php
//$pieces=["","45","14.7","1","30","OFF","0","NIL","0","NIL","0","NIL\n","26-02-2016 11.48.53 AM","12.8381 N","80.13779 E","S0C0C0C0C"];

session_start();
$pieces=["ROV","ROV","ROV","ROV","ROV","ROV","ROV","ROV","ROV","ROV","ROV","ROV","ROV","ROV","ROV","ROV"];
$str="%ROV%ROV%ROV%ROV%ROV%ROV%ROV%ROV%ROV%ROV";
$gps="ROV%ROV%ROV%ROV";
$backupfile="%ROV%ROV%ROV%ROV%ROV%ROV%ROV%ROV%ROV%ROV%ROV%ROV%ROV%ROV";
$arduinocmd="ROV";
$defvrange="1400-1600";
$defhrange="1440-1560";
$defcamrange="50";
$defdepth="0";

if(file_exists("arduinodata.txt"))
{
$myfile = fopen("arduinodata.txt", "r") or die("Unable to open arduinodata file!");
$str =fread($myfile,filesize("arduinodata.txt"));
fclose($myfile);
}

if(file_exists("gps.txt"))
{
$gpsfile = fopen("gps.txt", "r") or die("Unable to open gps file!");
 $gps =fgets($gpsfile);
fclose($gpsfile);
}

$tr=$str."%";
$tr=$tr.$gps;
$tether_res=0.4;
$pieces = explode("%", $tr);

$current= ($pieces[20]-$pieces[1])/$tether_res;
$power=$current*$current*$tether_res;
$str=$str."%".$current."%".$power."%";
if($pieces[8]>500 || $pieces[1]>500) $str=$str."1";
else $str=$str."0";
if($pieces[7]>80) $str=$str."%"."1";
else $str=$str."%"."0";
//$str=$str."%".$_POST['cmd'];
$str=$str.'%'.$gps;
$pieces = explode("%", $str);

print_r(json_encode($pieces));



if($_POST['e']=="1")
{
	if(file_exists("rovcholandatabase.txt"))
	{   $rovcholandatabase = fopen("rovcholandatabase.txt", "a") or die("Unable to open rovcholandatabase file!");
		fwrite($rovcholandatabase,$str);
		fclose($rovcholandatabase);
	}

$servername = "localhost";
$username = "root";
$password = "rovcholan";
$dbname = "rovcholan";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "INSERT INTO newdata (sensedata) VALUES ('{$str}')";

if ($conn->query($sql) === TRUE) {
} else {
}

$conn->close();


}


 


if(file_exists("arduinocmd.txt"))
{
	$f = fopen("arduinocmd.txt","w");
        if($pieces[26]=="")$pieces[21]="0C0C0C"; 
	if ($_POST['override']=="true")   $arduinocmd=$_POST['lights'].$_POST['cmd'];
	if ($_POST['override']=="false")  $arduinocmd=$pieces[26];
        	
        if($_POST['reset']=="1") { $arduinocmd=$arduinocmd.'^'.$_POST['refdepth'].'^'.$_POST['camrange'].'^'.$_POST['htrange'].'^'.$_POST['vtrange'];}
        else if($_POST['reset']=="0") { $arduinocmd=$arduinocmd.'^'.$defdepth.'^'.$defcamrange.'^'.$defhrange.'^'.$defvrange;}

	fwrite($f,$arduinocmd);
	fclose($f);
}

if(file_exists("camera.txt"))
{
        $f = fopen("camera.txt","w");
        fwrite($f,$_POST['cam']);
        fclose($f);
}




?>

