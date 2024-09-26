
   <?php


   require_once("layout/header.php");
   require_once("layout/navbar.php");
   
//    get a blog detail
   $blogId = $_GET['blog_id'];

   $detailStmt = $db->prepare("SELECT blogs.title,blogs.content,blogs.image,blogs.created_at,users.name FROM blogs INNER JOIN users ON blogs.user_id = users.id WHERE blogs.id=$blogId");
   $detailStmt->execute();
   $blog=$detailStmt->fetchObject();
//    print_r($blogId);

//create comment
if(isset($_POST['createCommentBtn'])){
    $text = $_POST['text'];
    $created_at = date('Y-m-d H:I:s');
    $userId = $_SESSION['user']->id;

    $stmt = $db->prepare("INSERT INTO comments( text, blog_id,user_id, created_at) VALUES ('$text',$blogId,$userId,'$created_at')");
    $result = $stmt->execute();
    if($result){
        echo "<script>sweetAlert('created a coment','blog-detail.php?blog_id=". $blogId ."')</script>";
    }


};

// get cooments
    $commentStmt = $db->prepare("SELECT comments.text,users.name,comments.created_at FROM comments INNER JOIN users ON comments.user_id = users.id WHERE comments.blog_id = $blogId ");
    $commentStmt->execute();
    $comments = $commentStmt->fetchAll(PDO::FETCH_OBJ);
 

   ?>

    <div id="blog-detail">
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-8">
                    <h3 data-aos="fade-right" data-aos-duration="1000">Blog Detail</h3>
                    <div class="heading-line" data-aos="fade-left" data-aos-duration="1000"></div>
                    <div class="card my-3" data-aos="zoom-in" data-aos-duration="1000">
                        <div class="card-body p-0">
                            <div class="img-wrapper">
                                <img src="assets/blog-image/<?echo $blog->image?>" class="img-fluid" alt="">
                            </div>
                            <div class="content p-3">
                                <h5 class="fw-semibold"><?echo $blog->title;?></h5>
                                <div class="mb-3"><?echo $blog->created_at;?> | by <?echo $blog->name;?></div>
                                <p>
                                <?echo $blog->content;?> 
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- comment section -->
                    <div class="comment">
        
                <?
                if(isset($_SESSION['user'])):
                ?>
                <h5 data-aos="fade-right" data-aos-duration="1000">Leave a Comment</h5>
                    <form action="" data-aos="fade-left" data-aos-duration="1000" method="POST">
                        <div class="mb-2">
                            <textarea name="text" rows="5" class="form-control"></textarea>
                        </div>
                        <button class="btn" type="submit" name="createCommentBtn">Submit</button>
                    </form>

                <?
                else:
                ?>
                    <a  class="btn btn-primary" href="#signIn" data-bs-toggle="offcanvas" aria-controls="staticBackdrop">Sign in to comment</a>
                <? endif;?>
                <?foreach($comments as $comment):?>
                        <div class="card card-body my-3" data-aos="fade-right" data-aos-duration="1000">
                            <h6><?= $comment->name?></h6>
                           <?= $comment->text?>
                            <div class="mt-3">
                                <span class="float-end"><?= $comment->created_at?></span>
                            </div>
                        </div>
                        <?endforeach;?>
               
                    </div>
                </div>
                <?require_once("layout/right-side.php");?>
            </div>
        </div>
    </div>

   <?  require_once("layout/footer.php");?>
