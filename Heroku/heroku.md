### install
sudo snap install --classic heroku

Install the Heroku CLI
Download and install the Heroku CLI.

If you haven't already, log in to your Heroku account and follow the prompts to create a new SSH public key.

in package.json add


  "scripts": {
    "heroku-postbuild": "npm run build"
  },
  "engines": {
    "node": "14.x"
  },

$ heroku login
Clone the repository
Use Git to clone nuxt-bludelego's source code to your local machine.

$ heroku git:clone -a nuxt-bludelego
$ cd nuxt-bludelego
Deploy your changes
Make some changes to the code you just cloned and deploy them to Heroku using Git.

$ git add .
$ git commit -am "make it better"
$ git push heroku master


Env
HOST 0.0.0.0
NODE_ENV production
NPM_CONFIG_PRODUCTION false
WP_URL http://bludelego.cf

WP_URL from nuxt.config.js


