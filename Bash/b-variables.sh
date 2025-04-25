MY_SHELL="bash"

echo "MY_SHELL is set to $MY_SHELL"
echo "MY_SHELL is set to ${MY_SHELL}ing"

# SERVER_NAME=`hostname` - an oder syntax ``
SERVER_NAME=$(hostname)
echo "SERVER_NAME is set to $SERVER_NAME"
