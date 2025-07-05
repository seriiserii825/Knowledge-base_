# pyproject.toml

```toml

[tool.ruff]
line-length = 88
exclude = [
    "migrations",
    "tests",
    "docs",
    "build",
    "dist",
    "venv",
    ".venv",
    ".git",
    "__pycache__",
]
fix = true

[tool.ruff.lint]
select = [
    "F401",  # Unused import
    "F403",  # Wildcard import
    "F405",  # Name may be undefined, or defined from star imports
    "F841",  # Local variable is assigned to but never used
    "E501",  # Line too long
    "I",     # Import sorting (isort-compatible)
]
```
