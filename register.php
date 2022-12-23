<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>Registration</title>
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>

  <?php

  session_start();

  require('config/db_connect.php');

  // When form submitted, insert values into the database.
  if (isset($_POST['submit'])) {
    try {
      $alias = htmlspecialchars($_POST["alias"]);
      $email = htmlspecialchars($_POST["email"]);
      $password = htmlspecialchars($_POST["password"]);
      // echo ('alias = ' . $alias . '</br>');
      // echo ('email = ' . $email . '</br>');
      // echo ('password = ' . $password . '</br>');

      $query = "INSERT into `users` (users_alias, users_email, users_pwd) VALUES (?, ?, ?)";
      $hashed_pwd = password_hash($password, PASSWORD_DEFAULT);

      $stmt = $pdo->prepare($query);
      $result = $stmt->execute(array($alias, $email, $hashed_pwd));

      if ($result) {
        echo "<div class='form'>
                <h3>You are registered successfully.</h3><br/>
                <p class='link'>Click here to <a href='login.php'>Login</a></p>
                </div>";
      } else {
        echo "<div class='form'>
                <h3>Required fields are missing.</h3><br/>
                <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                </div>";
      }
    } catch (PDOException $e) {
      echo $e->getMessage();
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
                  } ?> placeholder="Fyll i ditt alias..." type="text" name="alias" id="alias" value="<?php echo !empty($_POST['alias']) ? htmlspecialchars($_POST['alias']) : '' ?>" />
          <div class="error">
            <?php echo $errors['alias'] ?? '' ?>
          </div>
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input <?php if (isset($errors['email'])) {
                    echo 'class="input-error"';
                  } ?> placeholder="Fyll i ditt email..." type="text" name="email" id="email" value="<?php echo !empty($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" />
          <div class="error">
            <?php echo $errors['email'] ?? '' ?>
          </div>
        </div>

        <div class="form-group">
          <label for="password">Lösenord</label>
          <input <?php if (isset($errors['password'])) {
                    echo 'class="input-error"';
                  } ?> placeholder="Fyll i ditt lösenord..." type="password" name="password" id="password" value="<?php echo !empty($_POST['password']) ? htmlspecialchars($_POST['password']) : '' ?>" />
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

  <?php
  }
  ?>
</body>

</html>



<?php include('templates/footer.php'); ?>