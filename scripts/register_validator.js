import { checkUsername, checkNome, checkCognome, checkEmail, checkRegisterPassword } from "./input_validator.js";

document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("registerForm").addEventListener("submit", function (event) {
    var username = document.getElementById("username").value;
    var nome = document.getElementById("nome").value;
    var cognome = document.getElementById("cognome").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirmPassword").value;

    var errorMessage = "";
    errorMessage += checkUsername(username);
    errorMessage += checkNome(nome);
    errorMessage += checkCognome(cognome);
    errorMessage += checkEmail(email);
    errorMessage += checkRegisterPassword(password, confirmPassword);

    if (errorMessage !== "") {
      event.preventDefault();
      var errorElement = document.getElementById("error-message");
      if (!errorElement) {
        errorElement = document.createElement("p");
        errorElement.id = "error-message";
        document
          .getElementById("registerForm")
          .insertBefore(errorElement, document.querySelector(".form-login-register fieldset"));
      }
      errorElement.textContent = errorMessage;
    }
  });
});
