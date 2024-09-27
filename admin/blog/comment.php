<?php
$blogId = $_GET['blog_id'];

// Fetch comments for the specific blog
$Stmt = $db->prepare("SELECT comments.text, users.name, comments.created_at 
                      FROM comments 
                      INNER JOIN users ON comments.user_id = users.id 
                      WHERE comments.blog_id = :blog_id");
$Stmt->bindParam(':blog_id', $blogId, PDO::PARAM_INT);
$Stmt->execute();
$comments = $Stmt->fetchAll(PDO::FETCH_OBJ);
?>

<div class="container-fluid">
    <!-- content row -->
    <div class="row">
        <div class="card shadow mb-4 col-md-12">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Comments List</h6>
                <a href="index.php?page=blogs" class="btn btn-primary btn-sm">
                    <i class="fas fa-angle-double-left"></i> Back
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <?php if (count($comments) >= 1): ?>
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>User</th>
                                    <th>Text</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($comments as $index => $comment): ?>
                                    <tr>
                                        <td><?php echo $index + 1; ?></td>
                                        <td><?php echo htmlspecialchars($comment->name); ?></td>
                                        <td><?php echo htmlspecialchars($comment->text); ?></td>
                                        <td><?php echo $comment->created_at; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>No comments found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>