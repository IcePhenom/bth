<?php

/**
 * Is user authenticated and logged in?
 */
function userIsAuthenticated() {
  if(isset($_SESSION['authenticated'])) {
    return $_SESSION['authenticated'];
  } else {
    return false;
  }
}

/**
 * create the login/logout menu
 */
function userLoginMenu() {
  if (userisAuthenticated()) {
    return "<a id='logout-' href='login.php?p=logout'>Logga ut</a>";
  }
  else {
    return "<a id='login-' href='login.php?p=login'>Logga in</a>";
  }
}

/**
 * Get login-form
 */
function userLoginForm($output=null, $outputClass=null) {
  if(isset($output)) {
    $output = "<p class='right'><output class='$outputClass'>$output</output></p>";
  }

  if(userisAuthenticated()) {
    return $output;
  }

  return "<form method='post' action='?p=login'>
            <fieldset>
              <legend>Login</legend>
              $output
              <p>
                <label for='input1'>Användarkonto:</label><br>
                <input id='input1' class='text' type='text' name='account'>
              </p>
              <p>
                <label for='input2'>Lösenord:</label><br>
                <input id='input2' class='text' type='password' name='password'>
              </p>
              <p>
                <input type='submit' name='doLogin' value='Login'>
              </p>
            </fieldset>
          </form>";
}

/**
 * Login the user
 */
function userLogin() {
  global $userAccount, $userPassword;
  if(isset($_POST['doLogin'])) {
    if($userAccount == $_POST['account'] && $userPassword == userPassword($_POST['password'])) {
      $_SESSION['authenticated'] = true;
      return userLoginForm("Du är nu inloggad, redigerings menyn är nu aktiverad på alla sidor där redigeringsmöjligheter finns.", "success");
    }
    return userLoginForm("Du lyckades ej logga in. Felaktigt konto eller lösenord.", "error");
  }
  return userLoginForm();
}

/**
 * Logout the user
 */
function userLogout() {
  unset($_SESSION['authenticated']);
  return "<h1>Utloggad</h1><p>Du är nu utloggad.</p>" . userLogin();
}

/**
 * Generate a password
 */
function userPassword($password) {
  return sha1($password);
}
