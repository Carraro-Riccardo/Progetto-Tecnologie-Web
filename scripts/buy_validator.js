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
        errorMessage += checkCreditCard(creditCard.replace(/\s/g, ''));
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

    document.getElementById("cardNumber").addEventListener("input", function (event) {
        let valore = event.target.value.replace(/\D/g, '');
        valore = valore.slice(0, 16);
        valore = valore.replace(/(\d{4})/g, '$1 ').trim();
        event.target.value = valore;
    });

    document.getElementById("cvv").addEventListener("input", function (event) {
        let valore = event.target.value.replace(/\D/g, '');
        valore = valore.slice(0, 3);
        event.target.value = valore;
    });

    document.getElementById("dataScadenza").addEventListener("input", function (event) {
        let valore = event.target.value.replace(/\D/g, '');
        valore = valore.slice(0, 4);
        valore = valore.replace(/(\d{2})/, '$1/');
        if (valore.length === 3 && event.inputType === "deleteContentBackward") {
            valore = valore.slice(0, 2);
        }
        event.target.value = valore;
    });
    

  });
  