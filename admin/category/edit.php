<?

// get old category
$categoryID =  $_GET['category_id'];

  $Statament = $db->prepare("SELECT * FROM categories WHERE id = $categoryID");
  $Statament->execute();
  $result = $Statament->fetchObject();
  $nameError="";

  // update category
  if(isset($_POST['categoryUpdate-btn'])){
   $name = $_POST['name'];

   
  if(empty($name)){
  $nameError = "The name field is required";
   }
   
 else{
  $updateStatement = $db->prepare("UPDATE categories SET name ='$name'  WHERE id=$categoryID");
       $updateStatement->execute();
  echo " <script>sweetAlert('updated a category', 'categories')</script>";
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
                <h6 class="m-0 font-weight-bold text-primary">Category Edit Form</h6>
                <a href="index.php?page=categories" class="btn btn-primary btn-sm "> << Back  </a>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-2">
                        <label for="">Name</label>
                        <input type="text" class="form-control <?if($nameError !=""):?>is-invalid<?endif;?>" name="name" value="<?
                        echo $result->name
                        ?>">
                        <span class="text-danger"><?echo $nameError;?></span>
                    </div>
                  
                    <button class="btn btn-primary" name="categoryUpdate-btn">Update</button>
                </form>
            </div>
        </div>
    </div>
   </div>
       
</div>
    
    