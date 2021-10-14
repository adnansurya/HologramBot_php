import sqlite3
import os



con = sqlite3.connect('holoAbsen.db')
cur = con.cursor()

cur.execute('''SELECT count(name) FROM sqlite_master WHERE type='table' AND name='holo_lg' ''')
if cur.fetchone()[0]!=1:
    con.execute('''
            CREATE TABLE "holo_lg" (
            "id_lg"	INTEGER PRIMARY KEY AUTOINCREMENT UNIQUE,
            "ktp_hex"	TEXT,
            "id_ur"	TEXT,
            "st_lg"	TEXT,
            "wkt"	TEXT
        )''')

cur.execute('''SELECT count(name) FROM sqlite_master WHERE type='table' AND name='holo_ur' ''')
if cur.fetchone()[0]!=1:
    con.execute('''
            CREATE TABLE "holo_ur" (
                "id_ac"	INTEGER PRIMARY KEY AUTOINCREMENT UNIQUE,
                "id_ur"	TEXT UNIQUE,
                "ktp_hex"	TEXT UNIQUE,
                "fst_nm"	TEXT,
                "lst_nm"	TEXT,
                "ur_nm"	TEXT,
                "im_fl"	TEXT,
                "tm_stmp"	TEXT,
                "role"	INTEGER
        )''')




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