<?php include __DIR__ . '/../layouts/header.php'; ?>

<section class="login-simple-container">
  <div class="login-card">
    <!-- Header -->
    <div class="login-header">
      <h1 class="login-title">Welcome back</h1>
      <p class="login-subtitle">Sign in to UMUHUZA.ONLINE</p>
    </div>

    <?php if (isLoggedIn()): ?>
      <div class="alert alert-info border-info p-3 mb-4 rounded-3 text-start">
        <div class="fw-bold mb-1">You are already logged in!</div>
        <div class="small text-muted-custom mb-3">Signed in as: <strong><?= e($_SESSION['full_name'] ?? $_SESSION['username'] ?? 'Active User') ?></strong></div>
        <div class="d-flex gap-2">
          <a href="<?= isAdmin() ? '?route=admin-dashboard' : '?route=provider-dashboard' ?>" class="btn btn-sm btn-primary">Go to Dashboard</a>
          <a href="?route=logout" class="btn btn-sm btn-outline-danger">Logout to switch account</a>
        </div>
      </div>
    <?php endif; ?>

    <!-- Login Form -->
    <form method="POST" action="?route=login-submit" class="login-form">
      <input type="hidden" name="csrf_token" value="<?php echo e(generateCsrfToken()); ?>">

      <!-- Identifier (Phone or Email) -->
      <div class="form-group">
        <label class="form-label">Phone Number or Email</label>
        <input 
          class="form-control form-control-lg" 
          type="text" 
          name="identifier" 
          placeholder="077... or you@example.com" 
          autocomplete="email"
          required />
      </div>

      <!-- Password -->
      <div class="form-group">
        <label class="form-label">Password</label>
        <div class="input-group input-group-lg">
          <input 
            class="form-control" 
            type="password" 
            id="loginPassword" 
            name="password" 
            placeholder="Enter your password" 
            autocomplete="current-password"
            required />
          <button 
            class="btn btn-outline-secondary" 
            type="button" 
            data-password-toggle="true" 
            data-password-target="loginPassword">
            Show
          </button>
        </div>
      </div>

      <!-- Remember Me & Forgot Password -->
      <div class="login-extras">
        <label class="remember-me">
          <input type="checkbox" name="remember_me" />
          <span>Remember me</span>
        </label>
        <a href="?route=forgot-password" class="forgot-password">Forgot password?</a>
      </div>

      <!-- Login Button -->
      <button type="submit" class="btn btn-primary btn-lg btn-block mt-4">Login</button>
    </form>

    <!-- Footer -->
    <div class="login-footer">
      <p>Don't have an account? <a href="?route=register" class="fw-bold">Create one</a></p>
    </div>

    <!-- Trust Badges -->
    <div class="login-badges">
      <span class="badge-item"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" style="margin-right:4px; vertical-align:middle;"><polyline points="20 6 9 17 4 12"/></svg>Verified agents</span>
      <span class="badge-item"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" style="margin-right:4px; vertical-align:middle;"><polyline points="20 6 9 17 4 12"/></svg>Secure payments</span>
      <span class="badge-item"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" style="margin-right:4px; vertical-align:middle;"><polyline points="20 6 9 17 4 12"/></svg>Fast matching</span>
    </div>
  </div>
</section>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
