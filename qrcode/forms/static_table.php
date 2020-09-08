<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive p-0">
      <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th width="5%">ID</th>
                <th width="12%">Filename</th>
                <th width="7%">Type</th>
                <th width="55%">Content</th>
                <th width="8%">Qr code</th>
                <th width="23%">Operations</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['filename']); ?></td>
                <td><?php echo htmlspecialchars($row['type']); ?></td>
                <td><?php echo $row['content']; ?></td>
                <td>
                    <?php echo '<img src="'.PATH.htmlspecialchars($row['qrcode']).'" width="100" height="100">'; ?>
                </td>
                <td>
                    
                    <!-- EDIT -->
                    <a href="edit_static.php?filename=<?php echo $row['filename']; ?>&static_id=<?php echo $row['id']; ?>&operation=edit" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                    
                    <!-- DELETE -->
                    <a href="#" class="btn btn-danger delete_btn" data-toggle="modal" data-target="#confirm-delete-<?php echo $row['id']; ?>"><i class="fas fa-trash"></i></a>
                    
                    <!-- DOWNLOAD -->
                    <a href="<?php echo PATH.htmlspecialchars($row['qrcode']); ?>" class="btn btn-primary" download><i class="fa fa-download"></i></a>
                </td>
            </tr>
            <!-- Delete Confirmation Modal -->
            <div class="modal fade" id="confirm-delete-<?php echo $row['id']; ?>" role="dialog">
                <div class="modal-dialog">
                    <form action="delete_static.php" method="POST">
                        <!-- Modal content -->
                
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Confirm</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="del_id" id="del_id" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="filename" id="filename" value="<?php echo $row['filename']; ?>">
                                <p>Are you sure you want to delete this row? Proceeding with the cancellation the image will be deleted from the server and you will have to re-create the qr code with the desired content</p>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.Delete Confirmation Modal -->
            <?php endforeach; ?>
        </tbody>
    </table>
   </div><!-- /.Card body -->
   
   <div class="card-footer clearfix">
       <?php echo paginationLinks($page, $total_pages, 'static_qrcodes.php'); ?>
       </div><!-- /.Card footer -->
       
        </div><!-- /.Card -->
    </div><!-- /.col -->
</div><!-- /.row -->