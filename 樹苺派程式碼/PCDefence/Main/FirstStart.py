import os

os.system('sudo ifconfig wlan0 192.168.68.135')
#os.system('sudo ifconfig wlan0 192.168.43.133')
os.system('sudo dhclient')
