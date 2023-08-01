### if statement

```
count=11
if [ $count -eq 10 ]
then
  echo "Count is 10"
elif (( $count <=9 ))
  echo "<= 9"
else
  echo "Count is not 10"
fi
```

### check if app is installed

```
package=htop

sudo apt install $package -y

if [ $? -eq 0 ]
then
  echo "Package installed successfully"
  echo "Package name is $package"
  which $package
else
  echo "Package $package installation failed"
fi
```
