/*PIN CONNECTIONS
A0 - Water Sensor
A1 - Water Sensor
A2 - Battery Voltage
A3 - LM35
A4 - White - SDA
A5 - Green - SCL


0     - RX to RPi
1     - TX to RPi
2     - NC
3     - CAM LIGHTS
4     - DHT11
5     - ESC
6     - ESC
7,8   - NC
9     - ESC
10    - ESC
11,12,13 - NC 

 DHT connections
 Connect pin 1 (on the left) of the sensor to +5V
 Connect pin 2 of the sensor to whatever your DHTPIN is
 Connect pin 4 (on the right) of the sensor to GROUND
 Connect a 10K resistor from pin 2 (data) to pin 1 (power) of the sensor

*/

#include <string.h>
#include <Servo.h>
#include <Wire.h>
#include "MS5837.h"
#include "DHT.h"
#define DHTPIN 4     
#define DHTTYPE DHT11   // DHT 11 

DHT dht(DHTPIN, DHTTYPE);
MS5837 depth_sensor;

int init_pos=0,currentpos=0;
int x=1500;
int ws1=0, ws2=1, bat_pin=2, temp=3;
byte LED=3;
Servo LHT,RHT,LVT,RVT,LEDS;
int WS1=0,WS2=0;
float hum=0;
float V_Bat=0;
float depth =0;
float pressure=0;
float temperature, temperature_d,temperature_h;
char prevMdir='C';
char c[5][40]={"h","g","k","c","a"};
char Mspeed[4]="000",Mdir[4]="CCC";
String arduinodata="%45%45%45%14.7%1%50%0%1%OFF%0%NIL%0%NIL%0%NIL&",stemp="45",stempd="45",stemph="45",spressure="14.7",sdepth="1",slights="0FF",shum="50",sbat="14.0";
char arduinocmd[]="00C0C0C^30^80^1300-1700^1300-1700"; //@00C0C0C^30^80^1300-1700^1300-1700& @01A1A1A^30^80^1300-1700^1300-1700& @01A1A1A^30^80^^&
float refdepth=0,cmax=1500;
const int h0=1500,v0=1500;
int hf=200,hr=200,vf=200,vr=200;


void calib()
{
char val[4][40]={"1","1","1","1"};
int hlow=1300,hhigh=1700,vlow=1300,vhigh=1700;

 int i=0,j=0,k=0,m=0;
 char *p = arduinocmd;
 char *str;
// int flag[4]={-1,-1,-1,-1};
while(arduinocmd[i]!='\0')
{
  if(arduinocmd[i]!='^'){ c[j][k]=arduinocmd[i]; k++; i++;}
  else { j++; k=0; i++;}
  
}
j=0;
refdepth=String(c[1]).toFloat();
cmax=String(c[2]).toFloat();

for(m=3;m<5;m++)
{ i=0;  k=0;
  while(c[m][i]!='\0')
  {
    if(c[m][i]=='-'){ j++; k=0; i++; }  
    else  {val[j][k]=c[m][i]; k++; i++; }
  }
  j++;
}
hlow=String(val[0]).toInt();  hr=h0-hlow; 
hhigh=String(val[1]).toInt(); hf=hhigh-h0;
vlow=String(val[2]).toInt();  vr=v0-vlow; 
vhigh=String(val[3]).toInt();  vf=vhigh-v0;

}



