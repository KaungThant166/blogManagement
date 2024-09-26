<?
  $statement = $db->prepare(("SELECT * FROM users"));
  $statement->execute();
  $Users = $statement->fetchAll(PDO::FETCH_OBJ);

//   print_r($Users);
if(isset($_POST['delete-btn'])){
    echo $userId = $_POST['user_id'];
      $deleteStament = $db->prepare("DELETE FROM users WHERE id=$userId  ");
     $deleteResult =  $deleteStament->execute();
   if($deleteResult){
    echo " <script>sweetAlert('deleted a user', 'users')</script>";
   }


}

?>

<div class="container-fluid">


     <!-- content row -->
     <div class="row">
     <div class="card shadow mb-4 col-md-12">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">User List</h6>
                <a href="index.php?page=users-create" class="btn btn-primary btn-sm "><i class="fa fa-plus" aria-hidden="true"></i>Add New</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                    <?
                    foreach($Users as $index => $user):
                        $no = $index +1;
                    ?>
                            <tr>
                                <td><?echo $no; ?></td>
                                <td><?echo $user->name; ?></td>
                                <td><?echo $user->email; ?></td>
                                <td><?echo $user->role; ?></td>
                                <td>
                                <form action="" method="POST">
                                    <a href="index.php?page=users-edit&user_id=<?
                                    echo $user->id;
                                    ?>" class="btn btn-primary">Edit</a>
                                    <input type="hidden" value="<? echo $user->id?>" name="user_id">
                                    <button class="btn btn-danger" name="delete-btn" onclick="return confirm('Are you sure to delete')">Delete</button>
                                </form>
                                </td>
                            </tr>

                    <? endforeach; ?>
                        </tbody>


                    </table>
                </div>
            </div>
        </div>
      </div>

       
</div>