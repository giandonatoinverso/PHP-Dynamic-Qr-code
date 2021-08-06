 <div class="col-md-4">
     <label for="">Used For</label>
     <div class="row" id="append_filed">
         <?php for ($i=0;$i < $num_used_for;$i++): ?>
         <div class="col-md-12 del-row">
             <div class="row">
                 <div class="col-md-11">
                     <div class="form-group">
                         <input type="text" class="form-control" name="used_for[]"
                             value="<?=($edit && is_array($used_for)?trim($used_for[$i]):'')?>">
                     </div>
                 </div>
                 <div class="col-md-1">
                     <a href="javascript:void(0)" class="remove d-block pt-2">
                         <i class="fas fa-times text-danger"></i>
                     </a>
                 </div>
             </div>
         </div>
         <?php endfor ?>
     </div>
     <a name="add_more" id="add_more" data-template="used_for_template" data-append="append_filed"
         class="btn btn-primary btn-xs" href="javascript:void(0)" role="button">
         <i class="fa fa-plus" aria-hidden="true"></i> Add More
     </a>
 </div>
 <input type="hidden" name="num_fields" id="num_fields" value="<?=$num_used_for?>">