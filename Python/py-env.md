### create .env file
```bash
touch .env
```

### add the following to the .env file
```bash
# .env
FLASK_APP=app.py
FLASK_ENV=development
```

### in main.py
```python
from dotenv import load_dotenv
load_dotenv()

import os
print(os.getenv('FLASK_APP'))
```

