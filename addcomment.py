import sys
import random 
import html
user = sys.argv[1]
userpage = sys.argv[2]
comment = sys.argv[3]
userpage = "users/" + userpage + ".csv"
print(user + " " + userpage + " " + comment)
x=open(userpage, "r")
line=x.readlines()
lastlinenumber= len(line)-1
x.close()
def reverse(file):
      ofile=open(file,"r")
      k=ofile.readlines()
      t=reversed(k)
      with open(file,'w') as f:
          for i in t:
           f.write(i.rstrip() + "\n")
with open(userpage,'a') as f:
    reverse(userpage)
    f.write("\n \"<a href=\'/users/" + sys.argv[1]  + ".php\'>" + sys.argv[1] + "</a>\",\" " + html.unescape(comment) + "\"")
    f.flush()
    f.close()
    reverse(userpage)

    
