<?php

include('config/db_connect.php');

$query = 'SELECT * FROM cats;';
$stmt = $pdo->prepare($query);
$stmt->execute();
$cats = $stmt->fetchAll();

// close connection
$pdo = null;
?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php'); ?>

<h4 class="center grey-text">Katter utan familj</h4>

<div class="container">
  <div class="row">

    <?php foreach ($cats as $cat) : ?>

      <div class="col s6 m4">
        <div class="card z-depth-0">
          <img src="img/cat-profile.svg" class="cat">
          <div class="card-content center">
            <h6><?php echo htmlspecialchars($cat['cats_name']); ?></h6>
            <p><?php echo htmlspecialchars($cat['cats_breed']); ?></p>
          </div>
          <div class="card-action right-align">
            <a class="brand-text" href="details.php?id=<?php echo $cat['cats_id'] ?>">more info</a>
          </div>
        </div>
      </div>

    <?php endforeach; ?>

  </div>
</div>

<?php include('templates/footer.php'); ?>

</html>