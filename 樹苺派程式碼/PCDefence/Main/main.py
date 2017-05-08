#
#	作者:戴宇辰
#	完成時間:5/27
#
import RPi.GPIO as GPIO
import time
import picamera
import urllib
import urllib2
import requests
import thread
import L-HCSR04
import R-HCSR04

i = 0
workday = datetime.date(2016,12,1)
today = datetime.date.today()

from time import gmtime, strftime
url="http://203.72.0.26/~nhu1403/image.php"
python_url = "http://203.72.0.26/~nhu1403/getPythonData.php"
Count_url = "http://203.72.0.26/~nhu1403/getImageCountLeft.php"
SendGCM_url = "http://203.72.0.26/~nhu1403/APP_SendGcmMessage.php"

try:
      thread.start_new_thread(L-HCSR04.run, ())
      thread.start_new_thread(R-HCSR04.run, ())
except:
      print "Errot!"

while True:
      #ultrasound first get distance of left and right.
      dist_L = get_distance_L()
      dist_R = get_distance_R()
      #initialize Low state.
      GPIO.output(LED_PIN_L, GPIO.LOW)
      GPIO.output(LED_PIN_R, GPIO.LOW)
      GPIO.output(buzzer, GPIO.LOW)
      #picture name format setting.
      LeftName = 'nhu1403-{counter:d}.jpg'
      RightName = 'nhu1403-{counter:d}.jpg'
      #set GCM message state initialize for 0.
      fetch_thing(SendGCM_url,{'state':0},'GET')
      with picamera.PiCamera() as camera:
            camera.FLASH_MODES = 'on'
            if (dist_L <= 5 or dist_R <= 5):
                  #Left senssor.
                  try:
                        if (dist_L > 0 and dist_L <= 5):
                              GPIO.output(LED_PIN_L, GPIO.HIGH)
                              GPIO.output(LED_PIN_R, True)
                              #GPIO.output(buzzer, GPIO.HIGH)
                              readLeft = urllib.urlopen("http://203.72.0.26/~nhu1403/count_left.txt")
                              #i = int(str(readLeft.read()), 10)
                              i = int(readLeft.read())
                              
                              while(i <= 30):
                                    i = i + 1
                                    if i == 31:
                                          i = 1
                                          if(int(str((today - workday).days)) == 14):
                                                print "In time!"
                                                workday += datetime.timedelta(days=1)
                                                #write file!
                                          else:
                                                print "No arrive time!"
                                                workday += datetime.timedelta(days=1)
                                                print workday
                                          fetch_thing(Count_url,{'Left_sensor':0},'GET')
                                    camera.capture("nhu1403" + '-%d' %(i) + ".jpg");
                                    fetch_thing(SendGCM_url,{'state':1},'GET')
                                  
                                    fetch_thing(Count_url,{'Left_sensor':i},'GET')
                                    files = {'file': open("nhu1403" + '-%d' %(i) + ".jpg", 'rb')}

                                    r = requests.post(url, files=files)
                                    if(os.path.isfile("nhu1403" + '-%d' %(i) + ".jpg")== True):
                                          time.sleep(1)
                                          os.remove("nhu1403" + '-%d' %(i) + ".jpg")
                                    response_code = fetch_thing(python_url,
                                                {'id':'nhu1403' + '-%d' %(i) + '.jpg','temp':"LEFT Warming: CM = %.3f" % dist_L},'GET')
                                    print response_code
                                    time.sleep(1)
                                    print ("OH! OH! Warming!!Left: CM = %.3f" % dist_L)
                                    dist_L = get_distance_L()
                                    
                                    print i
                                    if dist_L > 5:
                                          break
                     #Right senssor.              
                        if (dist_R > 0 and dist_R <= 5):
                              GPIO.output(LED_PIN_R, True)
                              GPIO.output(LED_PIN_L, GPIO.HIGH)
                              #GPIO.output(buzzer, GPIO.HIGH)
                              readLeft = urllib.urlopen("http://203.72.0.26/~nhu1403/count_left.txt")
                              #i = int(str(readLeft.read()), 10)
                              i = int(readLeft.read())
                              
                              while(i <= 100):
                                    i = i + 1
                                    if i == 100:
                                          i = 1
                                          #if(int(str((today - workday).days)) == 14):
                                                #print "In time!"
                                                #workday += datetime.timedelta(days=1)
                                                #write file!
                                          #else:
                                                #print "No arrive time!"
                                                #workday += datetime.timedelta(days=1)
                                                #print workday
                                          fetch_thing(Count_url,{'Left_sensor':0},'GET')
                                    camera.capture("nhu1403" + '-%d' %(i) + ".jpg");
                                    fetch_thing(SendGCM_url,
                                    {'state':1},'GET')
                                    
                                    GPIO.output(LED_PIN_L, GPIO.HIGH)
                                    GPIO.output(buzzer, GPIO.HIGH)
                               
                                    #for i,filename in enumerate(camera.capture_continuous(LeftName)):
                                    #i = int(str(readLeft.read()))
                                    #i = i + 1
                                    
                                    fetch_thing(Count_url,{'Left_sensor':i},'GET')
                                    files = {'file': open("nhu1403" + '-%d' %(i) + ".jpg", 'rb')}

                                    #count_i = count_i + 1
                                    r = requests.post(url, files=files)
                                    if(os.path.isfile("nhu1403" + '-%d' %(i) + ".jpg")== True):
                                          time.sleep(1)
                                          os.remove("nhu1403" + '-%d' %(i) + ".jpg")
                                    response_code = fetch_thing(python_url,
                                         {'id':'nhu1403' + '-%d' %(i) + '.jpg','temp':"Right Warming: CM = %.3f" % dist_R},'GET')
                                    print response_code
                                    time.sleep(1)
                                    print ("OH! OH! Warming!!Right: CM = %.3f" % dist_R)
                                    dist_R = get_distance_R()
                                    
                                    print i
                                    if dist_R > 5:
                                          break
                                          
                  except KeyboardInterrupt:
                        print "Error!"
                        GPIO.cleanup()
                  
            else: 
                  print("LEFT:  CM = %.3f" % dist_L)
                  print("RIGHT: CM = %.3f\n" % dist_R)
                  time.sleep(0.0001)
                  #camera.close()