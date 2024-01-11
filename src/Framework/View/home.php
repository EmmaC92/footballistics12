<?php include $this->resolvePath('Partials/_header.php'); ?>

<head>
    <link rel="stylesheet" href="/Assets/league.css">
</head>

<div class='argentine-leagues-page'>
    <div class="league-title">
        All argentine Leagues!
    </div>

    <div class='leagues'>
        <?php foreach ($leagues as $league) : ?>
            <div class='league-item'>
                <a href="">
                    <img src="<?php echo $league['league']['logo'] ?>" alt="<?php echo $league['league']['name']; ?>">
                    <strong>
                        <?php echo $league['league']['name']; ?>
                    </strong>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php include $this->resolvePath('Partials/_footer.php'); ?>