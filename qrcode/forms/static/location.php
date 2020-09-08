<form class="form" action="./add_static.php?type=location" method="post" id="static_form" enctype="multipart/form-data">
    <?php include BASE_PATH.'/forms/qrcode_options.php'; ?>
<!-- Input forms -->
    <div class="col-sm-4">
        <div class="form-group">
            <label>Latitude *</label>
            <input type="text" name="latitude" value="" placeholder="40.7127753" class="form-control">
        </div>
    </div>
    
    <div class="col-sm-4">
        <div class="form-group">
            <label>Longitude *</label>
            <input type="text" name="longitude" value="" placeholder="-74.0059728" class="form-control">
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