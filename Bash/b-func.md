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

### local variable

```
echo $1 # first argument from command line

function print(){
    local name=$1 # argumen for function iside bash
    echo "From local $name"
}

name="Tome"
echo "From outside $name"

print "John"
```
