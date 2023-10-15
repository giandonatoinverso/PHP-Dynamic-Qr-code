<?php
if(isset($_SESSION['success']))
{

echo '
<section class="content">
  <div class="container-fluid">
    <div class="row">
          <div class="col-12">
              <div class="card-body p-0">
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <i class="icon fas fa-check"></i><strong>Success! </strong>'. $_SESSION['success'].'
  	            </div>
  	           </div>
  	        </div>
  	  </div>
  </div>
</section>';
  unset($_SESSION['success']);
}

if(isset($_SESSION['failure']))
{
echo '
<section class="content">
  <div class="container-fluid">
    <div class="row">
          <div class="col-12">
              <div class="card-body p-0">
                <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <i class="fas fa-times"></i> <strong>Oops! </strong>'. $_SESSION['failure'].'
  	            </div>
  	           </div>
  	        </div>
  	  </div>
  </div>
</section>';
  unset($_SESSION['failure']);
}

if(isset($_SESSION['info']))
{
echo '          
<section class="content">
  <div class="container-fluid">
    <div class="row">
          <div class="col-12">
              <div class="card-body p-0">
                <div class="alert alert-info alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <i class="fas fa-info-circle"></i> '. $_SESSION['info'].'
  	            </div>
  	           </div>
  	        </div>
  	  </div>
  </div>
</section>';
  unset($_SESSION['info']);
}

 ?>