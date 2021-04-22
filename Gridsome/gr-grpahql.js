{
  "name": "My App",
  "schemaPath": "my_endpoint_schema.graphql",
  "extensions": {
    "endpoints": {
      "My App Endpoint": {
        "url": "http://localhost:8080/___graphql",
        "headers": {
          // If you need auth, add it here
          "Authorization": "Bearer TOKEN"
        },
        "introspect": true
      }
    }
  }
}
