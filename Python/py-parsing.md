# BeautifulSoup

## install packages

```bash
pip install requests beautifulsoup4 lxml fake-useragent
```

## fake user agent

```python
from fake_useragent import UserAgent
ua = UserAgent()
headers = {'User-Agent': ua.random}

soup = BeautifulSoup(src, 'lxml', headers=headers)
```

## get title

```python

from bs4 import BeautifulSoup
import re
with open('index.html', 'r') as file:
    src = file.read()
soup = BeautifulSoup(src, 'lxml')
title = soup.title
```

