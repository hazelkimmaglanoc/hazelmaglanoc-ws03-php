<?php
/** @var array $errors */
/** @var array $fields */
$errors ??= [];
$fields ??= [];
?>
<?php loadPartial('head') ?>
<?php loadPartial('navbar') ?>

<section class="create-page">
  <div class="create-wrap">
    <div class="form-shell">
      <div class="form-hero">
        <h1>Post a Job</h1>
        <p>Share flexible jobs for working mothers.</p>
      </div>

      <?php if (!empty($errors)): ?>
        <div class="error-summary" style="background:#fee2e2;border:1px solid #fca5a5;border-radius:8px;padding:1rem 1.25rem;margin-bottom:1.5rem;">
          <p style="font-weight:600;color:#b91c1c;margin-bottom:.5rem;">Please fix the following errors:</p>
          <ul style="margin:0;padding-left:1.25rem;color:#b91c1c;">
            <?php foreach ($errors as $error): ?>
              <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <form method="POST" action="<?= BASE_URL ?>listings" class="job-form">
        <div class="form-section">
          <h2>Position Information</h2>
          <div class="form-grid">
            <div class="form-group full">
              <label for="title">Job Title</label>
              <input type="text" id="title" name="title" value="<?= htmlspecialchars($fields['title'] ?? '') ?>" placeholder="e.g. Social Media Assistant" class="form-input <?= isset($errors['title']) ? 'input-error' : '' ?>" />
              <?php if (isset($errors['title'])): ?><p class="field-error"><?= htmlspecialchars($errors['title']) ?></p><?php endif; ?>
            </div>
            <div class="form-group full">
              <label for="description">Job Description</label>
              <textarea id="description" name="description" rows="5" placeholder="e.g. Manage posts, comments, and messages for business social media pages." class="form-input <?= isset($errors['description']) ? 'input-error' : '' ?>"><?= htmlspecialchars($fields['description'] ?? '') ?></textarea>
              <?php if (isset($errors['description'])): ?><p class="field-error"><?= htmlspecialchars($errors['description']) ?></p><?php endif; ?>
            </div>
            <div class="form-group">
              <label for="salary">Monthly Salary</label>
              <input type="text" id="salary" name="salary" value="<?= htmlspecialchars($fields['salary'] ?? '') ?>" placeholder="₱30,000" class="form-input <?= isset($errors['salary']) ? 'input-error' : '' ?>" />
              <?php if (isset($errors['salary'])): ?><p class="field-error"><?= htmlspecialchars($errors['salary']) ?></p><?php endif; ?>
            </div>
            <div class="form-group">
              <label for="requirements">Requirements</label>
              <input type="text" id="requirements" name="requirements" value="<?= htmlspecialchars($fields['requirements'] ?? '') ?>" placeholder="e.g.Familiar with Facebook and Instagram" class="form-input" />
            </div>
            <div class="form-group full">
              <label for="benefits">Benefits</label>
              <input type="text" id="benefits" name="benefits" value="<?= htmlspecialchars($fields['benefits'] ?? '') ?>" placeholder="e.g. Remote work, Flexible time" class="form-input" />
            </div>
            <div class="form-group full">
              <label for="tags">Tags</label>
              <input type="text" id="tags" name="tags" value="<?= htmlspecialchars($fields['tags'] ?? '') ?>" placeholder="e.g. Social Media, Techy, Creative" class="form-input" />
            </div>
          </div>
        </div>

        <div class="form-section">
          <h2>Location</h2>
          <div class="form-grid">
            <div class="form-group full">
              <label for="company">Comapny/Organization Name</label>
              <input type="text" id="company" name="company" value="<?= htmlspecialchars($fields['company'] ?? '') ?>" placeholder="e.g. TrendHive Digital" class="form-input <?= isset($errors['company']) ? 'input-error' : '' ?>" />
              <?php if (isset($errors['company'])): ?><p class="field-error"><?= htmlspecialchars($errors['company']) ?></p><?php endif; ?>
            </div>
            <div class="form-group full">
              <label for="address">Address</label>
              <input type="text" id="address" name="address" value="<?= htmlspecialchars($fields['address'] ?? '') ?>" placeholder="345 Rizal St" class="form-input" />
            </div>
            <div class="form-group">
              <label for="city">City / Municipality</label>
              <input type="text" id="city" name="city" value="<?= htmlspecialchars($fields['city'] ?? '') ?>" placeholder="e.g. Cabanatuan" class="form-input <?= isset($errors['city']) ? 'input-error' : '' ?>" />
              <?php if (isset($errors['city'])): ?><p class="field-error"><?= htmlspecialchars($errors['city']) ?></p><?php endif; ?>
            </div>
            <div class="form-group">
              <label for="state">Province / Region</label>
              <input type="text" id="state" name="state" value="<?= htmlspecialchars($fields['state'] ?? '') ?>" placeholder="e.g. Nueva Ecija" class="form-input <?= isset($errors['state']) ? 'input-error' : '' ?>" />
              <?php if (isset($errors['state'])): ?><p class="field-error"><?= htmlspecialchars($errors['state']) ?></p><?php endif; ?>
            </div>
            <div class="form-group">
              <label for="phone">Contact Number</label>
              <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($fields['phone'] ?? '') ?>" placeholder="+63 123 456 7890" class="form-input" />
            </div>
            <div class="form-group">
              <label for="email">Application Email</label>
              <input type="email" id="email" name="email" value="<?= htmlspecialchars($fields['email'] ?? '') ?>" placeholder="e.g. THDigital@gmail.com" class="form-input <?= isset($errors['email']) ? 'input-error' : '' ?>" />
              <?php if (isset($errors['email'])): ?><p class="field-error"><?= htmlspecialchars($errors['email']) ?></p><?php endif; ?>
            </div>
          </div>
        </div>

        <div class="action-row">
          <button type="submit" class="btn btn-primary">
            Post Position
          </button>
          <a href="<?= BASE_URL ?>" class="btn btn-secondary">
            Cancel
          </a>
        </div>
      </form>
    </div>
  </div>
</section>

<?php loadPartial('footer') ?>
