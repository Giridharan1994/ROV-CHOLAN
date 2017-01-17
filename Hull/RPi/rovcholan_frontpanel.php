
<html>
<head> 
<link rel="stylesheet" type="text/css" href="rovcholan_styles.css">
</head>
 <script src="jquery.js"></script> 
 <script>
 function blinker()
 {
	 $('.blinking').fadeOut(500);
	 $('.blinking').fadeIn(500);
	 
 }
 setInterval(blinker,1000);
 </script>
 <body bgcolor="black"> <title>ROV CHOLAN</title>
 <form method="POST" action=''>

<div id="heading">
    <p style="color:white;font-family:verdana;font-size:200%;">ROV CHOLAN FRONT PANEL</p>
</div>

<div id="senses">
<table style="width:100%;">
<tr>
	<td id="video"><img src="http://192.168.7.2:8080/?action=stream" width="620" height="400" ></img></td>
	<td style="background-color:white;">
		<table id="sensordatatable"  >
			<caption style="margin-left:-100px">SENSOR DATA</caption>
			<tr>
				<td style="width:140px;position:left" >Time</td>
				<td id="time">02-03-2016 4.38.57 PM</td>
			</tr>
			
			<tr>
				<td>GPS</td>
				<td> LATITUDE <span id="lat">12.8383 N </span>  LONGITUDE <span id="long">80.13786 E </span></td>
			</tr>		
    		
			<tr>
				<td >Water Temperature</td>
				<td ><span id ="temp">29 </span> degree Celsius <span style="display:inline-block; width: 13px;"></span> <input type="text" id="reftempform" style="visibility:hidden;width:50px;"></input><span style="display:inline-block; width: 15px;"></span>
			</tr>
		
		
		    <tr>
				<td>Pressure</td>
				<td><span id="pressure">14.6</span> mbar <span style="display:inline-block; width: 80px;"></span><input type="text" id="refpresform" style="visibility:hidden;width:50px;"></input><span style="display:inline-block; width: 15px;"></span>
			</tr>
	
			<tr>
				<td>Depth</td>
				<td><span id="depth">0.4</span> m <span style="display:inline-block; width: 220px;"></span>
				<input type="button"  onclick="depth()" name="DEPTH"  id="refdepth" value="SET  AS ZERO POINT" style="width:151px;height:20px;visibility:hidden;"></input><span style="display:inline-block; width: 10px;"></span></td>
			</tr>
	
			
		</table>
	
		<table id="sensordatatable">
		<caption ><span style="display:inline-block; margin-left:-100px; width: 00px; line-height:-20px"></span>ROV MONITOR</caption>
			<tr></tr>
			<tr>
				<td >Camera Lights<span style="display:inline-block; width: 30px;"></td>
				<td ><span id="camlight">OFF</span><span style="display:inline-block; width: 140px;"></span>
				<input type="text" id="refcamform" style="visibility:hidden;width:35px;"></input>
				<input type="button"  onclick="lumrange()" id="refcam" name="CAM"  value="ENTER MAX LUMINESCENCE" style="width:200px;height:20px;visibility:hidden;"></input></td>
                
			</tr>
			
			<tr>
				<td>Left Thruster</td>
				<td> Speed <span id="lspeed">ZERO </span> Direction <span id="ldir">NIL</span>
     			
			</tr>		
    		
			<tr>
				<td>Right Thruster</td>
				<td> Speed <span id="rspeed">ZERO </span> Direction <span id="rdir">NIL</span>
			    <input type="text" id="htform" style="visibility:hidden;width:35px;"></input>
				<input type="button"  onclick="htf()" id="ht" name="HT"  value="ENTER THRUST RANGE" style="width:165px;height:20px;visibility:hidden;"></input></td>
                
			</tr>		
    		
			<tr>
				<td>Vertical Thrusters</td>
				<td> Speed <span id="vspeed">ZERO </span> Direction <span id="vdir">NIL</span>
     			<input type="text" id="vtform" style="visibility:hidden;width:35px;"></input>
				<input type="button"  onclick="vtf()" id="vt" name="VT"  value="ENTER THRUST RANGE" style="width:165px;height:20px;visibility:hidden;"></input></td>
                
			</tr>		
    		
<!--			<tr>
				<td>Humidity</td>
				<td><span id="hum"> NC </span> % <span style="display:inline-block; width: 40px;"></span>
				<span style="color:red; visibility:hidden" class="blinking" id="humwarn">WARNING!!!</span></td>
			</tr>
