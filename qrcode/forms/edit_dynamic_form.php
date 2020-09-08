<fieldset>
    <div class="col-sm-4">
        <div class="form-group">
            <label for="identifier">Redirect identifier</label>
            <input type="text" name="identifier" value="<?php echo htmlspecialchars($edit ? $dynamic_qrcode['identifier'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Identifier" class="form-control" id="identifier" readonly>
        </div>
    </div>
    

    <div class="col-sm-4">
        <div class="form-group">
            <label for="filename">Filename *</label>
            <p>N.B. You can change the name of the file visible in the table, however a new qr code will NOT be generated</p>
            <input type="text" name="filename" value="<?php echo htmlspecialchars($edit ? $dynamic_qrcode['filename'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Filename" class="form-control" required="required" id = "filename">
        </div> 
    </div>
    
    <div class="col-sm-4">
        <div class="form-group">
            <label for="link">URL *</label>
            <input type="url" pattern="https://.*" name="link" value="<?php echo htmlspecialchars($edit ? $dynamic_qrcode['link'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Link" class="form-control" required="required" id="link">
        </div>
    </div>
    

    <div class="col-sm-4">
        <label for="state">Redirect to url *</label>
        
        <div class="form-group">
            <label class="radio-inline">
            <input type="radio" name="state" value="enable" <?php echo ($edit &&$dynamic_qrcode['state'] =='enable') ? "checked": "" ; ?> required="required" id="enable"/> Enable</label>
            
            <label class="radio-inline">
            <input type="radio" name="state" value="disable" <?php echo ($edit && $dynamic_qrcode['state'] =='disable')? "checked": "" ; ?> required="required" id="disable"/> Disable</label>
        </div>
    </div>
</fieldset>