## check if package are installed
```
import subprocess
retval = subprocess.call(["which", "woff2_compress"])
if retval != 0:
    print("Packagename not installed!")
    subprocess.call(["sudo", "apt", "install", "woff2", "-y"])
```