-->
			<tr>
				<td>Water Sensors</td>
				<td>D<span id="WS1">0 </span> E<span id="WS2">0</span><span style="display:inline-block; width: 18px;"></span>
				<span style="color:red; visibility:hidden" class="blinking" id="watwarn">WARNING!!!</span></td>
			</tr>
		
		    <tr>
				<td  style="">ROV Temperature </td>
				<td   style=""><span id="temp1">NC</span> </td>
			</tr>
<!--		    <tr>
				<td>ROV Temperature 2</td>
				<td><span id="temp2">NC</span> degree Celsius</td>
			</tr>
-->		</table>
		<table id="sensordatatable">
		    <tr>
				<td style="color:white; visibility:hidden">Battery Voltage<span style="display:inline-block; width: 55px;"></td>
				<td style="color:white; visibility:hidden"><span id="bat">NC</span> V <span style="display:inline-block; width: 125px;"></td>
				<td style="color:white; visibility:hidden">Voltage in Hull <span style="display:inline-block; width: 60px;"></td>
				<td style="color:white; visibility:hidden"><span id="hull">NC</span> V</td>
			</tr>
			
		    <tr>
				<td style="color:white; visibility:hidden">Current Drawn </td>
				<td style="color:white; visibility:hidden"><span id="I">NC</span> A</td>
				<td style="color:white; visibility:hidden">Power </td>
				<td style="color:white; visibility:hidden"><span id="P">NC</span> W</td>
			</tr>
			
		
		</table>
	
	
	
	
	
	
	
	</td>
</tr>
</table>
</div>

<div id="override" align="bottom">
  <table id="controlpad" align="bottom">
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>

        <tr>
		<td></td>
		<td></td>
    	<td style="color:white;">LIGHTS</td>
    	<td></td>
		<td></td>
		<td style="text-align:center;"><input type="button"  onclick="rovfront()" name="ROVFRONT" id="ROVFRONT" value="ROV FRONT " style="width:100px;height:20px;"></input> </td>
        <td></td>
		<td></td>
		<td></td>
		<td style="text-align:center;"><input type="button"  onclick="rovup()" name="ROVUP" id="ROVUP"  value="ROV UP" style="width:100px;height:20px;"></input> </td>
        <td></td>
		<td></td>
		<td style="color:white;">Control Override</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		
	</tr>
	<tr>
		<td></td>
		<td></td>
     	<td> <select  id="lights" onchange="light()" >
				<option value="0">OFF</option>
				<option value="1">MIN</option>
				<option value="2">MED</option>
				<option value="3">MAX</option>
			</select>
		</td>
     	<td></td>
		<td style="text-align:center;"><input type="button"  onclick="rovleft()" name="ROVLEFT" id="ROVLEFT" value="ROV LEFT" style="width:100px;height:20px;"></input> </td>
        <td style="text-align:center;"><input type="button"  onclick="rovstop()" name="ROVSTOP" id="ROVSTOP" value="ROV STOP" style="width:100px;height:20px;"></input> </td>
        <td style="text-align:center;"><input type="button"  onclick="rovright()" name="ROVRIGHT" id="ROVRIGHT"  value="ROV RIGHT" style="width:100px;height:20px;"></input> </td>
        <td></td>
		<td></td>
		<td style="text-align:center;"><input type="button"  onclick="rovhover()" name="ROVHOVER" id="ROVHOVER"   value="ROV HOVER" style="width:100px;height:20px;"></input> </td>
        <td></td>
		<td></td>
		<td style="color:white;"><input type="radio" id="r1" 
										onclick="document.getElementById('ROVFRONT').disabled=false;
												 document.getElementById('ROVBACK').disabled=false;
												 document.getElementById('ROVLEFT').disabled=false;
												 document.getElementById('ROVRIGHT').disabled=false;
												 document.getElementById('ROVUP').disabled=false;
												 document.getElementById('ROVDOWN').disabled=false;
												 document.getElementById('ROVSTOP').disabled=false;
												 document.getElementById('ROVHOVER').disabled=false; allowoverride();" name="override" value="on" checked > Allow Override </td>
        
	    <td></td>
		<td></td>
		<td></td>
