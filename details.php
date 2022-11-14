<?php

include('config/db_connect.php');

if (isset($_POST['delete'])) {

  $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

  $sql = "DELETE FROM cats WHERE id = $id_to_delete";

  if (mysqli_query($conn, $sql)) {
    header('Location: index.php');
  } else {
    echo 'query error: ' . mysqli_error($conn);
  }
}

// check GET request id param
if (isset($_GET['id'])) {
  $id = htmlspecialchars($_GET["id"]);

  $query = "SELECT * FROM cats WHERE cats_id = ?";
  $stmt = $pdo->prepare($query);
  $stmt->execute(array($id));
  $cat = $stmt->fetch();

  // close connection
  $pdo = null;
}

?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php'); ?>

<div class="container center grey-text">
  <?php if ($cat) : ?>
    <h4><?php echo $cat['cats_name']; ?></h4>
    <p><b>Breed: </b><?php echo $cat['cats_breed']; ?></p>
    <div class="image">
      <img src="img/<?php echo htmlspecialchars($cat['cats_picture']); ?>" alt="<?php echo htmlspecialchars($cat['cats_name']); ?>" width="400" height="400" />
    </div>
    <h5>Information:</h5>
    <p><?php echo $cat['cats_info']; ?></p>

    <!-- DELETE FORM -->
    <form action="details.php" method="POST">
      <input type="hidden" name="id_to_delete" value="<?php echo $cat['cats_id']; ?>">
      <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
    </form>

  <?php else : ?>
    <h5>No such cat exists.</h5>
  <?php endif ?>
</div>

<?php include('templates/footer.php'); ?>

</html>