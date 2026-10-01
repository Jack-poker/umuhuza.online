<?php include __DIR__ . '/../layouts/header.php'; ?>
<section class="container py-5">
  <div class="row g-4">
    <aside class="col-lg-4 panel p-4">
      <div class="d-flex align-items-center gap-3 mb-3">
        <div class="rounded-circle bg-primary text-white d-grid place-items-center" style="width:68px;height:68px;font-size:1.1rem;"><?= strtoupper(substr(e(($listing['provider_name'] ?? 'Provider')),0,2)) ?></div>
        <div>
          <h2 class="fw-bold mb-1"><?= e(($listing['provider_name'] ?? 'Provider')) ?></h2>
          <p class="text-muted-custom small mb-0">Verified provider • <?= e(($listing['rating'] ?? '4.5')) ?> rating</p>
        </div>
      </div>
      <p class="small text-muted-custom mb-1"><strong>Phone:</strong> <?= e(($listing['phone'] ?? '')) ?></p>
      <p class="small text-muted-custom mb-1"><strong>WhatsApp:</strong> <?= e(($listing['whatsapp'] ?? '')) ?></p>
      <p class="small text-muted-custom mb-1"><strong>Plan:</strong> <?= e(($listing['plan_name'] ?? 'Free')) ?></p>
      <p class="small text-muted-custom mb-1"><strong>Status:</strong> <?= e(($listing['provider_status'] ?? 'active')) ?></p>
      <div class="d-flex gap-2 mt-3">
        <a class="btn btn-primary" href="tel:<?= e(($listing['phone'] ?? '')) ?>"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>Call</a>
        <a class="btn btn-success" target="_blank" rel="noopener" href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $listing['whatsapp'] ?? ($listing['phone'] ?? '')) ?>?text=<?= urlencode('Hello ' . ($listing['provider_name'] ?? 'Provider') . ', I am contacting you from UMUHUZA.ONLINE.') ?>"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>WhatsApp</a>
      </div>
    </aside>
    <main class="col-lg-8">
      <div class="d-flex justify-content-between align-items-end mb-3">
        <div>
          <h3 class="section-title mb-1">Listings by this provider</h3>
          <p class="text-muted-custom mb-0">Real marketplace inventory from the same verified business profile.</p>
        </div>
        <span class="badge badge-super"><?= count($providerListings ?? []) ?> active listings</span>
      </div>
      <div class="row g-4">
        <?php foreach (($providerListings ?? []) as $item): ?>
          <article class="col-md-6">
            <a href="?route=listing&id=<?= (int)$item['id'] ?>" class="listing-card card-hover p-3 h-100 d-block text-dark">
              <img class="listing-visual" src="<?= e(listingCoverUrl($item)) ?>" alt="<?= e($item['title'] ?? 'Listing') ?>" />
              <div class="mt-3">
                <div class="d-flex gap-2 mb-2"><span class="badge badge-super"><?= e($item['plan_name'] ?? 'Free') ?></span><span class="badge badge-premium"><?= e($item['category_name'] ?? 'General') ?></span></div>
                <h5 class="fw-bold mb-1"><?= e($item['title']) ?></h5>
                <p class="small text-muted-custom mb-2"><?= e($item['description']) ?></p>
                <div class="fw-bold text-primary mb-1"><?= formatPrice($item['price']) ?></div>
                <div class="small text-muted-custom d-flex align-items-center gap-2"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 21s6-5.2 6-11a6 6 0 1 0-12 0c0 5.8 6 11 6 11z"/><circle cx="12" cy="10" r="2.5"/></svg><?= e($item['province']) ?> / <?= e($item['district']) ?></div>
              </div>
            </a>
          </article>
        <?php endforeach; ?>
      </div>
    </main>
  </div>
</section>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
