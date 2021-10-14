from gtts import gTTS
from playsound import playsound
import os


def printText(teks):
    tampilkan = "Test : " + str(teks)
    print(tampilkan)


def sebutNama(nama):
    mytext = 'Hallo ' + str(nama)

    language = 'en'
    myobj = gTTS(text=mytext, lang=language, slow=False)
    myobj.save("welcome.mp3")

    playsound("welcome.mp3")