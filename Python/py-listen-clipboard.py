# Initialize the last clipboard content to an empty string
last_clipboard_content = ""

while True:
    current_clipboard_content = pyperclip.paste()
    if current_clipboard_content != last_clipboard_content:
      temp_file = os.path.join(projects_dir, 'temp.txt')
      with open(temp_file, 'w') as file:
        file.write(current_clipboard_content)
      last_clipboard_content = current_clipboard_content
      if ':' in current_clipboard_content:
        scssHandler(temp_file, variables_file)
    time.sleep(0.5)
