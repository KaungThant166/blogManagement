<?

if(isset($_POST['signUpBtn'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $pass = $_POST['password'];
 
  if(!empty($name) && !empty($email) && !empty($pass)){
      $pass = md5($pass);
      $createStatement = $db->prepare("INSERT INTO users(name,email,role,password) VALUES ('$name', '$email','user','$pass')");
      $result = $createStatement->execute();

      if($result){
        echo "<script>sweetAlert('Sign Up','index.php')</script>";
       };
    
  }
  
  }



//user sign in
if(isset($_POST['signIn_btn'])){
  $email = $_POST['email'];
  $password = md5($_POST['password']);

  $statement = $db->prepare("SELECT * FROM users WHERE email='$email' AND password='$password'");
    $statement->execute();
    $user =  $statement->fetchObject();

      if($user){
        $_SESSION['user'] = $user;
          if($user->role === 'admin'){
            echo "<script>sweetAlert('Sign Up','admin/index.php')</script>";
          }else{
            echo "<script>sweetAlert('Sign Up','index.php')</script>";
          };
        
      }else{
       ?>
      <script>
        Swal.fire({
          icon: "error",
          title: "sorry",
          text: "Sign in fail ",
          confirmButtonText: 'OK'
    
        }).then(()=>
        {location.href='index.php'}
        )
      </script>
       <?
      }
}


?>





<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" id="footer-wave"><path fill="#6366f1" fill-opacity="1" d="M0,32L48,37.3C96,43,192,53,288,90.7C384,128,480,192,576,192C672,192,768,128,864,117.3C960,107,1056,149,1152,149.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>


<footer id="footer" class="d-flex justify-content-center align-items-center">
        <div class="container" >
            <div>&copy; 2023 Hornbill Technology, Inc. All rights reserved.</div>
        </div>
    </footer>

    <!-- sign up  -->
    <div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="signUp" aria-labelledby="signUpLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="signUpLabel">Sign Up</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <div class="">
            <form action="" method="POST">
                <div class="mb-2">
                    <input type="text" name="name"  class="form-control" placeholder="name" required>
                </div>
                <div class="mb-2">
                    <input type="email" name="email" class="form-control" placeholder="email" required>
                </div>
                <div class="mb-2">
                    <input type="password" name="password" class="form-control" placeholder="password" required>
                </div>
                <button class="btn" name="signUpBtn" type="submit">Sign Up</button>
            </form>
         
          </div>
        </div>
    </div>

    <!-- sign in  -->
    <div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="signIn" aria-labelledby="signInLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="signInLabel">Sign In</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <div class="">
            <form action="" method="POST">
                <div class="mb-2">
                    <input type="text" class="form-control" placeholder="email" name="email" required>
                </div>
                <div class="mb-2">
                    <input type="password" class="form-control" placeholder="password" name="password" required>
                </div>
                <button class="btn" name="signIn_btn" >Sign In</button>
            </form>
            <a href="#signUp" data-bs-toggle="offcanvas" aria-controls="staticBackdrop" class="d-block mt-2">You don't have any account?Sign up here</a>
          </div>
        </div>
    </div>
    
    <!-- bootstrap cdn  -->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
   
    ></script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
     
    ></script>
    <!-- aos  -->
    <script src="assets/aos/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>