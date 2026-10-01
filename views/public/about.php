<?php include __DIR__ . '/../layouts/header.php'; ?>

<section class="container py-5">
  <!-- Hero Section -->
  <div class="panel p-4 p-lg-5 mb-5 bg-white rounded-4 border shadow-sm">
    <div class="row g-4 align-items-center">
      <div class="col-lg-7">
        <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-semibold mb-3">ABOUT UMUHUZA.ONLINE</span>
        <h1 class="display-6 fw-bold text-dark mb-3">Rwanda’s Premier Property & Professional Services Marketplace</h1>
        <p class="lead text-muted-custom mb-4">
          UMUHUZA.ONLINE connects property buyers, renters, verified real estate agents, and local service providers across all 30 districts of Rwanda into one fast, trusted digital hub.
        </p>
        <div class="d-flex flex-wrap gap-3">
          <a href="?route=listings" class="btn btn-primary px-4 py-2 rounded-3 fw-semibold">Explore Marketplace</a>
          <a href="?route=register" class="btn btn-outline-primary px-4 py-2 rounded-3 fw-semibold">Join as Provider / Agent</a>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="p-4 rounded-4 bg-light border text-dark">
          <h5 class="fw-bold mb-3"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-2 text-primary"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>Our Core Mission</h5>
          <p class="small text-muted-custom mb-3">
            To make finding property and hiring skilled professionals in Rwanda transparent, reliable, and instant. We eliminate middleman friction by connecting clients directly with verified local experts.
          </p>
          <div class="d-flex flex-column gap-2 small fw-semibold">
            <div class="d-flex align-items-center gap-2"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-success"><polyline points="20 6 9 17 4 12"/></svg> Direct Call & WhatsApp Integration</div>
            <div class="d-flex align-items-center gap-2"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-success"><polyline points="20 6 9 17 4 12"/></svg> Verified Real Estate Agents & Technicians</div>
            <div class="d-flex align-items-center gap-2"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="text-success"><polyline points="20 6 9 17 4 12"/></svg> Instant Location-Based Request Matching</div>
          </div>
        </div>
      </div>
    </div>
  </div>  <!-- How System Works Section -->
  <div class="mb-5">
    <div class="section-header text-center mb-5" style="max-width: 650px; margin: 0 auto;">
      <span class="badge badge-super mb-2" data-i18n="how_it_works_badge">⚡ SIMPLE & INSTANT</span>
      <h2 class="fw-bold fs-2 text-dark" data-i18n="how_it_works_title">How UMUHUZA.ONLINE Works</h2>
      <p class="text-muted-custom fs-6" data-i18n="how_it_works_sub">Connecting service providers, real estate agents, and clients fast and reliably across Rwanda.</p>
    </div>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="panel p-4 text-center h-100 bg-white rounded-4 border card-hover border-top border-4 border-primary shadow-sm">
          <div class="rounded-circle bg-primary-subtle text-primary d-inline-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px;">
            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 2 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
          </div>
          <h4 class="fw-bold mb-2 text-dark" data-i18n="step1_title">1. Post Your Need</h4>
          <p class="text-muted-custom small mb-0" data-i18n="step1_desc">Search for properties or submit a request for the service you need in seconds. No login required.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="panel p-4 text-center h-100 bg-white rounded-4 border card-hover border-top border-4 border-success shadow-sm">
          <div class="rounded-circle bg-success-subtle text-success d-inline-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px;">
            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 1 0 7.75"/></svg>
          </div>
          <h4 class="fw-bold mb-2 text-dark" data-i18n="step2_title">2. Instant Matching</h4>
          <p class="text-muted-custom small mb-0" data-i18n="step2_desc">Our system immediately delivers your request to nearby verified service providers and agents in your area.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="panel p-4 text-center h-100 bg-white rounded-4 border card-hover border-top border-4 border-warning shadow-sm">
          <div class="rounded-circle bg-warning-subtle text-warning d-inline-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px;">
            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.79 19.79 0 0 1 2.08 4.18 2 2 0 0 1 4.06 2h3a2 2 0 0 1 2 1.72c.12.9.33 1.79.63 2.65a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.43-1.18a2 2 0 0 1 2.11-.45c.86.3 1.75.51 2.65.63A2 2 0 0 1 22 16.92z"/></svg>
          </div>
          <h4 class="fw-bold mb-2 text-dark" data-i18n="step3_title">3. Connect Directly</h4>
          <p class="text-muted-custom small mb-0" data-i18n="step3_desc">Call or chat directly via WhatsApp with property owners and technicians with zero commission.</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Subscription Plans Section -->
  <div class="mb-5">
    <div class="section-header text-center mb-5" style="max-width: 650px; margin: 0 auto;">
      <span class="badge badge-super mb-2" data-i18n="pricing_badge">💎 SUBSCRIPTIONS & PLANS</span>
      <h2 class="fw-bold fs-2 text-dark" data-i18n="pricing_title">Provider & Agent Pricing</h2>
      <p class="text-muted-custom fs-6" data-i18n="pricing_sub">Choose the ideal plan to gain top visibility and acquire more clients in Rwanda.</p>
    </div>
    <div class="row g-4 justify-content-center">
      <!-- Free Plan -->
      <div class="col-lg-4 col-md-6">
        <div class="panel p-4 h-100 d-flex flex-column bg-white rounded-4 border card-hover position-relative shadow-sm">
          <div class="mb-3">
            <span class="badge bg-secondary mb-2" data-i18n="free_plan_tag">BASIC</span>
            <h3 class="fw-bold text-dark" data-i18n="free_plan_name">Free Plan</h3>
            <div class="display-6 fw-bold text-dark my-2">0 <small class="fs-6 text-muted-custom">RWF / mo</small></div>
            <p class="text-muted-custom small" data-i18n="free_plan_desc">Ideal for individuals starting out on the platform.</p>
          </div>
          <hr />
          <ul class="list-unstyled flex-fill mb-4 small space-y-2">
            <li class="d-flex align-items-center gap-2 mb-2"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" class="text-success"><polyline points="20 6 9 17 4 12"/></svg> <span data-i18n="free_feat_1">Up to 5 listings per week</span></li>
            <li class="d-flex align-items-center gap-2 mb-2"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" class="text-success"><polyline points="20 6 9 17 4 12"/></svg> <span data-i18n="free_feat_2">Standard search visibility</span></li>
            <li class="d-flex align-items-center gap-2 mb-2"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" class="text-success"><polyline points="20 6 9 17 4 12"/></svg> <span data-i18n="free_feat_3">5 free instant leads monthly</span></li>
            <li class="d-flex align-items-center gap-2 mb-2 text-muted"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg> <span>Delayed leads throttling</span></li>
          </ul>
          <a href="?route=register" class="btn btn-outline-primary w-100" data-i18n="start_free">Start Free</a>
        </div>
      </div>

      <!-- Premium Plan -->
      <div class="col-lg-4 col-md-6">
        <div class="panel p-4 h-100 d-flex flex-column bg-white rounded-4 border border-2 border-primary card-hover position-relative shadow" style="background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);">
          <div class="position-absolute top-0 end-0 m-3"><span class="badge badge-super-premium" data-i18n="popular">MOST POPULAR</span></div>
          <div class="mb-3">
            <span class="badge bg-primary mb-2" data-i18n="premium_plan_tag">GROWTH</span>
            <h3 class="fw-bold text-primary" data-i18n="premium_plan_name">Premium Plan</h3>
            <div class="display-6 fw-bold text-dark my-2">3,000 <small class="fs-6 text-muted-custom">RWF / mo</small></div>
            <p class="text-muted-custom small" data-i18n="premium_plan_desc">Designed for agents and service providers seeking steady clients.</p>
          </div>
          <hr />
          <ul class="list-unstyled flex-fill mb-4 small space-y-2">
            <li class="d-flex align-items-center gap-2 mb-2"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" class="text-success"><polyline points="20 6 9 17 4 12"/></svg> <strong data-i18n="prem_feat_1">Up to 20 listings per week</strong></li>
            <li class="d-flex align-items-center gap-2 mb-2"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" class="text-success"><polyline points="20 6 9 17 4 12"/></svg> <span data-i18n="prem_feat_2">Priority search ranking</span></li>
            <li class="d-flex align-items-center gap-2 mb-2"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" class="text-success"><polyline points="20 6 9 17 4 12"/></svg> <strong data-i18n="prem_feat_3">Instant lead notifications</strong></li>
            <li class="d-flex align-items-center gap-2 mb-2"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" class="text-success"><polyline points="20 6 9 17 4 12"/></svg> <span data-i18n="prem_feat_4">Verified Provider Badge</span></li>
          </ul>
          <a href="?route=register" class="btn btn-primary w-100 fw-semibold" data-i18n="get_premium">Upgrade to Premium</a>
        </div>
      </div>

      <!-- Super Premium Plan -->
      <div class="col-lg-4 col-md-6">
        <div class="panel p-4 h-100 d-flex flex-column bg-white rounded-4 border card-hover position-relative shadow-sm">
          <div class="mb-3">
            <span class="badge bg-warning text-dark mb-2" data-i18n="super_plan_tag">VIP EXECUTIVE</span>
            <h3 class="fw-bold text-dark" data-i18n="super_plan_name">Super VIP Plan</h3>
            <div class="display-6 fw-bold text-dark my-2">5,000 <small class="fs-6 text-muted-custom">RWF / mo</small></div>
            <p class="text-muted-custom small" data-i18n="super_plan_desc">Top position for premier agents and leading service companies in Rwanda.</p>
          </div>
          <hr />
          <ul class="list-unstyled flex-fill mb-4 small space-y-2">
            <li class="d-flex align-items-center gap-2 mb-2"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" class="text-success"><polyline points="20 6 9 17 4 12"/></svg> <strong data-i18n="super_feat_1">Unlimited listings</strong></li>
            <li class="d-flex align-items-center gap-2 mb-2"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" class="text-success"><polyline points="20 6 9 17 4 12"/></svg> <strong data-i18n="super_feat_2">#1 Top Placement in search</strong></li>
            <li class="d-flex align-items-center gap-2 mb-2"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" class="text-success"><polyline points="20 6 9 17 4 12"/></svg> <span data-i18n="super_feat_3">Instant lead delivery & SMS</span></li>
            <li class="d-flex align-items-center gap-2 mb-2"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" class="text-success"><polyline points="20 6 9 17 4 12"/></svg> <span data-i18n="super_feat_4">VIP Featured Badge & Dedicated Support</span></li>
          </ul>
          <a href="?route=register" class="btn btn-warning w-100 fw-semibold text-dark" data-i18n="get_super">Get Super VIP</a>
        </div>
    </div>
  </div>

  <!-- Conversion Cards Section -->
  <div class="conversion-section mb-5 p-4 rounded-4" style="background: var(--surface-1);">
    <div style="text-align: center; margin-bottom: 32px;">
      <h2 style="font-size: 1.5rem; font-weight: 800; margin-bottom: 12px; color: #0f172a;" data-i18n="join_title">Ready to join UMUHUZA.ONLINE?</h2>
      <p style="color: #475569; font-size: 1rem; max-width: 500px; margin: 0 auto;" data-i18n="join_sub">Choose your role and start connecting with buyers, renters, or service seekers today.</p>
    </div>
    <div class="conversion-cards-grid">
      <div class="conversion-card agent-card">
        <div class="conversion-card-icon">
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:var(--primary);"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        </div>
        <h3 data-i18n="become_agent">Become an Agent</h3>
        <p data-i18n="become_agent_desc">Sell or rent properties and reach verified buyers and renters across Rwanda</p>
        <a href="?route=register" class="btn btn-outline-primary btn-sm" data-i18n="get_started">Get started</a>
      </div>
      <div class="conversion-card">
        <div class="conversion-card-icon">
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:var(--primary);"><path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z"/></svg>
        </div>
        <h3 data-i18n="become_provider">Become a Service Provider</h3>
        <p data-i18n="become_provider_desc">Offer your services and receive direct requests from clients who need your expertise</p>
        <a href="?route=register" class="btn btn-outline-primary btn-sm" data-i18n="get_started">Get started</a>
      </div>
      <div class="conversion-card">
        <div class="conversion-card-icon">
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:var(--primary);"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
        </div>
        <h3 data-i18n="browse_connect">Browse & Connect</h3>
        <p data-i18n="browse_connect_desc">Find trusted agents, service providers, and post requests for the services you need</p>
        <a href="?route=listings" class="btn btn-outline-primary btn-sm" data-i18n="explore_now">Explore now</a>
      </div>
    </div>
  </div>

  <!-- Comprehensive FAQ Section -->
  <div class="panel p-4 p-lg-5 bg-white rounded-4 border shadow-sm mb-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4 border-bottom pb-3">
      <div>
        <span class="badge bg-primary-subtle text-primary px-3 py-1 rounded-pill small fw-semibold mb-1">HELP & KNOWLEDGE BASE</span>
        <h2 class="fw-bold text-dark mb-1">Frequently Asked Questions (FAQ)</h2>
        <p class="text-muted-custom small mb-0">Everything you need to know about browsing, listing, and connecting on UMUHUZA.ONLINE.</p>
      </div>
      <a href="#requestModal" data-bs-toggle="modal" class="btn btn-outline-primary btn-sm">Have a question? Submit a Request</a>
    </div>

    <div class="accordion accordion-flush" id="faqAccordion">
      <!-- FAQ Item 1 -->
      <div class="accordion-item border-bottom py-2">
        <h2 class="accordion-header" id="faqHeading1">
          <button class="accordion-button collapsed fw-bold text-dark fs-6" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse1" aria-expanded="false" aria-controls="faqCollapse1">
            1. What is UMUHUZA.ONLINE and how does it connect people in Rwanda?
          </button>
        </h2>
        <div id="faqCollapse1" class="accordion-collapse collapse" aria-labelledby="faqHeading1" data-bs-parent="#faqAccordion">
          <div class="accordion-body text-muted-custom small leading-relaxed">
            UMUHUZA.ONLINE is a digital marketplace in Rwanda that brings together real estate property listings (houses, land, apartments) and verified service providers (plumbers, electricians, technicians, logistics, cleaning services) into a single unified platform. It allows buyers and renters to discover property and hire skilled services directly without unnecessary intermediaries.
          </div>
        </div>
      </div>

      <!-- FAQ Item 2 -->
      <div class="accordion-item border-bottom py-2">
        <h2 class="accordion-header" id="faqHeading2">
          <button class="accordion-button collapsed fw-bold text-dark fs-6" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
            2. How do I contact a Real Estate Agent or Service Provider directly?
          </button>
        </h2>
        <div id="faqCollapse2" class="accordion-collapse collapse" aria-labelledby="faqHeading2" data-bs-parent="#faqAccordion">
          <div class="accordion-body text-muted-custom small leading-relaxed">
            Simply click on any listing or provider profile card on the marketplace. Every active listing includes direct <strong>Call</strong> and <strong>WhatsApp</strong> buttons. Tapping <strong>Call</strong> opens your phone dialer with the provider’s verified phone number, while tapping <strong>WhatsApp</strong> opens an instant chat with pre-filled details about the listing you are inquiring about.
          </div>
        </div>
      </div>

      <!-- FAQ Item 3 -->
      <div class="accordion-item border-bottom py-2">
        <h2 class="accordion-header" id="faqHeading3">
          <button class="accordion-button collapsed fw-bold text-dark fs-6" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3">
            3. How can property owners and service providers post listings?
          </button>
        </h2>
        <div id="faqCollapse3" class="accordion-collapse collapse" aria-labelledby="faqHeading3" data-bs-parent="#faqAccordion">
          <div class="accordion-body text-muted-custom small leading-relaxed">
            Register for a provider account by clicking <strong>Join as Provider / Agent</strong> or <strong>Post Listing</strong>. Once logged in to your <strong>Provider Dashboard</strong>, click <strong>Post Listing</strong> on the sidebar menu, fill in your title, price, location (Province/District/Sector), description, and upload photos. Your listing will be published on the marketplace immediately.
          </div>
        </div>
      </div>

      <!-- FAQ Item 4 -->
      <div class="accordion-item border-bottom py-2">
        <h2 class="accordion-header" id="faqHeading4">
          <button class="accordion-button collapsed fw-bold text-dark fs-6" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse4" aria-expanded="false" aria-controls="faqCollapse4">
            4. What are the subscription plans (Free, Premium, Super) and listing limits?
          </button>
        </h2>
        <div id="faqCollapse4" class="accordion-collapse collapse" aria-labelledby="faqHeading4" data-bs-parent="#faqAccordion">
          <div class="accordion-body text-muted-custom small leading-relaxed">
            All new providers start on the <strong>Free Plan</strong> (allowing up to 5 active listings). Upgrading to <strong>Premium</strong> or <strong>Super</strong> plans increases your listing quota, adds glowing badges to your posts, ranks your listings at the top of search results, and gives you priority lead matching when clients submit requests in your area.
          </div>
        </div>
      </div>

      <!-- FAQ Item 5 -->
      <div class="accordion-item border-bottom py-2">
        <h2 class="accordion-header" id="faqHeading5">
          <button class="accordion-button collapsed fw-bold text-dark fs-6" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse5" aria-expanded="false" aria-controls="faqCollapse5">
            5. How do I update my name, phone number, WhatsApp contact, or location?
          </button>
        </h2>
        <div id="faqCollapse5" class="accordion-collapse collapse" aria-labelledby="faqHeading5" data-bs-parent="#faqAccordion">
          <div class="accordion-body text-muted-custom small leading-relaxed">
            Log in to your account, open the <strong>Provider Dashboard</strong>, and click <strong>Profile Settings</strong> on the left sidebar. There, you can edit your Business Name, Phone Number, WhatsApp Number, Email, Location (Province/District/Sector), Profile Photo, and Password. Saving your profile updates your details across all your listings automatically.
          </div>
        </div>
      </div>

      <!-- FAQ Item 6 -->
      <div class="accordion-item border-bottom py-2">
        <h2 class="accordion-header" id="faqHeading6">
          <button class="accordion-button collapsed fw-bold text-dark fs-6" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse6" aria-expanded="false" aria-controls="faqCollapse6">
            6. Can clients submit a service or property request without creating an account?
          </button>
        </h2>
        <div id="faqCollapse6" class="accordion-collapse collapse" aria-labelledby="faqHeading6" data-bs-parent="#faqAccordion">
          <div class="accordion-body text-muted-custom small leading-relaxed">
            Yes! Clients do not need an account to submit requests. Click the <strong>Requests</strong> or <strong>Submit Request</strong> button anywhere on the page, enter your name, contact phone, location, and requirement details. Our platform will match your request with verified providers in your local area.
          </div>
        </div>
      </div>

      <!-- FAQ Item 7 -->
      <div class="accordion-item border-bottom py-2">
        <h2 class="accordion-header" id="faqHeading7">
          <button class="accordion-button collapsed fw-bold text-dark fs-6" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse7" aria-expanded="false" aria-controls="faqCollapse7">
            7. Are providers and agents on UMUHUZA.ONLINE verified for trust and safety?
          </button>
        </h2>
        <div id="faqCollapse7" class="accordion-collapse collapse" aria-labelledby="faqHeading7" data-bs-parent="#faqAccordion">
          <div class="accordion-body text-muted-custom small leading-relaxed">
            Yes. Our platform administration checks registrations and phone numbers. Accounts that complete verification receive a green <strong>Verified</strong> badge, giving buyers and clients confidence when booking services or inquiring about property.
          </div>
        </div>
      </div>

      <!-- FAQ Item 8 -->
      <div class="accordion-item py-2">
        <h2 class="accordion-header" id="faqHeading8">
          <button class="accordion-button collapsed fw-bold text-dark fs-6" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse8" aria-expanded="false" aria-controls="faqCollapse8">
            8. Is UMUHUZA.ONLINE accessible on mobile smartphones?
          </button>
        </h2>
        <div id="faqCollapse8" class="accordion-collapse collapse" aria-labelledby="faqHeading8" data-bs-parent="#faqAccordion">
          <div class="accordion-body text-muted-custom small leading-relaxed">
            Yes. UMUHUZA.ONLINE is fully responsive and optimized for all mobile smartphones, tablets, and desktop computers. It features mobile drawer menus, smooth section switching, and fast loading speeds across 3G/4G networks.
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Call to Action Banner -->
  <div class="panel p-4 p-lg-5 bg-primary text-white rounded-4 text-center">
    <h2 class="fw-bold mb-2">Get Started on UMUHUZA.ONLINE Today</h2>
    <p class="opacity-90 max-w-xl mx-auto mb-4">Whether you are looking to rent a home, buy land, hire a technician, or grow your business as an agent, we are here to help.</p>
    <div class="d-flex justify-content-center gap-3">
      <a href="?route=register" class="btn btn-light text-primary px-4 py-2 rounded-3 fw-bold">Register as Provider</a>
      <a href="?route=listings" class="btn btn-outline-light px-4 py-2 rounded-3 fw-semibold">Browse Listings</a>
    </div>
  </div>
</section>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
