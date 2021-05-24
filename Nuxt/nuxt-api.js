http://wp-zuccato.seriiburduja.ru/wp-json/wp/v2/pages/2

Install Express.js
Add Express.js to Nuxt.js
Handle CORS
 

When you start a new project you can use a template made by the nuxt community that handles integrataion of Nuxt and Express. But what if you started your project without Express.js and want to add it now? Fortunately the integration is very easy and you don't need any template at all. Seriously you can do it yourself in just a few minutes. Nuxt is a really well designed framework which give you a lot of flexibility what's on your backend. In this post I write about Express.js integration but you can use this technique to add almost any backend framework.

 

Install Express.js
 

Start with installing Express using comand line. This have to be done from your nuxt root folder.

npm install express --save
 

Next create a new folder named api in the root of your nuxt project where you can put your backend. You can go with any other name descriptive to you but keep in mind that you will have to refer to this name accordingly in the following steps.

 


nuxt express integration basic structure
 

In the folder create index.js file with at least minimal express.js config as shown below and a single endpoint that can be tested.

// api/index.js

const express = require('express')

const app = express()
app.use(express.json())
app.use(express.urlencoded({ extended: false }))

app.get('/test', function (req, res) {
  res.send('Test successful')
})


export default {
  path: '/api',
  handler: app
}
 

Add Express.js to Nuxt.js
 

In your nuxt.config file add a new variable responsible for communication with your backend. This is basically done by serverMiddleware  property.

// nuxt.config.js

...

/*
** Server Middleware
*/
serverMiddleware: {
  '/api': '~/api'
},

...
 

If you happen to work on static mode remember to change this propery in nuxt.config to server mode.

Create a new nuxt page to test the integration. I recommend using Axios liblary for nuxt, if you don't have it yet just install it using console.

 npm install @nuxtjs/axios
 

In the created page create a button and register a function that can send get request to the express.js test route. Open dev toolbar and check if it works. Notice that all your requests to the express have to be prefixed with the name previusly registered in the serverMiddleware porperty, in this instance is just api. Thus you get /api/test request in nuxt for your backend endpoint /test.

// pages/index.js

<template>
  <button @click="showMessageFromBackend">Show message from backend</button>
</template>

<script>
export default {
  methods: {
    async showMessageFromBackend () {

      try {
        const response = await this.$axios.get('/api/test')
        console.log(response.data)
      } catch (err) {
        console.log(err)
      }

    }
  }
}
</script>
 

Handle CORS
 

During your work in development environment everything should just work fine in terms of your integration with backend. But when you build your app and start using some proxy server like Apache or Nginx you may encounter errors triggered by CORS policies. This happen because your backend uses slighly different domain urls. Thankfully there is a simple solution to fulfill this policy in a secure way. Go to the nuxt.config and add or change property named axios. The following example is made for example.com domain but you should get your app addresses from the error saw in the toolbar and fill them appropriately in the axios config.

// nuxt.config.js

axios: {
  baseURL: 'http://example.com',
  browserBaseURL: 'http://localhost:3000',
},
 

What more thing to rememer if your migrated from static mode. Use npm run build and start instead of nuxt generate or nuxt start form now on.
