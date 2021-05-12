<?php
    require_once 'core/Bootstrap.php';
    $poll->submitVote();
    $results = $poll->getOptions();
    $pageTitle = 'Poll Results';

require 'views/header.php';
?>
<h1><?= $pageTitle; ?></h1>
<hr>
<?php if (isset($_SESSION['flash'])) { ?>
    <div class="success-message" role="alert">
        <?= $_SESSION['flash']; ?>
        <?php unset($_SESSION['flash']); ?>
        <?php session_destroy(); ?>
    </div>
<?php } ?>
<?php foreach ($results as $option_result): ?>
    <div class="option-results">
        <div class="name">
            <?= stringToTitle($option_result['option_item']); ?>:
        </div>
        <div class="count">
            <?= $option_result['count']; ?>
        </div>
    </div>
<?php endforeach; ?>
<hr>
<a class="footer-link" href="index.php">< Back to poll</a>

<?php require 'views/footer.php'; ?>