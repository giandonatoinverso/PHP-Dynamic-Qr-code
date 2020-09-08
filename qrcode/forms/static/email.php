<form class="form" action="./add_static.php?type=email" method="post" id="static_form" enctype="multipart/form-data">
    <?php include BASE_PATH.'/forms/qrcode_options.php'; ?>
<!-- Input forms -->
<div class="col-sm-12 mb-2">
    <div class="row">

    <div class="col-6 col-md-3">
        <div class="form-group">
            <label>Send to *</label>
            <input type="email" name="email" value="" placeholder="E-mail" class="form-control">
        </div>
    </div>
    
    <div class="col-6 col-md-3">
        <div class="form-group">
            <label>Subject </label>
            <input type="text" name="subject" value="" placeholder="" class="form-control">
        </div>
    </div>
    </div>
</div>

<div class="col-sm-6">
        <div class="form-group">
            <label>Message *</label>
            <textarea class="form-control" name="message" value="" rows="5" placeholder=""></textarea>
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