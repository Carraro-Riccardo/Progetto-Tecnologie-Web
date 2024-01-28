import { checkNome, checkCognome, checkEmail, checkMessage} from "./input_validator";

document.addEventListener("DOMContentLoaded", function () {
    
    document.getElementById("contactForm").addEventListener("submit", function (event) {
        var nome = document.getElementById("firstName").value;
        var cognome = document.getElementById("lastName").value;
        var email = document.getElementById("email").value;
        var message = document.getElementById("message").value;

        var errorMessage = "";

        errorMessage += checkNome(nome);
        errorMessage += checkCognome(cognome);
        errorMessage += checkEmail(email);
        errorMessage += checkMessage(message);

        if (errorMessage !== "") {
            event.preventDefault();
            var errorElement = document.getElementById("error-message");
            if (!errorElement) {
              errorElement = document.createElement("p");
              errorElement.id = "error-message";
              document
                .getElementById("contactForm")
                .insertBefore(errorElement, document.querySelector(".contactUs-form"));
            }
            errorElement.innerHTML = errorMessage;
          }
    });

   
});