void setup() 
{
  
  Serial.begin(9600);
  Serial.setTimeout(50);
  LHT.attach(5);
  RHT.attach(6);
  LVT.attach(9);
  RVT.attach(10);
  LEDS.attach(LED);
  
//  Serial.println("Starting");
  LHT.writeMicroseconds(1500); // send "stop" signal to ESC.
  RHT.writeMicroseconds(1500); // send "stop" signal to ESC.
  LVT.writeMicroseconds(1500); // send "stop" signal to ESC.
  RVT.writeMicroseconds(1500); // send "stop" signal to ESC.
  LEDS.writeMicroseconds(1100); // send "stop" signal to ESC.
  
  currentpos=init_pos;

  Wire.begin();
  depth_sensor.init();
  depth_sensor.setFluidDensity(1029); // kg/m^3 (997 freshwater, 1029 for seawater)
//  dht.begin();

}
  
  
void camlights(char lights)
{
  int d=cmax-1100;
  switch(lights)
  {
    case '0': {slights="OFF"; LEDS.writeMicroseconds(1100);   break;}
    case '1': {slights="MIN"; LEDS.writeMicroseconds(1100+d/3);  break;}
    case '2': {slights="MED"; LEDS.writeMicroseconds(1100+2*d/3);  break;}
    case '3': {slights="MAX"; LEDS.writeMicroseconds(1100+d);  break;}
    default :  {slights="OFF";LEDS.writeMicroseconds(1100);}
  }
}
  
void loop()
{
 // Serial.println("hello");
  String cmd;//="@00C0C0C^^1450-1550^1450-1550";

  char lights='0',mdir='C',mspeed='0';
  watersensors();  
  while(!Serial.available())watersensors(); 
  cmd=Serial.readString();
  if(cmd[0]=='@' && cmd.indexOf('&')>0)
    {
      int i=0;
      cmd.remove(0,1);
      cmd.remove(cmd.indexOf('&'),cmd.length()-cmd.indexOf('&'));
      cmd.toCharArray(arduinocmd,50);
      calib();
      
      cmd=String(c[0]);
//      Serial.println(cmd);
      if(cmd.length()==7)
        {
         if(cmd!="")
         {
          lights=cmd.charAt(0);
          camlights(lights);
          
          if(cmd.charAt(1)!='*')  motorcontrol(cmd.charAt(1),cmd.charAt(2),'L');
          if(cmd.charAt(3)!='*')  motorcontrol(cmd.charAt(3),cmd.charAt(4),'R');
          if(cmd.indexOf("0H0H0H0H")==-1)
            {
              if(cmd.charAt(5)!='*')  motorcontrol(cmd.charAt(5),cmd.charAt(6),'V');
            }
          else  hover();
          senddata();  

         }         
     } 
    }

         
}

void humidity() 
{

  if (isnan(dht.readHumidity()) || isnan(dht.readTemperature())); 
  else 
   {
        hum = dht.readHumidity();
        temperature_h = dht.readTemperature();
   }  
}


void battery_voltage()
{
   int sensorValue = analogRead(bat_pin);
  // Convert the analog reading (which goes from 0 - 1023) to a voltage (0 - 5V):
  float V = sensorValue * (5.0 / 1023.0);
  // print out the value you read:
  float R1=120, R2=33;
   V_Bat= V*(R1+R2)/R2;
  V_Bat= V_Bat+0.5+0.4; // 0.5 drift error, 0.4 diode knee voltage
}

