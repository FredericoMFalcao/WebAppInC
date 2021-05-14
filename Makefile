SHELL=bash

WebAppAsExecutable: gui CliEntry.c 
	gcc-11 CliEntry.c -o $@
 


#
# 2. Graphical User Interface
#

gui: pages $(shell ls gui/pages/*.class.php)
pages: $(basename $(shell ls gui/pages/*.c.php))

%.c: %.c.php
	php $< > $@

clean:
	rm main.c
