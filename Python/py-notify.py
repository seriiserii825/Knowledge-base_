import subprocess
message = "Hello, World!"
"""Send a notification using notify-send."""
subprocess.run(['notify-send', message], check=True)
