<?php

include('config/db_connect.php');

require('cat_validator.php');

$errors = [];
// $nameError = '';
// $breedError = '';
// $infoError = '';
// $pictureError = '';

if (isset($_POST['submit'])) {
  // validate pizza entries
  $cat_validation = new CatValidator($_POST);
  $errors = $cat_validation->validateForm();

  $nameError = $errors['name'] ?? '';
  $breedError = $errors['breed'] ?? '';
  $infoError = $errors['info'] ?? '';
  $pictureError = $errors['picture'] ?? '';

  if (array_filter($errors)) {
    //echo 'errors in form';
  } else {
    // escape sql chars
    $name = htmlspecialchars($_POST["name"]);
    $breed = htmlspecialchars($_POST["breed"]);
    $info = htmlspecialchars($_POST["info"]);
    $picture = htmlspecialchars($_POST["picture"]);

    // create sql
    $sql = "INSERT INTO pizzas('name', 'breed', 'info', 'picture') VALUES(?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    // save to db and check
    if (!$stmt->execute(array($name, $breed, $info, $picture))) {
      $stmt = null;
      header("location: index.php?error=stmtfailed");
      exit();
    } else {
      $stmt = null;
      header('Location: index.php');
    }
  }
} // end POST check

?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php'); ?>

<section class="container grey-text">
  <h4 class="center">Lägg till en katt</h4>
  <form class="white" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

    <label>Kattens namn</label>
    <input type="text" name="name" value="<?php $temp = $_POST['name'] ?? ''; ?><?php echo htmlspecialchars($temp) ?>" />
    <div class="error">
      <?php echo $errors['name'] ?? '' ?>
    </div>

    <label>Kattens ras</label>
    <input type="text" name="breed" value="<?php $temp = $_POST['breed'] ?? ''; ?><?php echo htmlspecialchars($temp) ?>" />
    <div class="error">
      <?php echo $errors['breed'] ?? '' ?>
    </div>

    <label>Information om katten</label>
    <input type="text" name="info" value="<?php echo !empty($_POST['info']) ? htmlspecialchars($_POST['info']) : '' ?>" />
    <div class="error">
      <?php echo $errors['info'] ?? '' ?>
    </div>

    <label>Bild på katten</label>
    <input placeholder="Filens namn..." type="text" name="picture" value="<?php echo !empty($_POST['picture']) ? htmlspecialchars($_POST['picture']) : '' ?>" />
    <div class="error">
      <?php echo $errors['picture'] ?? '' ?>
    </div>

    <div class="center">
      <input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
    </div>

  </form>

</section>

<?php include('templates/footer.php'); ?>

</html>