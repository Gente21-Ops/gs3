#!/bin/bash
sudo ../../var/www/gstest2015/msgserver/licode2/scripts/initLicode.sh
sleep 5s
sudo ../../var/www/gstest2015/msgserver/licode2/scripts/initBasicExample.sh
echo "SG msgserver has been initialized" | mail -s "MSG SERVER INITIALIZED" raulrodriguezarias@gmail.com
