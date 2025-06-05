<?php 

add_shortcode('dii_books_table', 'dii_render_books_table');

function dii_render_books_table() {
    global $wpdb;
    $book_table = $wpdb->prefix . 'dii_book';
    $books = $wpdb->get_results("SELECT * FROM $book_table", ARRAY_A);

    if (empty($books)) {
        return '<div class="alert alert-info">No books found.</div>';
    }

    ob_start();
    ?>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped align-middle">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Author</th>
                    <th scope="col">About</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book) : ?>
                    <tr>
                        <td><?php echo esc_html($book['id']); ?></td>
                        <td>
                            <?php if (!empty($book['book_image'])) : ?>
                                <img src="<?php echo esc_url($book['book_image']); ?>" alt="Book Image" class="img-fluid" style="max-width: 80px;" />
                            <?php else : ?>
                                <span class="text-muted">No Image</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo esc_html($book['name']); ?></td>
                        <td><?php echo esc_html($book['author']); ?></td>
                        <td><?php echo esc_html($book['about']); ?></td>
                        <td>
                            <button class="btn btn-primary btn-sm dii-send-message" data-book-id="<?php echo esc_attr($book['id']); ?>">Send Message</button>


                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>


    <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Send message</h4>
      </div>
      <div class="modal-body">
        <!-- Hidden input for book ID -->
           <form id="dii-message-form" method="POST">
            <input type="hidden" name="action" value="dii_submit_message">
            <input type="hidden" name="security" value="<?php echo wp_create_nonce('dii_message_nonce'); ?>">
            <input type="hidden" id="dii-book-id" name="book_id">

                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Insert name" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Insert email" required>
                </div>
                <div class="form-group">
                    <input type="tel" name="phone" class="form-control" placeholder="Insert phone" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
    <?php
    return ob_get_clean();
}