void watersensors()
{
  
  if(analogRead(ws1)>500) WS1=1; else WS1=0;
  if(analogRead(ws2)>500) WS2=1; else WS2=0;
  
//  Serial.println(WS1);
//  Serial.println(WS2);
  
  if (WS1==1 || WS2==1) 
  {
    motorcontrol('0','C','L');
    motorcontrol('0','C','R');
    motorcontrol('0','C','V');
  }
  
}
float error;
void senddata()
{
 String motordir[3],motorspeed[3],ref;
 battery_voltage();
 depthsense();
 tempsense();
// humidity();
 sbat=String(V_Bat);
 stemp=String(temperature);
 if(temperature_d>1000 || temperature_d<0) stempd="NIL"; else stempd=String(temperature_d);
 stemph=String(temperature_h);
 shum=String(hum);
 if(pressure>100000) spressure="NIL"; else spressure=String(pressure);
 if(depth>100000) sdepth="NIL"; else  sdepth=String(depth); 
 
 for(int i=0;i<3;i++)
 {
   if(Mspeed[i]=='2') motorspeed[i]="MAX";
   else if (Mspeed[i]=='1') motorspeed[i]="MED";
   if(Mspeed[i]=='0') { motorspeed[i]="ZERO"; motordir[i]="NIL"; }
   else 
    {
      if(Mdir[i]=='C') motordir[i]="CLOCKWISE";
      else if(Mdir[i]=='A') motordir[i]="ANTICLOCKWISE";
    } 
 }
arduinodata= '%' +  sbat + '%'+ stemp + '%' + stempd + '%' + stemph + '%'+ spressure + '%' + sdepth + '%' + shum + '%' + String(WS1) + '%' + String(WS2) + '%' + slights ;
ref=  '^' + String(refdepth) + '^' + String(cmax) + '^' + String(h0-hr) + '-' + String(h0+hf) + '^' + String(v0-vr) + '-' + String(v0+vr);
Serial.print('@');
Serial.print(arduinodata);
for(int i=0;i<3;i++){ Serial.print('%' + motorspeed[i] + '%' + motordir[i]);}
Serial.print(ref);
Serial.println('&');
//Serial.println(String(x)+'%'+sdepth+'%'+String(error));
}
void hover()
{
/* depthsense();
 float setdepth=0.25,k;
 error= depth-setdepth;
 float P=abs(error);
// P=map(P,0,0.4,0,vr);
 if(0 <= P<0.05)   k=vr/5;
 else if(0.05 <= P<0.1)   k=vr/4;
 else if(0.1 <= P<0.2)   k=vr/3;
 else if(0.3 <= P<0.4)   k=vr/2;
 else if(0.4 <= P)   k=vr/1;


 if(error<0) {   x=1500+k; }
 else        {   x=1500-k;}  

LVT.writeMicroseconds(x); RVT.writeMicroseconds(x);
*/
}

