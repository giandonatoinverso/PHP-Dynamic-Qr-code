<div class="modal modal-backdrop download-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Download QRCode(s)
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/bulk-action.php" id="download-form">
                    <div class="form-group">
                        <label>Select File type:</label>
                        <select name="file_type">
                            <option value="default" selected>
                                Original Format(s) (default)
                            </option>
                            <option value="png">PNG</option>
                            <option value="gif">GIF</option>
                            <option value="jpeg">JPEG</option>
                            <option value="jpg">JPG</option>
                            <option value="svg">SVG</option>
                            <option value="eps">EPS</option>
                        </select>
                        <input type="hidden" name="type" value="<?=$type?>">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>
                <button type="submit" for="#download-form" class="btn btn-primary">
                    Download
                </button>
            </div>
        </div>
    </div>
</div>