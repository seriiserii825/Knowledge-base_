## pyperclip
subprocess.Popen(['notify-send', file_content])
### get from clipboard
```
import pyperclip
clipboard = pyperclip.paste()
```

### insert to clipboard
```

import os

def addToClipBoard(text):
    # Copy to clipboard
    pyperclip.copy(new_file_path.strip())
    subprocess.run(['notify-send', new_file_path], check=True)
```
