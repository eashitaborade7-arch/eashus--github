<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Plan Karo — Safar Yadoon Ka…</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --navy: #0f1b2d;
      --teal: #0ea5a4;
      --gold: #f59e0b;
      --white: #ffffff;
      --light: #f0f6ff;
      --dark2: #111e2f;
      --muted: #94a3b8;
    }
    *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
    html { scroll-behavior: smooth; }
    body { font-family: 'Poppins', sans-serif; background: var(--navy); color: var(--white); overflow-x: hidden; }

    /* ── NAV ── */
    nav {
      position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
      display: flex; align-items: center; justify-content: space-between;
      padding: 16px 40px;
      background: rgba(15, 27, 45, 0.92);
      backdrop-filter: blur(12px);
      border-bottom: 1px solid rgba(14,165,164,0.2);
      transition: all 0.3s;
    }
    .logo { font-family: 'Playfair Display', serif; font-size: 1.7rem; color: var(--white); text-decoration: none; letter-spacing: 1px; }
    .logo span { color: var(--gold); }
    .nav-links { display: flex; gap: 6px; align-items: center; }
    .nav-links a {
      color: var(--muted); text-decoration: none; padding: 8px 16px; border-radius: 25px;
      font-size: 0.88rem; font-weight: 500; transition: all 0.25s; letter-spacing: 0.3px;
    }
    .nav-links a:hover { color: var(--white); background: rgba(14,165,164,0.15); }
    .nav-links a.active { color: var(--navy); background: var(--gold); font-weight: 600; }
    .nav-links a.btn-login {
      background: var(--teal); color: var(--white); margin-left: 8px;
    }
    .nav-links a.btn-login:hover { background: #0b8786; }
    .hamburger { display: none; flex-direction: column; gap: 5px; cursor: pointer; }
    .hamburger span { width: 24px; height: 2px; background: var(--white); border-radius: 2px; transition: all 0.3s; }

    /* ── HERO ── */
    .hero {
      position: relative; min-height: 100vh;
      display: flex; align-items: center; justify-content: center;
      overflow: hidden;
      background: linear-gradient(135deg, #0f1b2d 0%, #0d2744 50%, #0a3d4f 100%);
    }
    .hero-bg {
      position: absolute; inset: 0; z-index: 0;
      background-image:
        radial-gradient(ellipse at 20% 50%, rgba(14,165,164,0.12) 0%, transparent 60%),
        radial-gradient(ellipse at 80% 20%, rgba(245,158,11,0.08) 0%, transparent 50%);
    }
    /* Floating cards background effect */
    .hero-float {
      position: absolute; inset: 0; z-index: 1; overflow: hidden;
    }
    .float-img {
      position: absolute; border-radius: 16px; overflow: hidden;
      box-shadow: 0 20px 60px rgba(0,0,0,0.5);
      opacity: 0.18;
    }
    .float-img img { width: 100%; height: 100%; object-fit: cover; }
    .fi1 { width: 260px; height: 180px; top: 8%; left: 2%; animation: floatA 8s ease-in-out infinite; }
    .fi2 { width: 200px; height: 250px; top: 30%; left: 5%; animation: floatB 10s ease-in-out infinite; }
    .fi3 { width: 280px; height: 190px; top: 5%; right: 2%; animation: floatA 9s ease-in-out infinite 1s; }
    .fi4 { width: 210px; height: 260px; top: 40%; right: 4%; animation: floatB 11s ease-in-out infinite 0.5s; }
    .fi5 { width: 230px; height: 160px; bottom: 8%; left: 12%; animation: floatA 7s ease-in-out infinite 2s; }
    .fi6 { width: 240px; height: 170px; bottom: 6%; right: 10%; animation: floatB 9s ease-in-out infinite 1.5s; }
    @keyframes floatA { 0%,100%{transform:translateY(0) rotate(-1deg)} 50%{transform:translateY(-18px) rotate(1deg)} }
    @keyframes floatB { 0%,100%{transform:translateY(0) rotate(1deg)} 50%{transform:translateY(-12px) rotate(-1deg)} }

    .hero-content {
      position: relative; z-index: 2;
      text-align: center; padding: 100px 20px 60px;
      max-width: 820px;
    }
    .hero-badge {
      display: inline-block; background: rgba(14,165,164,0.15); border: 1px solid rgba(14,165,164,0.4);
      color: var(--teal); font-size: 0.8rem; font-weight: 600; letter-spacing: 3px;
      text-transform: uppercase; padding: 8px 20px; border-radius: 30px; margin-bottom: 24px;
      animation: fadeUp 0.8s ease both;
    }
    .hero-title {
      font-family: 'Playfair Display', serif;
      font-size: clamp(3rem, 7vw, 5.5rem);
      line-height: 1.1; margin-bottom: 8px;
      animation: fadeUp 0.8s ease 0.15s both;
    }
    .hero-title .gold { color: var(--gold); }
    .hero-tagline {
      font-family: 'Playfair Display', serif; font-style: italic;
      font-size: clamp(1.1rem, 2.5vw, 1.5rem); color: var(--muted);
      margin-bottom: 24px; letter-spacing: 1px;
      animation: fadeUp 0.8s ease 0.3s both;
    }
    .hero-desc {
      font-size: 1rem; color: #cbd5e1; line-height: 1.8; max-width: 600px;
      margin: 0 auto 40px;
      animation: fadeUp 0.8s ease 0.45s both;
    }
    .hero-btns { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; animation: fadeUp 0.8s ease 0.6s both; }
    .btn-primary {
      padding: 15px 36px; border-radius: 50px;
      background: linear-gradient(135deg, var(--teal), #0b8786);
      color: var(--white); font-family: 'Poppins', sans-serif;
      font-weight: 600; font-size: 0.95rem; text-decoration: none;
      letter-spacing: 0.5px; transition: all 0.3s;
      box-shadow: 0 8px 30px rgba(14,165,164,0.35);
    }
    .btn-primary:hover { transform: translateY(-3px); box-shadow: 0 14px 40px rgba(14,165,164,0.5); }
    .btn-outline {
      padding: 15px 36px; border-radius: 50px;
      border: 2px solid rgba(245,158,11,0.6); color: var(--gold);
      font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 0.95rem;
      text-decoration: none; letter-spacing: 0.5px; transition: all 0.3s;
    }
    .btn-outline:hover { background: var(--gold); color: var(--navy); transform: translateY(-3px); }

    .hero-stats {
      display: flex; justify-content: center; gap: 48px; margin-top: 60px;
      padding-top: 40px; border-top: 1px solid rgba(255,255,255,0.08);
      flex-wrap: wrap;
      animation: fadeUp 0.8s ease 0.75s both;
    }
    .stat-item { text-align: center; }
    .stat-num { font-family: 'Playfair Display', serif; font-size: 2.2rem; color: var(--teal); font-weight: 700; }
    .stat-lbl { font-size: 0.78rem; color: var(--muted); letter-spacing: 2px; text-transform: uppercase; margin-top: 4px; }

    /* Scroll indicator */
    .scroll-hint { position: absolute; bottom: 30px; left: 50%; transform: translateX(-50%); z-index: 2; animation: bounce 2s infinite; }
    .scroll-hint span { display: block; width: 24px; height: 40px; border: 2px solid rgba(255,255,255,0.3); border-radius: 12px; margin: 0 auto; position: relative; }
    .scroll-hint span::after { content:''; position:absolute; top:6px; left:50%; transform:translateX(-50%); width:4px; height:8px; background:var(--teal); border-radius:2px; animation:scrollDot 2s infinite; }
    @keyframes scrollDot { 0%{opacity:1;transform:translateX(-50%) translateY(0)} 100%{opacity:0;transform:translateX(-50%) translateY(14px)} }
    @keyframes bounce { 0%,100%{transform:translateX(-50%) translateY(0)} 50%{transform:translateX(-50%) translateY(-8px)} }

    @keyframes fadeUp { from{opacity:0;transform:translateY(30px)} to{opacity:1;transform:translateY(0)} }

    /* ── SECTION HEADER ── */
    .section { padding: 100px 40px; }
    .section-header { text-align: center; margin-bottom: 60px; }
    .section-badge { display: inline-block; background: rgba(14,165,164,0.1); border: 1px solid rgba(14,165,164,0.3); color: var(--teal); font-size: 0.72rem; font-weight: 600; letter-spacing: 3px; text-transform: uppercase; padding: 6px 18px; border-radius: 30px; margin-bottom: 16px; }
    .section-title { font-family: 'Playfair Display', serif; font-size: clamp(2rem, 4vw, 3rem); margin-bottom: 16px; }
    .section-title .accent { color: var(--gold); }
    .section-sub { color: var(--muted); font-size: 1rem; max-width: 560px; margin: 0 auto; line-height: 1.8; }

    /* ── WHY TRAVEL ── */
    .why-travel { background: linear-gradient(180deg, var(--navy) 0%, var(--dark2) 100%); }
    .why-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 24px; max-width: 1100px; margin: 0 auto; }
    .why-card {
      background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.07);
      border-radius: 20px; padding: 36px 28px;
      transition: all 0.35s; cursor: default;
      position: relative; overflow: hidden;
    }
    .why-card::before {
      content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
      background: linear-gradient(90deg, var(--teal), var(--gold));
      transform: scaleX(0); transform-origin: left; transition: transform 0.35s;
    }
    .why-card:hover { background: rgba(14,165,164,0.06); border-color: rgba(14,165,164,0.2); transform: translateY(-6px); }
    .why-card:hover::before { transform: scaleX(1); }
    .why-icon { font-size: 2.8rem; margin-bottom: 18px; display: block; }
    .why-card h3 { font-size: 1.1rem; font-weight: 600; margin-bottom: 12px; }
    .why-card p { color: var(--muted); font-size: 0.9rem; line-height: 1.8; }

    /* ── WHY PLAN KARO ── */
    .why-us { background: var(--dark2); }
    .why-us-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 60px; max-width: 1100px; margin: 0 auto; align-items: center; }
    .why-us-text { }
    .why-us-text h2 { font-family: 'Playfair Display', serif; font-size: clamp(1.8rem, 3.5vw, 2.6rem); margin-bottom: 24px; line-height: 1.3; }
    .why-us-text p { color: var(--muted); line-height: 1.9; margin-bottom: 20px; }
    .feature-list { list-style: none; display: flex; flex-direction: column; gap: 14px; margin-bottom: 36px; }
    .feature-list li { display: flex; align-items: flex-start; gap: 12px; font-size: 0.95rem; color: #cbd5e1; }
    .feature-list li::before { content: '✓'; color: var(--teal); font-weight: 700; font-size: 1rem; flex-shrink: 0; margin-top: 2px; }
    .why-us-visual {
      background: linear-gradient(135deg, rgba(14,165,164,0.1), rgba(245,158,11,0.05));
      border: 1px solid rgba(14,165,164,0.2); border-radius: 24px; padding: 40px;
      display: grid; grid-template-columns: 1fr 1fr; gap: 16px;
    }
    .metric-box { background: rgba(255,255,255,0.04); border-radius: 16px; padding: 24px; text-align: center; }
    .metric-box .num { font-family: 'Playfair Display', serif; font-size: 2rem; color: var(--teal); }
    .metric-box .lbl { font-size: 0.78rem; color: var(--muted); margin-top: 6px; }

    /* ── DESTINATIONS PREVIEW ── */
    .destinations { background: var(--navy); }
    .dest-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 28px; max-width: 1200px; margin: 0 auto; }
    .dest-card {
      border-radius: 20px; overflow: hidden;
      background: var(--dark2); border: 1px solid rgba(255,255,255,0.06);
      transition: all 0.35s; position: relative; group: true;
    }
    .dest-card:hover { transform: translateY(-8px); border-color: rgba(14,165,164,0.3); box-shadow: 0 24px 60px rgba(0,0,0,0.4); }
    .dest-img {
      width: 100%; height: 200px; overflow: hidden; position: relative;
    }
    .dest-img img {
      width: 100%; height: 100%; object-fit: cover;
      transition: transform 0.5s ease; display: block;
    }
    .dest-card:hover .dest-img img { transform: scale(1.08); }
    .dest-body { padding: 22px 20px; }
    .dest-body h3 { font-size: 1.2rem; font-weight: 700; margin-bottom: 8px; }
    .dest-body p { color: var(--muted); font-size: 0.88rem; line-height: 1.7; margin-bottom: 18px; }
    .dest-btns { display: flex; gap: 10px; }
    .dest-btns a {
      flex: 1; text-align: center; padding: 10px; border-radius: 10px;
      font-size: 0.82rem; font-weight: 600; text-decoration: none; transition: all 0.25s;
    }
    .btn-info { background: rgba(14,165,164,0.1); border: 1px solid rgba(14,165,164,0.3); color: var(--teal); }
    .btn-info:hover { background: var(--teal); color: var(--white); }
    .btn-map { background: rgba(245,158,11,0.1); border: 1px solid rgba(245,158,11,0.3); color: var(--gold); }
    .btn-map:hover { background: var(--gold); color: var(--navy); }

    .see-all-wrap { text-align: center; margin-top: 50px; }

    /* ── PACKAGES PREVIEW ── */
    .packages { background: var(--dark2); }
    .pkg-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 24px; max-width: 1100px; margin: 0 auto; }
    .pkg-card {
      background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.07);
      border-radius: 20px; overflow: hidden; transition: all 0.35s;
    }
    .pkg-card:hover { border-color: rgba(14,165,164,0.3); background: rgba(14,165,164,0.05); transform: translateY(-5px); }
    .pkg-thumb-home { height: 180px; overflow: hidden; position: relative; }
    .pkg-thumb-home img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; display: block; }
    .pkg-card:hover .pkg-thumb-home img { transform: scale(1.08); }
    .pkg-thumb-home .pkg-badge { position: absolute; top: 12px; left: 12px; background: rgba(245,158,11,0.92); color: var(--navy); font-size: 0.7rem; font-weight: 700; letter-spacing: 1px; padding: 4px 10px; border-radius: 6px; }
    .pkg-body-home { padding: 20px; }
    .pkg-top { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px; }
    .pkg-price { font-family: 'Playfair Display', serif; font-size: 1.4rem; color: var(--gold); }
    .pkg-price small { font-family: 'Poppins', sans-serif; font-size: 0.72rem; color: var(--muted); display: block; text-align: right; }
    .pkg-card h3 { font-size: 1.05rem; font-weight: 700; margin-bottom: 8px; }
    .pkg-details { display: flex; gap: 16px; margin-bottom: 16px; flex-wrap: wrap; }
    .pkg-detail { font-size: 0.8rem; color: var(--muted); display: flex; align-items: center; gap: 5px; }
    .pkg-card .btn-book {
      width: 100%; padding: 12px; border-radius: 12px;
      background: linear-gradient(135deg, var(--teal), #0b8786); color: var(--white);
      font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 0.9rem;
      text-decoration: none; text-align: center; display: block; transition: all 0.3s;
    }
    .pkg-card .btn-book:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(14,165,164,0.35); }

    /* ── TESTIMONIALS ── */
    .testimonials { background: var(--navy); }
    .testi-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 24px; max-width: 1100px; margin: 0 auto; }
    .testi-card {
      background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.07);
      border-radius: 20px; padding: 28px; transition: all 0.3s;
    }
    .testi-card:hover { border-color: rgba(245,158,11,0.2); }
    .stars { color: var(--gold); font-size: 1rem; margin-bottom: 16px; letter-spacing: 3px; }
    .testi-card p { color: #cbd5e1; font-size: 0.92rem; line-height: 1.8; margin-bottom: 20px; font-style: italic; }
    .testi-author { display: flex; align-items: center; gap: 12px; }
    .testi-avatar { width: 42px; height: 42px; border-radius: 50%; background: linear-gradient(135deg, var(--teal), var(--gold)); display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0; }
    .testi-name { font-weight: 600; font-size: 0.9rem; }
    .testi-loc { color: var(--muted); font-size: 0.78rem; }

    /* ── CTA SECTION ── */
    .cta-section {
      background: linear-gradient(135deg, #0a3d4f, #0f1b2d);
      padding: 100px 40px; text-align: center;
      position: relative; overflow: hidden;
    }
    .cta-section::before {
      content: ''; position: absolute; inset: 0;
      background: radial-gradient(ellipse at center, rgba(14,165,164,0.1) 0%, transparent 70%);
    }
    .cta-section h2 { font-family: 'Playfair Display', serif; font-size: clamp(2rem, 4vw, 3rem); margin-bottom: 16px; position: relative; }
    .cta-section p { color: var(--muted); font-size: 1rem; margin-bottom: 40px; position: relative; max-width: 500px; margin-left: auto; margin-right: auto; }
    .cta-btns { display: flex; justify-content: center; gap: 16px; flex-wrap: wrap; position: relative; }

    /* ── FOOTER ── */
    footer {
      background: #080f1a; padding: 60px 40px 30px;
      border-top: 1px solid rgba(255,255,255,0.06);
    }
    .footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 48px; max-width: 1100px; margin: 0 auto 48px; }
    .footer-brand .logo { font-size: 1.5rem; display: inline-block; margin-bottom: 12px; }
    .footer-brand p { color: var(--muted); font-size: 0.88rem; line-height: 1.8; max-width: 280px; }
    .footer-col h4 { font-weight: 600; font-size: 0.9rem; letter-spacing: 1px; margin-bottom: 16px; color: var(--teal); }
    .footer-col a { display: block; color: var(--muted); font-size: 0.85rem; text-decoration: none; margin-bottom: 10px; transition: color 0.2s; }
    .footer-col a:hover { color: var(--white); }
    .footer-bottom { border-top: 1px solid rgba(255,255,255,0.06); padding-top: 24px; max-width: 1100px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; }
    .footer-bottom p { color: var(--muted); font-size: 0.82rem; }

    /* ── MOBILE NAV ── */
    @media(max-width:768px) {
      nav { padding: 14px 20px; }
      .hamburger { display: flex; }
      .nav-links { display: none; position: absolute; top: 100%; left: 0; right: 0; background: var(--dark2); flex-direction: column; padding: 16px; gap: 4px; border-bottom: 1px solid rgba(14,165,164,0.2); }
      .nav-links.open { display: flex; }
      .nav-links a { text-align: center; }
      .why-us-grid { grid-template-columns: 1fr; }
      .footer-grid { grid-template-columns: 1fr 1fr; gap: 32px; }
      .section { padding: 60px 20px; }
    }
    @media(max-width:480px) {
      .footer-grid { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>

<!-- NAV -->
<nav id="mainNav">
  <a href="index.php" class="logo">Plan <span>Karo</span></a>
  <div class="hamburger" onclick="toggleMenu()" id="hamburger">
    <span></span><span></span><span></span>
  </div>
  <div class="nav-links" id="navLinks">
    <a href="index.php" class="active">🏠 Home</a>
    <a href="destination.php">🌍 Destinations</a>
    <a href="packages.php">📦 Packages</a>
    <a href="live_map.php">🗺️ Live Map</a>
    <a href="suggestion.php">✨ Suggestions</a>
    <a href="contact.php">📞 Contact Us</a>
    <a href="admin/login.php">🛠️ Admin</a>
    <a href="login.php" class="btn-login">🔑 Login / Register</a>
  </div>
</nav>

<!-- HERO -->
<section class="hero">
  <div class="hero-bg"></div>
  <div class="hero-float">
    <div class="float-img fi1"><div class="dest-img">🗽</div></div>
    <div class="float-img fi2"><div class="dest-img">🗼</div></div>
    <div class="float-img fi3"><div class="dest-img">🏯</div></div>
    <div class="float-img fi4"><div class="dest-img">🕌</div></div>
    <div class="float-img fi5"><div class="dest-img">🏖️</div></div>
    <div class="float-img fi6"><div class="dest-img">🏔️</div></div>
  </div>
  <div class="hero-content">
    <span class="hero-badge">✈️ India's Best Travel Platform</span>
    <h1 class="hero-title">Plan <span class="gold">Karo</span></h1>
    <p class="hero-tagline">Safar Yadoon Ka…</p>
    <p class="hero-desc">
      Your journey to unforgettable destinations starts here. Discover breathtaking places,
      curated packages, and seamless bookings — all in one platform.
    </p>
    <div class="hero-btns">
      <a href="destination.php" class="btn-primary">🌍 Explore Destinations</a>
      <a href="packages.php" class="btn-outline">🗓️ Plan Your Trip</a>
      <a href="suggestion.php" class="btn-outline">✨ Get Smart Suggestions</a>
    </div>
    <div class="hero-stats">
      <div class="stat-item">
        <div class="stat-num">50+</div>
        <div class="stat-lbl">Destinations</div>
      </div>
      <div class="stat-item">
        <div class="stat-num">200+</div>
        <div class="stat-lbl">Hotels</div>
      </div>
      <div class="stat-item">
        <div class="stat-num">10K+</div>
        <div class="stat-lbl">Happy Travelers</div>
      </div>
      <div class="stat-item">
        <div class="stat-num">8+</div>
        <div class="stat-lbl">Countries</div>
      </div>
    </div>
  </div>
  <div class="scroll-hint"><span></span></div>
</section>

<!-- WHY TRAVEL -->
<section class="section why-travel">
  <div class="section-header">
    <span class="section-badge">Why Travel?</span>
    <h2 class="section-title">Traveling Changes <span class="accent">Everything</span></h2>
    <p class="section-sub">Every journey opens new doors — to cultures, experiences, and versions of yourself you didn't know existed.</p>
  </div>
  <div class="why-grid">
    <div class="why-card">
      <span class="why-icon">🧠</span>
      <h3>Expand Your Mind</h3>
      <p>Exposure to different cultures, languages, and ways of life broadens your perspective and fosters empathy and understanding.</p>
    </div>
    <div class="why-card">
      <span class="why-icon">💆</span>
      <h3>Recharge & De-stress</h3>
      <p>Stepping away from your routine refreshes your mind, reduces stress, and helps you return to daily life with renewed energy.</p>
    </div>
    <div class="why-card">
      <span class="why-icon">🤝</span>
      <h3>Build Connections</h3>
      <p>Travel creates bonds — with locals, fellow travelers, and loved ones — that last far longer than any souvenir.</p>
    </div>
    <div class="why-card">
      <span class="why-icon">📸</span>
      <h3>Create Memories</h3>
      <p>The moments you experience on the road become the stories you tell for decades — priceless chapters of your life story.</p>
    </div>
    <div class="why-card">
      <span class="why-icon">🌱</span>
      <h3>Personal Growth</h3>
      <p>Navigating unfamiliar places builds confidence, adaptability, and problem-solving skills that transform your outlook.</p>
    </div>
    <div class="why-card">
      <span class="why-icon">🎯</span>
      <h3>Discover New Passions</h3>
      <p>From scuba diving in the Andamans to food trails in Japan — travel uncovers interests you never knew you had.</p>
    </div>
  </div>
</section>

<!-- WHY PLAN KARO -->
<section class="section why-us">
  <div class="why-us-grid">
    <div class="why-us-text">
      <span class="section-badge">Why Plan Karo?</span>
      <h2>The Smarter Way to <span style="color:var(--gold)">Book Your Dream Trip</span></h2>
      <p>Plan Karo combines technology with travel expertise to give you the most seamless, affordable, and memorable journey planning experience.</p>
      <ul class="feature-list">
        <li>Handpicked destinations with verified hotels and real reviews</li>
        <li>Live interactive maps powered by OpenStreetMap</li>
        <li>Custom trip budgeting — know your costs upfront</li>
        <li>Secure, hassle-free booking and payment in minutes</li>
        <li>24/7 customer support with international helplines</li>
        <li>Exclusive packages combining flights, hotels & activities</li>
        <li>Full booking history and trip management dashboard</li>
      </ul>
      <a href="packages.php" class="btn-primary" style="display:inline-block">🏖️ Browse Packages</a>
    </div>
    <div class="why-us-visual">
      <div class="metric-box">
        <div class="num">4.9★</div>
        <div class="lbl">Average Rating</div>
      </div>
      <div class="metric-box">
        <div class="num">₹0</div>
        <div class="lbl">Booking Fee</div>
      </div>
      <div class="metric-box">
        <div class="num">24/7</div>
        <div class="lbl">Support</div>
      </div>
      <div class="metric-box">
        <div class="num">100%</div>
        <div class="lbl">Secure Payment</div>
      </div>
    </div>
  </div>
</section>

<!-- DESTINATIONS PREVIEW -->
<section class="section destinations">
  <div class="section-header">
    <span class="section-badge">Top Destinations</span>
    <h2 class="section-title">Where Do You Want to <span class="accent">Go?</span></h2>
    <p class="section-sub">From the deserts of Dubai to the temples of Japan — every destination tells a story waiting for you.</p>
  </div>
  <div class="dest-grid">
    <div class="dest-card">
      <div class="dest-img"><img src="https://images.unsplash.com/photo-1499092346302-2a4cd7571c7f?w=600&q=80" alt="USA New York City"></div>
      <div class="dest-body">
        <h3>🇺🇸 USA</h3>
        <p>Land of dreams — Grand Canyon, NYC skyscrapers, Las Vegas lights, and the freedom of the open road.</p>
        <div class="dest-btns">
          <a href="destination-detail.php?dest=usa" class="btn-info">ℹ️ More Info</a>
          <a href="live_map.php" class="btn-map">🗺️ View Map</a>
        </div>
      </div>
    </div>
    <div class="dest-card">
      <div class="dest-img"><img src="https://images.unsplash.com/photo-1582672060674-bc2bd808a8b5?w=600&q=80" alt="Dubai Skyline"></div>
      <div class="dest-body">
        <h3>🇦🇪 Dubai</h3>
        <p>Burj Khalifa, desert safaris, gold souks, and world-class luxury — the city that turns dreams into reality.</p>
        <div class="dest-btns">
          <a href="destination-detail.php?dest=dubai" class="btn-info">ℹ️ More Info</a>
          <a href="live_map.php" class="btn-map">🗺️ View Map</a>
        </div>
      </div>
    </div>
    <div class="dest-card">
      <div class="dest-img"><img src="https://images.unsplash.com/photo-1524492412937-b28074a5d7da?w=600&q=80" alt="India Taj Mahal Rajasthan"></div>
      <div class="dest-body">
        <h3>🇮🇳 India</h3>
        <p>Goa beaches, Kashmir valleys, Rajasthan palaces — India is a universe of experiences waiting to be explored.</p>
        <div class="dest-btns">
          <a href="destination-detail.php?dest=india" class="btn-info">ℹ️ More Info</a>
          <a href="live_map.php" class="btn-map">🗺️ View Map</a>
        </div>
      </div>
    </div>
    <div class="dest-card">
      <div class="dest-img"><img src="https://images.unsplash.com/photo-1552832230-c0197dd311b5?w=600&q=80" alt="Rome Colosseum Italy"></div>
      <div class="dest-body">
        <h3>🇮🇹 Italy</h3>
        <p>Colosseum grandeur, Amalfi sunsets, gondola rides in Venice, and the world's finest cuisine.</p>
        <div class="dest-btns">
          <a href="destination-detail.php?dest=italy" class="btn-info">ℹ️ More Info</a>
          <a href="live_map.php" class="btn-map">🗺️ View Map</a>
        </div>
      </div>
    </div>
    <div class="dest-card">
      <div class="dest-img"><img src="https://images.unsplash.com/photo-1538485399081-7191377e8241?w=600&q=80" alt="Seoul South Korea"></div>
      <div class="dest-body">
        <h3>🇰🇷 South Korea</h3>
        <p>K-pop culture, ancient palaces, neon-lit Seoul, and cherry blossoms — a perfect blend of old and new.</p>
        <div class="dest-btns">
          <a href="destination-detail.php?dest=south-korea" class="btn-info">ℹ️ More Info</a>
          <a href="live_map.php" class="btn-map">🗺️ View Map</a>
        </div>
      </div>
    </div>
    <div class="dest-card">
      <div class="dest-img"><img src="https://images.unsplash.com/photo-1492571350019-22de08371fd3?w=600&q=80" alt="Mount Fuji Japan"></div>
      <div class="dest-body">
        <h3>🇯🇵 Japan</h3>
        <p>Mount Fuji serenity, bullet trains, cherry blossoms, anime culture and the world's most disciplined beauty.</p>
        <div class="dest-btns">
          <a href="destination-detail.php?dest=japan" class="btn-info">ℹ️ More Info</a>
          <a href="live_map.php" class="btn-map">🗺️ View Map</a>
        </div>
      </div>
    </div>
    <div class="dest-card">
      <div class="dest-img"><img src="https://images.unsplash.com/photo-1502602898657-3e91760cbb34?w=600&q=80" alt="Eiffel Tower Paris France"></div>
      <div class="dest-body">
        <h3>🇫🇷 France</h3>
        <p>Eiffel Tower romance, Louvre masterpieces, lavender fields of Provence, and unmatched French elegance.</p>
        <div class="dest-btns">
          <a href="destination-detail.php?dest=france" class="btn-info">ℹ️ More Info</a>
          <a href="live_map.php" class="btn-map">🗺️ View Map</a>
        </div>
      </div>
    </div>
    <div class="dest-card">
      <div class="dest-img"><img src="https://images.unsplash.com/photo-1506973035872-a4ec16b8e8d9?w=600&q=80" alt="Sydney Opera House Australia"></div>
      <div class="dest-body">
        <h3>🇦🇺 Australia</h3>
        <p>Great Barrier Reef, Sydney Opera House, Outback adventures, and the land down under's wild wonders.</p>
        <div class="dest-btns">
          <a href="destination-detail.php?dest=australia" class="btn-info">ℹ️ More Info</a>
          <a href="live_map.php" class="btn-map">🗺️ View Map</a>
        </div>
      </div>
    </div>
  </div>
  <div class="see-all-wrap">
    <a href="destination.php" class="btn-primary">View All Destinations →</a>
  </div>
</section>

<!-- PACKAGES PREVIEW -->
<section class="section packages">
  <div class="section-header">
    <span class="section-badge">Top Packages</span>
    <h2 class="section-title">Handpicked <span class="accent">Travel Deals</span></h2>
    <p class="section-sub">All-inclusive packages designed for every budget and dream — just pick and go!</p>
  </div>
  <div class="pkg-grid">
    <div class="pkg-card">
      <div class="pkg-thumb-home">
        <img src="https://images.unsplash.com/photo-1582672060674-bc2bd808a8b5?w=600&q=80" alt="Dubai Luxury">
        <span class="pkg-badge">🔥 Popular</span>
      </div>
      <div class="pkg-body-home">
        <div class="pkg-top">
          <h3>🇦🇪 Dubai Luxury Escape</h3>
          <div class="pkg-price">₹85,000<small>per person</small></div>
        </div>
        <div class="pkg-details">
          <span class="pkg-detail">📅 7 Days</span>
          <span class="pkg-detail">🏨 Atlantis The Palm</span>
          <span class="pkg-detail">✈️ Flights Included</span>
        </div>
        <a href="booking.php?pkg=dubai-luxury" class="btn-book">Book Package →</a>
      </div>
    </div>
    <div class="pkg-card">
      <div class="pkg-thumb-home">
        <img src="https://images.unsplash.com/photo-1492571350019-22de08371fd3?w=600&q=80" alt="Japan Cultural Journey">
        <span class="pkg-badge">✈️ International</span>
      </div>
      <div class="pkg-body-home">
        <div class="pkg-top">
          <h3>🇯🇵 Japan Cultural Journey</h3>
          <div class="pkg-price">₹1,10,000<small>per person</small></div>
        </div>
        <div class="pkg-details">
          <span class="pkg-detail">📅 10 Days</span>
          <span class="pkg-detail">🏨 Park Hyatt Tokyo</span>
          <span class="pkg-detail">✈️ Flights Included</span>
        </div>
        <a href="booking.php?pkg=japan-culture" class="btn-book">Book Package →</a>
      </div>
    </div>
    <div class="pkg-card">
      <div class="pkg-thumb-home">
        <img src="https://images.unsplash.com/photo-1512343879784-a960bf40e7f2?w=600&q=80" alt="Goa Beach Getaway">
        <span class="pkg-badge">🇮🇳 India</span>
      </div>
      <div class="pkg-body-home">
        <div class="pkg-top">
          <h3>🇮🇳 Goa Beach Getaway</h3>
          <div class="pkg-price">₹25,000<small>per person</small></div>
        </div>
        <div class="pkg-details">
          <span class="pkg-detail">📅 5 Days</span>
          <span class="pkg-detail">🏨 Taj Exotica Goa</span>
          <span class="pkg-detail">🚂 Train Included</span>
        </div>
        <a href="booking.php?pkg=goa-beach" class="btn-book">Book Package →</a>
      </div>
    </div>
  </div>
  <div class="see-all-wrap">
    <a href="packages.php" class="btn-primary">View All Packages →</a>
  </div>
</section>

<!-- TESTIMONIALS -->
<section class="section testimonials">
  <div class="section-header">
    <span class="section-badge">Traveler Stories</span>
    <h2 class="section-title">What Our <span class="accent">Travelers Say</span></h2>
  </div>
  <div class="testi-grid">
    <div class="testi-card">
      <div class="stars">★★★★★</div>
      <p>"Plan Karo made our Dubai trip absolutely magical. From booking to checkout — everything was seamless and the hotel suggestions were spot-on!"</p>
      <div class="testi-author">
        <div class="testi-avatar">😊</div>
        <div>
          <div class="testi-name">Priya Sharma</div>
          <div class="testi-loc">Mumbai, Maharashtra</div>
        </div>
      </div>
    </div>
    <div class="testi-card">
      <div class="stars">★★★★★</div>
      <p>"I planned my Japan trip in just 20 minutes using Plan Karo. The live map feature is incredible — I found hidden gems I'd never have discovered otherwise."</p>
      <div class="testi-author">
        <div class="testi-avatar">🧔</div>
        <div>
          <div class="testi-name">Arjun Mehta</div>
          <div class="testi-loc">Delhi, India</div>
        </div>
      </div>
    </div>
    <div class="testi-card">
      <div class="stars">★★★★★</div>
      <p>"Best travel platform in India! The custom trip planner helped me calculate our budget perfectly. Went to Manali with family — 10/10 experience!"</p>
      <div class="testi-author">
        <div class="testi-avatar">👩</div>
        <div>
          <div class="testi-name">Neha Kulkarni</div>
          <div class="testi-loc">Pune, Maharashtra</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-section">
  <h2>Your Next Adventure <span style="color:var(--gold)">Awaits</span></h2>
  <p>Join thousands of happy travelers who trust Plan Karo for their journeys. Start planning today — it's free!</p>
  <div class="cta-btns">
    <a href="register.php" class="btn-primary">🚀 Get Started Free</a>
    <a href="live_map.php" class="btn-outline">🗺️ Explore the Map</a>
    <a href="suggestion.php" class="btn-primary">✨ Tell Us Your Mood</a>
  </div>
</section>

<!-- FOOTER -->
<footer>
  <div class="footer-grid">
    <div class="footer-brand">
      <a href="index.php" class="logo">Plan <span>Karo</span></a>
      <p>Your trusted travel companion for journeys across India and the world. Safar Yadoon Ka…</p>
    </div>
    <div class="footer-col">
      <h4>Quick Links</h4>
      <a href="index.php">Home</a>
      <a href="destination.php">Destinations</a>
      <a href="packages.php">Packages</a>
      <a href="live_map.php">Live Map</a>
    </div>
    <div class="footer-col">
      <h4>Support</h4>
      <a href="contact.php">Contact Us</a>
      <a href="login.php">Login</a>
      <a href="register.php">Register</a>
    </div>
    <div class="footer-col">
      <h4>Contact</h4>
      <a href="/cdn-cgi/l/email-protection#7f161119103f0f131e11141e0d10511611">📧 <span class="__cf_email__" data-cfemail="2841464e47685844494643495a47064146">[email&#160;protected]</span></a>
      <a href="tel:+911800001234">📞 1800-000-1234</a>
      <a href="#">🌐 www.plankaro.in</a>
    </div>
  </div>
  <div class="footer-bottom">
    <p>© 2025 Plan Karo. All rights reserved. | Safar Yadoon Ka…</p>
    <p style="color:var(--teal)">Made with ❤️ for travelers</p>
  </div>
</footer>

<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>
  (function attachImageFallbacks() {
    const fallback = 'https://picsum.photos/seed/plankaro/1200/800';
    document.querySelectorAll('img').forEach((img) => {
      img.addEventListener('error', function onErr() {
        if (this.dataset.fallbackApplied === '1') return;
        this.dataset.fallbackApplied = '1';
        this.src = fallback;
      });
    });
  })();

  function toggleMenu() {
    document.getElementById('navLinks').classList.toggle('open');
  }
  // Scrol