<?php
/** @var array $errors */
/** @var array $fields */
$errors ??= [];
$fields ??= [];
?>
<?php loadPartial('head') ?>
<?php loadPartial('navbar') ?>
<?php loadPartial('message') ?>

<section class="create-page">
  <div class="create-wrap" style="max-width: 480px;">
    <div class="form-shell">
      <div class="form-hero">
        <span class="form-badge">Welcome Back</span>
        <h1>Log In</h1>
        <p>Sign in to manage your job listings.</p>
      </div>

      <?php loadPartial('errors', ['errors' => $errors]) ?>

      <form method="POST" action="<?= BASE_URL ?>auth/login" class="job-form">
        <div class="form-section">
          <div class="form-grid">

            <div class="form-group full">
              <label for="email">Email Address</label>
              <input type="email" id="email" name="email"
                     value="<?= htmlspecialchars($fields['email'] ?? '') ?>"
                     placeholder="juan@example.com"
                     class="form-input <?= isset($errors['email']) ? 'input-error' : '' ?>" />
              <?php if (isset($errors['email'])): ?><p class="field-error"><?= htmlspecialchars($errors['email']) ?></p><?php endif; ?>
            </div>

            <div class="form-group full">
              <label for="password">Password</label>
              <input type="password" id="password" name="password"
                     placeholder="Your password"
                     class="form-input <?= isset($errors['password']) ? 'input-error' : '' ?>" />
              <?php if (isset($errors['password'])): ?><p class="field-error"><?= htmlspecialchars($errors['password']) ?></p><?php endif; ?>
            </div>

          </div>
        </div>

        <div class="action-row">
          <button type="submit" class="btn btn-primary" style="width:100%;">
            <i class="fa fa-right-to-bracket"></i>
            Log In
          </button>
        </div>

        <p style="text-align:center;margin-top:1rem;color:#6b7280;font-size:.9rem;">
          Don't have an account?
          <a href="<?= BASE_URL ?>auth/register" style="color:#6366f1;font-weight:600;">Register</a>
        </p>
      </form>
    </div>
  </div>
</section>

<?php loadPartial('footer') ?>
