Я использовал решение что ниже
In Xubuntu 16.04 the XKBOPTIONS setting ( XKBOPTIONS="numpad:microsoft" ) in /etc/default/keyboard is ignored - I consider this to be a bug.

I'm using the following command as workaround:
setxkbmap -option 'numpad:microsoft'

In order to run the above command automatically when starting the graphical desktop environment, I've create an Application Autostart entry:
Menu > Settings > Session and Startup > Application Autostart > Add

Name: Make Shift+NumPad work like MS Windows
Description: whatsoever
Command:setxkbmap -option 'numpad:microsoft'
