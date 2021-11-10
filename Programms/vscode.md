{
    "name": "My Server",
    "host": "ftp14.hostland.ru",
    "protocol": "ftp",
    "port": 21,
    "username": "host1670806_tacchino",
    "password": "QBSdJHYm",
    "remotePath": "/host1670806.hostland.pro/htdocs/html-tacchino",
    "uploadOnSave": false,
    "watcher": {
        "files": "**/*.{php,scss,css,css.map,js}",
        "autoUpload": true,
        "autoDelete": true
    },
    "ignore": [
        ".vscode",
        ".git",
        ".DS_Store",
        "node_modules",
        ".idea"
    ]
}

#sftp
Shutdown / Quit VS Code.
Locate the following file:
Mac OS X:
~/.vscode/extensions/liximomo.sftp-1.12.9/node_modules/ssh2-streams/lib/sftp.js

Windows:
C:\Users\account_name\.vscode\extensions\liximomo.sftp-1.12.9\node_modules\ssh2-streams\lib\sftp.js
Make a backup copy of the file.
Modify line 388, which should be:
if ( code === STATUS_CODE . OK ) { changing it to:
if (code === STATUS_CODE.OK || code === STATUS_CODE.NO_SUCH_FILE) {
Save the file.
Relaunch VS Code; test by uploading or downloading from your sftp server. The error should not be present.
