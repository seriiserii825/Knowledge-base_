### install browser binaries

```python
uv run playwright install
```

### open browser

headless=False will open the browser in non-headless mode, without it, the browser will run in headless mode,
which means it will not display a user interface and will run in the background.

```python
browser = p.chromium.launch(headless=False)
page = browser.new_page()
page.goto("https://www.google.com")
```

### tests

```bash
sudo pacman -S python-pytest-playwright
```

install pytest and pytest-playwright with pm

```python

from playwright.sync_api import Page

def test_main_title(page: Page):
    page.goto("https://iteco.altuofianco.com/")
    assert page.title() == "ITECO - Home"
```

run tests

```bash
uv run pytest
```
