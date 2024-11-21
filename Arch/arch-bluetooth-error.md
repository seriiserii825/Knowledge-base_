### **1\. Check Bluetooth Service Status**

Make sure the Bluetooth service is running smoothly.





`systemctl status bluetooth`

If it’s not active, enable and start it:





`sudo systemctl enable --now bluetooth`

---

### **2\. Reset the Bluetooth Controller**

Resetting the controller often fixes reconnection issues. You can do this manually or set it up automatically.

#### **Manual Reset**







`sudo systemctl restart bluetooth`

#### **Automatic Reset on Errors**

Create or edit a udev rule to reset the controller when issues arise.

1. Edit the udev rules:
    
        
    
    
    `sudo nano /etc/udev/rules.d/99-bluetooth.rules`
    
2. Add the following line:
    
    makefile
    
    
    
    `ACTION=="add", KERNEL=="hci0", RUN+="/usr/bin/hciconfig hci0 reset"`
    
3. Reload udev rules:
    
        
    
    
    `sudo udevadm control --reload`
    

---

### **3\. Reconnect Using `bluetoothctl`**

Sometimes using `bluetoothctl` can provide more reliable results.

1. Open `bluetoothctl`:
    
        
    
    
    `bluetoothctl`
    
2. Ensure the device is trusted:
    
        
    
    
    `trust <MAC_ADDRESS>`
    
3. Reconnect:
    
        
    
    
    `connect <MAC_ADDRESS>`
    

---

### **4\. Modify `auto-power-on` Setting**

Enable auto power-on for the Bluetooth device in the configuration file.

1. Open the configuration file:
    
        
    
    
    `sudo nano /etc/bluetooth/main.conf`
    
2. Add or modify the line:
    
    ini
    
    
    
    `AutoEnable=true`
    
3. Restart the Bluetooth service:
    
        
    
    
    `sudo systemctl restart bluetooth`
    

---

### **5\. Use a Custom Script**

Create a script to automate disconnecting and reconnecting the device.

1. Create a script:
    
        
    
    
    `nano ~/reconnect_bluetooth.sh`
    
2. Add the following:
    
        
    
    
    `#!/bin/bash DEVICE_MAC="<YOUR_DEVICE_MAC>" bluetoothctl disconnect $DEVICE_MAC sleep 2 bluetoothctl connect $DEVICE_MAC`
    
3. Make it executable:
    
        
    
    
    `chmod +x ~/reconnect_bluetooth.sh`
    
4. Run the script when needed:
    
        
    
    
    `./reconnect_bluetooth.sh`
    

---

### **6\. Additional Debugging**

If these steps don’t resolve the issue:

- Check logs for errors:
    
        
    
    
    `journalctl -u bluetooth`
    
- Ensure firmware is up to date.
- Try alternative Bluetooth managers like **Blueman** for easier control.

Let me know if you need further assistance!