<td style="text-align:center;;"><input type="button" style="width:210px;height:30px;" 
		onclick="  if(this.value=='START AN EXPEDITION') { this.value='Recording data, Click here to stop the expedition'; document.getElementById('CALIBRATION').disabled=true;}
		           else                                   { this.value='START AN EXPEDITION'; document.getElementById('CALIBRATION').disabled=false;}" id="EXPEDITION"  name="EXPEDITION"  value="START AN EXPEDITION" style="width:300px;height:40px;"></input> </td>
        <td style="text-align:center;"><input type="button"  style="width:150px;height:30px;"
		onclick="  if(this.value=='CUSTOMIZE')
						{ 
						  this.value='STOP CUSTOMIZING'; 
						  document.getElementById('refdepth').style.visibility='visible'; 
						  document.getElementById('refcam').style.visibility='visible'; 
						  document.getElementById('ht').style.visibility='visible';
						  document.getElementById('vt').style.visibility='visible';
						  document.getElementById('camera').style.visibility='visible'; 
                                                  document.getElementById('reset').style.visibility='visible';


						 } 
		           else  
					   {
						  this.value='CUSTOMIZE'; 
						  document.getElementById('refdepth').style.visibility='hidden';
						  document.getElementById('refcam').style.visibility='hidden';
						  document.getElementById('ht').style.visibility='hidden';
						  document.getElementById('vt').style.visibility='hidden'; 
						  document.getElementById('refcamform').style.visibility='hidden';
						  document.getElementById('htform').style.visibility='hidden'; 
						  document.getElementById('vtform').style.visibility='hidden'; 
						  document.getElementById('camera').style.visibility='hidden';
                                                  document.getElementById('reset').style.visibility='hidden';

 
						  }" id="CUSTOM" name="CUSTOM"  value="CUSTOMIZE" ></input> </td>
        <td style="text-align:center;"><input type="button" onclick="camera1()" id="camera"  name="camera"  value="TOGGLECAM1" style="width:100px;height:30px;visibility:hidden;"></input> </td>
       <td style="text-align:center;"><input type="button"  onclick="reset1()" value="RESET" id="reset"  name="reset"  style="width:60px;height:30px;visibility:hidden;"></input> </td>
        
       </tr>
	<tr>
		<td></td>
		<td></td>
    	<td></td>
    	<td></td>
		<td></td>
		<td style="text-align:center;"><input type="button"  onclick="rovback()" name="ROVBACK"  id="ROVBACK" value="ROV BACK" style="width:100px;height:20px;"></input> </td>
        <td></td>
		<td></td>
		<td></td>
		<td style="text-align:center;"><input type="button"  onclick="rovdown()" name="ROVDOWN" id="ROVDOWN"   value="ROV DOWN" style="width:100px;height:20px;"></input> </td>
        <td></td>
		<td></td>
		<td style="color:white;"><input type="radio" id="r2" 
										onclick="document.getElementById('ROVFRONT').disabled=true;
												document.getElementById('ROVBACK').disabled=true;
												document.getElementById('ROVLEFT').disabled=true;
												document.getElementById('ROVRIGHT').disabled=true;
												document.getElementById('ROVUP').disabled=true;
												document.getElementById('ROVDOWN').disabled=true;
												document.getElementById('ROVSTOP').disabled=true;
												document.getElementById('ROVHOVER').disabled=true; nooverride();" name="override"  id="override" value="off" >Don't allow Override</td>
		
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>

	
	</tr>


  </table>
	
<table align="right"><tr ><td style="color:yellow;font-family:verdana; text-align:center; font-size:95%;"> &copy IIITD&M KANCHEEPURAM</td></tr>
<tr ><td style="color:yellow;font-family:verdana; text-align:center; font-size:55%;"> DEVELOPED BY GIRIDHARAN K </td></tr></table>	


</div>



</form>

<script>
var cmd="0C0C0C";
var lights="0";
var override="true";
var e="1";
var refdepth;
var vtrange;
var htrange;
var camrange;
var cam;
var reset="1";
var tether_res=0.4;
var data=["","temp","pres","depth","deg","caml","lspeed","ldir","rspeed","rdir","vspeed","vdir","time","lat","long",""];
$(document).ready
 (
	setInterval(function (){ajax();},1000));

