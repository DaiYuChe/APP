import RPi.GPIO as GPIO
import time
import picamera
import urllib
import urllib2
#
#	作者:戴宇辰
#	完成時間:5/27
#

import requests

from time import gmtime, strftime
url="http://203.72.0.26/~nhu1403/image.php"

buzzer = 5
GPIO.setwarnings(False)
GPIO.setmode(GPIO.BCM)
GPIO.setup(buzzer, GPIO.OUT)

#Right ultrasound initializer.
trigger_pin_R = 16
echo_pin_R = 20
GPIO.setwarnings(False)
GPIO.setmode(GPIO.BCM)
GPIO.setup(trigger_pin_R, GPIO.OUT)
GPIO.setup(echo_pin_R, GPIO.IN)

#LED initializer.
LED_PIN_R = 17
GPIO.setwarnings(False)
GPIO.setup(LED_PIN_R, GPIO.OUT)

def send_trigger_pulse_R():
      GPIO.output(trigger_pin_R, True)
      time.sleep(0.001)
      GPIO.output(trigger_pin_R, False)

def wait_for_echo_R(value, timeout):
      count = timeout
      while GPIO.input(echo_pin_R) != value and count > 0:
            count = count - 1

def get_distance_R():
      send_trigger_pulse_R()
      wait_for_echo_R(True, 5000)
      start = time.time()
      wait_for_echo_R(False, 5000)
      finish = time.time()
      pulse_len = finish - start
      distance_cm = (pulse_len*34300)/2 
      return (distance_cm)
