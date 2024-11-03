<?php
require './views/layout/header.php';
?>

<!-- Start Main -->
<main>
    <section id="myContent" class="content">
        <h1>Blogpage Content</h1>
        <!--The section of the website where new posts can be created-->
        <h3>Add post</h3>
        <form method="post" action="/blogpage/submit">
            <input type="hidden" name="_submit" VALUE="createPost"> <!--Hidden input field to determine action in blogpage controller-->
            <label for="postTitle">Title:</label><br>
            <input type="text" id="postTitle" name="postTitle" required><br>
            <label for="postAuthor">Author:</label><br>
            <input type="text" id="postAuthor" name="postAuthor" required><br>
            <label for="postContent">Message:</label><br>
            <input type="text" id="postContent" name="postContent" required><br>
            <input type="submit" value="Create post">
        </form>
        <form method="post" action="blogpage/submit">
            <input type="hidden" name="_submit" VALUE="deleteEveryPost"> <!--Hidden input field to determine action in blogpage controller-->
            <input type='submit' value='Delete all post'  onclick="return confirm('You are about to nuke the board. Are you sure?')">
        </form>

        <!--Posts pulled from the database put in html elements-->
        <h2>Posts</h2>
        <?php
            foreach($results as $result) {
                //cleandd($result['comments']['author']);
        ?>
        <div class="blog-posts-section">
        <!--Filling the layout blog posts & comments with pulled data-->
        <!--Post content-->
            <div class="blog-post">
                <h3><?= $result['title'] ?></h3>
                <p><?= $result['content'] ?></p>
                <p><?= 'Posted by ' . $result['author'] . ' at ' . $result['created_at'] ?></p>
            </div>
            <!--Form to leave a comment on a post-->
            <div class="blogpost-comment-form">
                <form method="post" action="/blogpage/submit">
                    <input type="hidden" name="_submit" VALUE="createComment"> <!--Hidden input field to determine action in blogpage controller-->
                    <input type="hidden" id="commentPostId" name="commentPostId" value="<?=$result['id']?>">
                    <label for="commentAuthor">Author:</label><br>
                    <input type="text" id="commentAuthor" name="commentAuthor" required><br>
                    <label for="commentContent">Comment:</label><br>
                    <input type="text" id="commentContent" name="commentContent" required><br>
                    <input type="submit" value="Reply">
                </form>
            </div>
            <!--Comment content-->
            <?php if(!empty($result['comments'])){?>
                <p style="text-indent: 30px"><strong>Replies</strong></p>
                <?php foreach($result['comments'] as $comment) {?>
                <div class="blog-comment">
                    <p style="text-indent: 30px"><?=$comment['content']?></p>
                    <p style="text-indent: 30px"><?= 'Posted by ' . $comment['author'] . ' at ' . $comment['created_at']?></p>
                </div>
            <?php }}?>
        </div>
        <?php } ?>
    </section>
</main>
<!-- End main -->

<?php
require './views/layout/footer.php';
?>
