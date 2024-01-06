export function checkUsername(username) {
  var usernameRegex = /^[A-Za-z]+$/;
  var usernameLength = 50;

  if (username === "") {
    return "Il campo username non può essere vuoto.\n";
  } else if (!username.match(usernameRegex)) {
    return "Il campo username può contenere solo caratteri (sia maiuscoli che minuscoli).\n";
  } else if (username.length > usernameLength) {
    return "Il campo username non può superare " + usernameLength + " caratteri.\n";
  }

  return "";
}

export function checkNome(nome) {
  var nomeRegex = /^[A-Za-z]+$/;
  var nomeLength = 30;

  if (nome === "") {
    return "Il campo nome non può essere vuoto.\n";
  } else if (!nome.match(nomeRegex)) {
    return "Il campo nome può contenere solo caratteri (sia maiuscoli che minuscoli).\n";
  } else if (nome.length > nomeLength) {
    return "Il campo nome non può superare " + nomeLength + " caratteri.\n";
  }

  return "";
}

export function checkCognome(cognome) {
  var cognomeRegex = /^[A-Za-z]+$/;
  var cognomeLength = 30;

  if (cognome === "") {
    return "Il campo cognome non può essere vuoto.\n";
  } else if (!cognome.match(cognomeRegex)) {
    return "Il campo cognome può contenere solo caratteri (sia maiuscoli che minuscoli).\n";
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
    return "Il campo password non può essere vuoto.\n";
  } else if (password.length > passwordLength) {
    return "Il campo password non può superare " + passwordLength + " caratteri.\n";
  } else if (password !== confirmPassword) {
    return "Il campo password e il campo conferma password devono corrispondere.\n";
  }

  return "";
}

export function checkPassword(password) {
    var passwordLength = 255;
  
    if (password === "") {
      return "Il campo password non può essere vuoto.\n";
    } else if (password.length > passwordLength) {
      return "Il campo password non può superare " + passwordLength + " caratteri.\n";
    }
    
    return "";
  }
