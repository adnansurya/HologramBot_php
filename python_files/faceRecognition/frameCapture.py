import cv2
import numpy as np
import face_recognition
import os
import customFunction as cfun
import base64
import requests

# urlServer = "https://hologramks.000webhostapp.com/"
urlServer = "http://127.0.0.1/HologramBot_php/"

objVideo = cv2. VideoCapture(0)
if not objVideo.isOpened():
    print('Kamera tak dapat diakses')
    exit()
objVideo.set(cv2.CAP_PROP_POS_FRAMES, 10)
objVideo.set(cv2.CAP_PROP_FRAME_WIDTH, 480)
objVideo.set(cv2.CAP_PROP_FRAME_HEIGHT, 320)

tombolDitekan = False
path = 'Capture'
namaFoto = 'oi'

if not os.path.exists(path):
    os.mkdir(path)

lastFrame = None
while (tombolDitekan == False):
    
    ret, frame = objVideo.read()
    
    if ret == True:    
        lastFrame = frame    
        image = cv2.resize(frame, (480,320))
        try:            
            cv2.imshow('Frame',image)
        except Exception as e:
            print(e)

        if cv2.waitKey(1) & 0xFF == ord('q'):
            tombolDitekan = True
            break
        
    else:
        break

objVideo.release()
cv2.destroyAllWindows()



namaFileFoto = cfun.uniquify(path+"/"+namaFoto+".jpg")
print(namaFileFoto)          
cv2.imwrite(namaFileFoto, lastFrame)

with open(namaFileFoto, "rb") as image_file:
    encoded_string = base64.b64encode(image_file.read())

     
    myobj = {
        'gambar': encoded_string
        }

    x = requests.post(urlServer + "api/ported_absen.php", data = myobj)
    respon = x.text
    print(respon)