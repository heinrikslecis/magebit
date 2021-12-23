<?php require APPROOT . '/views/inc/header.php'; ?>

<main>

    <section class="section section-content">
        <!-- Sidebar -->

        <div class="left">
            <?php require APPROOT . '/views/inc/navbar.php'; ?>

            <div class="main-content subscribe">
                <!-- <div class="main-subscribe"> -->
                <span class="ic-success"><span class="path1"></span><span class="path2"></span><span
                        class="path3"></span><span class="path4"></span><span class="path5"></span><span
                        class="path6"></span><span class="path7"></span></span>
                <div class="main-text subscribe">
                    <h1>Thanks for subscribing!</h1>
                    <p>You have successfully subscribed to our email listing. Check your email for the discount code.
                    </p>
                </div>
                <hr class="hr subscribe">
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