<div class="content-header" style="margin-left: -18px">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<form  action="">
					<div class="col-sm-12 mb-2" style="margin-left: 10px">
						<div class="row">
						    
						    <!-- SEARCH -->
							<div class="col-5 col-md-2">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Search" id="input_search" name="search_str" value="<?php echo htmlspecialchars($search_str??'', ENT_QUOTES, 'UTF-8'); ?>">
									<div class="input-group-append">
										<span class="input-group-text">
											<i class="fas fa-search"></i>
										</span>
									</div>
								</div>
							</div>
							
							<!-- ORDER BY -->
							<div class="col-5 col-md-1">
								<select name="order_by" class="form-control">
                <?php
foreach ($options as $opt_value => $opt_name):
	($order_by === $opt_value) ? $selected = 'selected' : $selected = '';
	echo ' <option value="' . $opt_value . '" ' . $selected . '>' . $opt_name . '</option>';
endforeach;
?>
                                </select>
							</div>
							
							<!-- ASCENDING ORDER -->
							<div class="col-5 col-md-1">
								<select name="order_dir" class="form-control" id="input_order">
                <option value="Asc" <?php
if ($order_dir == 'Asc') {
	echo 'selected';
}
?> >Asc</option>
                <option value="Desc" <?php
if ($order_dir == 'Desc') {
	echo 'selected';
}
?>>Desc</option>
                                </select>
							</div>
							
							<!-- SUBMIT -->
							<div class="col-5 col-md-3">
								<input type="submit" value="Go" class="btn btn-primary">
							</div>
							
						</div><!-- /.row -->
					</div><!-- /.col-sm-12 -->
				</form>
			</div><!-- /.col-12 -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div><!-- /.content header -->
		<hr>
