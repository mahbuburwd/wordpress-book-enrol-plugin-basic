<?php 

global $wpdb;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_name'])) {
    $table_name = $wpdb->prefix . 'dii_book';

    $book_name   = sanitize_text_field($_POST['book_name']);
    $book_author = sanitize_text_field($_POST['book_author']);
    $book_about  = sanitize_textarea_field($_POST['book_about']);
    $book_image  = esc_url_raw($_POST['book_image']);

    $wpdb->insert(
        $table_name,
        [
            'name'       => $book_name,
            'author'     => $book_author,
            'about'      => $book_about,
            'book_image' => $book_image,
            'created_at' => current_time('mysql')
        ]
    );

    echo '<div class="updated notice is-dismissible"><p><strong>Book added successfully!</strong></p></div>';
}
?>




<div class="wrap">


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Book Information</h3>
                    </div>
                    <div class="panel-body">
                        <form action="" method="post">

                            <div class="form-group">
                                <label for="bookname">Book Name</label>
                                <input type="text" class="form-control" name="book_name" id="bookname" required>
                            </div>
                             <div class="form-group">
                                <label for="bookname">Book Author</label>
                                <input type="text" class="form-control" name="book_author" id="bookname" required>
                            </div>
                             <div class="form-group">
                                <label for="bookname">Book About</label>
                               <textarea name="book_about" id="" class="form-control"></textarea>
                            </div>
                             <div class="form-group">
                            <label for="book_image">Book Image</label>
                            <div class="input-group">
                                <input type="text" id="book_image" name="book_image" class="form-control" readonly>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default" id="upload_book_image">Upload Image</button>
                                </span>
                            </div>
                            <div id="book_image_preview" style="margin-top:10px; width:150px;">
                                <!-- Image preview will appear here -->
                            </div>
                        </div>

                            <!-- Add more fields here if needed -->

                            <button type="submit" class="btn btn-primary">Add Book</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>