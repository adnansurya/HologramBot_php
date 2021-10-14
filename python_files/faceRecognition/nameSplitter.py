

def akhirNama(nama):
    name = str(nama)
    namaPisah = name.split()
    splitter = int(len(namaPisah)/2)
    lastName ='' 
    lN = namaPisah[-splitter:]
    for i in lN:
        i += ' '
        lastName += i
    return lastName

def awalNama(nama):
    name = str(nama)
    namaPisah = name.split()
    splitter = int(len(namaPisah)/2)
    firstName = ''
    fN = namaPisah[0:-splitter]
    for i in fN:
        i += ' '
        firstName += i