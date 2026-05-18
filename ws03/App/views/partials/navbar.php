<header class="site-header">
    <div class="container mx-auto max-w-6xl px-4">
        <div class="header-inner">
            <h1 class="brand">
                <a href="<?= BASE_URL ?>">
                    <span class="brand-text">WorkNest</span></span>
                </a>
            </h1>

            <nav class="main-nav">
                <?php if (\Framework\Session::has('user')) : ?>

                    <span class="nav-link" style="color:white ;font-weight:600;">
                        <?= htmlspecialchars(\Framework\Session::get('user')['name']) ?>
                    </span>
                    <form method="POST" action="<?= BASE_URL ?>auth/logout" style="display:inline;">
                        <button type="submit" class="nav-link" style="background:none;border:none;cursor:pointer;padding:0;">Logout</button>
                    </form>
                    <a href="<?= BASE_URL ?>listings/create" class="btn btn-primary nav-cta">
                        <span>Post a Job</span>
                    </a>

                <?php else : ?>
                    <a href="<?= BASE_URL ?>auth/login" class="nav-link">Login</a>
                    <a href="<?= BASE_URL ?>auth/register" class="nav-link">Register</a>
                <?php endif; ?>
            </nav>
        </div>
    </div>

</header>