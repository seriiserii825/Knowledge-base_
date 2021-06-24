            let xhr2 = new XMLHttpRequest();
            xhr2.open("POST", "https://api.monitorcrm.it/index.php/topcare/setCustomerTopCare");
            xhr2.onreadystatechange = () => {//Call a function when the state changes.
              console.log(xhr2.status, 'xhr2.status')
              if (xhr2.readyState == 4 && xhr2.status == 200) {
                console.log(xhr2.responseText, 'xhr2.responseText')
              } else {
                console.log(xhr2, 'error xhr2')
              }
            }
            xhr2.send(apiFormData);