void motorcontrol(char mspeed,char mdir,char mname)
{
  int i=-1;
  char M_speed,M_p,M_n;
  int hzero=1500 , hfmax=1530 , hfmin=1560 , hrmax=1440 , hrmin=1470;
  int vzero=hzero, vfmax=hfmax, vfmin=hfmin, vrmax=hrmax, vrmin=hrmin;
  if(hf<60 || hr<60 || hf>400 || hr>400 ) { hf=60; hr=60;}
  if(vf<60 || vr<60 || vf>400 || vr>400 ) { vf=100; vr=100; }
  
   
    hzero=h0; 
    hfmin=h0+(hf/2);
    hfmax=h0+hf;
    hrmin=h0-(hr/2);
    hrmax=h0-hr;
  
    vzero=v0;
    vfmin=v0+(vf/2);
    vfmax=v0+vf;
    vrmin=v0-(vr/2);
    vrmax=v0-vr;


  
  if(mname=='L')
   {// i=0;
     if(mdir=='C')
       {//i=0;
        if(mspeed=='1')      {i=0; LHT.writeMicroseconds(hfmin);}
        else if (mspeed=='2'){i=0; LHT.writeMicroseconds(hfmax);}
        else {i=0;LHT.writeMicroseconds(hzero);}
       }
     else if(mdir=='A')
       {//i=0;
        if(mspeed=='1')       {i=0;LHT.writeMicroseconds(hrmin);}
        else if (mspeed=='2') {i=0;LHT.writeMicroseconds(hrmax);}
        else  {i=0;LHT.writeMicroseconds(hzero);}
       }
  }

  if(mname=='R')
   {// i=1;
     if(mdir=='C')
       {//i=1;
        if(mspeed=='1')      {i=1; RHT.writeMicroseconds(hfmin);}
        else if (mspeed=='2'){i=1; RHT.writeMicroseconds(hfmax);}
        else {i=1; RHT.writeMicroseconds(hzero);}
       }
     else if(mdir=='A')
       {//i=1;
        if(mspeed=='1')      {i=1; RHT.writeMicroseconds(hrmin);}
        else if (mspeed=='2'){i=1; RHT.writeMicroseconds(hrmax);}
        else {i=1; RHT.writeMicroseconds(hzero);}
       }
  }

  if(mname=='V')
   {// i=2;
     if(mdir=='C')
       {//i=2;
        if(mspeed=='1')       {i=2; LVT.writeMicroseconds(vfmin); RVT.writeMicroseconds(vfmin);  }
        else if (mspeed=='2') {i=2; LVT.writeMicroseconds(vfmax); RVT.writeMicroseconds(vfmax); }
        else  {i=2; LVT.writeMicroseconds(vzero); RVT.writeMicroseconds(vzero); }
       }
     else if(mdir=='A')
       {//i=2;
        if(mspeed=='1')       {i=2; LVT.writeMicroseconds(vrmin); RVT.writeMicroseconds(vrmin); }
        else if (mspeed=='2') {i=2; LVT.writeMicroseconds(vrmax); RVT.writeMicroseconds(vrmax); }
        else  {i=2; LVT.writeMicroseconds(vzero); RVT.writeMicroseconds(vzero); }
       }
  }


  
//  Serial.println(String(mspeed)+String(mdir)+String(mname));
/*  if(mname=='L')
   {// i=0;
     if(mdir=='C')
       {//i=0;
        if(mspeed=='1')      {i=0; LHT.writeMicroseconds(1530);}
        else if (mspeed=='2'){i=0; LHT.writeMicroseconds(1540);}
        else                  {i=0;LHT.writeMicroseconds(1500);}
       }
     else if(mdir=='A')
       {//i=0;
        if(mspeed=='1')       {i=0;LHT.writeMicroseconds(1470);}
        else if (mspeed=='2') {i=0;LHT.writeMicroseconds(1460);}
        else                  {i=0;LHT.writeMicroseconds(1500);}
       }
  }

  if(mname=='R')
   {// i=1;
     if(mdir=='C')
       {//i=1;
        if(mspeed=='1')      {i=1; RHT.writeMicroseconds(1530);}
        else if (mspeed=='2'){i=1; RHT.writeMicroseconds(1540);}
        else                 {i=1; RHT.writeMicroseconds(1500);}
       }
     else if(mdir=='A')
       {//i=1;
        if(mspeed=='1')      {i=1; RHT.writeMicroseconds(1470);}
        else if (mspeed=='2'){i=1; RHT.writeMicroseconds(1460);}
        else                 {i=1; RHT.writeMicroseconds(1500);}
       }
  }

  if(mname=='V')
   {// i=2;
     if(mdir=='C')
       {//i=2;
        if(mspeed=='1')       {i=2; LVT.writeMicroseconds(1530); RVT.writeMicroseconds(1530);  }
        else if (mspeed=='2') {i=2; LVT.writeMicroseconds(1540); RVT.writeMicroseconds(1540); }
        else                  {i=2; LVT.writeMicroseconds(1500); RVT.writeMicroseconds(1500); }
       }
     else if(mdir=='A')
       {//i=2;
        if(mspeed=='1')       {i=2; LVT.writeMicroseconds(1470); RVT.writeMicroseconds(1470); }
        else if (mspeed=='2') {i=2; LVT.writeMicroseconds(1460); RVT.writeMicroseconds(1460); }
        else                  {i=2; LVT.writeMicroseconds(1500); RVT.writeMicroseconds(1500); }
       }
  }
*/
 if(mdir=='C')         Mdir[i]='C';
 else if (mdir=='A')   Mdir[i]='A';
 
 if(mspeed=='1')       Mspeed[i]='1';
 else if(mspeed=='2')  Mspeed[i]='2';
 else                  Mspeed[i]='0';
  
//  Serial.println(String(i)+String(Mdir[i])+String(Mspeed[i]));
}





void tempsense()
{
int val = analogRead(temp);
float mv = ( val/1024.0)*5000; 
float cel = mv/10;
float farh = (cel*9)/5 + 32;
temperature=cel;
}

void depthsense()
{
  depth_sensor.read();
  pressure=depth_sensor.pressure();  // mbar
  temperature_d=depth_sensor.temperature(); //*C
  depth=depth_sensor.depth()-refdepth; // m 
}
