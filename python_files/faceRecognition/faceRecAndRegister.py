import cv2
import numpy as np
import face_recognition
import nameSplitter as ns
import time
import dbManager
import os
import customFunction as cfun
import requests


# urlServer = "https://hologramks.000webhostapp.com/"
urlServer = "http://127.0.0.1/HologramBot_php/"
namaFolder = "Foto"


objVideo = cv2. VideoCapture(0)
if not objVideo.isOpened():
    print('Kamera tak dapat diakses')
    exit()
objVideo.set(cv2.CAP_PROP_POS_FRAMES, 10)
objVideo.set(cv2.CAP_PROP_FRAME_WIDTH, 480)
objVideo.set(cv2.CAP_PROP_FRAME_HEIGHT, 320)

tombolDitekan = False
tekanC = False
adaOrang = False

path = 'Foto'
if not os.path.exists(path):
    os.mkdir(path)

framePath = 'LastFrame'
if not os.path.exists(framePath):
    os.mkdir(framePath)

# known face encoding and known face name list
lastNamed = "unknown"
lastKnown = "unknown"
images = []
class_names = []
encode_list = []
attendance_list = os.listdir(path)
# print(attendance_list)
for cl in attendance_list:
    cur_img = cv2.imread(f'{path}/{cl}')
    images.append(cur_img)
    class_names.append(os.path.splitext(cl)[0])
for img in images:
    img = cv2.cvtColor(img, cv2.COLOR_BGR2RGB)
    boxes = face_recognition.face_locations(img)
    encodes_cur_frame = face_recognition.face_encodings(img, boxes)[0]
    # encode = face_recognition.face_encodings(img)[0]
    encode_list.append(encodes_cur_frame)
    
def face_rec_(frame, encode_list_known, class_names):
        """
        :param frame: frame from camera
        :param encode_list_known: known face encoding
        :param class_names: known face names
        :return:
        """
        # face recognition
        faces_cur_frame = face_recognition.face_locations(frame) 
        
        global adaOrang
        if len(faces_cur_frame) > 0:
            adaOrang = True
        else:
            adaOrang = False

        encodes_cur_frame = face_recognition.face_encodings(frame, faces_cur_frame)
        # count = 0
        for encodeFace, faceLoc in zip(encodes_cur_frame, faces_cur_frame):
            match = face_recognition.compare_faces(encode_list_known, encodeFace, tolerance=0.50)
            face_dis = face_recognition.face_distance(encode_list_known, encodeFace)
            name = "unknown"

            if len(class_names) > 0:
                best_match_index = np.argmin(face_dis)
            else:
                best_match_index = -1
            
            y1, x2, y2, x1 = faceLoc
            if best_match_index > -1 and match[best_match_index]:
                name = class_names[best_match_index].upper()  
                name = str(name).split("-")[0]     
                cv2.rectangle(frame, (x1, y1), (x2, y2), (0, 255, 0), 2)
                cv2.rectangle(frame, (x1, y2 - 20), (x2, y2), (0, 255, 0), cv2.FILLED)
                
            else:
                cv2.rectangle(frame, (x1, y1), (x2, y2), (255, 0, 0), 2)
                cv2.rectangle(frame, (x1, y2 - 20), (x2, y2), (255, 0, 0), cv2.FILLED)
                
            cv2.putText(frame, name, (x1 + 6, y2 - 6), cv2.FONT_HERSHEY_COMPLEX, 0.5, (255, 255, 255), 1)
            global lastNamed
            global lastKnown

            if name != lastNamed:
                
                cv2.imwrite(framePath+"/LastFrame.jpg", frame)
                imgFile = cfun.toBase64(framePath+"/LastFrame.jpg")
                myobj = {
                    'gambar': imgFile,
                    'nama' : name
                    }

                x = requests.post(urlServer + "api/ported_absen.php", data = myobj)
                respon = x.text
                print(respon)
                cfun.printText(name)
                if name != lastKnown and name != "unknown":
                    
                    # p3.sebutNama(name)
                    teks = name + " (Dikenal)"
                    cfun.printText(teks)
                    # cv2.imwrite(str(name) +"-Cap.jpg", frame)
                    lastKnown = name
           
            
            lastNamed = name   
                    
            
            
            # mark_attendance(name)
            
        return frame

        
lastFrame =None
while (tombolDitekan == False):
    ret, frame = objVideo.read()
    
    if ret == True:
        lastFrame = frame
        image = cv2.resize(frame, (480,320))
        try:
            image = face_rec_(image, encode_list, class_names)
            cv2.imshow('Frame',image)
        except Exception as e:
            print(e)

        if cv2.waitKey(1) & 0xFF == ord('q'):
            tombolDitekan = True
            break

        if cv2.waitKey(1) & 0xFF == ord('c'):
            tombolDitekan = True
            tekanC = True
            print('C ditekan')
            break
    else:
        break

objVideo.release()
cv2.destroyAllWindows()

if lastNamed == 'unknown' and adaOrang:
    namaFoto = str(input("Masukkan Nama Foto : "))
    

    r = requests.get(urlServer + "api/get_member.php")

    jsonObj = r.json()

    print('No - Telegram - KTP - FirstName - LastName - Username - Foto - Timestamp - Role ') 
    print('--------------------------------------------------------------------------')       
    userDisplay = ""
    for i in range(len(jsonObj)):
        userObj = jsonObj[i] 
        
        userDisplay += str(i+1)
        userDisplay += " - "   
        for key in userObj:
            if userObj[key] == "":
                userDisplay += "x"               
            if key != "id_ac":
                userDisplay += str(userObj[key])
                userDisplay += " - "                        
            # print(key, ":", userObj[key])

        

    print(userDisplay)
    idUser = int(input("Masukkan No. Member sesuai Foto : ")) -1
    idTelegram = str(jsonObj[idUser]['id_ur'])    

    
    myobj = {
        'id': idTelegram,
        'filename' : namaFoto
        }

    x = requests.post(urlServer + "api/photo_link.php", data = myobj)

    respon = x.text
    print(respon)
    
    if(respon.find('Berhasil') > -1):
        i = 0
        namaFoto = respon.split(':')[1]       

        namaFileFoto = cfun.uniquify(path+"/"+namaFoto+".jpg")
        print(namaFileFoto)          
        cv2.imwrite(namaFileFoto, lastFrame)
    





    