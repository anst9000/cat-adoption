<?php

include('config/db_connect.php');

// check GET request id param
if (isset($_GET['id'])) {
  $id = htmlspecialchars($_GET['id']);

  $query = "SELECT * FROM cats WHERE cats_id = ?";
  $stmt = $pdo->prepare($query);
  $stmt->execute(array($id));
  $cat = $stmt->fetch();

  // close connection
  $pdo = null;
}

?>

<?php include('templates/header.php'); ?>

<div class="container">
  <?php if ($cat) : ?>
    <h2><?php echo ($cat['cats_name']); ?></h2>
    <div class="cat-details">
      <div class="cat-img">
        <img src="img/<?php echo htmlspecialchars($cat['cats_picture']); ?>" alt="<?php echo htmlspecialchars($cat['cats_name']); ?>" width="400" height="400" />
      </div>

      <div class="cat-info">
        <p><b>Ras: </b><?php echo $cat['cats_breed']; ?></p>
        <p><b>Information: </b><?php echo $cat['cats_info']; ?></p>
      </div>
    </div>
    <!-- ADOPT FORM -->
    <form class="btn-group" action="adopt.php" method="POST">
      <input type="hidden" name="id_to_adopt" value="<?php echo $cat['cats_id']; ?>">
      <input type="hidden" name="name_to_adopt" value="<?php echo $cat['cats_name']; ?>">
      <input type="hidden" name="picture_to_adopt" value="<?php echo $cat['cats_picture']; ?>">

      <div class="btn-group login-person">
        <input class="btn" type="submit" name="adopt" value="Adoptera">
        <a href="index.php" class="a-back">
          <button class="btn-back">Gå tillbaka ></button>
        </a>
      </div>
    </form>

  <?php else : ?>
    <h5>Det finns ingen katt med id-nummer <?php echo ($id) ?></h5>
  <?php endif ?>
</div>

<?php include('templates/footer.php'); ?>