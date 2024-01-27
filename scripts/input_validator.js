export function checkUsername(username) {
  var usernameRegex = /^[A-Za-z]+$/;
  var usernameLength = 50;

  if (username === "") {
    return "Il campo <span lang='en'>username</span> non può essere vuoto.\n";
  } else if (!username.match(usernameRegex)) {
    return "Il campo <span lang='en'>username</span> può contenere solo caratteri (sia maiuscoli che minuscoli).\n";
  } else if (username.length > usernameLength) {
    return "Il campo <span lang='en'>username</span> non può superare " + usernameLength + " caratteri.\n";
  }

  return "";
}

export function checkNome(nome) {
  nome = nome.trim();
  var nomeRegex = /^[A-Za-z\s]+$/;
  var nomeLength = 30;

  if (nome === "") {
    return "Il campo nome non può essere vuoto.\n";
  } else if (!nome.match(nomeRegex)) {
    return "Il campo nome può contenere solo caratteri (sia maiuscoli che minuscoli) e spazi.\n";
  } else if (nome.length > nomeLength) {
    return "Il campo nome non può superare " + nomeLength + " caratteri.\n";
  }

  return "";
}

export function checkCognome(cognome) {
  cognome = cognome.trim();
  var cognomeRegex = /^[A-Za-z\s]+$/;
  var cognomeLength = 30;

  if (cognome === "") {
    return "Il campo cognome non può essere vuoto.\n";
  } else if (!cognome.match(cognomeRegex)) {
    return "Il campo cognome può contenere solo caratteri (sia maiuscoli che minuscoli) e spazi.\n";
  } else if (cognome.length > cognomeLength) {
    return "Il campo cognome non può superare " + cognomeLength + " caratteri.\n";
  }

  return "";
}

export function checkEmail(email) {
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  var emailLength = 50;

  if (email === "") {
    return "Il campo email non può essere vuoto.\n";
  } else if (!email.match(emailRegex)) {
    return "Il campo email deve essere un email valido.\n";
  } else if (email.length > emailLength) {
    return "Il campo email non può superare " + emailLength + " caratteri.\n";
  }

  return "";
}

export function checkRegisterPassword(password, confirmPassword) {
  var passwordLength = 255;

  if (password === "") {
    return "Il campo <span lang='en'>password</span> non può essere vuoto.\n";
  } else if (password.length > passwordLength) {
    return "Il campo <span lang='en'>password</span> non può superare " + passwordLength + " caratteri.\n";
  } else if (password !== confirmPassword) {
    return "Il campo <span lang='en'>password</span> e il campo conferma <span lang='en'>password</span> devono corrispondere.\n";
  }

  return "";
}

export function checkPassword(password) {
    var passwordLength = 255;
  
    if (password === "") {
      return "Il campo <span lang='en'>password</span> non può essere vuoto.\n";
    } else if (password.length > passwordLength) {
      return "Il campo <span lang='en'>password</span> non può superare " + passwordLength + " caratteri.\n";
    }
    
    return "";
  }

export function checkMessage(message){
  var messageLength = 1000;

  if (message === "") {
    return "Il campo messaggio non può essere vuoto.\n";
  } else if (message.length > messageLength) {
    return "Il campo messaggio non può superare " + messageLength + " caratteri.\n";
  }

  return "";
}
export function checkCreditCard(creditCard) {
  var creditCardRegex = /^[0-9]{16}$/;

  if (creditCard === "") {
    return "Il campo numero carta non può essere vuoto.\n";
  } else if (!creditCard.match(creditCardRegex)) {
    return "Il campo numero carta deve contenere solo 16 cifre.\n";
  }

  return "";
}

export function checkCVV(cvv) {
  var cvvRegex = /^[0-9]{3}$/;

  if (cvv === "") {
    return "Il campo CVV non può essere vuoto.\n";
  } else if (!cvv.match(cvvRegex)) {
    return "Il campo CVV deve contenere solo 3 cifre.\n";
  }

  return "";
}


export function checkDataScadenza(data) {
  var regexDataScadenza = /^(0[1-9]|1[0-2])\/([0-9]{2})$/;

  if (data === "") {
    return "Il campo data di scadenza non può essere vuoto.\n";
  } else if (!data.match(regexDataScadenza)) {
    return "La data di scadenza deve essere valida e nel formato MM/AA.\n";
  }

  var oggi = new Date();
  var annoCorrente = oggi.getFullYear() % 100;
  var meseCorrente = oggi.getMonth() + 1;

  var [meseScadenza, annoScadenza] = data.split("/").map(Number);

  if (annoScadenza < annoCorrente || (annoScadenza === annoCorrente && meseScadenza < meseCorrente)) {
    return "La data di scadenza non può essere nel passato.\n";
  }

  return "";
}

export function checkDataScadenzaCertificato(data) {
  var dateParts = data.split("/");

  if (dateParts.length === 3 && dateParts[0].length === 2 && dateParts[1].length === 2 && dateParts[2].length === 4) {
      var day = parseInt(dateParts[0], 10);
      var month = parseInt(dateParts[1], 10);
      var year = parseInt(dateParts[2], 10);

      var date = new Date(year, month - 1, day);
      if (date && date.getMonth() + 1 === month && date.getDate() === day && date.getFullYear() === year) {
          var today = new Date();

          if (date > today) {
              return "";
          } else {
              return "Data non valida, deve essere una data futura.";
          }
      } else {
          return "Data inserita non valida";
      }
  } else {
      return "Il formato della data non è corretto: deve essere GG/MM/AAAA";
  }
}

export function checkDurata(durata){
  var durataRegex = /^[0-9]+$/;

  if (durata === "") {
    return "Il campo durata non può essere vuoto.\n";
  } else if (!durata.match(durataRegex)) {
    return "Il campo durata deve contenere solo numeri.\n";
  }

  return "";
}

//price can have decimals
export function checkPrezzo(prezzo){
  var prezzoRegex = /^[0-9]+(\.[0-9]{1,2})?$/;

  if (prezzo === "") {
    return "Il campo prezzo non può essere vuoto.\n";
  } else if (!prezzo.match(prezzoRegex)) {
    return "Il campo prezzo deve contenere solo cifre con massimo 2 decimali.\n";
  }

  return "";
}
