#! /bin/sh
# chkaide.sh - Bob Aiello
MYDATE`date +%Y-%m-%d`
MYFILENAME"Aide-"$MYDATE.txt
/bin/echo "Aide check !! `date`" > /tmp/$MYFILENAME
/usr/sbin/aide --check > /tmp/myAide.txt
/bin/cat /tmp/myAide.txt|/bin/grep -v failed >> /tmp/$MYFILENAME
/bin/echo "**************************************" >> /tmp/$MYFILENAME
/usr/bin/tail -20 /tmp/myAide.txt >> /tmp/$MYFILENAME
/bin/echo "****************DONE******************" >> /tmp/$MYFILENAME
/bin/mail -s"$MYFILENAME `date`" matthew@matthewsetter.com < /tmp/$MYFILENAME