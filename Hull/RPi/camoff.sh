
#cd /var/www/rovcholan/
#sudo python rovcholan_python.py &
#killall mjpg_streamer
#/home/pi/mjpg-streamer/mjpg-streamer/mjpg_streamer -i "/home/pi/mjpg-streamer/mjpg-streamer/input_uvc.so -f 15 -r 640x480" -o "/home/pi/mjpg-streamer/mjpg-streamer/output_http.so -w /home/pi/mjpg-streamer/mjpg-streamer/www" &

sudo pkill mjpg_streamer
