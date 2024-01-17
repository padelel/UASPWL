<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow">
        <div class="card-header">
            <h4 class="mb-0">Admin
                <a href="admins-create.php" class="btn btn-primary float-end">Add admin</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alert(); ?>

            <?php
            $admins = getAll('admins');
            if (mysqli_num_rows($admins) > 0) {
            ?>
                <div class="table-responsive">
                    <table class="table table-stripped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($admins as $adminItem) : ?>
                                <tr>
                                    <td><?= $adminItem['id'] ?></td>
                                    <td><?= $adminItem['name'] ?></td>
                                    <td>
                                        <a href="admins-edit.php?id=<?= $adminItem['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="admins-delete.php?id=<?= $adminItem['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                    </table>
                </div>
            <?php
            } else {
            ?>
                <h4 class="mb-0">No Record Found</h4>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>