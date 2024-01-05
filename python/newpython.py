import serial
import mysql.connector

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="miniproject"
)
mycursor = mydb.cursor()

pin = serial.Serial('COM8', 9600)

flag = 0
data = ""
while True:
    value = pin.read().decode('ascii')

    if value == '*':
        flag = 1
    elif value == '#':
        flag = 0
        adp = data
        sql = "SELECT log_status FROM emp_logs WHERE Rf_id=%s AND log_id=(SELECT MAX(log_id) FROM emp_logs WHERE Rf_id=%s)"  # Remove single quotes around %s
        mycursor.execute(sql, (adp,adp))  # Pass adp as a tuple to execute()
        result = mycursor.fetchone()[0]
        
        if result=="IN":
            status="OUT"
        else:
            status="IN"
        sql = "INSERT INTO emp_logs (Rf_id,Log_status) VALUES (%s, %s)"
        val = (adp, status)
        mycursor.execute(sql, val)
        print("Your ID : ",adp," status : ", status)
        mydb.commit()
        data = ""
    if flag == 1:
        if value != '*' and value != '#':
            data += value
