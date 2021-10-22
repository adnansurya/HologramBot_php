from gtts import gTTS
from playsound import playsound
import os
import requests
import base64


def printText(teks):
    tampilkan = "Test : " + str(teks)
    print(tampilkan)


def sebutNama(nama):
    mytext = 'Hallo ' + str(nama)

    language = 'en'
    myobj = gTTS(text=mytext, lang=language, slow=False)
    myobj.save("welcome.mp3")

    playsound("welcome.mp3")

def uniquify(path):
    filename, extension = os.path.splitext(path)
    counter = 0 
    path = filename + "-" + str(counter) + extension
    while os.path.exists(path):
        path = filename + "-" + str(counter) + extension
        counter += 1

    return path


def toBase64(imgPath):
    with open(imgPath, "rb") as image_file:
        encoded_string = base64.b64encode(image_file.read())
    return encoded_string         

# print(uniquify('Foto/Adnan.jpg'))