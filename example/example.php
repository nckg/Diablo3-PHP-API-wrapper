<?php

// require stuff
require("../Diablo3/CurlRequest.php");
require("../Diablo3/Diablo3.php");
require("../Diablo3/Profile.php");
require("../Diablo3/Hero.php");

$battleNetId = 'FaceRip#2904';

$profile = new Profile($battleNetId);

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Diablo 3 API - example</title>
		<link rel="stylesheet" href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css" type="text/css" media="screen" charset="utf-8" />
	</head>
	<body>
        <div class="container">
            <header class="jumbotron">
                <h1>Diablo 3 - Heroes</h1>
            </header>
            <section id="heroes">
                <?php foreach ($profile->getHeroes() as $hero) : ?>
                <h1><?php echo $hero->name; ?> <small><?php echo $hero->class; ?></small></h1>
                <div class="row">
                    <?php
                    $heroInfo = $hero->getInfo();
                    ?>
                    <div class="span2">
                        <p>Level: <?php echo $heroInfo->level; ?></p>
                    </div>
                    <div class="span4">
                        <h2>Active Skills</h2>
                        <ul>
                        <?php foreach ($heroInfo->skills->active as $skill) : ?>
                            <li><?php echo $skill->skill->name; ?> (<?php echo $skill->skill->categorySlug; ?>)</li>
                        <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <?php endforeach; ?>
            </section>
        </div>
	</body>
</html>