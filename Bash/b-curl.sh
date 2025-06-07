```
url="https://www.dundeecity.gov.uk/sites/default/files/publications/civic_renewal_forms.zip"
# curl $url -O -- download original file name

# curl $url > myfilename
curl_status=$(curl -s -o /dev/null -w "%{http_code}" $url)

if [ $curl_status -eq 200 ]; then
    echo "File exists"
    curl $url -O
else
    echo "File does not exist"
fi
```

## show pretty print
curl https://api.openweathermap.org/data/2.5/weather\?lat\=47.00604248046875\&lon\=28.856674194335938\
  &appid\=appkey | python -mjson.tool

## install httpie in arch
sudo pacman -S httpie
# httpie example
 http https://api.openweathermap.org/data/2.5/weather\?lat\=47.00604248046875\&lon\=28.8566741943359 38\

