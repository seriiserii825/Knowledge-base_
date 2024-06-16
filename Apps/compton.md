#install
Install compton

#restart
killall compton
compton -b

#i3
exec --no-startup-id compton -b
