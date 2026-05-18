<?php
/** @var string $status */
/** @var string $message */
?>
<?php loadPartial('head'); ?>
<?php loadPartial('navbar'); ?>

<section class="error-page">
    <div class="error-wrap">
        <div class="error-card">
            <div class="error-icon-wrap">
                <div class="error-icon-spin">
                    <i class="fa fa-exclamation-circle"></i>
                </div>
            </div>

            <span class="error-badge">Error <?= htmlspecialchars($status) ?></span>
            <h1 class="error-title"><?= $status === '404' ? 'Page Not Found' : 'Something Went Wrong' ?></h1>
            <p class="error-text">
                <?= htmlspecialchars($message) ?>
            </p>

            <div class="error-actions">
                <a href="<?= BASE_URL ?>" class="btn error-btn-primary">
                    <i class="fa fa-house"></i>
                    Back to Home
                </a>
                <a href="<?= BASE_URL ?>listings" class="btn error-btn-secondary">
                    <i class="fa fa-briefcase"></i>
                    Browse Jobs
                </a>
            </div>
        </div>
    </div>
</section>

<?php loadPartial('footer'); ?>
