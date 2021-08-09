Create repository
Go to Settings -> Secret and create secret enviroment and add variables from project .env.local
npm i gh-pages -D

in package.json add script

"homepage": "https://seriiserii825.github.io/react-movies",
"predeploy": "npm run build",
"deploy": "gh-pages -d build"

react-movies = repo name

build, because build for react is inside build map

npm run deploy

after Published in console, go to github and choose branch gh-pages.
Go to settings, Github pages and get site link.

