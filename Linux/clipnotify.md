## Dependencies

1. **xsel**: `sudo apt install xsel`
2. [**clipnotify**](https://github.com/cdown/clipnotify). You can use the pre-compiled clipnotify provided in the repository or compile yourself.  
    **To compile clipnotify yourself**
    
    ```bash
    sudo apt install git build-essential libx11-dev libxtst-dev
    git clone https://github.com/cdown/clipnotify.git
    cd clipnotify
    sudo make
    ```
    

## To USE

1. Download this repository as zip or copy and paste the script in a text editor and save it as copy\_without\_linebreaks.sh.
2. Make sure that script and clipnotify (downloaded or precompiled) are in the same folder.
3. Open terminal in script's folder and set permission  
    `chmod +x "copy_without_linebreaks.sh"`
4. Double-click the script or run by entering in terminal :  
    `.\copy_without_linebreaks.sh`
5. Copy text in pdf and paste it anywhere. Lines breaks will be removed.
