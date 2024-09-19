from datetime import datetime
import subprocess

from rich import print
from rich.panel import Panel
command = f"wp user list --field=user_login --role=administrator"
user = subprocess.check_output(command, shell=True, text=True).strip()


today_date = datetime.today().strftime('%Y-%m-%d')
command = [
        "git", "log",
        f'--since={today_date} 00:00:00', f'--until={today_date} 23:59:59',
        '--pretty=format:%an: %cd: %s'
        ]
result = subprocess.run(command, capture_output=True, text=True)

if result.stdout:
    #color result.stdout
    print(Panel(f"[green]{result.stdout}", title='title'))
