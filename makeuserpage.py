import sys
import os
import os.path
import mysql.connector
import html
passwordSQL = sys.argv[2]
mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password=passwordSQL,
  database="userinfo"
)
mycursor = mydb.cursor()
query = "SELECT avatar FROM users WHERE username = '" + sys.argv[1] + "';"
mycursor.execute(query)
avatarurl = mycursor.fetchone()
template = "<?php include_once '../header.php'; ?><link rel='stylesheet' href='/style.css'> <title>" + sys.argv[1] + "</title><div> <div class='extrainf' style=\"position:'fixed'; top: '0px'; height: 200px; width: 500px;\"><h2 align='left'>" + sys.argv[1] + "</h1>" + "<img class='avatar' src=<?php echo getAvatar(\'" + sys.argv[1] + "\'); ?> align='left' width='128' height='128'></img> <h4> \n <?php $commentform = file_get_contents('../commentform.php'); getbio(basename($_SERVER['PHP_SELF'],'.php')); ?></h4></div> \n <?php if (isset($_COOKIE['sesh']) && (readcookie('sesh') == basename($_SERVER['PHP_SELF'],'.php'))){echo \" <hr>  \" . loadcomments() . \"</div>\";} else {echo \" \" . loadcomments() . \"</div>\";} ?>"
f = open("users/" + sys.argv[1] + ".php", "w")
print(template)
f.write(template)
f.close()
os.system("chmod 755 " + "users/" + sys.argv[1] + ".php")
if not os.path.isfile("users/" + sys.argv[1] + ".csv"):
    os.system('touch ' + "users/" + sys.argv[1] + ".csv")
    os.system("chmod 777 " + "users/" + sys.argv[1] + ".csv")
