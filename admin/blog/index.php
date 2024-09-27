<?php
// Fetch blogs with their related categories and users
$statement = $db->prepare("
    SELECT 
        blogs.id, blogs.title, blogs.content, blogs.created_at, blogs.image, 
        categories.name AS category_name, 
        users.name AS user_name 
    FROM blogs
    INNER JOIN categories ON blogs.category_id = categories.id 
    INNER JOIN users ON blogs.user_id = users.id
");
$statement->execute();
$blogs = $statement->fetchAll(PDO::FETCH_OBJ);

// Delete blog
if (isset($_POST['delete-btn'])) {
    $blogId = $_POST['blog_id'];

    // Fetch the blog image before deleting
    $statement = $db->prepare("SELECT image FROM blogs WHERE id = :id");
    $statement->bindParam(':id', $blogId, PDO::PARAM_INT);
    $statement->execute();
    $blogState = $statement->fetchObject();

    // Prepare and execute the delete statement
    $deleteStatement = $db->prepare("DELETE FROM blogs WHERE id = :id");
    $deleteStatement->bindParam(':id', $blogId, PDO::PARAM_INT);
    $result = $deleteStatement->execute();

    // If deletion is successful, remove the image file
    if ($result) {
        if ($blogState && $blogState->image && file_exists("../assets/blog-image/" . $blogState->image)) {
            unlink("../assets/blog-image/" . $blogState->image);
        }
        // Redirect after success to avoid form resubmission issues
        echo "<script>
                Swal.fire('Deleted!', 'The blog has been deleted.', 'success').then(() => {
                    window.location.href = 'index.php?page=blogs';
                });
              </script>";
    } else {
        // Handle deletion failure
        echo "<script>Swal.fire('Error', 'Failed to delete the blog.', 'error');</script>";
    }
}
?>

<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <div class="card shadow mb-4 col-md-12">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Blogs List</h6>
                <a href="index.php?page=blogs-create" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus" aria-hidden="true"></i> Add New
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Content</th>
                                <th>Author</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($blogs as $index => $blog): ?>
                                <tr>
                                    <td><?= $index + 1; ?></td>
                                    <td>
                                        <img src="../assets/blog-image/<?= htmlspecialchars($blog->image); ?>" class="img-fluid" alt="Blog Image" style="width: 100px;">
                                    </td>
                                    <td><?= htmlspecialchars($blog->title); ?></td>
                                    <td><?= htmlspecialchars($blog->category_name); ?></td>
                                    <td>
                                        <div style="max-width:300px; max-height:200px; overflow:auto;">
                                            <?= htmlspecialchars($blog->content); ?>
                                        </div>
                                    </td>
                                    <td><?= htmlspecialchars($blog->user_name); ?></td>
                                    <td><?= htmlspecialchars($blog->created_at); ?></td>
                                    <td>
                                        <form method="POST" class="d-flex">
                                            <a href="index.php?page=blogs-edit&blog_id=<?= $blog->id; ?>" class="btn btn-primary m-1" title="Edit">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            <input type="hidden" value="<?= $blog->id; ?>" name="blog_id">
                                            <button class="btn btn-danger m-1" name="delete-btn" onclick="return confirm('Are you sure you want to delete this blog?')" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <a href="index.php?page=blogs-comments&blog_id=<?= $blog->id; ?>" class="btn btn-primary m-1" title="Comments">
                                                <i class="fas fa-comment"></i>
                                            </a>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>