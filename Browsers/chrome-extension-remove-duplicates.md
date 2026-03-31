## Remove duplicate Chrome extensions

```bash
  python3 -c "
  import json

  path = '/home/serii/.config/google-chrome/Default/Preferences'
  with open(path) as f:
      p = json.load(f)

  ext = p.get('extensions', {}).get('settings', {})
  to_remove = [k for k,v in ext.items() if 'quick-tabs' in v.get('path','')]
  print('Removing:', to_remove)
  for k in to_remove:
      del ext[k]

  with open(path, 'w') as f:
      json.dump(p, f)
  print('Done')
  "
```
