import sqlite3

con = sqlite3.connect('holoAbsen.db')
cur = con.cursor()

def newUser(idTele, idKtp, firstName, lastName, userName, imageFile, timeStamp, role):
    sqlStr = ("INSERT INTO holo_ur  ("
    "id_ur, ktp_hex, fst_nm, lst_nm, ur_nm, im_fl, tm_stmp, role) VALUES "
    "('%s','%s','%s','%s','%s','%s','%s','%s') " 
    % (str(idTele), str(idKtp), str(firstName), str(lastName), str(userName), str(imageFile), str(timeStamp), str(role)))  
    print(sqlStr)
    con.execute(sqlStr)
    con.commit()
    print("Berhasil Disimpan")
    con.close()

# newUser(1,2,3,4,5,6,7,8)