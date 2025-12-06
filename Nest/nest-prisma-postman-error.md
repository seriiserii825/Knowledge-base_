### problem
```bash
{
    "message": "Failed to create actor: SASL: SCRAM-SERVER-FIRST-MESSAGE: client password must be a string",
    "error": "Internal Server Error",
    "statusCode": 500
}
```

### solution in main.ts

```typescript

import { config } from 'dotenv';

// after bootstrap()
async function bootstrap() {
  config();
```
