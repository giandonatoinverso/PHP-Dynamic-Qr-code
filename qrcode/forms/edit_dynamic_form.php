<fieldset>
    <div class="col-sm-4">
        <div class="form-group">
            <label for="identifier">Redirect identifier</label>
            <input type="text" name="identifier"
                value="<?php echo htmlspecialchars($edit ? $dynamic_qrcode['identifier'] : '', ENT_QUOTES, 'UTF-8'); ?>"
                placeholder="Identifier" class="form-control" id="identifier" readonly>
        </div>
    </div>


    <div class="col-sm-4">
        <div class="form-group">
            <label for="filename">Nombre *</label>
            <p>Puedes cambiar el nombre y url a la que dirige, pero no cambiará la imágen del QR</p>
            <input type="text" name="filename"
                value="<?php echo htmlspecialchars($edit ? $dynamic_qrcode['filename'] : '', ENT_QUOTES, 'UTF-8'); ?>"
                placeholder="Nombre" class="form-control" required="required" id="filename">
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <label for="link">URL *</label>
            <input type="url" pattern="https://.*" name="link"
                value="<?php echo htmlspecialchars($edit ? $dynamic_qrcode['link'] : '', ENT_QUOTES, 'UTF-8'); ?>"
                placeholder="Link" class="form-control" required="required" id="link">
        </div>
    </div>


    <div class="col-sm-4">
        <label for="state">Redirigir a URL *</label>

        <div class="form-group">
            <label class="radio-inline">
                <input type="radio" name="state" value="enable"
                    <?php echo ($edit &&$dynamic_qrcode['state'] =='enable') ? "checked": "" ; ?> required="required"
                    id="enable" /> Activar</label>

            <label class="radio-inline">
                <input type="radio" name="state" value="disable"
                    <?php echo ($edit && $dynamic_qrcode['state'] =='disable')? "checked": "" ; ?> required="required"
                    id="disable" /> Desactivar</label>
        </div>
    </div>
    <div class="col-sm-12 mb-2">
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="is_default" id="is_default" value="1"
                    <?php echo ($edit && $dynamic_qrcode['is_default'] =='1')? "checked": "" ?> />
                Default QR
            </label>
        </div>
    </div>
    <?php include_once(BASE_PATH. '/forms/used_for_field.php') ?>
</fieldset>