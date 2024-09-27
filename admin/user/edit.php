<?php
$userId =  $_GET['user_id'];

$Statament = $db->prepare("SELECT * FROM users WHERE id = $userId");
$Statament->execute();
$result = $Statament->fetchObject();

// print_r($result);

$nameError = "";
$emailError = "";
$roleError = "";
$passError = "";


if(isset($_POST['userUpdate-btn'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $role = $_POST['role'];
    
   if(!empty($name) && !empty($email) && !empty($role)){

    if(empty($pass)){
        $updateStatement = $db->prepare("UPDATE users SET name = '$name', email = '$email',
        role = '$role' WHERE id=$userId");
    }else{
        $pass = md5($pass);
        $updateStatement = $db->prepare("UPDATE users SET name = '$name', email = '$email',
        role = '$role',password = '$pass' WHERE id=$userId");
    }
   
    $updateStatement->execute();

    echo " <script>sweetAlert('updated a user', 'users')</script>";
    }
     else{
   $nameError = "The name field is required";
   $emailError = "Email required";
   $roleError = "role required";
   $passError = "passowrd required";


 };
 
   };




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
                        <input type="text" class="form-control <?php if($nameError !=""):?>is-invalid<?php endif; ?>" name="name" value="<?php
                        echo $result->name
                        ?>">
                        <span class="text-danger"><?php echo $nameError; ?></span>
                    </div>
                    <div class="mb-2">
                        <label for="">Email</label>
                        <input type="text" class="form-control <?php if($emailError !=""): ?>is-invalid<?php endif; ?>" name="email" value="<?php
                        echo $result->email
                        ?>">
                        <span class="text-danger"><?php echo $emailError; ?></span>
                    </div>
                    <div class="mb-2">
                        <label for="">Role</label>
                        <select name="role" id="" class="form-control">
                            <option value="admin"
                            <?php
                            if($result->role === 'admin'):
                            ?>
                            selected
                            <?php endif; ?>
                            
                            >Admin</option>
                            <option value="user"
                            <?php
                                if($result->role === 'user'):
                                ?>
                                selected
                                <?php endif;?>
                            
                            >User</option>
                        </select>
                        <span class="text-danger"><?php echo $roleError; ?></span>
                    </div>
                    <div class="mb-2">
                        <label for="">Password</label>
                        <input type="checkbox" onclick="clickPass()" id="check">
                        <input type="password" class="form-control <?php if($passError !=""): ?>is-invalid<?php endif; ?>" name="password" style="display: none;" id="passInputBox" placeholder="Enter new password">
                        <span class="text-danger"><?echo $passError;?></span>
                    </div>
                    <button class="btn btn-primary" name="userUpdate-btn">Update</button>
                </form>
            </div>
        </div>
    </div>
   </div>
       
</div>
<script>
let inputTag = document.getElementById("passInputBox");
let checkTag = document.getElementById("check");

let clickPass = () => {
    if(checkTag.checked){
        inputTag.style.display = "block";
    }else{
        inputTag.style.display = "none";
    }
}


</script>
    
