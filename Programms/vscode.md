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
https://stackoverflow.com/questions/67506693/error-no-such-file-sftp-liximomo-extension

/home/serii/.vscode/extensions/liximomo.sftp-1.12.9
in package.json am schimbat versiunea la ssh2 ("ssh2": "^1.1.0",); 
npm install 
