import os
import sys
import time
import subprocess
batcmd="/opt/vc/bin/vcgencmd measure_temp"


while 1:
     file1 = open('/var/www/rovcholan/temp.txt','w')
     x=subprocess.check_output(batcmd, shell=True)
     y=x.split('=')     
     x=y[1].split('C')
     file1.write(x[0]+'C')
#    print lines
#    if lines=="OFF" and status=="ON":
#print os.system("/opt/vc/bin/vcgencmd measure_temp")
#          status="OFF"
#    if lines=="ON" and status=="OFF":
#          os.system("sh /var/www/rovcholan/camon.sh")
#          status="ON"
     file1.close()           
     time.sleep(1)

