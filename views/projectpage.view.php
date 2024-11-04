<?php
require './views/layout/header.php';
?>

<!-- Start Main -->
<main>
    <section id="myContent" class="content">
        <div class="grid-container">
            <div class="create-projects-section">
                <h1>Welcome to the project page</h1>
                <!--The section of the website where new projects can be created-->
                <h3>Create project</h3>
                <!--Enctype required when input type="file" is used in a form-->
                <form method="post" action="/projectpage/submit" enctype="multipart/form-data">
                    <!--Hidden input field to determine action in projectpage controller-->
                    <input type="hidden" name="_submit" VALUE="createProject">
                    <label for="projectName">Name:</label><br>
                    <input type="text" id="projectName" name="projectName" required><br>
                    <label for="projectDescription">Description:</label><br>
                    <input type="text" id="projectDescription" name="projectDescription" required><br>
                    <label for="projectThumbnail">Thumbnail:</label><br>
                    <input type="file" id="projectThumbnail" name="projectThumbnail" required><br>
                    <input type="submit" name="submit-btn" value="Create project">
                </form>
                <!--Nuke all projects button-->
                <form method="post" action="/projectpage/submit">
                    <input type="hidden" name="_submit" VALUE="deleteEveryProject">
                    <!--Hidden input field to determine action in projectpage controller-->
                    <input type='submit' name="submit-btn" value='Delete all projects'
                           onclick="return confirm('You are about to nuke the board. Are you sure?')">
                </form>
            </div>
            <div class="projects-section">
                <h2>Projects</h2>
                <!--Filling the layout of projects with pulled data-->
                <!--Each project put in html elements-->
                <?php foreach ($projects as $project) { ?>
                    <!--Project content-->
                    <div class="project">
                        <h3><?= $project['name'] ?></h3>
                        <div class="project-content">
                            <img class="project-thumbnail" src="<?= '/uploaded_images/' . $project['thumbnail_name'] ?>" alt='project thumbnail'>
                            <p><?= $project['description'] ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
</main>
<!-- End main -->

<?php
require './views/layout/footer.php';
?>
