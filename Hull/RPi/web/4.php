
<?php
$f = fopen("/home/pi/hel.txt","w");
if (isset($_POST['UP']))     fwrite($f,"UP");
if (isset($_POST['DOWN']))   fwrite($f,"DOWN");
if (isset($_POST['LEFT']))   fwrite($f,"LEFT");
if (isset($_POST['RIGHT']))  fwrite($f,"RIGHT");
if (isset($_POST['CAMUP']))  fwrite($f,"CAMUP");
if (isset($_POST['CAMDOWN']))fwrite($f,"CAMDOWN");
fclose($f);
?>




<html>
<head></head>
<script src="jquery.js"></script>

<body bgcolor="black">
<title>ROV CHOLAN</title>
<script type="text/css">
//.center { margin: 0 auto; width: 400px; }

</script>


<script>
function checkfunction(obj){
$.post("4.php",$(obj).serialize(),function(data){
 alert("success");
 });
 return false;
 }
</script>
<form onsubmit="return checkfunction(this)" method="POST" action=''>
<table style="width:100%">
  <tr>
    <td style="color:white;font-family:verdana; text-align:center; font-size:200%;">ROV CHOLAN CONTROL PANEL</td>
  </tr>
</table>
<table style="width:100%">  
  <tr>
    <tr></tr>
	<tr></tr>
	<tr></tr>
	<tr></tr>
	<tr></tr>
	
    <td style="width:47%"><img id="video" src="http://192.168.7.2:8080/?action=stream" width="600" height="414" ></img></td>
    <td style="background-color:white;width:53%">
	<table style="margin-top:-180px; margin-left:10px;width:100%">
	<caption style="font-family:verdana; text-align:center; ">SENSOR DATA</caption>
	<tr>
	<td>Temperature</td>
	<td><span id ="temp">25 </span>degree Celsius</td>
	</tr>
		
	<tr>
	<td>Depth</td>
	<td><span id="depth">5</span> m</td>
	</tr>
	
	<tr>
	<td>GPS</td>
	<td id="GPS">12.83N 80.13E</td>
	</tr>
	
	<tr>
	<table style="width:100%">
	<tr>
	<td></td>
	<td style="text-align:center;"> <input type="submit" name="UP"  value="ROV UP" style="width:100px;height:20px;"></input> </td>
	<td></td>
	</tr>
	<tr>
	<td style="text-align:center;"> <input type="submit" name="LEFT"  value="ROV LEFT" style="width:100px;height:20px;"></input> </td>
	<td></td>
	<td style="text-align:center;"> <input type="submit" name="RIGHT"  value="ROV RIGHT" style="width:100px;height:20px;"></input> </td>
	</tr>
	<tr>
	<td></td>
	<td style="text-align:center;"><input type="submit" name="DOWN"  value="ROV DOWN" style="width:100px;height:20px;"></input> </td>
	<td></td>
	</tr>
	<tr>
	
	</tr>
	<tr></tr> <tr></tr> <tr></tr> <tr></tr> <tr></tr> <tr></tr>
	<tr>
	<td></td>
	<td style="text-align:center;"><input type="submit" name="CAMUP"  value="CAM UP" style="width:100px;height:20px;"></input> </td>
	<td></td>
	</tr>
	<tr></tr> <tr></tr> <tr></tr> <tr></tr>
	
	<tr>
	<td></td>
	<td style="text-align:center;"><input type="submit" name="CAMDOWN"  value="CAM DOWN" style="width:100px;height:20px;"></input> </td>
	<td></td>
	</tr>
	</table>
	</tr>
	
	
	</table>
	</td>		
  </tr>

</table>
<table ><tr ><td style="color:white;font-family:verdana; text-align:center; font-size:95%;"> &copy IIITD&M KANCHEEPURAM</td></tr></table>
</form>

<script>
$(document).ready(setInterval(function(){
$.post('read.php',{}).error(function (ddata){console.log(ddata)}).success(function (data){data = JSON.parse(data);document.getElementById("temp").innerHTML = data[1]; document.getElementById("depth").innerHTML = data[2]; document.getElementById("GPS").innerHTML = data[3]; });
},1000));
</script>
</body>
</html>
