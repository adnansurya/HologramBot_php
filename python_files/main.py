import serial
import urllib.request as req
import urllib.parse as par

def sendPost(card_id):
    apiurl = 'https://betaku.000webhostapp.com/hologramBot/absen.php'
    data = {
            'card' : card_id
           
        }
    data = bytes(par.urlencode(data).encode())
    handler = req.urlopen(apiurl,data)
    print(handler.read().decode('utf-8'))

ser = serial.Serial('COM5', 9600)

while True:
    line = ser.readline()
    clean_line = line.strip().decode( "utf-8" )
    if(line != ''):
        
        print('ID : ' + str(clean_line))
        sendPost(clean_line)
