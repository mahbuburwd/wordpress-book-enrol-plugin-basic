<?php
global $wpdb;
$author_table = $wpdb->prefix . 'dii_author_table';
$author_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Get the book data
$author = $wpdb->get_row(
    $wpdb->prepare("SELECT * FROM {$author_table} WHERE id = %d", $author_id), 
    ARRAY_A
);

// update code here

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['author_name'], $_POST['author_link'])) {
    $author_name  = sanitize_text_field($_POST['author_name']);
    $author_link  = esc_url_raw($_POST['author_link']);
    $author_about = sanitize_textarea_field($_POST['author_about']);

    $updated = $wpdb->update(
        $author_table,
        [
            'name'  => $author_name,
            'links' => $author_link,
            'about' => $author_about,
        ],
        ['id' => $author_id],
        ['%s', '%s', '%s'],
        ['%d']
    );

    if ($updated !== false) {
        echo '<div class="notice notice-success"><p>Author updated successfully.</p></div>';
        // Refresh data after update
        $author = $wpdb->get_row(
            $wpdb->prepare("SELECT * FROM {$author_table} WHERE id = %d", $author_id), 
            ARRAY_A
        );
    } else {
        echo '<div class="notice notice-warning"><p>No changes made or update failed.</p></div>';
    }
}



?>

<div class="wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Update Author</h3>
                    </div>
                    <div class="panel-body">
                        <form action="" method="post">

                            <div class="form-group">
                                <label for="author_name">Author Name</label>
                                <input type="text" class="form-control" value="<?php echo $author['name']?>" name="author_name" id="author_name" required>
                            </div>

                            <div class="form-group">
                                <label for="author_link">Link</label>
                                <input type="url" value="<?php echo $author['links']?>" class="form-control" name="author_link" id="author_link" required>
                            </div>

                            <div class="form-group">
                                <label for="author_about">About Author</label>
                                <textarea name="author_about" id="author_about" class="form-control">
                                    <?php echo $author['about']?>
                                </textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Author</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
