<?php

// Fetch all categories
$selectCategoryStatement = $db->prepare("SELECT * FROM categories");
$selectCategoryStatement->execute();
$categories = $selectCategoryStatement->fetchAll(PDO::FETCH_OBJ);

// Delete category
if (isset($_POST['delete-btn'])) {
    $categoryId = $_POST['category_id'];

    // Use a prepared statement to prevent SQL injection
    $deleteStatement = $db->prepare("DELETE FROM categories WHERE id = :id");
    $deleteStatement->bindParam(':id', $categoryId, PDO::PARAM_INT);
    $deleteStatement->execute();

    // SweetAlert usage, assuming the function is defined or integrated properly
    echo "<script>Swal.fire('Deleted!', 'Category has been deleted.', 'success').then(() => { window.location.href = 'index.php?page=categories'; });</script>";
}
?>

<div class="container-fluid">

    <!-- content row -->
    <div class="row">
        <div class="card shadow mb-4 col-md-12">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Category List</h6>
                <a href="index.php?page=categories-create" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus-circle"></i> Add New
                </a>
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
                            <?php foreach ($categories as $index => $category): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= htmlspecialchars($category->name) ?></td>
                                    <td>
                                        <form action="" method="POST">
                                            <a href="index.php?page=categories-edit&category_id=<?= $category->id ?>" class="btn btn-primary">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            <input type="hidden" name="category_id" value="<?= $category->id ?>">
                                            <button class="btn btn-danger" name="delete-btn" onclick="return confirm('Are you sure you want to delete this category?')">
                                                Delete
                                            </button>
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