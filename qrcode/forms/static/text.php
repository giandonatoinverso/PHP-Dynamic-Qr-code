<form class="form" action="./add_static.php?type=text" method="post" id="static_form" enctype="multipart/form-data">
    <?php include BASE_PATH.'/forms/qrcode_options.php'; ?>
<!-- Input forms -->
    <div class="col-sm-6">
        <div class="form-group">
            <label>Text *</label>
            <textarea class="form-control" name="text" value="" rows="5" placeholder=""></textarea>
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