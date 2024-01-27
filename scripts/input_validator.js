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
