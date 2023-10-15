<div class="col-sm-12 mb-2">
        <div class="row">
            <div class="col-6 col-md-3">
                <label for="foreground">Foreground:</label>
                <div class="input-group my-colorpicker2">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-qrcode"></i></span>
                    </div>
                    
                    <input type="text" class="form-control" id="foreground" name="foreground" value="#000000">
                </div>
            </div>
                  
            <div class="col-6 col-md-3">
                <label for="background">Background:</label>
                <div class="input-group my-colorpicker2">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-qrcode"></i></span>
                    </div>
                    
                    <input type="text" class="form-control" id="background" name="background" value="#ffffff">
                </div>
            </div>
                  
            <div class="col-6 col-md-3">
                <label for="level">Precision</label>
                <select name="level" class="form-control">
                    <option value="L">L - Smallest</option>
                    <option value="M">M - Medium</option>
                    <option value="Q">Q - High</option>
                    <option value="H">H - Best</option>
                </select>
            </div>
        
            <div class="col-6 col-md-3">
                <label for="size">Size (px)</label>
                <select name="size" class="form-control">
                    <option value="100">100</option>
                    <option value="200">200</option>
                    <option value="300">300</option>
                    <option value="400">400</option>
                    <option value="500">500</option>
                    <option value="600">600</option>
                    <option value="700">700</option>
                    <option value="800">800</option>
                    <option value="900">900</option>
                    <option value="1000">1000</option>
                </select>
            </div>
        </div>
    </div>
    
    <!-- Its use is not recommended. Read the documentation
    <div class="form-group">
        <label for="logo">Logo</label>
        <?php //include 'logo.php' ?>
    </div>
    -->
    
<div class="col-sm-12 mb-2">
  <div class="row">    
    <div class="col-sm-4">
        <div class="form-group">
            <label for="filename">Filename *</label>
            <input type="text" name="filename" value="" placeholder="My first Qrcode" class="form-control error" required="required" id = "filename">
          
        </div>
    </div>
    
    <div class="col-6 col-md-1">
                <label for="format">Format</label>
                <select name="format" class="form-control">
                    <option value="png">PNG</option>
                    <option value="gif">GIF</option>
                    <option value="jpeg">JPEG</option>
                    <option value="jpg">JPG</option>
                    <option value="svg">SVG</option>
                    <option value="eps">EPS</option>
                </select>
    </div>
  </div>
</div>
    <br>