### ✅ Step 1: Install `flake8`

Make sure it's installed in your system or virtual environment:

`pip install flake8`

Test it works:

`flake8 --version`

---

### ✅ Step 2: Configure `coc.nvim` for Python linting

Coc uses a `coc-settings.json` file (usually in `~/.vim/` or the project root)
to configure language settings.

Create or edit `~/.vim/coc-settings.json` (or `:CocConfig`):

```python
{  
    "python.linting.enabled": true,   "python.linting.flake8Enabled": true,
    "python.linting.flake8Path": "flake8",
    "python.linting.flake8Args": [     "--max-line-length=88"   ] 
}
```

> You can add more arguments to match your `.flake8` config if needed.

---

### ✅ Step 3: Install a Python language server

`coc.nvim` needs a Python LSP for features like linting, completion, etc. Recommended:

`:CocInstall coc-pyright`

This provides LSP features (but linting comes from `flake8` as configured above).

---

### ✅ Step 4: (Optional) Use a `.flake8` config file

In your project root:

`# .flake8 [flake8] max-line-length = 88 exclude = .git,__pycache__,venv`

---

### ✅ Step 5: Test linting

Open a Python file in Neovim and save it:
    — linting issues from `flake8` should appear as diagnostics from Coc.
