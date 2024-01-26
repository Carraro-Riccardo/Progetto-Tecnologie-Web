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

export function checkCreditCard(creditCard) {
  var creditCardRegex = /^[0-9]{16}$/;

  if (creditCard === "") {
    return "Il campo carta di credito non può essere vuoto.\n";
  } else if (!creditCard.match(creditCardRegex)) {
    return "Il campo carta di credito deve contenere solo 16 cifre.\n";
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
    return "Il campo data di scadenza deve essere nel formato MM/AA.\n";
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

