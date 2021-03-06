import serial
import urllib.request as req
import urllib.parse as par
import json
from playsound import playsound
import os
import serial.tools.list_ports

selectedPort = ""
ports = serial.tools.list_ports.comports()
for port, desc, hwid in sorted(ports):
    print("{}: {} [{}]".format(port, desc, hwid))
    deskripsi = desc.lower()
    if(deskripsi.find('arduino uno') != -1):
        selectedPort = port
        print("ARDUINO UNO PORT : " + selectedPort)



def playRingtone(resultStr, toneStr):
    path =  os.path.dirname(__file__)
    mp3string =path + "\\" + 'tone' + "\\" + toneStr + "\\" + resultStr + '.mp3'
    playsound(mp3string)

def loadJson(teks):
    jsonObj = json.loads(teks)
    result = str(jsonObj['result']).lower()
    msg = jsonObj['msg']
    uid = jsonObj['data']['uid']
    
    if(jsonObj['data']['tone'] != 'unknown'):
        tone = jsonObj['data']['tone']['ringtone_name']
    else:
        tone = 'unknown'

    print(result)
    print(uid)
    print(tone)
    
    if(result != 'unknown'):
        playRingtone(result, tone)
    else:
        playRingtone(result, 'default')
    
        
    

    
    

def sendPost(card_id):
    apiurl = 'https://betaku.000webhostapp.com/hologramBot/absen.php'
    data = {
            'card' : card_id
           
        }
    data = bytes(par.urlencode(data).encode())
    handler = req.urlopen(apiurl,data)
    resText = handler.read().decode('utf-8')
    print(resText)
    return resText


    

if(selectedPort == ""):
    print("ARDUINO TIDAK TERDETEKSI")
    exit()

ser = serial.Serial(selectedPort, 9600)
try:
    while True:
        line = ser.readline()
        clean_line = line.strip().decode( "utf-8" )
        if(line != ''):
            uid = str(clean_line).replace(':','-')
            print('ID : ' + uid)

            koneksi = False
            
            
            try :
                responText = sendPost(uid)
                koneksi = True
            except :
                koneksi = False

            if koneksi:
                loadJson(responText)
            else:
                playRingtone('gagal', 'default')

except KeyboardInterrupt:

    print("Press Ctrl-C to terminate while statement")

    pass
