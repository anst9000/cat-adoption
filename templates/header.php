<?php

session_start();

//$_SESSION['name'] = 'mario';

if ($_SERVER['QUERY_STRING'] == 'noname') {
  //unset($_SESSION['name']);
  session_unset();
}

// null coalesce
$name = $_SESSION['name'] ?? 'Guest';

// $_SESSION["userid"] = $user[0]["users_id"];
// $_SESSION["useralias"] = $user[0]["users_alias"];
$_SESSION["userid"] = 23;
$_SESSION["useralias"] = "Acke";


?>

<head>
  <title>Kattadoption</title>
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
  <style type="text/css">
    .brand {
      background: #cbb09c !important;
    }

    .brand-text {
      color: #cbb09c !important;
    }

    form {
      max-width: 460px;
      margin: 20px auto;
      padding: 20px;
    }

    .pizza {
      width: 100px;
      margin: 40px auto -30px;
      display: block;
      position: relative;
      top: -30px;
    }
  </style>
</head>

<body class="grey lighten-4">
  <nav class="white z-depth-0">
    <div class="container">
      <a href="index.php" class="brand-logo brand-text">Kattadoption</a>
      <ul id="nav-mobile" class="right hide-on-small-and-down">
        <?php
        if (isset($_SESSION["userid"])) {
        ?>
          <li class="grey-text">
            <?php echo $_SESSION["useralias"]; ?>
          </li>
          <li class="grey-text">
            <a href="add.php" class="btn brand z-depth-0">Ny katt</a>
          </li>
          <li class="grey-text">
            <a href="logout.php" class="btn brand z-depth-0">LOGOUT</a>
          </li>
        <?php
        } else {
        ?>
          <li class="grey-text">
            <a href="register.php" class="btn brand z-depth-0">REGISTER</a>
          </li>
          <li class="grey-text">
            <a href="login.php" class="btn brand z-depth-0">LOGIN</a>
          </li>
        <?php
        }
        ?>

      </ul>
    </div>
  </nav>