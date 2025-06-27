# new line before regexp in Neovim

`:%s/^\(export.*\)/\r\1/`

This:

- Searches lines beginning with `export`
- Wraps them as a group
- Inserts a carriage return (`\r`) before the line, adding a blank line above
