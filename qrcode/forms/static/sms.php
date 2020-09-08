<form class="form" action="./add_static.php?type=sms" method="post" id="static_form" enctype="multipart/form-data">
    <?php include BASE_PATH.'/forms/qrcode_options.php'; ?>
<!-- Input forms -->
<div class="col-sm-12 mb-2">
    <div class="row">

    <div class="col-6 col-md-3">
        <div class="form-group">
            <label>Country Code *</label>
            <select name="country_code" class="form-control">
            <?php include BASE_PATH . '/forms/static/country-code.html'; ?> 
            </select>
        </div>
    </div>
    
    <div class="col-6 col-md-3">
        <div class="form-group">
            <label>Phone number * </label>
            <input type="text" name="phone_number" value="" placeholder="" class="form-control">
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