/*function callread()
{
}*/
 function ajax() 
{
	if(document.getElementById("EXPEDITION").value=="Recording data, Click here to stop the expedition") e="1";
	else if(document.getElementById("EXPEDITION").value=="START AN EXPEDITION") e="0";
	
	$.post('rovcholan_backend.php',{cmd:cmd,lights:lights,override:override,e:e,refdepth:refdepth,htrange:htrange,vtrange:vtrange,camrange:camrange,cam:cam,reset:reset})
	 .error(function (ddata){console.log(ddata);})
	 .success
	   (
	    function (plist)
	    {
                 
		 plist = JSON.parse(plist);
		 console.log(plist);
                 for(i=1;i<=26;i++)
                  {
                    if(plist[i]!='') data[i]=plist[i];
                
                  }



         document.getElementById("hull").innerHTML              = data[1]; 
		 document.getElementById("temp1").innerHTML             = data[17]; 
		 document.getElementById("temp").innerHTML          	= data[3];
		 //document.getElementById("temp2").innerHTML 	        = data[4]; 
		 document.getElementById("pressure").innerHTML  	    = data[5]; 
		 document.getElementById("depth").innerHTML 	        = data[6]; 
		// document.getElementById("hum").innerHTML 	        	= data[7]; 
		 document.getElementById("WS1").innerHTML 	        	= data[8]; 
		 document.getElementById("WS2").innerHTML 	        	= data[9]; 
		 document.getElementById("camlight").innerHTML     	    = data[10];
      	 document.getElementById("lspeed").innerHTML      		= data[11]; 
		 document.getElementById("ldir").innerHTML     	        = data[12];
      	 document.getElementById("rspeed").innerHTML 		    = data[13];
	     document.getElementById("rdir").innerHTML 		        = data[14];
	     document.getElementById("vspeed").innerHTML 		    = data[15];
	     document.getElementById("vdir").innerHTML 		        = data[16];
	     document.getElementById("time").innerHTML 	    	    = data[22]; 
		 document.getElementById("lat").innerHTML 		        = data[23]; 
		 document.getElementById("long").innerHTML 		        = data[24]; 
         document.getElementById("bat").innerHTML 		        = data[25]; 
        document.getElementById("I").innerHTML 		        = data[18];// parseInt(me)*2;//(parseFloat(document.getElementById("bat").innerHTML)-parseFloat(document.getElementById("hull").innerHTML))/parseFloat(tether_res); 
         document.getElementById("P").innerHTML 		        = data[19];//parseFloat(document.getElementById("I")*document.getElementById("I").innerHTML)*parseFloat(tether_res); 
 
        
         if(data[20]=="1") document.getElementById("watwarn").style.visibility="visible";
		 else document.getElementById("watwarn").style.visibility="hidden";
		 //if(data[21]=="1") document.getElementById("humwarn").style.visibility="visible";
		 //else document.getElementById("humwarn").style.visibility="hidden";

		});
	}
function rovfront()   {cmd="1C1C**";}
function rovback()    {cmd="1A1A**";}
function rovleft()    {cmd="1C0C**";}
function rovright()   {cmd="0C1C**";}
function rovup()      {cmd="****1C";}
function rovdown()    {cmd="****1A";}
function rovstop()    {cmd="0C0C0C";}
function rovhover()   {cmd="0H0H0H";}

function light()        {  lights=document.getElementById("lights").value;}

function allowoverride()    { alert("OVERRIDE   ON !!"); override="true";}
function nooverride()       { alert("OVERRIDE  OFF!!");  override="false";}
function reset1()
{
        if( document.getElementById("reset").value == "RESET")
        {
                document.getElementById("reset").value = "SET";
                reset="0";

        }
        else if( document.getElementById("reset").value == "SET")
        {
                 document.getElementById("reset").value = "RESET";
                reset="1";

        }

}
function camera1()
{
        if( document.getElementById("camera").value == "TOGGLECAM1")
        {
                document.getElementById("camera").value = "TOGGLECAM2";
                cam="OFF";

        }
        else if( document.getElementById("camera").value == "TOGGLECAM2")
        {
                document.getElementById("camera").value = "TOGGLECAM1";
                cam="ON";
              
        }
//alert(cam);

}



function vtf()       
{
	
	if( document.getElementById("vt").value == "SET THRUST RANGE") 
	{
		document.getElementById("vt").value="ENTER THRUST RANGE" ;
		document.getElementById("vtform").style.visibility="hidden";
		vtrange=document.getElementById("vtform").value;

	}
	else
	{
		document.getElementById("vt").value = "SET THRUST RANGE"; 
		document.getElementById("vtform").style.visibility="visible";
		
	}	
//	alert(vtrange);
	 
}

function htf()       
{
	
	if( document.getElementById("ht").value == "SET THRUST RANGE")
	{
		document.getElementById("ht").value="ENTER THRUST RANGE" ;
		document.getElementById("htform").style.visibility="hidden";
		htrange=document.getElementById("htform").value;
	}
	else
	{
		document.getElementById("ht").value = "SET THRUST RANGE"; 
		document.getElementById("htform").style.visibility="visible";
	}	
//	alert(htrange);
	
}

function lumrange()       
{
	if( document.getElementById("refcam").value == "SET MAX LUMINESCENCE")
	{
		document.getElementById("refcam").value="ENTER MAX LUMINESCENCE" ;
		document.getElementById("refcamform").style.visibility="hidden";
		camrange=document.getElementById("refcamform").value;
	}
	else
	{
		document.getElementById("refcam").value = "SET MAX LUMINESCENCE"; 
		document.getElementById("refcamform").style.visibility="visible";
	}	
//	alert(camrange);
	
}


function depth()       
{
	refdepth= document.getElementById("depth").innerHTML ;
	document.getElementById("depth").innerHTML = '0';
//	alert(refdepth);
}


</script>
</body>
</html>
