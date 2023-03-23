import serial
import time
import mysql.connector
import datetime
from tkinter import *
try:
    arduino = serial.Serial(port='com3', baudrate=9600)
    time.sleep(2)
    x=0
    l=[]
    while x<5:
        incoming = str (arduino.readline()) #read the serial data and print it as line
        l.append(incoming)
        incoming =""; 
        x=x+1 
    l.remove(l[0])
    l1=[]
    for i in l:
        s=''
        x=list(i)
        s=x[2]+x[3]+x[4]+x[5]+x[6]
        l1.append(s)
    arduino.close()
    print("All the data(humidity,temperature):",l1)
    x1=l1[0]
    y1=l1[1]
    p1=input("Please provide your place name: ")
    t1=datetime.datetime.now()
    db1 = mysql.connector.connect(host="localhost", user="root", password="", database="weather")
    mycursor1 = db1.cursor()
    sql="insert into weatherData (humidity,temperature,place,time) values (%s,%s,%s,%s);"
    val=(x1,y1,p1,t1)
    mycursor1.execute(sql,val)
    db1.commit()
    db1.close()
    print("succuss...")
except:
    print("Something wrong happend")