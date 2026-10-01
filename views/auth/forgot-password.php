<?php include __DIR__ . '/../layouts/header.php'; ?>

<section class="login-simple-container container py-5">
  <div class="login-card mx-auto" style="max-width: 480px; background: #fff; padding: 2rem; border-radius: 1rem; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
    <div class="login-header text-center mb-4">
      <h2 class="login-title fw-bold">Reset Password</h2>
      <p class="login-subtitle text-muted">Enter your registered email or phone number to recover access to your account.</p>
    </div>

    <form method="POST" action="?route=forgot-password-submit" class="login-form">
      <input type="hidden" name="csrf_token" value="<?php echo e(generateCsrfToken()); ?>">

      <div class="mb-3">
        <label class="form-label fw-semibold">Phone Number or Email</label>
        <input 
          class="form-control form-control-lg" 
          type="text" 
          name="identifier" 
          placeholder="078... or name@domain.com" 
          required />
      </div>

      <button type="submit" class="btn btn-primary btn-lg w-100 mt-3 fw-semibold">Send Reset Instructions</button>
    </form>

    <div class="login-footer text-center mt-4 pt-3 border-top">
      <p class="mb-0">Remember your password? <a href="?route=login" class="fw-bold">Sign In</a></p>
    </div>
  </div>
</section>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
