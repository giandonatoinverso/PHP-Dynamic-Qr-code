<form class="form" action="./add_static.php?type=wifi" method="post" id="static_form" enctype="multipart/form-data">
    <?php include BASE_PATH.'/forms/qrcode_options.php'; ?>
<!-- Input forms -->
<div class="col-sm-12 mb-2">
    <div class="row">

    <div class="col-6 col-md-3">
        <div class="form-group">
            <label>Encryption *</label>
            <select name="encryption" class="form-control">
                <option value="WPA" Selected>WPA/WPA2</option>
                <option value="WEP">WEP</option>
                <option value="">None</option>
            </select>
        </div>
    </div>
    
    <div class="col-6 col-md-3">
        <div class="form-group">
            <label>SSID *</label>
            <input type="text" name="ssid" value="" placeholder="" class="form-control">
        </div>
    </div>
    
    <div class="col-6 col-md-3">
        <div class="form-group">
            <label>Password</label>
            <input type="text" name="password" value="" placeholder="" class="form-control">
        </div>
    </div>
    </div>
</div>

<div class="col-sm-12 mb-2">
    <div class="row">
        <div class="col-6 col-md-3">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>    
    </div>
</div>
                
</form>