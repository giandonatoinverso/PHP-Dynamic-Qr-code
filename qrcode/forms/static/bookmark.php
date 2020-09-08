<form class="form" action="./add_static.php?type=bookmark" method="post" id="static_form" enctype="multipart/form-data">
    <?php include BASE_PATH.'/forms/qrcode_options.php'; ?>
<!-- Input forms -->
<div class="col-sm-12 mb-2">
    <div class="row">
        <div class="col-6 col-md-3">
            <div class="form-group">
                <label>URL *</label>
                <input type="text" name="url" value="" placeholder="" class="form-control">
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="form-group">
                <label>Title </label>
                <input type="text" name="title" value="" placeholder="" class="form-control">
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