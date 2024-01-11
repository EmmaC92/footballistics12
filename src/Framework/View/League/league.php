<?php include $this->resolvePath('Partials/_header.php'); ?>

<head>
    <link rel="stylesheet" href="/Assets/league.css">
</head>

<h1>Football Teams</h1>

<div id="teams-container">
    <?php foreach ($league as $team) : ?>
        <div class="team">
            <a href="/fixture?teamId=<?php echo $team['team']['id']; ?>&season=<?php echo $season; ?>">
                <img src="<?php echo $team['team']['logo']; ?>" alt="Team 1 Logo" class="team-logo">
                <span class="team-name"><?php echo $team['team']['name']; ?></span>
            </a>
        </div>

    <?php endforeach; ?>
</div>
<?php include $this->resolvePath('Partials/_footer.php'); ?>