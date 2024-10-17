### json
```

import json

# open
with open('original.json', 'r') as file:

# read
data = json.load(file)

# add
    data["abc"]["mno"] = 3
    data[abc].append("'f': + var3")

# remove
    data.pop("jkl")
    del data['names'][1]

# move
    field = data["abc"].pop("ghi")
    data["ghi"] = field

# rename
    field = data.pop("abc")
    data["pqr"] = field

newData = json.dumps(data, indent=4)

# open
    with open('modified.json', 'w') as file:

# write
file.write(newData)
    ```

### add variables to json
    ```
    group = {}
    group['key'] = field_id
    group['label'] = title
    group['name'] = slug
    group['aria-label'] = ""
    group['type'] = "group"
    group['instructions'] = ""
    group['required'] = 0
    group['conditional_logic'] = 0
    group['wrapper'] = {
        "width": "",
        "class": "",
        "id": ""
    }
group['layout'] = "block"
group['sub_fields'] = []
```
