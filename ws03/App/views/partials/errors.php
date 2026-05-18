<?php
/** @var array $errors */
if (empty($errors)) return;
?>
<div class="error-summary" role="alert">
    <div class="error-summary-header">
        <i class="fa fa-circle-exclamation"></i>
        <p>Please fix the following errors before continuing:</p>
    </div>
    <ul>
        <?php foreach ($errors as $error): ?>
            <li><?= htmlspecialchars($error) ?></li>
        <?php endforeach; ?>
    </ul>
</div>

<style>
.error-summary {
    background: #fee2e2;
    border: 1px solid #fca5a5;
    border-radius: 10px;
    padding: 1rem 1.25rem;
    margin-bottom: 1.5rem;
    animation: flashSlideIn .3s ease;
}
.error-summary-header {
    display: flex;
    align-items: center;
    gap: .5rem;
    color: #b91c1c;
    font-weight: 600;
    margin-bottom: .5rem;
}
.error-summary-header i {
    font-size: 1rem;
}
.error-summary ul {
    margin: 0;
    padding-left: 1.5rem;
    color: #991b1b;
    font-size: .9rem;
    display: flex;
    flex-direction: column;
    gap: .2rem;
}
</style>
