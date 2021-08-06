<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive p-0">
      <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th width="10%">Foto de perfil</th>
                <th width="40%">Nombre</th>
                <th width="40%">Email</th>
                <th width="10%">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row):
                    $img = 'upload/images/dummy-profile-pic.png';
                    $path_info = pathinfo($row['profile_pic']);
                    $path = 'upload/images/'.$row['profile_pic'];
                    if (file_exists($path) && key_exists('extension', $path_info)) {
                        $img = $path;
                    }
                ?>
            <tr>
                <td>
                    <img src="<?=$img?>" alt="<?=$row['user_name']?>" width="100px" />
                </td>
                <td><?php echo htmlspecialchars($row['first_name'].' '.$row['last_name']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td>
                    <!-- EDIT -->
                    <a href="user_profile.php?user=<?php echo $row['user_name']; ?>" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
   </div><!-- /.Card body -->
   
   <div class="card-footer clearfix">
       <?php echo paginationLinks($page, $total_pages, 'admin_users.php'); ?>
       </div><!-- /.Card footer -->
       
        </div><!-- /.Card -->
    </div><!-- /.col -->
</div><!-- /.row -->