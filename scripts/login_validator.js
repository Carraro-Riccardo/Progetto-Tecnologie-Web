document.addEventListener("DOMContentLoaded", function () {
  function checkUsername(username) {
    var usernameRegex = /^[A-Za-z]+$/;
    var usernameLength = 50;
    var errorMessage = "";

    if (username === "") {
      errorMessage = "Username cannot be empty.";
    } else if (!username.match(usernameRegex)) {
      errorMessage = "Username can only contain characters (both uppercase and lowercase).";
    } else if (username.length > usernameLength) {
      errorMessage = "Username cannot exceed " + usernameLength + " characters.";
    }

    return errorMessage;
  }

  function checkPassword(password) {
    var passwordLength = 255;
    var errorMessage = "";

    if (password === "") {
      errorMessage = "Password cannot be empty.";
    } else if (password.length > passwordLength) {
      errorMessage = "Password cannot exceed " + passwordLength + " characters.";
    }

    return errorMessage;
  }

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
