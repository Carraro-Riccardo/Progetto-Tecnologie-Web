import {
    checkUsername,
    checkPassword,
    checkCreditCard, 
    checkCVV,
    checkDataScadenza
  } from "./input_validator.js";
  
  document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("buyForm")?.addEventListener("submit", function (event) {
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;
        var creditCard = document.getElementById("cardNumber").value;
        var cvv = document.getElementById("cvv").value;
        var dataScadenza = document.getElementById("dataScadenza").value;
    
        var errorMessage = "";
    
        errorMessage += checkUsername(username);
        errorMessage += checkPassword(password);
        errorMessage += checkCreditCard(creditCard);
        errorMessage += checkCVV(cvv);
        errorMessage += checkDataScadenza(dataScadenza);

        console.log(errorMessage);
    
        if (errorMessage !== "") {
          event.preventDefault();
          var errorElement = document.getElementById("error-message");
    
          if (errorElement) {
            errorElement.remove();
          }
          errorElement = document.createElement("p");
          errorElement.id = "error-message";
          document.getElementById("container-abbonamento-login").parentNode.insertBefore(errorElement, document.getElementById("container-abbonamento-login"));
          errorElement.innerHTML = errorMessage;
        }
    });

  });
  