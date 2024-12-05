### 1\. **Convert Lowercase to Uppercase**

`echo "hello world" | tr 'a-z' 'A-Z' # Output: HELLO WORLD`

### 2\. **Convert Uppercase to Lowercase**

`echo "HELLO WORLD" | tr 'A-Z' 'a-z' # Output: hello world`

### 3\. **Delete Specific Characters**

`echo "hello123" | tr -d '0-9' # Output: hello`

### 4\. **Replace Spaces with Underscores**

`echo "hello world" | tr ' ' '_' # Output: hello_world`

### 5\. **Compress Repeated Characters**

`echo "aaabbbccc" | tr -s 'a-c' # Output: abc`

### 6\. **Remove Non-Printable Characters**

`echo -e "hello\x01world" | tr -d '\000-\037\177' # Output: helloworld`

### 7\. **Translate Tabs to Spaces**

`echo -e "hello\tworld" | tr '\t' ' ' # Output: hello world`

### 8\. **Remove All Vowels**

`echo "hello world" | tr -d 'aeiouAEIOU' # Output: hll wrld`

### 9\. **Replace Newlines with Spaces**

`echo -e "line1\nline2\nline3" | tr '\n' ' ' # Output: line1 line2 line3`

### 10\. **Replace Digits with X**

`echo "My phone is 123-456-7890" | tr '0-9' 'X' # Output: My phone is XXX-XXX-XXXX`
