## get file
```python
output = os.popen('fzf').read().split('\n')[0]
file_name = output.split('/')[-1].strip()
```
