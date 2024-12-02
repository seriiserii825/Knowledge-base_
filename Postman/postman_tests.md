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


