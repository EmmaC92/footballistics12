<?php include $this->resolvePath('Partials/_header.php'); ?>

<head>
    <link rel="stylesheet" href="/Assets/leagues.css">
</head>

<h1>Home</h1>
<div class="league-by-season">
    <form action="/leagues" method="POST">
        <label for="season">Country:</label>
        <select id="country" name="country" required>
            <option value="" disabled selected>Select a Country</option>
            <?php foreach ($countries as $country) : ?>
                <option value="<?php echo $country['name']; ?>"><?php echo $country['name']; ?></option>
            <?php endforeach; ?>
        </select><br><br>
        <?php if (array_key_exists('country', $errors)) : ?>
            <div class="bg-gray-100 mt-2 p-2 text-red-500">
                <?php echo $errors['country'][0]; ?>
            </div>
        <?php endif; ?>

        <label for="season">Season:</label>
        <select id="season" name="season" required>
            <option value="" disabled selected>Select a season</option>
            <option value="2015">2015</option>
            <option value="2016">2016</option>
            <option value="2017">2017</option>
            <option value="2018">2018</option>
            <option value="2019">2019</option>
            <option value="2020">2020</option>
            <option value="2021">2021</option>
            <option value="2022">2022</option>
            <option value="2023">2023</option>
            <option value="2024">2024</option>
        </select><br><br>
        <?php if (array_key_exists('season', $errors)) : ?>
            <div class="bg-gray-100 mt-2 p-2 text-red-500">
                <?php echo $errors['season'][0]; ?>
            </div>
        <?php endif; ?>

        <input type="submit" value="Submit">
    </form>
</div>

<?php include $this->resolvePath('Partials/_footer.php'); ?>