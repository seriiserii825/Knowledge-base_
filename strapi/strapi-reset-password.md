Try resetting your password using Strapi CLI.

Steps:

Open terminal (iTerm, cmd, etc.) in your Strapi app directory.
Run : yarn strapi admin:reset-user-password --email="YOUR_EMAIL" --password="YOUR_NEW_PASSWORD" (if you use Yarn). You may have to create alphanumeric password (according to Strapi), so weak password like 12345 might fail to reset your password.
If you use NPM, you probably should run 
npm run strapi admin:reset-user-password --email="YOUR_EMAIL" --password="YOUR_NEW_PASSWORD".
