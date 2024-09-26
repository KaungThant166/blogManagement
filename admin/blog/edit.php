<?php

$updateId = $_GET['blog_id'];

$Statament = $db->prepare("SELECT * FROM blogs WHERE id = $updateId");
$Statament->execute();
$Blog = $Statament->fetchObject();

//get category

$categoryStmt = $db->prepare("SELECT * FROM categories");
$categoryStmt->execute();
$categories = $categoryStmt->fetchAll(PDO::FETCH_OBJ);


$categoryError = "";
$titleError = "";
$imageError = "";
$contentError = "";
// print_r($result->title);

if(isset($_POST['blogUpdate-btn'])){

$categortId = $_POST['category-id'];
 $title = $_POST['title'];
 $content = $_POST['content'];
 $userId = $_SESSION['user']->id;
 $created_at = date('Y-m-d H:I:s');

 $image = $_FILES['image'];
 $imageName = $_FILES['image']['name'];
 $imageTumpName = $_FILES['image']['tmp_name'];
 $imageType = $_FILES['image']['type'];

  
 if(!empty($title) && !empty($content) &&!empty($categortId)){

    if(empty($imageName)){
       $imgStmt = $db->prepare(" UPDATE blogs SET title='$title',content='$content',category_id=$categortId WHERE id=$updateId");
    }else{
       
        // delete image link
        unlink("../assets/blog-image/$Blog->image");
        // update image
        if(in_array($imageType, ['image/png','image/jpg','image/jpeg'])){
            move_uploaded_file($imageTumpName, "../assets/blog-image/$imageName");
        };
        $imgStmt = $db->prepare(" UPDATE blogs SET title='$title',content='$content',image='$imageName' WHERE id=$updateId");
       
      
    };

     $result = $imgStmt->execute();
    if($result){
        echo " <script>sweetAlert('updated a Blog', 'blogs')</script>";
    };
}else{
    $nameError = "The name field is required";
    $emailError = "Email required";
    $roleError = "role required";
    $passError = "passowrd required";
    $categoryerror = "category required";
}
}
// echo "<pre>";
// print_r($image);
// echo "</pre>";
?>
<div class="container-fluid">


        <!-- Content Row -->
     
        <!-- Content Row -->
    <div class="row">
   <div class="col-md-12">
   <div class="card shadow mb-4 ">
   <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Blog Creation Form</h6>
                <a href="index.php?page=blogs" class="btn btn-primary btn-sm "> <i class="fas fa-angle-double-left"></i> Back</a>
            </div>
            <div class="card-body">
                <form  method="POST" enctype="multipart/form-data">
                    <div class="mb-2">
                        <label for="">Title</label>
                        <input type="text" class="form-control <?if($titleError !=""):?>is-invalid<?endif;?>" name="title" value="<? echo $Blog->title;?>">
                        <span class="text-danger"><?echo $titleError;?></span>
                    </div>
                    <div class="mb-2">
                        <label for="">Category</label>
                       <select name="category-id" id="" class="form-control">
                        <option value="">Select category</option>
                        <?foreach($categories as $category):?>
                        <option value="<?=$category->id?>"
                        <?php
                            if ($category->id == $Blog->category_id){
                                echo "selected";
                            };?>
                        
                        >
                        
                        <?= $category->name?></option>
                        <?php endforeach;?>
                       </select>
                       <span class="text-danger"><?php echo $categoryError;?></span>
                    </div>
                    <div class="mb-2">
                        <label for="">Content</label>
                            <textarea name="content" class="form-control <?php if($$contentError !=""):?>is-invalid<?php endif;?>" cols="30" rows="10"><?php  echo $Blog->content;?></textarea>
                        <span class="text-danger"><?echo $contentError;?></span>
                    </div>
                    <div class="mb-2">
                        <label for="">Image</label>
                        <input type="file" class="form-control <?php if($imageError !=""):?>is-invalid<?php endif;?>" name="image">
                        <img src="../assets/blog-image/<?php htmlspecialchars($Blog->image) ?>" alt="" style="width: 120px;" class="m-2">
                        <span class="text-danger"><?echo $imageError;?></span>
                    </div>
                    <button class="btn btn-primary" name="blogUpdate-btn">Submit</button>
                </form>
            </div>
        </div>
    </div>
   </div>
       
</div>
