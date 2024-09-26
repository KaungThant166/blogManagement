



<?

// create category 
 $nameError="";
   if(isset($_POST['categoryCreate-btn'])){
    $name =  $_POST['name'];
    

    if(!empty($name)){
        $createStatement = $db->prepare("INSERT INTO categories(name) VALUES ('$name')");
        $createStatement->execute();
        echo "<script>sweetAlert('created a category', 'categories')</script>";
    }else{
        $nameError = "name required";
    }


    };

?>





<div class="container-fluid">


        <!-- Content Row -->
     
        <!-- Content Row -->
    <div class="row">
   <div class="col-md-12">
   <div class="card shadow mb-4 ">
   <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Category Creation Form</h6>
                <a href="index.php?page=categories" class="btn btn-primary btn-sm "> <i class="fas fa-angle-double-left"></i> Back  </a>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-2">
                        <label for="">Name</label>
                        <input type="text" class="form-control <?if($nameError !=""):?>is-invalid<?endif;?>" name="name">
                        <span class="text-danger"><?echo $nameError;?></span>
                    </div>
                  
                    <button class="btn btn-primary" name="categoryCreate-btn">Submit</button>
                </form>
            </div>
        </div>
    </div>
   </div>
       
</div>
    