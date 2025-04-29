def showOccuriences(file_extension, search_string, excluded_dirs):
     # Start building the command
    command = f"grep -rnw --include='*.{file_extension}'"

    # Add excluded directories
    for dir in excluded_dirs:
        command += f" --exclude-dir={dir}"

    # Add the search string and root directory
    command += f" -e '{search_string}' ."

    print(Panel(f"[green]command: {command}"))
    os.system(command)

