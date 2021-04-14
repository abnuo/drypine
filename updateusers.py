import os
import sys
import mysql.connector 
passwordSQL = sys.argv[1]
mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password= passwordSQL,
  database="userinfo"
)
mycursor = mydb.cursor()
query = "SELECT username FROM users;"
mycursor.execute(query)
myresult = mycursor.fetchall()
for x in myresult:
  print("Updating the page for " + x[0])
  os.system("/usr/local/bin/python3 makeuserpage.py " + x[0] + " " + passwordSQL)
