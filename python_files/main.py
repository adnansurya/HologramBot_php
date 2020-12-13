import serial
import urllib.request as req
import urllib.parse as par
import json 

def loadJson(teks):
    jsonObj = json.loads(teks)
    result = jsonObj['result']
    msg = jsonObj['msg']
    uid = jsonObj['data']['uid']
    tone = jsonObj['data']['tone']['ringtone_name']
    
    print(uid)
    print(tone)
    

    
    

def sendPost(card_id):
    apiurl = 'https://betaku.000webhostapp.com/hologramBot/absen.php'
    data = {
            'card' : card_id
           
        }
    data = bytes(par.urlencode(data).encode())
    handler = req.urlopen(apiurl,data)
    resText = handler.read().decode('utf-8')
    print(resText)
    loadJson(resText)

ser = serial.Serial('COM5', 9600)

while True:
    line = ser.readline()
    clean_line = line.strip().decode( "utf-8" )
    if(line != ''):
        uid = str(clean_line).replace(':','-')
        print('ID : ' + uid)
        sendPost(uid)
