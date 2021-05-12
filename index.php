<?php
    require_once 'core/Bootstrap.php';
    $poll->setQuestion('What is your favourite colour?');
    $options = $poll->getOptions();
    $poll->submitVote();
    $pageTitle = 'Voting Poll';

require 'views/header.php';
?>
<h1><?= $poll->getQuestion(); ?></h1>
<hr>
<form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <?php foreach ($options as $option): ?>
        <div class="option">
            <input type="radio" name="option_item" value="<?= $option['option_item']; ?>">
            <label for="option"><?= stringToTitle($option['option_item']); ?></label>
        </div>
    <?php endforeach; ?>
    <div>
        <button type="submit">Submit</button>
    </div>
</form>
<hr>
<a class="footer-link" href="results.php">View results</a>
<?php require 'views/footer.php'; ?>