<?php
/** @var array $errors */
/** @var array $fields */
$errors ??= [];
$fields ??= [];
?>
<?php loadPartial('head') ?>
<?php loadPartial('navbar') ?>

<section class="create-page">
  <div class="create-wrap" style="max-width: 520px;">
    <div class="form-shell">
      <div class="form-hero">
        <h1>Create an Account</h1>
        <p>Explore flexible and work-from-home jobs for moms in the Philippines.</p>
      </div>

      <?php loadPartial('errors', ['errors' => $errors]) ?>

      <form method="POST" action="<?= BASE_URL ?>auth/register" class="job-form">
        <div class="form-section">
          <div class="form-grid">

            <div class="form-group full">
              <label for="name">Full Name</label>
              <input type="text" id="name" name="name"
                     value="<?= htmlspecialchars($fields['name'] ?? '') ?>"
                     placeholder="Juan dela Cruz"
                     class="form-input <?= isset($errors['name']) ? 'input-error' : '' ?>" />
              <?php if (isset($errors['name'])): ?><p class="field-error"><?= htmlspecialchars($errors['name']) ?></p><?php endif; ?>
            </div>

            <div class="form-group full">
              <label for="email">Email Address</label>
              <input type="email" id="email" name="email"
                     value="<?= htmlspecialchars($fields['email'] ?? '') ?>"
                     placeholder="juan@example.com"
                     class="form-input <?= isset($errors['email']) ? 'input-error' : '' ?>" />
              <?php if (isset($errors['email'])): ?><p class="field-error"><?= htmlspecialchars($errors['email']) ?></p><?php endif; ?>
            </div>

            <div class="form-group">
              <label for="city">City</label>
              <input type="text" id="city" name="city"
                     value="<?= htmlspecialchars($fields['city'] ?? '') ?>"
                     placeholder="Quezon City"
                     class="form-input" />
            </div>

            <div class="form-group">
              <label for="state">Province / Region</label>
              <input type="text" id="state" name="state"
                     value="<?= htmlspecialchars($fields['state'] ?? '') ?>"
                     placeholder="Metro Manila"
                     class="form-input" />
            </div>

            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" id="password" name="password"
                     placeholder="At least 6 characters"
                     class="form-input <?= isset($errors['password']) ? 'input-error' : '' ?>" />
              <?php if (isset($errors['password'])): ?><p class="field-error"><?= htmlspecialchars($errors['password']) ?></p><?php endif; ?>
            </div>

            <div class="form-group">
              <label for="password_confirm">Confirm Password</label>
              <input type="password" id="password_confirm" name="password_confirm"
                     placeholder="Repeat your password"
                     class="form-input <?= isset($errors['password_confirm']) ? 'input-error' : '' ?>" />
              <?php if (isset($errors['password_confirm'])): ?><p class="field-error"><?= htmlspecialchars($errors['password_confirm']) ?></p><?php endif; ?>
            </div>

          </div>
        </div>

        <div class="action-row">
          <button type="submit" class="btn btn-primary" style="width:100%;">
            <i class="fa fa-user-plus"></i>
            Create Account
          </button>
        </div>

        <p style="text-align:center;margin-top:1rem;color:#6b7280;font-size:.9rem;">
          Already have an account?
          <a href="<?= BASE_URL ?>auth/login" style="color:#6366f1;font-weight:600;">Log in</a>
        </p>
      </form>
    </div>
  </div>
</section>

<?php loadPartial('footer') ?>
