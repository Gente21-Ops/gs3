#!/bin/bash
sudo ../../var/www/gstest2015/msgserver/licode/scripts/initLicode.sh
sleep 5s
sudo ../../var/www/gstest2015/msgserver/licode/scripts/initBasicExample.sh
echo "SG msgserver has been initialized" | mail -s "MSG SERVER INITIALIZED" raulrodriguezarias@gmail.com
#echo "SG msgserver NOT initialized" | mail -s "MSG SERVER INITIALIZED" raulrodriguezarias@gmail.com
