#!/bin/bash
x=0
while true
do
echo $x > /var/www/html/worker2.txt
((x=x+3))
php /affichage.php
sleep 5
done