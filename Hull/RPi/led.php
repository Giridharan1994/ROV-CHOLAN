<?php
$f = fopen("/sys/devices/soc/soc:leds/leds/led0/brightness","w");
if (isset($_POST['button1'])) fwrite($f,1);
if (isset($_POST['button2'])) fwrite($f,0);
$g= exec("cat /sys/devices/soc/soc:leds/leds/led0/brightness");
echo $g.'<br>';

//$h = exec("python /home/pi/serialtest.py yuv");
//echo $h;
//$command = escapeshellcmd("sudo python /home/pi/serialtest.py yuv");
//$output = shell_exec($command);
//echo $output;

$ff = fopen("/var/www/web/d.txt","w");
fwrite($ff,"hello");

$gg= exec("cat /var/www/web/d.txt");
echo $gg;
 

?>

<form method="POST" action=''>
<input type="submit" name="button1"  value="ON">
<input type="submit" name="button2"  value="OFF">
</form>

