Make the Headset Mic Default If switching manually works but doesn’t persist, make it the default input:

Open a terminal and list input sources:
pactl list sources short

Find your headset mic in the list and note its name (e.g., alsa_input.pci-0000_00_1f.3.analog-stereo).
Set it as default:

pactl set-default-source <source-name>
