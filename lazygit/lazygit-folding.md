# lazygit — folding directories in the Files panel

Keys in the Files panel (`[2]`, tree view):

| Key     | Action                                      |
|---------|---------------------------------------------|
| `Enter` | fold / unfold the directory under the cursor |
| `-`     | fold all directories                        |
| `=`     | unfold all directories                      |
| `` ` `` | switch between tree view and flat file list |

None of these are overridden in `~/dotfiles/.config/lazygit/config.yml` (only `toggleTreeView: "`"` is set, which is the default).

## Nested folders stay unfolded after `-`

lazygit remembers the fold state of each folder separately. `-` only folds the folders that are currently **visible**. If a parent folder was already folded when you pressed `-`, its subfolders were hidden and stay unfolded. When you open the parent again, the subfolders are still open.

Fold every level:

1. `=`: unfold everything, so all subfolders are visible.
2. `-`: now every folder gets folded, including the nested ones.

After that, `Enter` on a folder opens one level at a time.

## Merged path lines

A line like `internal/features` is one node. lazygit merges a chain of folders that each contain only one folder into a single line.
