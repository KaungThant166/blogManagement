<?
  $statement = $db->prepare("SELECT blogs.id,blogs.title,blogs.content,blogs.created_at,blogs.image,categories.name as category_name,users.name as user_name FROM blogs
  INNER JOIN categories ON blogs.category_id = categories.id 
  INNER JOIN users on blogs.user_id = users.id
  ");
  $statement->execute();
  $blogs = $statement->fetchAll(PDO::FETCH_OBJ);

//   delete blog
if(isset($_POST['delete-btn'])){
    echo $blogId = $_POST['blog_id'];

    $Statement = $db->prepare("SELECT image FROM blogs WHERE id=$blogId");
    $Statement->execute();
    $blogState =   $Statement->fetchObject();
    
    $deleteStament = $db->prepare("DELETE FROM blogs WHERE id=$blogId");
    $result =  $deleteStament->execute();
  
   if($result){
    unlink("../assets/blog-image/$blogState->image");
    echo " <script>sweetAlert('deleted a blog', 'blogs')</script>";
  }
  }
  

?>

<div class="container-fluid">


     <!-- content row -->
     <div class="row">
     <div class="card shadow mb-4 col-md-12">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Blogs List</h6>
                <a href="index.php?page=blogs-create" class="btn btn-primary btn-sm "><i class="fa fa-plus" aria-hidden="true"></i>Add New</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>
                                    Image
                                </th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Content
                                    
                                </th>
                                <th>Author</th>
                                <th>Created at</th>
                                <th>Actions</th>
                              
                                
                            </tr>
                        </thead>
                        <tbody>
                    <?
                    foreach($blogs as $index => $blog):
                        $no = $index +1;
                    ?>
                            <tr>
                                <td><?echo $no; ?></td>
                                <td>
                                <img src="../assets/blog-image/<?echo $blog->image?>" class="img-fluid" alt="" style="width: 100px;">
                                </td>
                                <td><?echo $blog->title; ?></td>
                                <td><?= $blog->category_name?></td>

                                <td>
                                <div style="max-width:300px;
                                max-height:200px; overflow:auto;"><?echo $blog->content; ?></div>
                                </td>
                                <td><?echo $blog->user_name; ?></td>
                                <td><?echo $blog->created_at; ?></td>

                                <td>
                                <form  method="POST" class="d-flex">
                                    <a href="index.php?page=blogs-edit&blog_id=<?
                                    echo $blog->id;
                                    ?>" class="btn btn-primary m-1" title="Edit"><i class="far fa-edit"></i></a>
                                    <input type="hidden" value="<? echo $blog->id?>" name="blog_id">
                                    <button class="btn btn-danger m-1" name="delete-btn" onclick="return confirm('Are you sure to delete')" title="Delete"><i class="fas fa-trash"></i></button>
                                    <a href="index.php?page=blogs-comments&blog_id=<?
                                    echo $blog->id;
                                    ?>" class="btn btn-primary m-1" title="Comment"><i class="fas fa-comment"></i></a>
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
