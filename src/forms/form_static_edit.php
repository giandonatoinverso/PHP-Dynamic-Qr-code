<fieldset>

    <div class="col-sm-4">
        <div class="form-group">
            <label for="filename">Filename *</label>
            <p>N.B. You can change the name of the file visible in the table, however a new qr code will NOT be generated</p>
            <input type="text" name="filename" value="<?php echo htmlspecialchars($edit ? $static_qrcode['filename'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Filename" class="form-control" required="required" id = "filename">
        </div> 
    </div>

    <?php if($_SESSION['type'] ===  'super') { ?>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="id_owner">Owner *</label>
                <select name="id_owner" class="form-control" required="required">
                    <?php
                    require_once BASE_PATH . '/lib/Users/Users.php';
                    $users_instance = new Users();

                    if(isset($static_qrcode['id_owner'])) {
                        $owner = $users_instance->getUser($static_qrcode['id_owner']);
                        echo "<option selected value=\"" . $owner["id"] . "\">" . $owner["username"] . "</option>";
                        echo "<option value=\"\">All</option>";
                    }

                    $users = $users_instance->getAllUsers();
                    foreach ($users as $user) {
                        ?>
                        <option value="<?php echo $user["id"];?>"><?php echo $user["username"];?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    <?php } else { ?>
        <input type="hidden" name="id_owner" value="<?php echo $_SESSION["user_id"];?>"/>
    <?php } ?>

    <input type="hidden" name="id" value="<?php echo $static_qrcode['id'];?>"/>
    <input type="hidden" name="edit" value="true"/>
    <input type="hidden" name="old_filename" value="<?php echo $static_qrcode['filename'];?>"/>
</fieldset>