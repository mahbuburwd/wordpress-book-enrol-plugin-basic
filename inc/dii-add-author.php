<?php 
global $wpdb;
$author_table = $wpdb->prefix . 'dii_author_table';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['author_name'], $_POST['author_link'])) {
    $author_name  = sanitize_text_field($_POST['author_name']);
    $author_link  = esc_url_raw($_POST['author_link']);
    $author_about = sanitize_textarea_field($_POST['author_about']);

    $inserted = $wpdb->insert(
        $author_table,
        [
            'name'       => $author_name,
            'links'      => $author_link,
            'about'      => $author_about,
            'created_at' => current_time('mysql'),
        ],
        ['%s', '%s', '%s', '%s']
    );

    if ($inserted) {
        echo '<div class="alert alert-success">Author added successfully!</div>';
    } else {
        echo '<div class="alert alert-danger">Failed to add author. Please try again.</div>';
    }
}
?>

<div class="wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Add Author</h3>
                    </div>
                    <div class="panel-body">
                        <form action="" method="post">

                            <div class="form-group">
                                <label for="author_name">Author Name</label>
                                <input type="text" class="form-control" name="author_name" id="author_name" required>
                            </div>

                            <div class="form-group">
                                <label for="author_link">Link</label>
                                <input type="url" class="form-control" name="author_link" id="author_link" required>
                            </div>

                            <div class="form-group">
                                <label for="author_about">About Author</label>
                                <textarea name="author_about" id="author_about" class="form-control"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Add Author</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
