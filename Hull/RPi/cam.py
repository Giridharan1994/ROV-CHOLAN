import os
import sys
import time
status="OFF" 
#file1 = open('/var/www/rovcholan/camera.txt')

while 1:
    file1 = open('/var/www/rovcholan/camera.txt')
    lines = file1.read()
#    print lines
    if lines=="OFF" and status=="ON":
          os.system("sh /var/www/rovcholan/camoff.sh")
          status="OFF"
    if lines=="ON" and status=="OFF":
          os.system("sh /var/www/rovcholan/camon.sh")
          status="ON"
    file1.close()           
#    time.sleep(1)
