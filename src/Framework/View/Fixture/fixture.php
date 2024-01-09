<?php include $this->resolvePath('Partials/_header.php'); ?>
<div class='fixture-page'>
    <?php foreach ($fixtures as $fixture) : ?>
        <div class='fixture-match'>
            <div class='home-team'>
                <?php $home = $fixture['teams']['home']; ?>
                Home: <?php echo $home['name']; ?>
                <img src="<?php echo $home['logo']; ?>" alt="<?php echo $home['name']; ?>">
            </div>
            <div class='away-team'>
                <?php $away = $fixture['teams']['away']; ?>
                Away: <?php echo $away['name']; ?>
                <img src="<?php echo $away['logo']; ?>" alt="<?php echo $away['name']; ?>">
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php include $this->resolvePath('Partials/_footer.php'); ?>