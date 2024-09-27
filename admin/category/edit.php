<?php

// Get the old category ID from the URL
$categoryID = $_GET['category_id'];

// Fetch the category details
$statement = $db->prepare("SELECT * FROM categories WHERE id = :id");
$statement->bindParam(':id', $categoryID, PDO::PARAM_INT);
$statement->execute();
$result = $statement->fetchObject();

$nameError = "";

// Update category
if (isset($_POST['categoryUpdate-btn'])) {
    $name = $_POST['name'];

    // Validate the name input
    if (empty($name)) {
        $nameError = "The name field is required.";
    } else {
        // Prepare statement using a parameterized query to prevent SQL injection
        $updateStatement = $db->prepare("UPDATE categories SET name = :name WHERE id = :id");
        $updateStatement->bindParam(':name', $name);
        $updateStatement->bindParam(':id', $categoryID, PDO::PARAM_INT);
        
        // Execute the update
        if ($updateStatement->execute()) {
            echo "<script>sweetAlert('Updated a category', 'categories')</script>";
        } else {
            $nameError = "Failed to update the category. Please try again.";
        }
    }
}

?>

<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Category Edit Form</h6>
                    <a href="index.php?page=categories" class="btn btn-primary btn-sm">
                        << Back
                    </a>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="mb-2">
                            <label for="name">Name</label>
                            <input type="text" id="name" class="form-control <?php if ($nameError != ""): ?>is-invalid<?php endif; ?>" name="name" value="<?php echo htmlspecialchars($result->name); ?>">
                            <span class="text-danger"><?php echo htmlspecialchars($nameError); ?></span>
                        </div>
                        <button class="btn btn-primary" name="categoryUpdate-btn">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>