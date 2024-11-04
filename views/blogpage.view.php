<?php
require './views/layout/header.php';
?>

<!-- Start Main -->
<main>
    <section id="myContent" class="content">
        <h1>Welcome to the blog page</h1>
        <div class="grid-container">
            <div class="create-posts-section">
                <!--The section of the website where new posts can be created-->
                <h2>Post information</h2>
                <form method="post" action="/blogpage/submit">
                    <input type="hidden" name="_submit" VALUE="createPost">
                    <!--Hidden input field to determine action in blogpage controller-->
                    <label for="postTitle">Title:</label><br>
                    <input type="text" id="postTitle" name="postTitle" required><br>
                    <label for="postAuthor">Author:</label><br>
                    <input type="text" id="postAuthor" name="postAuthor" required><br>
                    <label for="postContent">Message:</label><br>
                    <textarea id="postContent" name="postContent" required></textarea><br>
                    <input type="submit" name="submit-btn" value="Create post">
                </form>
                <!--Nuke all posts button-->
                <form method="post" action="/blogpage/submit">
                    <input type="hidden" name="_submit" VALUE="deleteEveryPost">
                    <!--Hidden input field to determine action in blogpage controller-->
                    <input type='submit' name="submit-btn" value='Delete all post'
                           onclick="return confirm('You are about to nuke the board. Are you sure?')">
                </form>
            </div>
            <div class="blog-posts-section">
                <h2>Posts</h2>
                <!--Filling the layout of blog posts & comments with pulled data-->
                <!--Each post put in html elements-->
                <?php foreach ($posts as $post) { ?>
                    <!--Post content-->
                    <div class="blog-post">
                        <h3><?= $post['title'] ?></h3>
                        <p><?= $post['content'] ?></p>
                        <p><?= 'Posted by ' . $post['author'] . ' at ' . $post['created_at'] ?></p>
                        <!--delete post button-->
                        <form method="post" action="/blogpage/submit">
                            <input type="hidden" name="_submit" VALUE="deletePost">
                            <input type="hidden" name="postId" VALUE=<?= $post['id'] ?>>
                            <!--Hidden input field to determine action in blogpage controller-->
                            <input type='submit' name="submit-btn" value='Delete'>
                        </form>
                    </div>
                    <!--Form to leave a comment on a post-->
                    <div class="blog-post-comment-form">
                        <form method="post" action="/blogpage/submit">
                            <input type="hidden" name="_submit" VALUE="createComment">
                            <!--Hidden input field to determine action in blogpage controller-->
                            <input type="hidden" id="commentPostId" name="commentPostId" value="<?= $post['id'] ?>">
                            <label for="commentAuthor">Author:</label>
                            <input type="text" id="commentAuthor" name="commentAuthor" required><br>
                            <label for="commentContent">Comment:</label>
                            <input type="text" id="commentContent" name="commentContent" required><br>
                            <input type="submit" name="submit-btn" value="Reply">
                        </form>
                    </div>
                    <!--Comment content-->
                    <?php if (!empty($post['comments'])) { ?>
                        <p class="replies-section">Replies</p>
                        <?php foreach ($post['comments'] as $comment) { ?>
                            <!--Each comment put in html elements-->
                            <div class="blog-post-comment">
                                <p><?= $comment['content'] ?></p>
                                <p><?= 'Posted by ' . $comment['author'] . ' at ' . $comment['created_at'] ?></p>
                                <!--delete comment button-->
                                <form method="post" action="/blogpage/submit">
                                    <input type="hidden" name="_submit" VALUE="deleteComment">
                                    <input type="hidden" name="commentId" VALUE=<?= $comment['comment_id'] ?>>
                                    <!--Hidden input field to determine action in blogpage controller-->
                                    <input type='submit' name="submit-btn" value='Delete'>
                                </form>
                            </div>
                        <?php }
                    } ?>
                <?php } ?>
            </div>
        </div>
    </section>
</main>
<!-- End main -->

<?php
require './views/layout/footer.php';
?>
