import { checkDataScadenzaCertificato } from "./input_validator.js";

document.addEventListener("DOMContentLoaded", function () {
  function showErrorMessage(e) {
    var inputDate = e.target.value;
    inputDate = inputDate.split("-").reverse().join("/");
    console.log(inputDate);
    var errorMessage = checkDataScadenzaCertificato(inputDate);
    if (errorMessage !== "") {
      var errorElement = document.getElementById("error-message");
  
      if (errorElement) {
        errorElement.remove();
      }
      errorElement = document.createElement("p");
      errorElement.id = "error-message";
      document
        .getElementById(e.target.id)
        .parentNode.insertBefore(
          errorElement,
          document.getElementById(e.target.id)
        );
      errorElement.innerHTML = errorMessage;
    }else{
      var errorElement = document.getElementById("error-message");
      if (errorElement) {
        errorElement.remove();
      }
    }
  }
  var dateScadenza_list = document.getElementsByClassName("dataScadenza");
  var formConvalida_list = document.getElementsByClassName("form_convalida");
  for (var i = 0; i < dateScadenza_list.length; i++) {
    dateScadenza_list[i].addEventListener("input", showErrorMessage);
    formConvalida_list[i].addEventListener("submit", function (event) {
      var inputDate = event.target.getElementsByClassName("dataScadenza")[0].value;
      inputDate = inputDate.split("-").reverse().join("/");
      var errorMessage = checkDataScadenzaCertificato(inputDate);
      if (errorMessage !== "") {
        event.preventDefault();
        var errorElement = document.getElementById("error-message");
  
        if (errorElement) {
          errorElement.remove();
        }
        errorElement = document.createElement("p");
        errorElement.id = "error-message";
        document
          .getElementById(event.target.getElementsByClassName("dataScadenza")[0].id)
          .parentNode.insertBefore(
            errorElement,
            document.getElementById(event.target.getElementsByClassName("dataScadenza")[0].id)
          );
        errorElement.innerHTML = errorMessage;
          }
      });
    }

    /** GESTIONE ABBONAMENTI */
    var formAbbonamento_list = document.getElementsByName("form_abbonamento");
    for (var i = 0; i < formAbbonamento_list.length; i++) {
      formAbbonamento_list[i].addEventListener("submit", function (event) {
        
        var inputNome = event.target.getElementsByName("nome")[0].value;
        var inputDurata = event.target.getElementsByName("durata")[0].value;
        var inputPrezzo = event.target.getElementsByName("costo")[0].value;

        var errorMessage = "";
        errorMessage += checkNome(inputNome);
        errorMessage += checkDurata(inputDurata);
        errorMessage += checkPrezzo(inputPrezzo);

        if (errorMessage !== "") {
          event.preventDefault();
          var errorElement = document.getElementById("error-message");
    
          if (errorElement) {
            errorElement.remove();
          }
          errorElement = document.createElement("p");
          errorElement.id = "error-message";
          document
            .getElementById(event.target.getElementsByClassName("form_abbonamento")[0].id)
            .parentNode.insertBefore(
              errorElement,
              document.getElementById(event.target.getElementsByClassName("form_abbonamento")[0].id)
            );
          errorElement.innerHTML = errorMessage;
            }
        });
      }
});
