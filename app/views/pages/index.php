<?php require APPROOT . '/views/inc/header.php'; ?>

<main>

    <section class="section section-content">
        <!-- Sidebar -->

        <div class="left">
            <?php require APPROOT . '/views/inc/navbar.php'; ?>

            <div class="main-content">
                <div class="main-text">
                    <h1>Subscribe to newsletter</h1>
                    <p>Subscribe to our newsletter and get 10% discount on pineapple glasses.</p>
                </div>
                <form class="email" action="<?php echo URLROOT; ?>/index" method="POST" name="form" novalidate>
                    <button type="submit" id="submit-btn" value="Subscribe"></button>
                    <input type="email" name="email" id="mail" placeholder="Type your email address here…"
                        value="<?php echo $data['email']; ?>" required>
                    <span class="error <?php echo (!empty($data['email_err'])) ? 'active' : ''; ?>"
                        id="error"><?php echo $data['email_err']; ?></span>
                    <span id="ic-arrow" class="ic-arrow"></span>

                    <div class="checkbox-container">
                        <input type="checkbox" name="checkbox_name" value="checkbox_value" id="checkbox"
                            onclick="buttonClick()">
                        <span class="checkmark"></span>
                        <p>I agree to <a href="#">terms of service</a></p>
                    </div>
                </form>
                <hr>
                <?php require APPROOT . '/views/inc/socials.php'; ?>
            </div>


        </div>
        <!-- Image -->
        <div class="right">
            <aside class="container-image"></aside>
        </div>

    </section>

</main>

<?php require APPROOT . '/views/inc/footer.php'; ?>