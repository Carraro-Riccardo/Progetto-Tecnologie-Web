document.addEventListener('DOMContentLoaded', function(){
document.getElementById('form-certificato').addEventListener('submit', function(event) {
    var fileInput = document.getElementById('certificato');
    var filePath = fileInput.value;
  
    var allowedExtensions = /(\.pdf)$/i;

    if (!allowedExtensions.exec(filePath)) {
        event.preventDefault();
        var errorMessage = "Il file caricato non è un PDF.";
        var errorElement = document.getElementById("error-message");
        if (!errorElement) {
          errorElement = document.createElement("p");
          errorElement.id = "error-message";
          document
            .getElementById("form-certificato")
            .insertBefore(errorElement, document.querySelector("#form-certificato fieldset"));
        }
        errorElement.innerHTML = errorMessage;
      fileInput.value = '';
    }
  });
});