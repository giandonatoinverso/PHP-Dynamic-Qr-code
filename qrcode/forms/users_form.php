<fieldset>
    <div class="col-sm-4">
        <div class="form-group">
            <label for="username">Nombre de usuario</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                </div>

                <input type="text" name="user_name" placeholder="Nombre de usuario" class="form-control" required=""
                    value="<?php echo ($edit) ? $admin_account['user_name'] : ''; ?>" autocomplete="off"
                    pattern="^(?=.{8,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$"
                >
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label for="username">Email</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-at"></i></span>
                </div>

                <input type="email" name="email" pattern="^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$" placeholder="email" class="form-control" required=""
                    value="<?php echo ($edit) ? $admin_account['email'] : ''; ?>" autocomplete="off">
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <label for="password">Password</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                </div>

                <input type="password" name="password" placeholder="Password" class="form-control" required=""
                    autocomplete="off">
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <label for="user-type">User type</label>

        <div class="form-group">
            <div class="radio">
                <label class="radio">
                    <?php //echo $admin_account['admin_type']?>
                    <input type="radio" name="admin_type" value="super" required=""
                        <?php echo ($edit && $admin_account['admin_type'] =='super') ? "checked": "" ; ?> /> Super
                    admin</label>
            </div>

            <div class="radio">
                <label class="radio">
                    <input type="radio" name="admin_type" value="admin" required=""
                        <?php echo ($edit && $admin_account['admin_type'] =='admin') ? "checked": "" ; ?> />
                    Admin</label>
            </div>
            <div class="radio">
                <label class="radio">
                    <input type="radio" name="admin_type" value="user" required=""
                        <?php echo ($edit && $admin_account['admin_type'] =='user') ? "checked": "" ; ?> /> User</label>
            </div>
        </div>
    </div>
</fieldset>