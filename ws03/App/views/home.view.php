<?php

/** @var array $listings */
?>
<?php loadPartial('head'); ?>
<?php loadPartial('navbar'); ?>
<?php loadPartial('showcase-search'); ?>

<section class="jobs-section">
    
    <div class="container mx-auto max-w-6xl px-4">
        <div class="jobs-section-header">
            <h2 class="jobs-section-title">Job List</h2>
            <p class="jobs-section-subtitle">
                Discover flexible, trusted jobs for moms who want to earn while staying with their family.
            </p>
        </div>

        <div class="jobs-grid">
            <?php if (empty($listings)): ?>
                <p style="text-align:center; color: #6366f1; grid-column: 1/-1;">
                    No job listings yet. <a href="<?= BASE_URL ?>listings/create" style="color:#4338ca; font-weight:700;">Post the first one!</a>
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

        <div class="jobs-footer-link-wrap">
            <a href="<?= BASE_URL ?>listings" class="jobs-footer-link">
                <span>Show All Jobs</span>
                <i class="fa fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<?php loadPartial('bottom-banner'); ?>
<?php loadPartial('footer'); ?>