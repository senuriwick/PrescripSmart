const validation = new JustValidate("#signup");

validation
    .addField("#first-name", [
        {
            rule: "required"
        }
    ])
    .addField("#last-name", [
        {
            rule: "required"
        }
    ])
    .addField("#email", [
        {
            rule: "required"
        },
        {
            rule: "email"
        },
        {
            validator: (value) => () => {
                return fetch("validate-email.php?email=" + encodeURIComponent(value))
                       .then(function(response) {
                           return response.json();
                       })
                       .then(function(json) {
                           return json.available;
                       });
            },
            errorMessage: "email already exists"
        }
    ])
    .addField("#password", [
        {
            rule: "required"
        },
        {
            rule: "password"
        }
    ])
    .onSuccess((event) => {
        document.getElementById("signup").submit();
    });
    
    
    
    
    
    
    
    
    
    
    
    
    