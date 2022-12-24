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
    if ($_POST['alias'] == "" || $_POST['password'] == "") {
      echo "<div class='credentials'>
                <h3>Required fields are missing.</h3><br />
                <a href='login.php'>
                  <button class='btn-again'>Login</button>
                </a>
            </div>";
    } else {
      $alias = $_POST['alias'];
      $password = $_POST['password'];
      $hashed_pwd = password_hash($password, PASSWORD_DEFAULT);

      $alias = $_POST['alias'];
      $password = $_POST['password'];
      $hashed_pwd = password_hash($password, PASSWORD_DEFAULT);

      $query = "SELECT * FROM `users` WHERE `users_alias` = ?;";

      $stmt = $pdo->prepare($query);
      $result = $stmt->execute(array($alias));

      // Get user from DB
      $user = $stmt->fetch();

      if ($user && password_verify($password, $user['users_pwd'])) {
        $_SESSION['username'] = $user['users_alias'];
        $_SESSION['userid'] = $user['users_id'];
        header("location: index.php");
      } else {
        echo "<div class='credentials'>
                <h3>Invalid username or password.</h3><br />
                <a href='login.php'>
                  <button class='btn-again'>Login</button>
                </a>
              </div>";
      }

      // close connection
      $pdo = null;
    }
  } else {

  ?>
    <section class="container login">
      <form id="login-form" class="login-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <h4 class="">Logga in</h4>

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
          <label for="password">Lösenord</label>
          <input <?php if (isset($errors['password'])) {
                    echo 'class="input-error"';
                  } ?> placeholder="Fyll i ditt lösenord..." type="password" name="password" id="password" value="<?php echo !empty($_POST['password']) ? htmlspecialchars($_POST['password']) : '' ?>" />
          <div class="error">
            <?php echo $errors['password'] ?? '' ?>
          </div>
        </div>


        <div class="btn-group login-person">
          <input type="submit" name="submit" value="Logga in" class="btn" />
          <a href="register.php">
            <button type="button" class="link">Registrera ></button>
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