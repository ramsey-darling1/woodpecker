<!doctype html>
<html>
<head>
<title>Project Hours</title>
<link rel="stylesheet" href="/bower_components/foundation/css/foundation.css">
<link rel="stylesheet" href="/css/main.css">
<script src="js/vendor/modernizr.js"></script>
</head>
<body>
<header>
    <div class="row">
        <div class="small-6 columns">
            <h1>woodpecker</h1>
            <p>project hours management</p>
        </div>
        <div class="small-6 columns">
            <?php if($account->is_logged_in()): ?>
            <nav class="top-bar" data-topbar role="navigation">
                <section class="top-bar-section">
                    <ul class="">
                      <li class="active"><a href="#">New Project</a></li>
                      <li><a href="">List Projects</a></li>
                    </ul>
                </section>
            </nav>
            <?php endif; ?>
        </div>
    </div>
</header>
<div class="row">
    <div class="small-12 columns"><div class="res-message"></div></div>
</div>
