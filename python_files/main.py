import serial

ser = serial.Serial('COM5', 9600)

while True:
    line = ser.readline()
    print(line.strip().decode( "utf-8" ))
