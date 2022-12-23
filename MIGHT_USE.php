    <!-- DELETE FORM -->
    <form action="details.php" method="POST">
      <input type="hidden" name="id_to_delete" value="<?php echo $cat['cats_id']; ?>">
      <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
    </form>

    <?php

    if (isset($_POST['delete'])) {

      $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

      $sql = "DELETE FROM cats WHERE id = $id_to_delete";

      if (mysqli_query($conn, $sql)) {
        header('Location: index.php');
      } else {
        echo 'query error: ' . mysqli_error($conn);
      }
    }
