pm2 stop 0
reset .nuxt from git
git pull
yarn build
pm2 start 0

npm install pm2 -g

touch ecosystem.config.js

module.exports = {
  apps: [
    {
      name: 'NuxtAppName',
      exec_mode: 'cluster',
      instances: 'max', // Or a number of instances
      script: './node_modules/nuxt/bin/nuxt.js',
      args: 'start'
    }
  ]
}
pm2 start npm --name "nuxt" -- start

