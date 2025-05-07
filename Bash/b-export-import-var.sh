# scripts need to be at the same level

# test.sh

message="Hello, World!"
export message
./print_message.sh

# print_message.sh
echo "$message"
