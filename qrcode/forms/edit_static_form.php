<fieldset>

    <div class="col-sm-4">
        <div class="form-group">
            <label for="filename">Nombre *</label>
            <p>Puedes cambiar el nombre y url a la que dirige, pero no cambiará la imágen del QR</p>
            <input type="text" name="filename" value="<?php echo htmlspecialchars($edit ? $static_qrcode['filename'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Nombre" class="form-control" required="required" id = "filename">
        </div> 
    </div>
    
</fieldset>