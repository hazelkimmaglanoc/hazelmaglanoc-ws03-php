<section class="hero-section">

    <div class="overlay"></div>

    <div class="container mx-auto hero-content">
        <?php loadPartial('message') ?>

        <h2>Find your next career opportunity</h2>
        <p>
            Building brighter careers for mothers everywhere.
        </p>

        <form class="hero-search-form" action="<?= BASE_URL ?>listings/search" method="GET">
            <div class="input-group">
                <i class="fa fa-search"></i>
                <input type="text" name="keywords" placeholder="Position (e.g. Online Tutor)" />
            </div>

            <div class="input-group">
                <i class="fa fa-location-dot"></i>
                <input type="text" name="location" placeholder="Location" />
            </div>

            <button class="btn btn-primary search-btn">
                Find Jobs
            </button>
        </form>

        </div>
    </div>
</section>