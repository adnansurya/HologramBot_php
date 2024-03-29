import cv2
import numpy as np
import face_recognition
import os

objVideo = cv2. VideoCapture(0)
if not objVideo.isOpened():
    print('Kamera tak dapat diakses')
    exit()
objVideo.set(cv2.CAP_PROP_POS_FRAMES, 10)
objVideo.set(cv2.CAP_PROP_FRAME_WIDTH, 480)
objVideo.set(cv2.CAP_PROP_FRAME_HEIGHT, 320)

tombolDitekan = False
path = 'Foto'

if not os.path.exists(path):
    os.mkdir(path)

images = []
class_names = []
encode_list = []
attendance_list = os.listdir(path)

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
        encodes_cur_frame = face_recognition.face_encodings(frame, faces_cur_frame)
        # count = 0
        for encodeFace, faceLoc in zip(encodes_cur_frame, faces_cur_frame):
            match = face_recognition.compare_faces(encode_list_known, encodeFace, tolerance=0.50)
            face_dis = face_recognition.face_distance(encode_list_known, encodeFace)
            name = "unknown"
            best_match_index = np.argmin(face_dis)
            # print("s",best_match_index)
            
            y1, x2, y2, x1 = faceLoc
            if match[best_match_index]:
                name = class_names[best_match_index].upper()            
                cv2.rectangle(frame, (x1, y1), (x2, y2), (0, 255, 0), 2)
                cv2.rectangle(frame, (x1, y2 - 20), (x2, y2), (0, 255, 0), cv2.FILLED)
                
            else:
                cv2.rectangle(frame, (x1, y1), (x2, y2), (255, 0, 0), 2)
                cv2.rectangle(frame, (x1, y2 - 20), (x2, y2), (255, 0, 0), cv2.FILLED)
                
            cv2.putText(frame, name, (x1 + 6, y2 - 6), cv2.FONT_HERSHEY_COMPLEX, 0.5, (255, 255, 255), 1)                                    
        return frame


while (tombolDitekan == False):
    ret, frame = objVideo.read()
    
    if ret == True:        
        image = cv2.resize(frame, (480,320))
        try:
            image = face_rec_(image, encode_list, class_names)
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





    