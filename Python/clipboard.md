## pyperclip

### get from clipboard
```
import pyperclip
clipboard = pyperclip.paste()
```

### insert to clipboard
```

import os

def addToClipBoard(text):
    command = 'echo ' + text.strip() + '| xclip -selection clipboard'
    os.system(command)
```
