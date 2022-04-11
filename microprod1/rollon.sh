#!/bin/bash
x=0
while true
do
echo $x > /var/www/html/worker1.txt
((x=x+5))
php /affichage.php
sleep 5
done