<?php
$nameError = "";
$emailError = "";
$roleError = "";
$passError = "";

if(isset($_POST['userCreate-btn'])){
$name = $_POST['name'];
$email = $_POST['email'];
$pass = $_POST['password'];
$role = $_POST['role'];

if(!empty($name) && !empty($email) && !empty($role) && !empty($pass)){
    $pass = md5($pass);
    $createStatement = $db->prepare("INSERT INTO users(name,email,role,password) VALUES ('$name', '$email','$role','$pass')");
    $result = $createStatement->execute();

   if($result){
    echo "<script>sweetAlert('created a useraccount', 'users')</script>";
   }
  
}else{
    $nameError = "name required";
    $emailError = "Email required";
    $roleError = "role required";
    $passError = "passowrd required";
}

}


?>





<div class="container-fluid">


        <!-- Content Row -->
     
        <!-- Content Row -->
    <div class="row">
   <div class="col-md-12">
   <div class="card shadow mb-4 ">
   <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">User Creation Form</h6>
                <a href="index.php?page=users" class="btn btn-primary btn-sm "> <i class="fas fa-angle-double-left"></i> Back  </a>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-2">
                        <label for="">Name</label>
                        <input type="text" class="form-control <?php if($nameError !=""): ?>is-invalid<?php endif; ?>" name="name">
                        <span class="text-danger"><?php echo $nameError; ?></span>
                    </div>
                    <div class="mb-2">
                        <label for="">Email</label>
                        <input type="text" class="form-control <?php if($emailError !=""): ?>is-invalid<?php endif; ?>" name="email">
                        <span class="text-danger"><?php echo $emailError; ?></span>
                    </div>
                    <div class="mb-2">
                        <label for="">Role</label>
                        <select name="role" id="" class="form-control">
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                        <span class="text-danger"><?php echo $roleError; ?></span>
                    </div>
                    <div class="mb-2">
                        <label for="">Password</label>
                        <input type="text" class="form-control <?php if($passError !=""): ?>is-invalid<?php endif; ?>" name="password">
                        <span class="text-danger"><?php echo $passError; ?></span>
                    </div>
                    <button class="btn btn-primary" name="userCreate-btn">Submit</button>
                </form>
            </div>
        </div>
    </div>
   </div>
       
</div>
    