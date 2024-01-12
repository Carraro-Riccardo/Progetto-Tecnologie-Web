import {
  checkUsername,
  checkNome,
  checkCognome,
  checkEmail,
  checkPassword,
  checkRegisterPassword,
} from "./input_validator.js";

document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("editUserDataForm").addEventListener("submit", function (event) {
    var username = document.getElementById("username").value;
    var nome = document.getElementById("nome").value;
    var cognome = document.getElementById("cognome").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    var errorMessage = "";

    errorMessage += checkUsername(username);
    errorMessage += checkNome(nome);
    errorMessage += checkCognome(cognome);
    errorMessage += checkEmail(email);
    errorMessage += checkPassword(password);

    if (errorMessage !== "") {
      event.preventDefault();
      var errorElement = document.getElementById("error-message");

      if (errorElement) {
        errorElement.remove();
      }
      errorElement = document.createElement("p");
      errorElement.id = "error-message";
      document
        .getElementById("editUserDataForm")
        .insertBefore(errorElement, document.querySelector(".form-login-register fieldset"));
      errorElement.innerHTML = errorMessage;
    }
  });

  document.getElementById("editPasswordForm")?.addEventListener("submit", function (event) {
    var password = document.getElementById("oldPassword").value;
    var newPassword = document.getElementById("newPassword").value;
    var confirmPassword = document.getElementById("confermaNuovaPsw").value;

    var errorMessage = "";

    errorMessage += checkPassword(password);
    errorMessage += checkRegisterPassword(newPassword, confirmPassword);

    if (errorMessage !== "") {
      event.preventDefault();
      var errorElement = document.getElementById("error-message");

      if (errorElement) {
        errorElement.remove();
      }

      errorElement = document.createElement("p");
      errorElement.id = "error-message";
      document
        .getElementById("editPasswordForm")
        .insertBefore(
          errorElement,
          document.getElementById("editPasswordForm").querySelector(".form-login-register fieldset")
        );

      errorElement.innerHTML = errorMessage;
    }
  });
});
