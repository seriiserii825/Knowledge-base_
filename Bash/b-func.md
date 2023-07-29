### function

```
function func() {
  echo "Hello World: $1"
}

func "John"

function check(){
  return_value='I love mac'
}

return_value='I love linux'
echo $return_value # I love linux
check
echo $return_value # I love mac
```
