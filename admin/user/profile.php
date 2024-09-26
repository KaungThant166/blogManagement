<?php
$userId = $_SESSION['user']->id;
$stmt = $db->prepare("SELECT name,email FROM users WHERE id=$userId ");
$stmt->execute();
$user = $stmt->fetchObject();
print_r($user);

?>

<div class="container-fluid">


     <!-- content row -->
     <div class="row">
     <div class="card shadow mb-4 col-md-12">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">User Profile</h6>
            </div>
            <div class="card-body">
                <div class="mt-3"><strong>Name</strong> :<?= $user->name?></div>
                <div class="mt-3"><strong>Email</strong> :<?= $user->email?></div>
            </div>
        </div>
      </div>

       
</div>