<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <label for="username">App ID / Client ID</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                </div>

                <input type="text" name="social_key" placeholder="ID" class="form-control" required=""
                    value="<?php echo ($edit) ? $setting_data['social_key'] : ''; ?>" autocomplete="off"
                >
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label for="social_secret">App Secret / Client Secret</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                </div>

                <input type="text" name="social_secret" placeholder="Secret" value="<?php echo ($edit) ? $setting_data['social_secret'] : ''; ?>" class="form-control" required=""
                    autocomplete="off">
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <label for="user-type">Provider type</label>

        <div class="form-group">
            <div class="radio">
                <label class="radio">
                    <?php //echo $setting_data['provider']?>
                    <input type="radio" name="provider" value="Facebook" required=""
                        <?php echo ($edit && $setting_data['provider'] =='Facebook') ? "checked": "" ; ?> /> Facebook</label>
            </div>

            <div class="radio">
                <label class="radio">
                    <input type="radio" name="provider" value="Google" required=""
                        <?php echo ($edit && $setting_data['provider'] =='Google') ? "checked": "" ; ?> />
                    Google</label>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <label for="user-type">Published</label>

        <div class="form-group">
            <div class="radio">
                <label class="radio">
                    <?php //echo $setting_data['provider']?>
                    <input type="radio" name="published" value="1" required=""
                        <?php echo ($edit && $setting_data['published'] =='1') ? "checked": "" ; ?> /> Yes</label>
            </div>

            <div class="radio">
                <label class="radio">
                    <input type="radio" name="published" value="0" required=""
                        <?php echo ($edit && $setting_data['published'] =='0') ? "checked": "" ; ?> />
                    No</label>
            </div>
        </div>
    </div>
</div>