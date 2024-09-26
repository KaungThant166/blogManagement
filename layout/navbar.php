<?
if(isset($_POST['signOutBtn'])){
  session_destroy();
  header("location:index.php");
}
?>

<nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="index.html" data-aos="fade-right" data-aos-duration="1000">Hornbill Blog</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0" data-aos="fade-left" data-aos-duration="1000">
       <? if(isset($_SESSION['user'])): ?>
        <li class="nav-item">
          <form action="" method="POST">
          <button class="btn nav-link"name="signOutBtn" onclick="confirm('Are you sure to sign out')">Sign out</button>
          </form>
        </li>
        <li class="nav-item">
            <span class="nav-link"><?= $_SESSION['user']->name?></span>
          </li>
        <?else:?>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#signIn" data-bs-toggle="offcanvas" aria-controls="staticBackdrop">Sign In</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#signUp" data-bs-toggle="offcanvas" aria-controls="staticBackdrop">Sign Up</a>
          </li>
        <?endif;?>
        </ul>
      </div>
    </div>
</nav>