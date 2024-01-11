<?php include $this->resolvePath('Partials/_header.php'); ?>

<head>
    <link rel="stylesheet" href="Assets/fixture.css">
</head>

<h1>Football Matches</h1>
<div class='fixture-page'>
    <?php foreach ($fixtures as $fixture) : ?>
        <?php $home = $fixture['teams']['home']; ?>
        <?php $away = $fixture['teams']['away']; ?>

        <div id="matches-container">
            <div class="match">
                <div class="team-home">
                    <img src=" <?php echo $home['logo']; ?>" alt="Team 1 Logo" class="team-logo">
                    <span class="team-name"><?php echo $home['name']; ?></span>
                </div>
                <div class="team-scores">
                    <strong class="match-date"><?php echo $fixture['league']['name']; ?></strong><br>
                    <span class="match-date"><?php echo date('d-M-Y', strtotime($fixture['fixture']['date'])); ?></span>
                    <span class="score"><?php echo $fixture['goals']['home']; ?> - <?php echo $fixture['goals']['away']; ?></span>
                    <?php if ($fixture['score']['penalty']['home']) : ?>
                        <span class="score">(<?php echo $fixture['score']['penalty']['home']; ?> - <?php echo $fixture['score']['penalty']['away']; ?>)</span>
                    <?php endif; ?>
                </div>
                <div class="team-away">
                    <img src=" <?php echo $away['logo']; ?>" alt="Team 2 Logo" class="team-logo">
                    <span class="team-name"><?php echo $away['name']; ?></span>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php include $this->resolvePath('Partials/_footer.php'); ?>