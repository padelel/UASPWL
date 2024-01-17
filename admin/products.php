<?php require 'includes/header.php'; ?>

<?php
$search = isset($_GET['search']) ? $_GET['search'] : '';
$whereClause = empty($search) ? '' : "WHERE products.name LIKE '%$search%' OR categories.name LIKE '%$search%'";

$query = "SELECT products.*, categories.name AS category_name FROM products JOIN categories ON products.category_id = categories.id $whereClause";
$products = mysqli_query($conn, $query);

$totalRows = mysqli_num_rows($products);
$rowsPerPage = 3; // Ubah ke 3 untuk menampilkan 3 produk per halaman
$totalPages = ceil($totalRows / $rowsPerPage);

$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
$currentPage = max(1, min($currentPage, $totalPages));

// Calculate start and end rows for pagination
$startRow = ($currentPage - 1) * $rowsPerPage;
$endRow = $startRow + $rowsPerPage;

// Ensure end row doesn't exceed the total number of rows
$endRow = min($endRow, $totalRows);

// Adjust start row if it exceeds the total number of rows
$startRow = max(0, $startRow);
?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow">
        <div class="card-header">
            <h4 class="mb-0">Products
                <a href="products-create.php" class="btn btn-primary float-end">Add Product</a>
            </h4>
        </div>

        <div class="card-body">
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="" method="get">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" placeholder="Input Name" aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" name="submit-search">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>

            <?php
            if ($totalRows > 0) {
                ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category Name</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            // Fetch all rows at once
                            $rows = mysqli_fetch_all($products, MYSQLI_ASSOC);

                            // Display rows based on the corrected start and end rows
                            for ($i = $startRow; $i < $endRow && $i < $totalRows; $i++) {
                                $Item = $rows[$i];
                                ?>
                                <tr>
                                    <td><?php echo $Item['id']; ?></td>
                                    <td><?php echo $Item['category_name']; ?></td>
                                    <td><?php echo $Item['name']; ?></td>
                                    <td><?php echo $Item['description']; ?></td>
                                    <td><?php echo $Item['price']; ?></td>
                                    <td><?php echo $Item['quantity']; ?></td>
                                    <td>
                                        <a href="products-edit.php?id=<?php echo $Item['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="products-delete.php?id=<?php echo $Item['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure want to delete this data.')">Delete</a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php if ($currentPage > 1) : ?>
                            <li class="page-item">
                                <a class="page-link" href="?search=<?php echo urlencode($search); ?>&page=<?php echo $currentPage - 1; ?>">Previous</a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                            <li class="page-item <?php echo $i === $currentPage ? 'active' : ''; ?>">
                                <a class="page-link" href="?search=<?php echo urlencode($search); ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($currentPage < $totalPages) : ?>
                            <li class="page-item">
                                <a class="page-link" href="?search=<?php echo urlencode($search); ?>&page=<?php echo $currentPage + 1; ?>">Next</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            <?php
            } else {
                echo '<div class="alert alert-info">No products found.</div>';
            }
            ?>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
