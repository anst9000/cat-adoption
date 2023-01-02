<?php

include('config/db_connect.php');

if (isset($_POST['adopt'])) {

  $id_to_adopt = $_POST['id_to_adopt'];
  $name_to_adopt = $_POST['name_to_adopt'];
  $picture_to_adopt = $_POST['picture_to_adopt'];
  $breed_to_adopt = $_POST['breed_to_adopt'];
  $info_to_adopt = $_POST['info_to_adopt'];

  try {
    $query = "DELETE FROM cats WHERE cats_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array($id_to_adopt));
    $cat = $stmt->fetch();
  } catch (PDOException $e) {
    echo $e->getMessage();
  }

  // close connection
  $pdo = null;
}

// header("location: index.php");

?>

<?php include('templates/header.php'); ?>

<div class="container">
  <?php if ($id_to_adopt) : ?>
    <h2><?php echo $_SESSION['username'] . " har adopterat " . $name_to_adopt; ?></h2>
    <div class="cat-details">

      <div class="cat-img">
        <img src="img/<?php echo htmlspecialchars($picture_to_adopt); ?>" alt="<?php echo htmlspecialchars($picture_to_adopt); ?>" width="400" height="400" />
      </div>

      <div class="cat-info">
        <p><b>Ras: </b><?php echo htmlspecialchars($breed_to_adopt); ?></p>
        <p><b>Information: </b><?php echo htmlspecialchars($info_to_adopt); ?></p>
        <p><b>Kontakt: </b>Vi skickar kompletterande information om avhämtning och skötselråd till din epost</p>
        <p><b><?php echo $_SESSION['useremail'] ?></b></p>
      </div>
    </div>
  <?php else : ?>
    <h5>No such cat exists.</h5>
  <?php endif ?>

  <a href="index.php" class="a-back">
    <button class="btn-back">Gå tillbaka</button>
  </a>

</div>

<?php include('templates/footer.php'); ?>