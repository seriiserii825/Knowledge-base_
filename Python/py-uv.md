# Init

## Generate pyproject

```bash
cd inside project
uv init .
```

## add package

```bash
uv add <project_name>
```

## Sync for existing project

```bash
uv lock
uv sync
```

## remove package

```bash
uv remove <project_name>
```

## run package

```bash
uv run <project_name>
```

## by default another version of python

```bash
uv python pin 3.11
```
