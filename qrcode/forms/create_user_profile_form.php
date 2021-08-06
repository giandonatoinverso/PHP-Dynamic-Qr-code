<?php
    $filed_value = ['first_name'=>'','last_name'=>'','mobile_no'=>'','facebook'=>'','twitter'=>'','instagram'=>'','email'=>''];
    foreach ($profile_data as $key => $value) {
        $filed_value[$key] = $value;
    }
    foreach ($filed_value as $key => $value) {
        if (!strlen($value) && key_exists($key, $_SESSION)) {
            $filed_value[$key] = $_SESSION[$key];
        }
    }
    $file_path = '';
    
?>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <label for="username">Nombre de usuario</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                </div>

                <input type="text" name="user_name" placeholder="Nombre de usuario" class="form-control" required=""
                    value="" autocomplete="off"
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
                    value="<?php echo $filed_value['email'] ?>" autocomplete="off">
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
</div>

<div class="row">
    <div class="col-md-12">
        <h3>Mi Perfil</h3>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="username">Nombre</label>
            <input type="text" name="first_name" placeholder="Nombre" class="form-control" required="" value="<?php echo $filed_value['first_name'] ?>" autocomplete="off">
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label for="username">Apellido</label>
            <input type="text" name="last_name" placeholder="Apellido" class="form-control" required="" value="<?php echo $filed_value['last_name'] ?>" autocomplete="off">
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label for="username">Teléfono</label>
            <input type="text" name="mobile_no" placeholder="Teléfono" class="form-control" required="" value="<?php echo $filed_value['mobile_no'] ?>" autocomplete="off">
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label for="username">Facebook</label>
            <input type="text" name="facebook" placeholder="Facebook profile link" class="form-control" value="<?php echo $filed_value['facebook'] ?>" autocomplete="off">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="username">Twitter</label>
            <input type="text" name="twitter" placeholder="Twitter profile link" class="form-control" value="<?php echo $filed_value['twitter'] ?>" autocomplete="off">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="username">Instagram</label>
            <input type="text" name="Instagram" placeholder="Instagram profile link" class="form-control" value="<?php echo $filed_value['instagram'] ?>" autocomplete="off">
        </div>
    </div>
    <div class="col-sm-2">
        <div class="form-group">
            <input type="file" name="profile_pic" class="dropify" data-default-file="<?php echo $file_path ?>" data-height="300" data-width="250" data-allowed-file-extensions="jpg png gif" />
        </div>
    </div>

</div>
