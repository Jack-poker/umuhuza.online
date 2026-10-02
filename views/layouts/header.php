<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Expires" content="0" />
  <title>UMUHUZA.ONLINE</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="public/assets/css/style.css?v=<?= urlencode(md5_file(__DIR__ . '/../../public/assets/css/style.css')) ?>" />
  <link rel="stylesheet" href="public/assets/css/design-system.css?v=<?= urlencode(md5_file(__DIR__ . '/../../public/assets/css/design-system.css')) ?>" />
  <link rel="stylesheet" href="public/assets/css/onboarding-premium.css?v=<?= filemtime(__DIR__ . '/../../public/assets/css/onboarding-premium.css') ?>" />
  <link rel="stylesheet" href="public/assets/css/wizard-ui.css?v=<?= filemtime(__DIR__ . '/../../public/assets/css/wizard-ui.css') ?>" />
  <link rel="stylesheet" href="public/assets/css/marketplace-ui.css?v=<?= filemtime(__DIR__ . '/../../public/assets/css/marketplace-ui.css') ?>" />
  <link rel="manifest" href="/public/manifest.json" />
</head>
<body class="marketplace-body">
<header class="marketplace-header fixed-top shadow-sm">
  <nav class="navbar navbar-expand-lg container py-2">
    <?php $currentUser = isLoggedIn() ? currentUser() : null; ?>
    <a class="navbar-brand d-flex align-items-center gap-3 me-3" href="?route=home">
      <img src="public/assets/logo_wide.png?v=<?= filemtime(__DIR__ . '/../../public/assets/logo_wide.png') ?>" alt="UMUHUZA.ONLINE" style="height: 48px; width: auto; object-fit: contain; max-height: 48px;" />
      <span class="d-none d-lg-block text-muted-custom" style="font-size: 0.85rem; border-left: 1px solid rgba(15, 23, 42, 0.12); padding-left: 14px; font-weight: 500; letter-spacing: 0.03em;">
        <span data-i18n="tagline"><?php echo __('tagline'); ?></span>
      </span>
    </a>
    <div class="d-flex align-items-center order-lg-last gap-2">
      <div class="dropdown">
        <button class="btn btn-light btn-sm dropdown-toggle d-flex align-items-center gap-1" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 999px; border: 1px solid #e2e8f0; background: #fff;">
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/><path d="M2 12h20"/></svg>
          <span id="currentLangLabel">EN</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow border-0" style="min-width: 140px; border-radius: 12px; margin-top: 8px;">
          <li><button type="button" class="dropdown-item lang-switch-btn fw-medium py-2" data-lang="en">🇬🇧 English</button></li>
          <li><button type="button" class="dropdown-item lang-switch-btn fw-medium py-2" data-lang="rw">🇷🇼 Kinyarwanda</button></li>
        </ul>
      </div>
      <button class="navbar-toggler border-0 ms-1" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="mainNav">
      <form class="header-search-bar d-flex align-items-center mx-lg-4 my-3 my-lg-0" action="?route=listings" method="GET">
        <input type="hidden" name="route" value="listings" />
        <input class="form-control border-0" type="text" name="q" data-i18n-placeholder="search_placeholder" placeholder="Search homes, services, providers" aria-label="Search" />
        <button class="btn btn-primary btn-sm ms-2" type="submit" data-i18n="search_button">Search</button>
      </form>
      <div class="header-nav d-flex flex-wrap align-items-center gap-2 ms-auto">
        <?php 
          $currRoute = $_GET['route'] ?? 'home';
          $isDashboardRoute = in_array($currRoute, ['provider-dashboard', 'admin-dashboard'], true);
        ?>
        <?php if ($currRoute === 'home'): ?>
        <div class="header-filter-group d-flex align-items-center gap-1 me-2" role="tablist" aria-label="Marketplace filters">
          <button type="button" class="header-filter-chip active" data-market-filter="all" data-i18n="filter_all">All</button>
          <button type="button" class="header-filter-chip" data-market-filter="agent" data-i18n="filter_agents">Agents</button>
          <button type="button" class="header-filter-chip" data-market-filter="service" data-i18n="filter_services">Service Providers</button>
        </div>
        <?php else: ?>
        <a class="nav-link fw-medium" href="?route=home" data-i18n="home">Home</a>
        <?php endif; ?>
        <a class="nav-link fw-medium" href="?route=listings&category=Real+Estate" data-i18n="real_estate">Real Estate</a>
        <a class="nav-link" href="#requestModal" data-bs-toggle="modal" data-i18n="requests">Requests</a>
        <?php if (isLoggedIn()): $notificationCount = $pdo ? NotificationModel::unreadCount($pdo, (int) ($_SESSION['user_id'] ?? 0)) : 0; ?>
          <a class="btn btn-sm btn-primary" href="<?= isAdmin() ? '?route=admin-dashboard' : '?route=provider-dashboard' ?>">Dashboard</a>
          <a id="notificationBell" class="btn btn-light btn-sm position-relative" href="<?= isAdmin() ? '?route=admin-dashboard' : '?route=provider-dashboard' ?>" data-notification-count="<?= (int) $notificationCount ?>">
            <span data-i18n="alerts">Alerts</span>
            <?php if ($notificationCount > 0): ?><span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?= (int) $notificationCount ?></span><?php endif; ?>
          </a>
          <a class="profile-avatar-wrapper" href="<?= isAdmin() ? '?route=admin-dashboard' : '?route=provider-dashboard' ?>" title="Your profile">
            <?php if (!empty($currentUser['profile_image'])): ?>
              <img class="profile-avatar" src="<?= e($currentUser['profile_image']) ?>" alt="Profile photo" loading="lazy" />
            <?php else: ?>
              <span class="profile-avatar profile-avatar-fallback"><?= strtoupper(substr(($currentUser['full_name'] ?? $currentUser['username'] ?? 'PR'), 0, 2)) ?></span>
            <?php endif; ?>
          </a>
          <a class="btn btn-outline-danger btn-sm" href="?route=logout" data-i18n="logout">Logout</a>
        <?php else: ?>
          <?php if ($currRoute !== 'login'): ?>
            <a class="btn btn-primary btn-sm" href="?route=login" data-i18n="login">Login</a>
          <?php endif; ?>
        <?php endif; ?>
      </div>
    </div>
  </nav>
</header>

<?php 
$errorMsg = flash('error');
$successMsg = flash('success');
?>
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11; top: 80px;">
  <?php if ($errorMsg): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="min-width: 300px;">
      <?= e($errorMsg) ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>
  <?php if ($successMsg): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="min-width: 300px;">
      <?= e($successMsg) ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <script>
      (function() {
        const msg = <?= json_encode(strtolower($successMsg)) ?>;
        let sound = null;
        if (msg.includes('payment') || msg.includes('subscription') || msg.includes('activated')) {
          sound = 'success.wav';
        } else if (msg.includes('listing')) {
          sound = 'listing.wav';
        } else if (msg.includes('request') || msg.includes('lead')) {
          sound = 'request.wav';
        }
        if (sound) {
          try {
            const audio = new Audio('public/assets/audio/' + sound);
            audio.play().catch(e => console.log('Audio autoplay blocked or failed:', e));
          } catch(err) {
            console.error('Audio play error:', err);
          }
        }
      })();
    </script>
  <?php endif; ?>
</div>

<main class="pb-5">
