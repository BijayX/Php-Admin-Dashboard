<?php
  include('includes/header.php');
?>
<div class="section">
    <div class="container">
       <div class="row justify-content-center">
        <div class="col-md-5 my-5">
            <div class="card my-5">
                <div class="card-header bg-light">
                    <h5>Contact Form</h5>
                </div>
                <div class="card-body">
                    <?php
                      // Include message handling code
                      include('message.php');
                    ?>
                    <form action="#" method="POST">
                        <h8>Do you have any <b>Quries</b>? Please do not hesitate to contact us directly</h8>
                            <hr>
                        <div class="form-group">
                            <label for="name">Your Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Address</label>
                            <input type="address" name="address" class="form-control" placeholder="Address" required>
                        </div>

                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea name="message" class="form-control" placeholder="Your Message" rows="4" required></textarea>
                        </div>
                        <hr>
                        <div class="form-group">
                            <button type="submit" name="contact_btn" class="btn btn-primary btn-block">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
       </div>
    </div>
</div>
<?php
  include('includes/footer.php');
?>
