import cv2
import numpy as np
import playsound
import smtplib
import  time
fire_reported=0
alarm_status=False
email_status=False
def play_audio():
    playsound.playsound("audioblocks-warning-attention-security-alarm-3_SWezu3uXtvL_WM (1).mp3")
#def send_email():



video=cv2.VideoCapture(0)
while True:
    ret,frame=video.read()

    if ret == False:
        break

    blur=cv2.GaussianBlur(frame,(15,15),0)
    hsv=cv2.cvtColor(blur,cv2.COLOR_BGR2HSV)
    lower=[18,50,50]
    upper=[35,255,255]
    lower=np.array(lower,'uint8')
    upper=np.array(upper,'uint8')
    mask=cv2.inRange(hsv,lower,upper)
    output= cv2.bitwise_and(frame,hsv,mask=mask)

    cv2.imshow('output', output)
    temp=27
    humidity=60
    number_of_total=cv2.countNonZero(mask)
    if int(number_of_total) > 15000:
        fire_reported=fire_reported+1
        if fire_reported>=1:
            if alarm_status==False and temp>26 and humidity>59 :
                print('k')
                play_audio()
                alarm_status=True
            if email_status== False:
                #send_email()
                email_status=True

    if cv2.waitKey(5) & 0xFF == ord('q'):
        break
cv2.destroyAllWindows()
video.release()

