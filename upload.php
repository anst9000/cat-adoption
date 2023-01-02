<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>Ny bild</title>
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>

  <?php
  session_start();

  if ($_SESSION["username"] != "skrutte") {
    header("Location: login.php");
    exit();
  }

  // Check if image file is a actual image or fake image
  if (isset($_POST["submit"])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check === false) {
      echo "<div class='credentials'>
      <h3>Filen är inte en bild, tyvärr.</h3><br />
      <a href='upload.php'>
        <button class='btn-again'>Ny bild</button>
      </a>
    </div>";

      $uploadOk = 0;
    } else {
      // echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;

      // Check if file already exists
      if (file_exists($target_file)) {
        echo "<div class='credentials'>
        <h3>Filen är redan uppladdad.</h3><br />
        <a href='upload.php'>
          <button class='btn-again'>Ny bild</button>
        </a>
      </div>";

        $uploadOk = 0;
      }

      // Check file size
      if ($_FILES["fileToUpload"]["size"] > 1000 * 1000 * 2) {
        echo "<div class='credentials'>
        <h3>Filen är tyvärr för stor, max 2MB.</h3><br />
        <a href='upload.php'>
          <button class='btn-again'>Ny bild</button>
        </a>
      </div>";

        $uploadOk = 0;
      }

      // Allow certain file formats
      if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
      ) {
        echo "<div class='credentials'>
          <h3>Endast filformaten [.jpg, .jpeg, .png, .gif] är tillåtna.</h3><br />
          <a href='upload.php'>
            <button class='btn-again'>Ny bild</button>
          </a>
        </div>";

        $uploadOk = 0;
      }

      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
        // echo "<div class='credentials'>
        //   <h3>Filen laddades inte upp.</h3><br />
        //   <a href='upload.php'>
        //     <button class='btn-again'>Ny bild</button>
        //   </a>
        // </div>";

        // if everything is ok, try to upload file
      } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          echo "<div class='credentials'>
            <h3>Uppladdningen av filen " . htmlspecialchars(basename($_FILES['fileToUpload']['name'])) . " gick bra.</h3><br />
            <a href='index.php'>
              <button class='btn-again'>Alla katter</button>
            </a>
          </div>";
        } else {
          echo "<div class='credentials'>
          <h3>Det blev något fel vid uppladdningen av filen.</h3><br />
          <a href='upload.php'>
            <button class='btn-again'>Ny bild</button>
          </a>
        </div>";
        }
      }
    }
  } else {

  ?>
    <section class="container login">
      <form id="upload-form" class="upload-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
        <div class="btn-group upload-file">
          <label for="fileToUpload" class="custom-file-upload">
            Välj bildfil
          </label>
          <input type="file" name="fileToUpload" id="fileToUpload">
          <input type="submit" value="Ladda upp bild" name="submit">
        </div>
        <div id="file-selected"></div>
      </form>

    </section>

  <?php
  }
  ?>

  <footer>
    <div class="copyright">&copy; Copyright 2022 Kattadoption</div>
  </footer>

  <script src="js/upload.js"></script>
</body>

</html>