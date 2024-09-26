<?php
// Initialize error variable
$nameError = "";

// Create category 
if (isset($_POST['categoryCreate-btn'])) {
    $name = $_POST['name'];

    // Validate name
    if (!empty($name)) {
        // Prepare statement using parameterized query to prevent SQL injection
        $createStatement = $db->prepare("INSERT INTO categories (name) VALUES (:name)");
        $createStatement->bindParam(':name', $name);
        $result = $createStatement->execute();

        // Check if the category was created successfully
        if ($result) {
            echo "<script>sweetAlert('Created a category', 'categories')</script>";
        } else {
            $nameError = "Failed to create category. Please try again.";
        }
    } else {
        $nameError = "Name is required.";
    }
}
?>

<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Category Creation Form</h6>
                    <a href="index.php?page=categories" class="btn btn-primary btn-sm">
                        <i class="fas fa-angle-double-left"></i> Back
                    </a>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="mb-2">
                            <label for="name">Name</label>
                            <input type="text" id="name" class="form-control <?php if ($nameError != ""): ?>is-invalid<?php endif; ?>" name="name" value="<?= isset($name) ? htmlspecialchars($name) : '' ?>">
                            <span class="text-danger"><?php echo htmlspecialchars($nameError); ?></span>
                        </div>
                        <button class="btn btn-primary" name="categoryCreate-btn">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>