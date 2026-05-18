<?php
/** @var object $listing */
/** @var array  $errors  */
$errors ??= [];
?>
<?php loadPartial('head') ?>
<?php loadPartial('navbar') ?>

<section class="create-page">
  <div class="create-wrap">
    <div class="form-shell">
      <div class="form-hero">
        <h1>Edit Job Information</h1>
        <p>Make changes to the job listing below, then save to update it.</p>
      </div>

      <?php loadPartial('errors', ['errors' => $errors]) ?>

      <form method="POST" action="<?= BASE_URL ?>listings/<?= $listing->id ?>" class="job-form">
        <input type="hidden" name="_method" value="PUT">

        <div class="form-section">
          <h2>Position Information</h2>
          <div class="form-grid">
            <div class="form-group full">
              <label for="title">Job Title</label>
              <input type="text" id="title" name="title"
                     value="<?= htmlspecialchars($listing->title) ?>"
                     placeholder="e.g. Grade 10 Math Teacher"
                     class="form-input <?= isset($errors['title']) ? 'input-error' : '' ?>" />
              <?php if (isset($errors['title'])): ?><p class="field-error"><?= htmlspecialchars($errors['title']) ?></p><?php endif; ?>
            </div>
            <div class="form-group full">
              <label for="description">Job Description</label>
              <textarea id="description" name="description" rows="5"
                        placeholder="Describe the role, subject area, grade level, and daily responsibilities..."
                        class="form-input <?= isset($errors['description']) ? 'input-error' : '' ?>"><?= htmlspecialchars($listing->description) ?></textarea>
              <?php if (isset($errors['description'])): ?><p class="field-error"><?= htmlspecialchars($errors['description']) ?></p><?php endif; ?>
            </div>
            <div class="form-group">
              <label for="salary">Monthly Salary</label>
              <input type="text" id="salary" name="salary"
                     value="<?= htmlspecialchars($listing->salary) ?>"
                     placeholder="₱28,000"
                     class="form-input <?= isset($errors['salary']) ? 'input-error' : '' ?>" />
              <?php if (isset($errors['salary'])): ?><p class="field-error"><?= htmlspecialchars($errors['salary']) ?></p><?php endif; ?>
            </div>
            <div class="form-group">
              <label for="requirements">Requirements</label>
              <input type="text" id="requirements" name="requirements"
                     value="<?= htmlspecialchars($listing->requirements) ?>"
                     placeholder="LET Passer, BSEd, 2 yrs experience"
                     class="form-input" />
            </div>
            <div class="form-group full">
              <label for="benefits">Benefits</label>
              <input type="text" id="benefits" name="benefits"
                     value="<?= htmlspecialchars($listing->benefits) ?>"
                     placeholder="HMO, tenure track, summer pay, housing allowance"
                     class="form-input" />
            </div>
            <div class="form-group full">
              <label for="tags">Tags</label>
              <input type="text" id="tags" name="tags"
                     value="<?= htmlspecialchars($listing->tags) ?>"
                     placeholder="e.g. Math, Science, Elementary"
                     class="form-input" />
            </div>
          </div>
        </div>

        <div class="form-section">
          <h2>School / Institution &amp; Location</h2>
          <div class="form-grid">
            <div class="form-group full">
              <label for="company">School / Institution Name</label>
              <input type="text" id="company" name="company"
                     value="<?= htmlspecialchars($listing->company) ?>"
                     placeholder="e.g. Quezon City National High School"
                     class="form-input <?= isset($errors['company']) ? 'input-error' : '' ?>" />
              <?php if (isset($errors['company'])): ?><p class="field-error"><?= htmlspecialchars($errors['company']) ?></p><?php endif; ?>
            </div>
            <div class="form-group full">
              <label for="address">Address</label>
              <input type="text" id="address" name="address"
                     value="<?= htmlspecialchars($listing->address) ?>"
                     placeholder="123 Rizal Avenue"
                     class="form-input" />
            </div>
            <div class="form-group">
              <label for="city">City / Municipality</label>
              <input type="text" id="city" name="city"
                     value="<?= htmlspecialchars($listing->city) ?>"
                     placeholder="Quezon City"
                     class="form-input <?= isset($errors['city']) ? 'input-error' : '' ?>" />
              <?php if (isset($errors['city'])): ?><p class="field-error"><?= htmlspecialchars($errors['city']) ?></p><?php endif; ?>
            </div>
            <div class="form-group">
              <label for="state">Province / Region</label>
              <input type="text" id="state" name="state"
                     value="<?= htmlspecialchars($listing->state) ?>"
                     placeholder="Metro Manila"
                     class="form-input <?= isset($errors['state']) ? 'input-error' : '' ?>" />
              <?php if (isset($errors['state'])): ?><p class="field-error"><?= htmlspecialchars($errors['state']) ?></p><?php endif; ?>
            </div>
            <div class="form-group">
              <label for="phone">Contact Number</label>
              <input type="text" id="phone" name="phone"
                     value="<?= htmlspecialchars($listing->phone) ?>"
                     placeholder="+63 912 345 6789"
                     class="form-input" />
            </div>
            <div class="form-group">
              <label for="email">Application Email</label>
              <input type="email" id="email" name="email"
                     value="<?= htmlspecialchars($listing->email ?? '') ?>"
                     placeholder="hiring@school.edu.ph"
                     class="form-input <?= isset($errors['email']) ? 'input-error' : '' ?>" />
              <?php if (isset($errors['email'])): ?><p class="field-error"><?= htmlspecialchars($errors['email']) ?></p><?php endif; ?>
            </div>
          </div>
        </div>

        <div class="action-row">
          <button type="submit" class="btn btn-primary">
            Save Changes
          </button>
          <a href="<?= BASE_URL ?>listings/<?= $listing->id ?>" class="btn btn-secondary">
            Cancel
          </a>
        </div>
      </form>
    </div>
  </div>
</section>

<?php loadPartial('footer') ?>
