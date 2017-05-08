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

from time import gmtime, strftime
url="http://203.72.0.26/~nhu1403/image.php"

buzzer = 5
GPIO.setwarnings(False)
GPIO.setmode(GPIO.BCM)
GPIO.setup(buzzer, GPIO.OUT)

#Left ultrasound initializer.
trigger_pin_L = 23
echo_pin_L = 24
GPIO.setwarnings(False)
GPIO.setmode(GPIO.BCM)
GPIO.setup(trigger_pin_L, GPIO.OUT)
GPIO.setup(echo_pin_L, GPIO.IN)

LED_PIN_L = 27
GPIO.setwarnings(False)
GPIO.setup(LED_PIN_L, GPIO.OUT)

def send_trigger_pulse_L():
      GPIO.output(trigger_pin_L, True)
      time.sleep(0.001)
      GPIO.output(trigger_pin_L, False)

def wait_for_echo_L(value, timeout):
      count = timeout
      while GPIO.input(echo_pin_L) != value and count > 0:
            count = count - 1

def get_distance_L():
      send_trigger_pulse_L()
      wait_for_echo_L(True, 5000)
      start = time.time()
      wait_for_echo_L(False, 5000)
      finish = time.time()
      pulse_len = finish - start
      distance_cm = (pulse_len*34300)/2 
      return (distance_cm)
