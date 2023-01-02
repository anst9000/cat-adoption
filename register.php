<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>Registrera</title>
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>

  <?php

  session_start();
  require('config/db_connect.php');

  // When form submitted, insert values into the database.
  if (isset($_POST['submit'])) {
    if ($_POST['alias'] == "" || $_POST['email'] == "" || $_POST['password'] == "") {
      echo "<div class='credentials'>
              <h3>Alla fält måste vara ifyllda</h3><br />
              <a href='register.php'>
                <button class='btn-again'>Registrera</button>
              </a>
            </div>";
    } else {

      try {
        $alias = htmlspecialchars($_POST["alias"]);
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);
        // echo ('alias = ' . $alias . '</br>');
        // echo ('email = ' . $email . '</br>');
        // echo ('password = ' . $password . '</br>');

        $query = "INSERT INTO `users` (users_alias, users_email, users_pwd) VALUES (?, ?, ?)";
        $hashed_pwd = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare($query);
        $result = $stmt->execute(array($alias, $email, $hashed_pwd));

        if ($result) {
          echo "<div class='credentials'>
                  <h3>Registreringen gick bra.</h3><br />
                  <a href='login.php'>
                    <button class='btn-again'>Logga in</button>
                  </a>
                </div>";
        } else {
          echo "<div class='credentials'>
                  <h3>Något blev fel, prova på nytt.</h3><br />
                  <a href='register.php'>
                    <button class='btn-again'>Registrera</button>
                  </a>
                </div>";
        }
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    }

    // close connection
    $pdo = null;
  } else {
  ?>

    <section class="container register">
      <form id="register-form" class="register-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <h4 class="">Registrera ny användare</h4>

        <div class="form-group">
          <label for="alias">Alias</label>
          <input <?php if (isset($errors['alias'])) {
                    echo 'class="input-error"';
                  } ?> placeholder="Fyll i ditt alias..." type="text" name="alias" id="register-alias" value="<?php echo !empty($_POST['alias']) ? htmlspecialchars($_POST['alias']) : '' ?>" />
          <div class="error">
            <?php echo $errors['alias'] ?? '' ?>
          </div>
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input <?php if (isset($errors['email'])) {
                    echo 'class="input-error"';
                  } ?> placeholder="Fyll i ditt email..." type="text" name="email" id="register-email" value="<?php echo !empty($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" />
          <div class="error">
            <?php echo $errors['email'] ?? '' ?>
          </div>
        </div>

        <div class="form-group">
          <label for="password">Lösenord</label>
          <input <?php if (isset($errors['password'])) {
                    echo 'class="input-error"';
                  } ?> placeholder="Fyll i ditt lösenord..." type="password" name="password" id="register-password" value="<?php echo !empty($_POST['password']) ? htmlspecialchars($_POST['password']) : '' ?>" />
          <div class="error">
            <?php echo $errors['password'] ?? '' ?>
          </div>
        </div>


        <div class="btn-group register-person">
          <input type="submit" name="submit" value="Registrera" class="btn" />
          <a href="login.php">
            <button type="button" class="link">Logga in ></button>
          </a>
        </div>

      </form>
    </section>

  <?php } ?>

  <footer>
    <div class="copyright">&copy; Copyright 2022 Kattadoption</div>
  </footer>

  <script src="js/credentials.js"></script>

</body>

</html>