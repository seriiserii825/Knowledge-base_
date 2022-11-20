pm2 stop 0
1. change priveleges api_seriivds
2. reset .nuxt from git
3. git pull
4. yarn build
5. api_www
6. pm2 start 0

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

