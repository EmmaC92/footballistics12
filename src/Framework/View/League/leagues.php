<?php include $this->resolvePath('Partials/_header.php'); ?>

<head>
    <link rel="stylesheet" href="Assets/leagues.css">
</head>

<h1>Football Leagues</h1>

<div class="league-page">
    <form action="/league" method="POST">
        <label for="league">League:</label>
        <select id="league" name="league" required>
            <option value="" disabled selected>Select a league</option>
            <?php foreach ($leagues as $league) : ?>
                <option value="<?php echo $league['league']['id']; ?>"><?php echo $league['league']['name']; ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <input type="submit" value="Submit">
    </form>
</div>
<?php include $this->resolvePath('Partials/_footer.php'); ?>