## get title
```

from bs4 import BeautifulSoup
import re
with open('index.html', 'r') as file:
    src = file.read()
soup = BeautifulSoup(src, 'lxml')
title = soup.title
```

## find

```
user_name = soup.find('div', class_='user__name')
user_name = soup.find('div', {'class': 'user__name', 'id': 'user-name'})
user_info = soup.find(class_='user__info').find_all('span')
```

## find parent

```
# post_text = soup.find(class_='post__text').find_parent()
post_text = soup.find(class_='post__text').find_parent('div', class_='user__post')
```

## find next element

```
# post_text = soup.find(class_='post__text').find_next_sibling()
post_text = soup.find(class_='post__text').find_next_sibling('div')
```

## find text

```

find_a_by_text = soup.find('a', string=re.compile('Instagram'))
find_all_a_by_text = soup.find_all('a', string=re.compile('[Ii]nstagram'))
```


