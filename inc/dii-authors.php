<?php
global $wpdb;
$author_table = $wpdb->prefix . 'dii_author_table';


// Fetch all books
$results = $wpdb->get_results("SELECT * FROM $author_table", ARRAY_A);

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
                        <td><?php echo esc_html($row['name']); ?></td>
                        <td><?php echo esc_html($row['links']); ?></td>
                        <td><?php echo esc_html($row['about']); ?></td>
                        <td><?php echo esc_html($row['created_at']); ?></td>
                        <td>
                            <a href="admin.php?page=dii-edit-author&action=edit&id=<?php echo esc_attr($row['id']); ?>" class="btn btn-warning btn-xs">Edit</a>

                           <?php
                            $delete_url = wp_nonce_url(
                                admin_url('admin-post.php?action=dii_delete_author&id=' . $row['id']),
                                'delete_author_' . $row['id']
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
