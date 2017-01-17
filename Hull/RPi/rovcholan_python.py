import urllib2
import os.path
import time
import serial
temp= "25-02-2016 11.44.53 AM%0 N%0 E%1S0C0C0C"
path= 'gps.txt'
backup="**********%-%-%-"
while 1:
    x= urllib2.urlopen('http://192.168.7.1/myfiles/gps.php')
    gps=(x.read().strip())
    if os.path.isfile(path):
       file = open(path,'w')
       file.write(gps)
       file.close()
       time.sleep(0.01)
    ser=serial.Serial("/dev/ttyAMA0",9600,timeout=1)
    cmd   = ""
    file1 = open('/var/www/rovcholan/arduinocmd.txt')
    lines = file1.readlines(100000)
    for line in lines:
        pass # do something
    str=''.join(lines)
    if str!="" :
	   backup=str
    else:
	   str=backup
    acmd = "@" + str + "&"
    ser.write(acmd)
    print "Sent: " + acmd
    file1.close()

    while True:
        c = ser.read();
#    cmd="@%5.58%243.16%-2273.69%0.00%36986596.00%378282.81%0.00%0%0%OFF%ZERO%NIL%ZERO%NIL%ZERO%NIL^0.00^0.00^1440-1560^1400-1600&"
        if (c=='&'):
           break        
        cmd=cmd+c
         
    if cmd.find('@')!=-1 :
          cmd=cmd.replace('@','')
          ccmd=cmd.split('^')
          f = open('/var/www/rovcholan/arduinodata.txt', 'w')
          file1 = open('/var/www/rovcholan/temp.txt')
          lines = file1.readline(100)
    	  ccmd[0]=ccmd[0]+'%'+lines
#          print "Recieved: " + ccmd[0]
          time.sleep(0.001)
          f.write(ccmd[0])
          f.close()
          file1.close()
          print "Recieved: " + ccmd[0]      
    ser.close()
