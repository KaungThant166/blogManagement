<?


$selectCategoryStatement = $db->prepare("SELECT * FROM categories");
    $selectCategoryStatement->execute();
 
  $categories =  $selectCategoryStatement->fetchAll(PDO::FETCH_OBJ);

//   delete category
if(isset($_POST['delete-btn'])){
    
  $categoryId = $_POST['category_id'];
  $deleteStament = $db->prepare("DELETE FROM categories WHERE id=$categoryId");
  $deleteStament->execute();
  echo "<script>sweetAlert('deleted a category', 'categories')</script>"; 

}


?>

<div class="container-fluid">


     <!-- content row -->
     <div class="row">
     <div class="card shadow mb-4 col-md-12">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Category List</h6>
                <a href="index.php?page=categories-create" class="btn btn-primary btn-sm "><i class="fas fa-plus-circle"></i>Add New</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Name</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                    <?
                     foreach($categories as $index => $category):
                        $no = $index +1;
                    ?>
                            <tr>
                                <td><?echo $no?></td>
                                <td><?echo $category->name?></td>
                                <td>
                                <form action="" method="POST">
                                    <a href="index.php?page=categories-edit&category_id=<?
                                    echo $category->id;
                                    ?>" class="btn btn-primary"><i class="far fa-edit"></i></a>
                                    <input type="hidden" value="<? echo $category->id?>" name="category_id">
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