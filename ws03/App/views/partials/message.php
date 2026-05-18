<?php $flash = getFlashMessage(); ?>

<?php if ($flash): ?>
<div class="flash-message flash-<?= htmlspecialchars($flash['type']) ?>" role="alert">
    <div class="flash-inner">
        <?php if ($flash['type'] === 'success'): ?>
            <i class="fa fa-circle-check flash-icon"></i>
        <?php elseif ($flash['type'] === 'error'): ?>
            <i class="fa fa-circle-xmark flash-icon"></i>
        <?php else: ?>
            <i class="fa fa-triangle-exclamation flash-icon"></i>
        <?php endif; ?>
        <span><?= htmlspecialchars($flash['message']) ?></span>
        <button class="flash-close" onclick="this.parentElement.parentElement.remove();" aria-label="Close">
            <i class="fa fa-xmark"></i>
        </button>
    </div>
</div>

<style>
.flash-message {
    margin: 1rem auto;
    max-width: 72rem;
    padding: 0 1rem;
    animation: flashSlideIn .3s ease;
}
@keyframes flashSlideIn {
    from { opacity: 0; transform: translateY(-10px); }
    to   { opacity: 1; transform: translateY(0); }
}
.flash-inner {
    display: flex;
    align-items: center;
    gap: .75rem;
    padding: .9rem 1.2rem;
    border-radius: 10px;
    font-weight: 500;
    font-size: .95rem;
}
.flash-success .flash-inner {
    background: #dcfce7;
    border: 1px solid #86efac;
    color: #166534;
}
.flash-error .flash-inner {
    background: #fee2e2;
    border: 1px solid #fca5a5;
    color: #991b1b;
}
.flash-warning .flash-inner {
    background: #fef9c3;
    border: 1px solid #fde047;
    color: #854d0e;
}
.flash-icon { font-size: 1.1rem; }
.flash-close {
    margin-left: auto;
    background: none;
    border: none;
    cursor: pointer;
    color: inherit;
    opacity: .6;
    font-size: 1rem;
    line-height: 1;
    padding: 0;
}
.flash-close:hover { opacity: 1; }
</style>
<?php endif; ?>
