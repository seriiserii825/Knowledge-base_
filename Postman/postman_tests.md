#Create test
- Select Tests tab
- In right side use Response body: JSON value check

#add title Should have..., and jwt
pm.test("Should have jwt token", function () {
    var jsonData = pm.response.json();
    pm.expect(jsonData.jwt).to.not.empty;
});

pm.test("Should have jwt token", function () {
    var jsonData = pm.response.json();
    pm.expect(jsonData.authorisation.token).to.not.empty;

    pm.globals.set("jwt-token", jsonData.authorisation.token);
});

- at the bottom use Tests tab and submit Send
- you will have Test result

## set token to Auth folder
- select folder
- in right side use tests
```javascript
var token = pm.globals.get("token");

if (token) {
    pm.request.headers.add({
        key: "Authorization",
        value: "Bearer " + token
    });
}
```
## xcsrf token
url /sanctum/csrf-cookie
tests
```javascript
pm.test("Set XSRF-TOKEN", function () {
    var xsrfToken = pm.cookies.get("XSRF-TOKEN");

    pm.expect(xsrfToken).to.exist; // Ensure the cookie exists
    pm.globals.set("xsrf_token", xsrfToken); // Store it as a global variable
});
```

add in folder in pre-request
```javascript
// Check if the XSRF-TOKEN is already set
if (!pm.globals.get("xsrf_token")) {
    pm.sendRequest({
        url: pm.environment.get("base_url") + "/sanctum/csrf-cookie",
        method: "GET"
    }, function (err, res) {
        if (!err) {
            var xsrfToken = pm.cookies.get("XSRF-TOKEN");
            if (xsrfToken) {
                pm.globals.set("xsrf_token", xsrfToken);
            }
        }
    });
}
```


#add user test
pm.test("Should user not be empty", function () {
    var jsonData = pm.response.json();
    pm.expect(jsonData.user).to.not.empty;
});

#add jwt to global enviroment
- in right side use set global variables
- insert this text in jwt test
 pm.globals.set("jwt_token", jsonData.jwt);
- after that, you will have in right top eye global variable jwt_token
- now you can use for request.

#set auth with jwt
- in Headers add key Authorization
- value - Bearer {{jwt_token}}

#set test to folder
- you can add test to folder, not to request, if you have more than one request with tests.

#add jwt auth token to folder with requests
- select folder
- in right side use Authorization
- select Type Bearer Token
- insert {{jwt_token}}


