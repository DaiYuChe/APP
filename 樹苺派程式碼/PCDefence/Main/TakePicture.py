#
#	作者:戴宇辰
#	完成時間:9/30
#
#take one picture!
import RPi.GPIO as GPIO
import time
import picamera
import os
import requests
import urllib
import urllib2
from time import gmtime, strftime

url = 'http://203.72.0.26/~nhu1403/image.php'
python_url = "http://203.72.0.26/~nhu1403/getImmediateImg.php"
ImageName = "Test_Image-1.jpg"

def fetch_thing(url, params, method):
      params = urllib.urlencode(params)
      if method == 'POST':
            f = urllib.urlopen(url, params)
      else:
            f = urllib.urlopen(url + '?' + params)
            
      return(f.read(), f.code)

with picamera.PiCamera() as camera:
      camera.capture(ImageName)
      files = {'file': open("Test_Image-1.jpg", 'rb')}
      r = requests.post(url, files=files)
      response_code = fetch_thing(python_url,
      {'username':"Test_Image-1.jpg"},'GET')
      if(os.path.isfile(ImageName)== True):
            time.sleep(1)
            os.remove(ImageName)
