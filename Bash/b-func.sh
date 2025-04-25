## variable scope
global_var="global_var"

function test {
  local local_var="local_var"
  echo "Inside function: $local_var"
  echo "Inside function: $global_var"
}

echo "Before function: $global_var"
test
echo "After function: $local_var" # This will cause an error because local_var is not accessible outside the function


## function with arguments
function parseArray {
  result=()
  array=("$@")

  for data in "${array[@]}"
  do
    if [[ $data == "value" ]]; then
      result+=("value")
    fi
  done

  echo "${result[@]}"
}

array=("value" "value1")

parseArray "${array[@]}"
