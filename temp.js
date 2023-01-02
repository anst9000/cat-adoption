{/* <div class="form-group">
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


      <div class="form-group">
      <label for="picture">Bild på katten</label>
      <input <?php if (isset($errors['picture'])) {
                echo 'class="input-error"';
              } ?> placeholder="Filens namn..." type="text" name="picture" id="picture" value="<?php echo !empty($_POST['picture']) ? htmlspecialchars($_POST['picture']) : '' ?>" />
      <div class="error">
        <?php echo $errors['picture'] ?? '' ?>
      </div>
    </div> */}
