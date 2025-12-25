### 1\. Install PM2

Ensure PM2 is installed globally on your VPS. You can install it with:
`npm install -g pm2`

### Create a PM2 Ecosystem File

```vim
ecosystem.config.js

module.exports = {
  apps: [
    {
      name: "nuxt-roman-timoshyuk", // Change this to your app's name
      script: "./.output/server/index.mjs", // Path to your Nuxt server file
      cwd: "./", // Working directory (optional)
      env: {
        NODE_ENV: "production",
        PORT: 3444,
      },
    },
  ],
};

```

in package json add 2 scripts with name from ecosystem file

```json
"start": "pm2 start ecosystem.config.cjs && pm2 save && pm2 startup",
"update": "git pull && bun install && bun run build && pm2 restart nuxt-roman-timoshyuk"
```

### 3\.  Start the App with PM2

on the server install packages and make build
`bun install && bun run build`
Then start your Nuxt app with PM2 using the ecosystem file:
`npm run start`

### 4\. Verify PM2 Status

Check that your app is running with:
`pm2 list`

### 5\. Save PM2 Process List for Restarts

Ensure PM2 restarts your app on server reboots:
`pm2 save pm2 startup`

### 6. To update run script npm run update
