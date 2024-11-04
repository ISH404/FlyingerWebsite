<html lang="en" class="focus-outline-visible">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
        echo $webpageTitle;
        ?>
    </title>
    <link rel="stylesheet" href="/views/css/myStyle.css">
</head>
<body>
    <main>
        <section id="myContent" class="content">
            <div class="grid-container">
                <div class="login-form-section">
                    <h2>Log in here!</h2>
                    <form method="post" action="/loginpage/submit">
                        <input type="submit" class="submit-btn" name="submit-btn" value="Click here to login">
                    </form>
                </div>
            </div>
        </section>
    </main>
</body>
<script src="/views/js/myScript.js"></script>
</html>