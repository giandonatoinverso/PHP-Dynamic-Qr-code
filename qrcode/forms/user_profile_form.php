<?php
    $filed_value = ['first_name'=>'','last_name'=>'','mobile_no'=>'','facebook'=>'','twitter'=>'','instagram'=>''];
    foreach ($profile_data as $key => $value) {
        $filed_value[$key] = $value;
    }
    $file_path = '';
    if (strlen($profile_data->profile_pic)) {
        $file_path = 'upload/images/'.$profile_data->profile_pic;
    }
?>
<div class="row">
    
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
