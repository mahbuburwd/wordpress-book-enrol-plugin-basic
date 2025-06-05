<?php
global $wpdb;
$table_name = $wpdb->prefix . 'dii_book';
$student_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Get the book data
$student = $wpdb->get_row(
    $wpdb->prepare("SELECT * FROM {$table_name} WHERE id = %d", $student_id), 
    ARRAY_A
);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_name'])) {
    // Verify nonce for security
    if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'update_book_' . $student_id)) {
        wp_die('Security check failed');
    }

    // Sanitize input data
    $book_name = sanitize_text_field($_POST['book_name']);
    $book_author = sanitize_text_field($_POST['book_author']);
    $book_about = sanitize_textarea_field($_POST['book_about']);
    $book_image = esc_url_raw($_POST['book_image']);

    // Update the book in database
    $updated = $wpdb->update(
        $table_name,
        array(
            'name' => $book_name,
            'author' => $book_author,
            'about' => $book_about,
            'book_image' => $book_image
        ),
        array('id' => $student_id),
        array('%s', '%s', '%s', '%s'),
        array('%d')
    );

    if ($updated !== false) {
        // Success message
        echo '<div class="notice notice-success is-dismissible"><p>Book updated successfully!</p></div>';
        
        // Refresh the student data after update
        $student = $wpdb->get_row(
            $wpdb->prepare("SELECT * FROM {$table_name} WHERE id = %d", $student_id), 
            ARRAY_A
        );
    } else {
        // Error message
        echo '<div class="notice notice-error is-dismissible"><p>Error updating book. Please try again.</p></div>';
    }
}
?>

<div class="wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Update Book</h3>
                    </div>
                    <div class="panel-body">
                        <?php if ($student) : ?>
                            <form action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post" enctype="multipart/form-data">
                                <?php wp_nonce_field('update_book_' . $student_id); ?>
                                <div class="form-group">
                                    <label for="bookname">Book Name</label>
                                    <input type="text" class="form-control" name="book_name" id="bookname" value="<?php echo esc_attr($student['name']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="bookauthor">Book Author</label>
                                    <input type="text" class="form-control" name="book_author" id="bookauthor" value="<?php echo esc_attr($student['author']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="bookabout">Book About</label>
                                    <textarea name="book_about" id="bookabout" class="form-control" rows="5"><?php echo esc_textarea($student['about']); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="book_image">Book Image</label>
                                    <div class="input-group">
                                        <input type="text" id="book_image" name="book_image" class="form-control" value="<?php echo esc_url($student['book_image']); ?>">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default" id="upload_book_image">Upload Image</button>
                                        </span>
                                    </div>
                                    <div id="book_image_preview" style="margin-top:10px; width:150px;">
                                        <?php if ($student['book_image']) : ?>
                                            <img src="<?php echo esc_url($student['book_image']); ?>" style="max-width:100%;" />
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Update Book</button>
                            </form>
                        <?php else : ?>
                            <p>No book data available to edit.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

