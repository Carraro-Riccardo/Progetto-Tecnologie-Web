document.getElementById('form-certificato').addEventListener('submit', function(event) {
    var fileInput = document.getElementById('certificato');
    var filePath = fileInput.value;
  
    var allowedExtensions = /(\.pdf)$/i;

    console.log(filePath);
    console.log(allowedExtensions.exec(filePath));
    if (!allowedExtensions.exec(filePath)) {
        console.log("Errore");
        event.preventDefault();
        var errorMessage = "Il file caricato non è un PDFAA.";
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
  