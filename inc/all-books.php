<?php
global $wpdb;
$table_name = $wpdb->prefix . 'dii_book';


// Fetch all books
$results = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);
?>

<div class="container">
    <h2 class="text-center">Book List</h2>

    <?php if (isset($_GET['deleted'])): ?>
            <?php if ($_GET['deleted'] == '1'): ?>
                <div class="alert alert-success">Book deleted successfully!</div>
            <?php else: ?>
                <div class="alert alert-danger">Failed to delete book.</div>
            <?php endif; ?>
        <?php endif; ?>

    <?php if (!empty($results)) : ?>
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Author</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $row) : ?>
                    <tr>
                        <td><?php echo esc_html($row['id']); ?></td>
                        <td>
                            <?php if (!empty($row['book_image'])) : ?>
                                <img src="<?php echo esc_url($row['book_image']); ?>" width="50" height="50" />
                            <?php else : ?>
                                <span class="text-muted">No Image</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo esc_html($row['name']); ?></td>
                        <td><?php echo esc_html($row['author']); ?></td>
                        <td><?php echo esc_html($row['created_at']); ?></td>
                        <td>
                            <a href="admin.php?page=edit-book&action=edit&id=<?php echo esc_attr($row['id']); ?>" class="btn btn-warning btn-xs">Edit</a>

                           <?php
                            $delete_url = wp_nonce_url(
                                admin_url('admin-post.php?action=dii_delete_book&id=' . $row['id']),
                                'delete_book_' . $row['id']
                            );

                            ?>

                            <a href="<?php echo esc_url($delete_url); ?>"
                            class="btn btn-danger btn-xs"
                            onclick="return confirm('Are you sure you want to delete this book?');">
                            Delete
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <div class="alert alert-info">No books found.</div>
    <?php endif; ?>
</div>
