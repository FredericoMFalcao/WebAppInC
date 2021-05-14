#!/bin/bash
rm conn1 2> /dev/null > /dev/null
mkfifo conn1

echo Running tiny webserver ...
while [ 1 ]
do
	cat conn1 | ./WebAppAsExecutable  | nc -l localhost 8080 > conn1

done
