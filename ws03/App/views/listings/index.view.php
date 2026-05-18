<?php
/** @var array  $listings */
/** @var string $keywords */
/** @var string $location */
$keywords ??= '';
$location ??= '';
$isSearch = !empty($keywords) || !empty($location);
?>
<?php loadPartial('head') ?>
<?php loadPartial('navbar') ?>
<?php loadPartial('message') ?>

<?php if (!isAuthenticated()): ?>
<div style="background:#eff6ff;border-bottom:1px solid #bfdbfe;padding:.75rem 1rem;text-align:center;font-size:.9rem;color:#1e40af;">
    <i class="fa fa-circle-info"></i>
    You're browsing as a guest.
    <a href="<?= BASE_URL ?>auth/login" style="font-weight:700;text-decoration:underline;">Log in</a>
    or
    <a href="<?= BASE_URL ?>auth/register" style="font-weight:700;text-decoration:underline;">Register</a>
    to post your own teaching jobs.
</div>
<?php endif; ?>

<section class="jobs-section">
    <div class="container mx-auto max-w-6xl px-4">
        <div class="jobs-section-header">
            <?php if ($isSearch): ?>
                <span class="jobs-section-badge"><i class="fa fa-magnifying-glass"></i> Search Results</span>
                <h1 class="jobs-section-title">
                    Results<?= !empty($keywords) ? ' for "<strong>' . htmlspecialchars($keywords) . '</strong>"' : '' ?>
                    <?= !empty($location) ? ' in <strong>' . htmlspecialchars($location) . '</strong>' : '' ?>
                </h1>
                <p class="jobs-section-subtitle"><?= count($listings) ?> job<?= count($listings) !== 1 ? 's' : '' ?> found &nbsp;
                    <a href="<?= BASE_URL ?>listings" style="color:#4338ca;font-weight:600;">Clear search</a>
                </p>
            <?php else: ?>
                <h1 class="jobs-section-title">Browse a Jobs</h1>
                <p class="jobs-section-subtitle">
                    Find opportunities that match your skills.
                </p>
            <?php endif; ?>
        </div>

        <div class="jobs-grid">
            <?php if (empty($listings)): ?>
                <p style="text-align:center; color: #6366f1; grid-column: 1/-1; padding: 3rem 0;">
                    <?php if ($isSearch): ?>
                        No jobs matched your search. <a href="<?= BASE_URL ?>listings" style="color:#4338ca;font-weight:700;">Browse all jobs</a>
                    <?php else: ?>
                        No job listings yet. <a href="<?= BASE_URL ?>listings/create" style="color:#4338ca; font-weight:700;">Post the first one!</a>
                    <?php endif; ?>
                </p>
            <?php else: ?>
                <?php foreach ($listings as $listing): ?>
                    <article class="job-card">
                        <div class="job-card-content">
                            <div class="job-card-top">
                                <span class="job-card-category"><?= htmlspecialchars($listing->city) ?></span>
                                <?php
                                    $cardTags = array_map('strtolower', array_map('trim', explode(',', $listing->tags ?? '')));
                                    $cardOnsite = in_array('onsite', $cardTags) || in_array('local', $cardTags);
                                ?>
                                <span class="job-badge <?= !$cardOnsite ? 'remote' : '' ?>"><?= $cardOnsite ? 'On-site' : 'Remote' ?></span>
                            </div>
                            <h3 class="job-card-title"><?= htmlspecialchars($listing->title) ?></h3>
                            <p class="job-card-description"><?= htmlspecialchars($listing->description) ?></p>
                            <div class="job-card-bottom">
                            <div class="job-card-meta">
                                <div class="job-meta-row">
                                    <span class="job-meta-label">Salary</span>
                                    <span class="job-salary"><?= formatSalary($listing->salary) ?>/mo</span>
                                </div>
                                <div class="job-meta-row">
                                    <span class="job-meta-label">Location</span>
                                    <span class="job-location"><?= htmlspecialchars($listing->city) ?>, <?= htmlspecialchars($listing->state) ?></span>
                                </div>
                                <div class="job-meta-row">
                                    <span class="job-meta-label">School</span>
                                    <span class="job-location"><?= htmlspecialchars($listing->company) ?></span>
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
                            <a href="<?= BASE_URL ?>listings/<?= $listing->id ?>" class="job-details-btn">View Details</a>
                            </div><!-- /.job-card-bottom -->
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="back-link-wrap">
            <a href="<?= BASE_URL ?>" class="back-link">
                <i class="fa fa-arrow-left"></i>
                <span>Back to Home</span>
            </a>
        </div>
    </div>
</section>

<?php loadPartial('bottom-banner') ?>
<?php loadPartial('footer') ?>
