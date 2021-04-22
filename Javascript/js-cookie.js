function setCookie(name, value, daysToLive) {
    // Encode value in order to escape semicolons, commas, and whitespace
    var cookie = name + "=" + encodeURIComponent(value);
    
    if(typeof daysToLive === "number") {
        /* Sets the max-age attribute so that the cookie expires
        after the specified number of days */
        cookie += "; max-age=" + (daysToLive*24*60*60);
        
        document.cookie = cookie;
    }
}

function getCookie(name) {
    // Split cookie string and get all individual name=value pairs in an array
    var cookieArr = document.cookie.split(";");
    
    // Loop through the array elements
    for(var i = 0; i < cookieArr.length; i++) {
        var cookiePair = cookieArr[i].split("=");
        
        /* Removing whitespace at the beginning of the cookie name
        and compare it with the given string */
        if(name == cookiePair[0].trim()) {
            // Decode the cookie value and return
            return decodeURIComponent(cookiePair[1]);
        }
    }
    
    // Return null if not found
    return null;
}
function checkCookie() {
    // Get cookie using our custom function
    var firstName = getCookie("firstName");
    
    if(firstName != "") {
        alert("Welcome again, " + firstName);
    } else {
        firstName = prompt("Please enter your first name:");
        if(firstName != "" && firstName != null) {
            // Set cookie using our custom function
            setCookie("firstName", firstName, 30);
        }
    }
}
// Creating a cookie
document.cookie = "firstName=Christopher; path=/; max-age=" + 30*24*60*60;

// Updating the cookie
document.cookie = "firstName=Alexander; path=/; max-age=" + 365*24*60*60;
// Deleting a cookie
document.cookie = "firstName=; max-age=0";

// Specifying path and domain while deleting cookie
document.cookie = "firstName=; path=/; domain=example.com; max-age=0";
