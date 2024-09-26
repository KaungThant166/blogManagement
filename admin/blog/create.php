<?
//get category

$categoryStmt = $db->prepare("SELECT * FROM categories");
$categoryStmt->execute();
$categories = $categoryStmt->fetchAll(PDO::FETCH_OBJ);
// print_r($categories);





$titleError = "";
$imageError = "";
$contentError = "";
$categoryError = "";

//create blog
if(isset($_POST['blogCreate-btn'])){

    $title = $_POST['title'];
    $content = $_POST['content'];
    $userId = $_SESSION['user']->id;
    $created_at = date('Y-m-d H:I:s');
    $categoryId = $_POST['category-id'];
      
    echo $categoryId;
    $image = $_FILES['image'];
    $imageName = $_FILES['image']['name'];
    $imageTumpName = $_FILES['image']['tmp_name'];
    $imageType = $_FILES['image']['type'];

    if(!empty($title) && !empty($imageName) && !empty($content) && !empty($categoryId)){

        $imageName = uniqid(). '_' .$imageName;
        if(in_array($imageType, ['image/png','image/jpg','image/jpeg'])){
            move_uploaded_file($imageTumpName, "../assets/blog-image/$imageName");
        };
    
        $blogCreateState = $db->prepare("INSERT INTO blogs(title,content,image,user_id,created_at,category_id) VALUES ('$title','$content','$imageName',$userId,'$created_at',$categoryId)");
        $result = $blogCreateState->execute();
   
        if($result){
           echo " <script>sweetAlert('created a Blog', 'blogs')</script>";
        }

      
  
    }else{
        $titleError = "The title field is required";
        $imageError = "The image field is required";
        $contentError = "The content field is required";
        $categoryError = "The category field is required";
    };
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
                <a href="index.php?page=blogs" class="btn btn-primary btn-sm "> <i class="fas fa-angle-double-left"></i> Back  </a>
            </div>
            <div class="card-body">
                <form  method="POST" enctype="multipart/form-data">
                    <div class="mb-2">
                        <label for="">Title</label>
                        <input type="text" class="form-control <?if($titleError !=""):?>is-invalid<?endif;?>" name="title">
                        <span class="text-danger"><?echo $titleError;?></span>
                    </div>
                    <div class="mb-2">
                        <label for="">Category</label>
                       <select name="category-id" id="" class="form-control">
                        <option value="">Select category</option>
                        <?foreach($categories as $category):?>
                        <option value="<?= $category->id?>"><?= $category->name?></option>
                        <?endforeach;?>
                       </select>
                       <span class="text-danger"><?echo $categoryError;?></span>
                    </div>
                    <div class="mb-2">
                        <label for="">Content</label>
                            <textarea name="content" class="form-control <?if($$contentError !=""):?>is-invalid<?endif;?>" cols="30" rows="10"></textarea>
                        <span class="text-danger"><?echo $contentError;?></span>
                    </div>
                    <div class="mb-2">
                        <label for="">Image</label>
                        <input type="file" class="form-control <?if($imageError !=""):?>is-invalid<?endif;?>" name="image">
                        <span class="text-danger"><?echo $imageError;?></span>
                    </div>
                    <button class="btn btn-primary" name="blogCreate-btn">Submit</button>
                </form>
            </div>
        </div>
    </div>
   </div>
       
</div>
