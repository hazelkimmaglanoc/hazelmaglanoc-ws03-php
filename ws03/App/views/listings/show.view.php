<?php
/** @var object $listing */
?>

<?php loadPartial('head'); ?>
<?php loadPartial('navbar'); ?>
<?php loadPartial('message'); ?>

<?php if (!isAuthenticated()): ?>
<div style="background:#eff6ff;border-bottom:1px solid #bfdbfe;padding:.75rem 1rem;text-align:center;font-size:.9rem;color:#1e40af;">
    <i class="fa fa-circle-info"></i>
    You're browsing as a guest.
    <a href="<?= BASE_URL ?>auth/login" style="font-weight:700;text-decoration:underline;">Log in</a>
    or
    <a href="<?= BASE_URL ?>auth/register" style="font-weight:700;text-decoration:underline;">Register</a>
    to post jobs.
</div>
<?php endif; ?>

<style>
/* =========================
   LISTING ACTION BUTTONS
========================= */

.form-shell {
    position: relative;
}

/* TOP RIGHT ACTIONS */
.listing-actions {
    position: absolute;
    top: 16px;
    right: 16px;
    display: flex;
    gap: 8px;
    z-index: 10;
}

/* BUTTON STYLE */
.action-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 0.45rem 0.8rem;
    font-size: 0.8rem;
    font-weight: 700;
    border-radius: 10px;
    border: 1px solid transparent;
    background: #fff;
    cursor: pointer;
    transition: 0.2s ease;
    text-decoration: none;
}

/* EDIT BUTTON */
.action-btn.edit {
    color: #ec4899;
    border-color: #ec4899;
}

.action-btn.edit:hover {
    background: #ec4899;
    color: #fff;
}

/* DELETE BUTTON */
.action-btn.delete {
    color: #ef4444;
    border-color: #ef4444;
}

.action-btn.delete:hover {
    background: #ef4444;
    color: #fff;
}
</style>

<section class="jobs-section">
    <div class="container mx-auto max-w-6xl px-4">

        <div class="back-link-wrap" style="justify-content: flex-start; margin-bottom: 2rem;">
            <a href="<?= BASE_URL ?>listings" class="back-link">
                <i class="fa fa-arrow-left"></i>
                <span>Back to Listings</span>
            </a>
        </div>

        <div class="form-shell" style="margin-bottom: 2rem;">

            <!-- TOP RIGHT ACTIONS -->
            <?php if (isAuthenticated() && (new \Framework\Middleware\Authorization())->isOwner($listing)): ?>
                <div class="listing-actions">

                    <a href="<?= BASE_URL ?>listings/edit/<?= $listing->id ?>" class="action-btn edit">
                        <i class="fa fa-pen-to-square"></i>
                        Edit
                    </a>

                    <form method="POST"
                          action="<?= BASE_URL ?>listings/<?= $listing->id ?>"
                          onsubmit="return confirm('Are you sure you want to delete this listing?');"
                          style="display:inline;">

                        <input type="hidden" name="_method" value="DELETE">

                        <button type="submit" class="action-btn delete">
                            <i class="fa fa-trash"></i>
                            Delete
                        </button>
                    </form>

                </div>
            <?php endif; ?>

            <div class="form-hero">

                <?php
                    $tags = array_map('strtolower', array_map('trim', explode(',', $listing->tags ?? '')));
                    $isOnsite = in_array('onsite', $tags) || in_array('local', $tags);
                ?>

                <span class="form-badge <?= !$isOnsite ? 'remote' : '' ?>">
                    <?= $isOnsite ? 'On-site' : 'Remote' ?>
                </span>

                <h1><?= htmlspecialchars($listing->title) ?></h1>

                <p>
                    <?= htmlspecialchars($listing->company) ?>
                    &mdash;
                    <?= htmlspecialchars($listing->city) ?>, <?= htmlspecialchars($listing->state) ?>
                </p>

            </div>

            <div class="job-form">

                <div class="form-section">
                    <h2>Job Description</h2>
                    <p style="color: #252525; line-height: 1.8;">
                        <?= nl2br(htmlspecialchars($listing->description)) ?>
                    </p>
                </div>

                <div class="form-section">
                    <h2>Position Details</h2>

                    <div class="job-card-meta" style="border-radius: 12px;">

                        <div class="job-meta-row">
                            <span class="job-meta-label">Salary</span>
                            <span class="job-salary"><?= formatSalary($listing->salary) ?>/mo</span>
                        </div>

                        <div class="job-meta-row">
                            <span class="job-meta-label">Location</span>
                            <span class="job-location">
                                <?= htmlspecialchars($listing->city) ?>, <?= htmlspecialchars($listing->state) ?>
                            </span>
                        </div>

                        <div class="job-meta-row">
                            <span class="job-meta-label">Address</span>
                            <span class="job-location">
                                <?= htmlspecialchars($listing->address) ?>
                            </span>
                        </div>

                        <div class="job-meta-row">
                            <span class="job-meta-label">Phone</span>
                            <span class="job-location">
                                <?= htmlspecialchars($listing->phone) ?>
                            </span>
                        </div>

                        <?php if (!empty($listing->tags)): ?>
                        <div class="job-meta-row job-tags-row">
                            <span class="job-meta-label">Tags</span>
                            <div class="job-tags">
                                <?php foreach (explode(',', $listing->tags) as $tag): ?>
                                    <span class="job-tag"><?= htmlspecialchars(trim($tag)) ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>

                    </div>
                </div>

                <div class="form-section">
                    <h2>Requirements</h2>
                    <p style="color: #252525; line-height: 1.8;">
                        <?= nl2br(htmlspecialchars($listing->requirements)) ?>
                    </p>
                </div>

                <div class="form-section">
                    <h2>Benefits</h2>
                    <p style="color: #252525; line-height: 1.8;">
                        <?= nl2br(htmlspecialchars($listing->benefits)) ?>
                    </p>
                </div>

                <div class="action-row">

                    <a href="mailto:<?= htmlspecialchars($listing->email) ?>?subject=Job Application" class="btn btn-primary">
                        <i class="fa fa-paper-plane"></i>
                        Apply Now
                    </a>

                    <a href="<?= BASE_URL ?>listings" class="btn btn-secondary">
                        <i class="fa fa-briefcase"></i>
                        Browse More Jobs
                    </a>

                </div>

            </div>
        </div>

    </div>
</section>

<?php loadPartial('bottom-banner'); ?>
<?php loadPartial('footer'); ?>