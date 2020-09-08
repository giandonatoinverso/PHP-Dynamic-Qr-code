<form class="form" action="./add_static.php?type=vcard" method="post" id="static_form" enctype="multipart/form-data">
    <?php include BASE_PATH.'/forms/qrcode_options.php'; ?>
<!-- Input forms -->
<!-- First row -->
<div class="col-sm-12 mb-2">
    <div class="row">

    <div class="col-6 col-md-3">
        <div class="form-group">
            <label>Full name *</label>
            <input type="text" name="full_name" value="" placeholder="" class="form-control">
        </div>
    </div>
    
    <div class="col-6 col-md-3">
        <div class="form-group">
            <label>Nickname</label>
            <input type="text" name="nickname" value="" placeholder="" class="form-control">
        </div>
    </div>
    
    <div class="col-6 col-md-3">
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="" placeholder="" class="form-control">
        </div>
    </div>
    
    <div class="col-6 col-md-3">
        <div class="form-group">
            <label>Website</label>
            <input type="url" name="website" value="" placeholder="https://google.it" class="form-control">
        </div>
    </div>
    
    </div>
</div>

<!-- Second row -->
<div class="col-sm-12 mb-2">
    <div class="row">

    <div class="col-6 col-md-3">
        <div class="form-group">
            <label>Phone *</label>
            <input type="text" name="phone" value="" placeholder="" class="form-control">
        </div>
    </div>
    
    <div class="col-6 col-md-3">
        <div class="form-group">
            <label>Home Phone</label>
            <input type="text" name="home_phone" value="" placeholder="" class="form-control">
        </div>
    </div>
    
    <div class="col-6 col-md-3">
        <div class="form-group">
            <label>Work phone</label>
            <input type="text" name="work_phone" value="" placeholder="" class="form-control">
        </div>
    </div>
    
    <div class="col-6 col-md-3">
        <div class="form-group">
            <label>Company</label>
            <input type="text" name="company" value="" placeholder="" class="form-control">
        </div>
    </div>
    
    </div>
</div>

<!-- Third row -->
<div class="col-sm-12 mb-2">
    <div class="row">

    <div class="col-6 col-md-3">
        <div class="form-group">
            <label>Role</label>
            <input type="text" name="role" value="" placeholder="CEO, CFO, COO" class="form-control">
        </div>
    </div>
    
    <div class="col-6 col-md-3">
        <div class="form-group">
            <label>Categories</label>
            <input type="text" name="categories" value="" placeholder="A list of tags" class="form-control">
        </div>
    </div>
    
    <div class="col-6 col-md-3">
        <div class="form-group">
            <label>Note</label>
            <input type="text" name="note" value="" placeholder="" class="form-control">
        </div>
    </div>
    
    <div class="col-6 col-md-3">
        <div class="form-group">
            <label>Photo</label>
            <input type="url" name="photo" value="" placeholder="Enter the url of the photo" class="form-control">
        </div>
    </div>
    
    </div>
</div>

<!-- Fourth row -->
<div class="col-sm-12 mb-2">
    <div class="row">

    <div class="col-6 col-md-3">
        <div class="form-group">
            <label>Address</label>
            <input type="text" name="address" value="" placeholder="" class="form-control">
        </div>
    </div>
    
    <div class="col-6 col-md-3">
        <div class="form-group">
            <label>City</label>
            <input type="text" name="city" value="" placeholder="" class="form-control">
        </div>
    </div>
    
    <div class="col-6 col-md-3">
        <div class="form-group">
            <label>Post Code</label>
            <input type="text" name="post_code" value="" placeholder="" class="form-control">
        </div>
    </div>
    
    <div class="col-6 col-md-3">
        <div class="form-group">
            <label>State</label>
            <input type="text" name="state" value="" placeholder="" class="form-control">
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