<?php
global $wpdb;
$table = $wpdb->prefix . 'dii_messages';
$book_table = $wpdb->prefix . 'dii_book';

$messages = $wpdb->get_results("SELECT m.*, b.name AS book_name FROM $table m JOIN $book_table b ON m.book_id = b.id", ARRAY_A);
?>

<div class="container">
    <h2 class="text-center">Customer Messages</h2>
    <?php if (!empty($messages)): ?>
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Book Name</th>
                <th>Customer Name</th>
                <th>Customer Phone</th>
                <th>Customer Email</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($messages as $msg): ?>
                <tr>
                    <td><?php echo esc_html($msg['id']); ?></td>
                    <td><?php echo esc_html($msg['book_name']); ?></td>
                    <td><?php echo esc_html($msg['name']); ?></td>
                    <td><?php echo esc_html($msg['phone']); ?></td>
                    <td><?php echo esc_html($msg['email']); ?></td>
                    <td><?php echo esc_html($msg['created_at']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
        <div class="alert alert-info">No messages found.</div>
    <?php endif; ?>
</div>
