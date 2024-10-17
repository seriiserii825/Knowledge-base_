import subprocess
PASSWORD = "password"
USERNAME = "username"
HOST = "host"
PORT = "port"
REMOTE_PATH = "/path/to/remote"
file_path = "/path/to/local/file"
relative_path = file_path.split("/")[-1]
command = [
    "sshpass", "-p", PASSWORD, "rsync", "-avz", "--progress",
    f"--rsh=sshpass -p {PASSWORD} ssh -p {PORT}",
    file_path, f"{USERNAME}@{HOST}:{REMOTE_PATH}{relative_path}"
]
print(command)
subprocess.run(command, check=True)
