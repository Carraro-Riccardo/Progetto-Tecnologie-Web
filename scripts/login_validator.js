import { checkUsername, checkPassword } from "./input_validator.js";

document.addEventListener("DOMContentLoaded", function () {

  document.getElementById("loginForm").addEventListener("submit", function (event) {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    var errorMessage = "";

    errorMessage += checkUsername(username);
    errorMessage += checkPassword(password);

    if (errorMessage !== "") {
      event.preventDefault();
      var errorElement = document.getElementById("error-message");
      if (!errorElement) {
        errorElement = document.createElement("p");
        errorElement.id = "error-message";
        document
          .getElementById("loginForm")
          .insertBefore(errorElement, document.querySelector(".form-login-register fieldset"));
      }
      errorElement.textContent = errorMessage;
    }
  });
});
