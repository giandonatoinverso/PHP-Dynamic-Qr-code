<form class="form" action="./add_static.php?type=bitcoin" method="post" id="static_form" enctype="multipart/form-data">
    <?php include BASE_PATH.'/forms/qrcode_options.php'; ?>
 <!-- Input forms -->   
<div class="col-sm-12 mb-2">
    <div class="row">

    <div class="col-6 col-md-3">
        <div class="form-group">
            <label>BTC address *</label>
            <input type="text" name="address" value="" placeholder="" class="form-control">
        </div>
    </div>
    
    <div class="col-6 col-md-3">
            <div class="form-group">
                <label>Amount *</label>
                <div class="input-group">
                    <input type="number" name="amount" value="" placeholder="" class="form-control" step="0.0001">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fab fa-bitcoin"></i></span>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

<div class="col-sm-12 mb-2">
    <div class="row">

    <div class="col-6 col-md-3">
        <div class="form-group">
            <label>Label</label>
            <input type="text" name="label" value="" placeholder="Item name" class="form-control">
        </div>
    </div>
    
    <div class="col-6 col-md-3">
        <div class="form-group">
            <label>Message</label>
            <input type="text" name="message" value="" placeholder="" class="form-control">
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