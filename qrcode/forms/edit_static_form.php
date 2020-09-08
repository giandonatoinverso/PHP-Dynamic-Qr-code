<fieldset>

    <div class="col-sm-4">
        <div class="form-group">
            <label for="filename">Filename *</label>
            <p>N.B. You can change the name of the file visible in the table, however a new qr code will NOT be generated</p>
            <input type="text" name="filename" value="<?php echo htmlspecialchars($edit ? $static_qrcode['filename'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Filename" class="form-control" required="required" id = "filename">
        </div> 
    </div>
    
</fieldset>