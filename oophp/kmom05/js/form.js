function formhash(form, password) {
   var p = form.elements["p"];
   p.value = SHA512(password.value);
   // Make sure the plaintext password doesn't get sent.
   password.value = "";
}