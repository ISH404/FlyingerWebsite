<?php
require './views/layout/header.php';
?>

<!-- Start Main -->
<main>
    <section id="myContent" class="content">
        <h1>Welcome to the contact page</h1>
        <p>Contact service current offline due to SMTP server setup required.<br>
           Send button reloads the page.</p>
        <div class="grid-container">
            <div class="contact-form-section">
                <!--The section of the website where contact requests can be sent-->
                <h2>Contact me</h2>
                <form method="post" action="/contactpage/submit">
                    <label for="contactName">Your Name:</label><br>
                    <input type="text" id="contactName" name="contactName" required><br>
                    <label for="contactEmail">Your Email:</label><br>
                    <input type="text" id="contactEmail" name="contactEmail" required><br>
                    <label for="contactSubject">Subject:</label><br>
                    <input type="text" id="contactSubject" name="contactSubject" required><br>
                    <label for="contactMessage">Message:</label><br>
                    <textarea id="contactMessage" name="contactMessage" required></textarea><br>
                    <input type="submit" name="submit-btn" value="Send">
                </form>
            </div>
        </div>
    </section>
</main>
<!-- End main -->

<?php
require './views/layout/footer.php';
?>
