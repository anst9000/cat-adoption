<?php

include('config/db_connect.php');

require('cat_validator.php');
require('cats_list.php');

$errors = [];
if (isset($_POST['submit'])) {

  // validate cat entries
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
    $sql = "INSERT INTO `cats` (cats_name, cats_breed, cats_info, cats_picture) VALUES(?, ?, ?, ?);";
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

<?php include('templates/header.php'); ?>

<section class="container add">
  <form id="cat-form" class="add-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <h4 class="">Lägg till en katt</h4>

    <div class="form-group">
      <label for="name">Kattens namn</label>
      <input <?php if (isset($errors['name'])) {
                echo 'class="input-error"';
              } ?> placeholder="Fyll i kattens namn..." type="text" name="name" id="name" value="<?php echo !empty($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>" />
      <div class="error">
        <?php echo $errors['name'] ?? '' ?>
      </div>
    </div>

    <div class="form-group">
      <label for="breed">Kattens ras</label>
      <select <?php if (isset($errors['breed'])) {
                echo 'class="input-error"';
              } ?> form="cat-form" name="breed" id="breed" value="<?php echo !empty($_POST['breed']) ? htmlspecialchars($_POST['breed']) : '' ?>">
        <option value="" disabled selected>Välj ras</option>
        <?php
        foreach ($cats_list as $cat) {
          echo "<option value='" . $cat . "'>" . $cat . "</option>";
        }
        ?>
      </select>
      <div class="error">
        <?php echo $errors['breed'] ?? '' ?>
      </div>
    </div>

    <div class="form-group">
      <label for="info">Information om katten</label>
      <textarea <?php if (isset($errors['info'])) {
                  echo 'class="input-error"';
                } ?> placeholder="Information om katten som ska adopteras..." id="info" rows="4" cols="50" name="info" value="<?php echo !empty($_POST['info']) ? htmlspecialchars($_POST['info']) : '' ?>;"></textarea>

      <div class="error">
        <?php echo $errors['info'] ?? '' ?>
      </div>
    </div>

    <div class="form-group">
      <label for="picture">Bild på katten</label>
      <input <?php if (isset($errors['picture'])) {
                echo 'class="input-error"';
              } ?> placeholder="Filens namn..." type="text" name="picture" id="picture" value="<?php echo !empty($_POST['picture']) ? htmlspecialchars($_POST['picture']) : '' ?>" />
      <div class="error">
        <?php echo $errors['picture'] ?? '' ?>
      </div>
    </div>

    <div class="button add-cat">
      <input type="submit" name="submit" value="Skicka" class="btn">
    </div>

  </form>

</section>

<?php include('templates/footer.php'); ?>