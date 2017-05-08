#
#	作者:戴宇辰
#	完成時間:9/30
#
import RPi.GPIO as GPIO, time, requests, os
import subprocess, sys
import os

def cls():
    os.system(['clear','cls'][os.name == 'nt'])
GPIO.cleanup()
#DEBUG = 1
#buzzer initializer
buzzer = 26
GPIO.setmode(GPIO.BCM)
GPIO.setup(buzzer, GPIO.OUT)

#LED initializer
LED = 21
GPIO.setup(LED, GPIO.OUT)
#GPIO.setup(BLUE, GPIO.OUT)

#remove warnings messages
GPIO.setwarnings(False)

response = requests.get('http://203.72.0.26/~nhu1403/Python_test.php')

while response.text != 'exit':
    response = requests.get('http://203.72.0.26/~nhu1403/Python_test.php')
    data = response.text
    
    Buzzer = data[0]
    TakePic = data[1]
    Reset = data[2]
    Shutdown = data[3]
    Light = data[4]
    Music = data[5]
    Recoder = data[6]

    cls()

    if response.text == 'exit':
        print (data)
    else:
        print ("Buzzer" + Buzzer + ", "),
        print ("TakePic" + TakePic + ", "),
        print ("Reset" + Reset + ", "),
        print ("Shutdown" + Shutdown + ", "),
        print ("Light" + Light + ", "),
        print ("Music" + Music + ", "),
        print ("Recoder" + Recoder)
        print

    #control buzzer
    if Buzzer == "1":
        GPIO.output(buzzer,True)     
    else:
        GPIO.output(buzzer,False)
        print "stop Buzzer"
    #take picture  
    if TakePic == '1':
        GPIO.output(LED,True)
        os.system("sudo python /home/pi/PCDefence/Main/TakePicture.py")
    else:
        GPIO.output(LED,False)
        print "stop TakePic"
    #control system reboot 
    if Reset == '1':
        os.system("sudo reboot")
    else:
        print "stop Reset"
    #control system shutdown 
    if Shutdown == '1':
        os.system("sudo shutdown 0")
    else:
        print "stop Shutdown"
    #control LED light    
    if Light == '1':
        GPIO.output(LED,True)
    else:
        GPIO.output(LED,False)
        print "stop Light"
    #music play 
    if Music == '1':
        os.system("sudo python /home/pi/PCDefence/Main/Android_Raspi/FetchRecoder.py")
        os.system("omxplayer RecoderTest.amr")
    else:
        #os.system("omxplayer -o /home/pi/PCDefence/Main/Android_Raspi/music.mp3")
        #os.system("sys.exit()")
        #p.stdin.write('q')
        print "stop Music"
    #testing...
    if Recoder == '1':
        #os.system("sudo shutdown 0")
        os.system("sudo exit")
    else:
        print "stop Recoder"
