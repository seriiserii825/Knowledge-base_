### 1\. Install PM2

Ensure PM2 is installed globally on your VPS. You can install it with:
`npm install -g pm2`

### 2\. Create a PM2 Configuration File

PM2 can use a configuration file to manage your application. Create a file called `ecosystem.config.js` in the root of your Nuxt project (or the directory containing `.output`):
javascript
`module.exports = {   apps: [     {       name: 'nuxt3-app', // Change this to your app's name       script: './.output/server/index.mjs', // Path to your Nuxt server file       cwd: './', // Working directory (optional)       env: {         NODE_ENV: 'production',         PORT: 4174, // Change the port here       },     },   ], };`

### 3\. Start the App with PM2

Run the following command to start your app:
`pm2 start ecosystem.config.js`

### 4\. Verify PM2 Status

Check that your app is running with:
`pm2 list`

### 5\. Save PM2 Process List for Restarts

Ensure PM2 restarts your app on server reboots:
`pm2 save pm2 startup`
