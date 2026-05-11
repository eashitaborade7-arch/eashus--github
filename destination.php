<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Destinations — Plan Karo</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root { --navy:#0f1b2d; --teal:#0ea5a4; --gold:#f59e0b; --white:#fff; --dark2:#111e2f; --muted:#94a3b8; }
    *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
    html { scroll-behavior:smooth; }
    body { font-family:'Poppins',sans-serif; background:var(--navy); color:var(--white); }

    nav { position:fixed; top:0; left:0; right:0; z-index:1000; display:flex; align-items:center; justify-content:space-between; padding:16px 40px; background:rgba(15,27,45,0.95); backdrop-filter:blur(12px); border-bottom:1px solid rgba(14,165,164,0.2); }
    .logo { font-family:'Playfair Display',serif; font-size:1.7rem; color:var(--white); text-decoration:none; }
    .logo span { color:var(--gold); }
    .nav-links { display:flex; gap:6px; align-items:center; }
    .nav-links a { color:var(--muted); text-decoration:none; padding:8px 16px; border-radius:25px; font-size:0.88rem; font-weight:500; transition:all 0.25s; }
    .nav-links a:hover { color:var(--white); background:rgba(14,165,164,0.15); }
    .nav-links a.active { color:var(--navy); background:var(--gold); font-weight:600; }
    .nav-links a.btn-login { background:var(--teal); color:var(--white); }
    .hamburger { display:none; flex-direction:column; gap:5px; cursor:pointer; }
    .hamburger span { width:24px; height:2px; background:var(--white); border-radius:2px; }

    .page-hero { padding:140px 40px 70px; text-align:center; background:linear-gradient(180deg, var(--dark2) 0%, var(--navy) 100%); }
    .page-hero h1 { font-family:'Playfair Display',serif; font-size:clamp(2.5rem,5vw,4rem); margin-bottom:12px; }
    .page-hero h1 span { color:var(--gold); }
    .page-hero p { color:var(--muted); font-size:1rem; max-width:560px; margin:0 auto; line-height:1.8; }

    .filter-bar { display:flex; justify-content:center; gap:10px; flex-wrap:wrap; padding:30px 40px; background:var(--dark2); border-bottom:1px solid rgba(255,255,255,0.05); }
    .filter-btn { padding:9px 22px; border-radius:25px; border:1.5px solid rgba(255,255,255,0.15); background:transparent; color:var(--muted); font-family:'Poppins',sans-serif; font-size:0.85rem; cursor:pointer; transition:all 0.25s; }
    .filter-btn:hover, .filter-btn.on { background:var(--teal); border-color:var(--teal); color:#fff; }
    .filter-btn.gold-on { background:var(--gold); border-color:var(--gold); color:var(--navy); }

    .dest-section { padding:60px 40px; }
    .section-label { font-size:0.75rem; font-weight:700; letter-spacing:3px; text-transform:uppercase; color:var(--teal); margin-bottom:28px; display:flex; align-items:center; gap:12px; }
    .section-label::after { content:''; flex:1; height:1px; background:rgba(14,165,164,0.2); }

    .dest-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(300px,1fr)); gap:28px; max-width:1200px; margin:0 auto; }
    .dest-card { border-radius:20px; overflow:hidden; background:var(--dark2); border:1px solid rgba(255,255,255,0.06); transition:all 0.35s; }
    .dest-card:hover { transform:translateY(-8px); border-color:rgba(14,165,164,0.3); box-shadow:0 24px 60px rgba(0,0,0,0.4); }
    .card-thumb {
      height:220px; position:relative; overflow:hidden;
    }
    .card-thumb img {
      width:100%; height:100%; object-fit:cover;
      transition:transform 0.5s ease;
      display:block;
    }
    .dest-card:hover .card-thumb img { transform:scale(1.08); }
    .card-thumb .overlay { position:absolute; inset:0; background:linear-gradient(180deg,transparent 40%,rgba(15,27,45,0.8)); }
    .card-badge { position:absolute; top:12px; left:12px; background:rgba(14,165,164,0.85); backdrop-filter:blur(4px); color:#fff; font-size:0.7rem; font-weight:600; letter-spacing:1.5px; text-transform:uppercase; padding:4px 10px; border-radius:6px; }
    .card-body { padding:22px 20px; }
    .card-body h3 { font-size:1.2rem; font-weight:700; margin-bottom:8px; }
    .card-body p { color:var(--muted); font-size:0.88rem; line-height:1.7; margin-bottom:16px; }
    .card-meta { display:flex; gap:16px; margin-bottom:18px; flex-wrap:wrap; }
    .card-meta span { font-size:0.78rem; color:var(--muted); display:flex; align-items:center; gap:4px; }
    .card-meta span strong { color:var(--gold); }
    .card-btns { display:flex; gap:10px; }
    .card-btns a { flex:1; text-align:center; padding:10px; border-radius:10px; font-size:0.82rem; font-weight:600; text-decoration:none; transition:all 0.25s; }
    .btn-info { background:rgba(14,165,164,0.1); border:1px solid rgba(14,165,164,0.3); color:var(--teal); }
    .btn-info:hover { background:var(--teal); color:#fff; }
    .btn-map { background:rgba(245,158,11,0.1); border:1px solid rgba(245,158,11,0.3); color:var(--gold); }
    .btn-map:hover { background:var(--gold); color:var(--navy); }

    footer { background:#080f1a; padding:40px; text-align:center; border-top:1px solid rgba(255,255,255,0.05); }
    footer p { color:var(--muted); font-size:0.85rem; }

    @media(max-width:768px) {
      nav { padding:14px 20px; }
      .hamburger { display:flex; }
      .nav-links { display:none; position:absolute; top:100%; left:0; right:0; background:var(--dark2); flex-direction:column; padding:16px; gap:4px; border-bottom:1px solid rgba(14,165,164,0.2); }
      .nav-links.open { display:flex; }
      .dest-section, .page-hero { padding:60px 20px; }
      .page-hero { padding-top:110px; }
    }
  </style>
</head>
<body>
<nav>
  <a href="index.php" class="logo">Plan <span>Karo</span></a>
  <div class="hamburger" onclick="document.getElementById('nl').classList.toggle('open')">
    <span></span><span></span><span></span>
  </div>
  <div class="nav-links" id="nl">
    <a href="index.php">🏠 Home</a>
    <a href="destination.php" class="active">🌍 Destinations</a>
    <a href="packages.php">📦 Packages</a>
    <a href="live_map.php">🗺️ Live Map</a>
    <a href="contact.php">📞 Contact Us</a>
    <a href="admin/login.php">🛠️ Admin</a>
    <a href="login.php" class="btn-login">🔑 Login</a>
  </div>
</nav>

<div class="page-hero">
  <h1>Explore <span>Destinations</span></h1>
  <p>From sun-kissed beaches to snow-capped peaks — discover your next unforgettable adventure across the world.</p>
</div>

<div class="filter-bar">
  <button class="filter-btn on" onclick="filterCards('all',this)">🌐 All</button>
  <button class="filter-btn" onclick="filterCards('international',this)">✈️ International</button>
  <button class="filter-btn" onclick="filterCards('india',this)">🇮🇳 India</button>
  <button class="filter-btn" onclick="filterCards('beach',this)">🏖️ Beach</button>
  <button class="filter-btn" onclick="filterCards('mountain',this)">🏔️ Mountain</button>
  <button class="filter-btn" onclick="filterCards('romantic',this)">💕 Romantic</button>
</div>

<section class="dest-section">
  <div class="section-label">🌍 International Destinations</div>
  <div class="dest-grid" id="destGrid">

    <div class="dest-card" data-cat="international">
      <div class="card-thumb">
        <img src="https://images.unsplash.com/photo-1499092346302-2a4cd7571c7f?w=600&q=80" alt="USA - New York City">
        <div class="overlay"></div>
        <div class="card-badge">International</div>
      </div>
      <div class="card-body">
        <h3>🇺🇸 USA — United States</h3>
        <p>Grand Canyon, NYC skyline, Las Vegas strip, Yellowstone, and the iconic Pacific Highway road trip.</p>
        <div class="card-meta">
          <span>💰 Budget: <strong>₹2,00,000+</strong></span>
          <span>📅 Best: <strong>Sep–Nov</strong></span>
        </div>
        <div class="card-btns">
          <a href="destination-detail.php?dest=usa" class="btn-info">ℹ️ More Info</a>
          <a href="live_map.php" class="btn-map">🗺️ View Map</a>
        </div>
      </div>
    </div>

    <div class="dest-card" data-cat="international">
      <div class="card-thumb">
        <img src="https://images.unsplash.com/photo-1582672060674-bc2bd808a8b5?w=600&q=80" alt="Dubai Skyline">
        <div class="overlay"></div>
        <div class="card-badge">International</div>
      </div>
      <div class="card-body">
        <h3>🇦🇪 Dubai — UAE</h3>
        <p>Burj Khalifa, desert safaris, gold souks, the Palm Jumeirah, and world-class dining experiences.</p>
        <div class="card-meta">
          <span>💰 Budget: <strong>₹1,20,000+</strong></span>
          <span>📅 Best: <strong>Oct–Apr</strong></span>
        </div>
        <div class="card-btns">
          <a href="destination-detail.php?dest=dubai" class="btn-info">ℹ️ More Info</a>
          <a href="live_map.php" class="btn-map">🗺️ View Map</a>
        </div>
      </div>
    </div>

    <div class="dest-card" data-cat="international">
      <div class="card-thumb">
        <img src="https://images.unsplash.com/photo-1552832230-c0197dd311b5?w=600&q=80" alt="Rome Colosseum Italy">
        <div class="overlay"></div>
        <div class="card-badge">International</div>
      </div>
      <div class="card-body">
        <h3>🇮🇹 Italy — Rome & Beyond</h3>
        <p>Colosseum, Vatican City, Amalfi Coast, Venetian canals, and pasta that will change your life.</p>
        <div class="card-meta">
          <span>💰 Budget: <strong>₹1,40,000+</strong></span>
          <span>📅 Best: <strong>Apr–Jun</strong></span>
        </div>
        <div class="card-btns">
          <a href="destination-detail.php?dest=italy" class="btn-info">ℹ️ More Info</a>
          <a href="live_map.php" class="btn-map">🗺️ View Map</a>
        </div>
      </div>
    </div>

    <div class="dest-card" data-cat="international">
      <div class="card-thumb">
        <img src="https://images.unsplash.com/photo-1538485399081-7191377e8241?w=600&q=80" alt="Seoul South Korea">
        <div class="overlay"></div>
        <div class="card-badge">International</div>
      </div>
      <div class="card-body">
        <h3>🇰🇷 South Korea</h3>
        <p>Ancient Gyeongbokgung Palace, neon Seoul, K-pop culture, DMZ border, and incredible street food.</p>
        <div class="card-meta">
          <span>💰 Budget: <strong>₹1,20,000+</strong></span>
          <span>📅 Best: <strong>Mar–May</strong></span>
        </div>
        <div class="card-btns">
          <a href="destination-detail.php?dest=south-korea" class="btn-info">ℹ️ More Info</a>
          <a href="live_map.php" class="btn-map">🗺️ View Map</a>
        </div>
      </div>
    </div>

    <div class="dest-card" data-cat="international">
      <div class="card-thumb">
        <img src="https://images.unsplash.com/photo-1492571350019-22de08371fd3?w=600&q=80" alt="Mount Fuji Japan">
        <div class="overlay"></div>
        <div class="card-badge">International</div>
      </div>
      <div class="card-body">
        <h3>🇯🇵 Japan</h3>
        <p>Mount Fuji, Shibuya crossing, bullet trains, cherry blossoms, anime culture, and ancient temples.</p>
        <div class="card-meta">
          <span>💰 Budget: <strong>₹1,50,000+</strong></span>
          <span>📅 Best: <strong>Mar–Apr</strong></span>
        </div>
        <div class="card-btns">
          <a href="destination-detail.php?dest=japan" class="btn-info">ℹ️ More Info</a>
          <a href="live_map.php" class="btn-map">🗺️ View Map</a>
        </div>
      </div>
    </div>

    <div class="dest-card" data-cat="international">
      <div class="card-thumb">
        <img src="https://images.unsplash.com/photo-1502602898657-3e91760cbb34?w=600&q=80" alt="Eiffel Tower Paris France">
        <div class="overlay"></div>
        <div class="card-badge">International</div>
      </div>
      <div class="card-body">
        <h3>🇫🇷 France</h3>
        <p>Eiffel Tower, Louvre Museum, lavender fields, Côte d'Azur, and the finest wine and cuisine on Earth.</p>
        <div class="card-meta">
          <span>💰 Budget: <strong>₹1,50,000+</strong></span>
          <span>📅 Best: <strong>Jun–Aug</strong></span>
        </div>
        <div class="card-btns">
          <a href="destination-detail.php?dest=france" class="btn-info">ℹ️ More Info</a>
          <a href="live_map.php" class="btn-map">🗺️ View Map</a>
        </div>
      </div>
    </div>

    <div class="dest-card" data-cat="international">
      <div class="card-thumb">
        <img src="https://images.unsplash.com/photo-1506973035872-a4ec16b8e8d9?w=600&q=80" alt="Sydney Opera House Australia">
        <div class="overlay"></div>
        <div class="card-badge">International</div>
      </div>
      <div class="card-body">
        <h3>🇦🇺 Australia</h3>
        <p>Great Barrier Reef, Sydney Opera House, Uluru, kangaroos, and the world's most unique wildlife.</p>
        <div class="card-meta">
          <span>💰 Budget: <strong>₹1,80,000+</strong></span>
          <span>📅 Best: <strong>Sep–Nov</strong></span>
        </div>
        <div class="card-btns">
          <a href="destination-detail.php?dest=australia" class="btn-info">ℹ️ More Info</a>
          <a href="live_map.php" class="btn-map">🗺️ View Map</a>
        </div>
      </div>
    </div>

    <!-- India Destinations -->
    <div class="dest-card" data-cat="india beach">
      <div class="card-thumb">
        <img src="https://images.unsplash.com/photo-1512343879784-a960bf40e7f2?w=600&q=80" alt="Goa Beach India">
        <div class="overlay"></div>
        <div class="card-badge">Beach</div>
      </div>
      <div class="card-body">
        <h3>🇮🇳 Goa</h3>
        <p>Pristine beaches, Portuguese architecture, vibrant nightlife, water sports, and sun-drenched paradise.</p>
        <div class="card-meta">
          <span>💰 Budget: <strong>₹25,000–₹40,000</strong></span>
          <span>📅 Best: <strong>Nov–Feb</strong></span>
        </div>
        <div class="card-btns">
          <a href="destination-detail.php?dest=goa" class="btn-info">ℹ️ More Info</a>
          <a href="live_map.php" class="btn-map">🗺️ View Map</a>
        </div>
      </div>
    </div>

    <div class="dest-card" data-cat="india mountain">
      <div class="card-thumb">
        <img src="https://images.unsplash.com/photo-1566837945700-30057527ade0?w=600&q=80" alt="Kashmir Dal Lake India">
        <div class="overlay"></div>
        <div class="card-badge">Mountain</div>
      </div>
      <div class="card-body">
        <h3>🇮🇳 Kashmir</h3>
        <p>Heaven on Earth — Dal Lake houseboats, snow-laden valleys, saffron fields, and breathtaking Himalayan views.</p>
        <div class="card-meta">
          <span>💰 Budget: <strong>₹40,000–₹70,000</strong></span>
          <span>📅 Best: <strong>Apr–Jun</strong></span>
        </div>
        <div class="card-btns">
          <a href="destination-detail.php?dest=kashmir" class="btn-info">ℹ️ More Info</a>
          <a href="live_map.php" class="btn-map">🗺️ View Map</a>
        </div>
      </div>
    </div>

    <div class="dest-card" data-cat="india mountain">
      <div class="card-thumb">
        <img src="https://images.unsplash.com/photo-1626621341517-bbf3d9990a23?w=600&q=80" alt="Manali Snow Mountains India">
        <div class="overlay"></div>
        <div class="card-badge">Hill Station</div>
      </div>
      <div class="card-body">
        <h3>🇮🇳 Manali</h3>
        <p>Snow-capped peaks, Rohtang Pass, river rafting, and the magical Solang Valley — adventure capital of India.</p>
        <div class="card-meta">
          <span>💰 Budget: <strong>₹30,000–₹45,000</strong></span>
          <span>📅 Best: <strong>Oct–Jun</strong></span>
        </div>
        <div class="card-btns">
          <a href="destination-detail.php?dest=manali" class="btn-info">ℹ️ More Info</a>
          <a href="live_map.php" class="btn-map">🗺️ View Map</a>
        </div>
      </div>
    </div>

    <div class="dest-card" data-cat="india romantic">
      <div class="card-thumb">
        <img src="https://images.unsplash.com/photo-1524492412937-b28074a5d7da?w=600&q=80" alt="Rajasthan Palace India">
        <div class="overlay"></div>
        <div class="card-badge">Romantic</div>
      </div>
      <div class="card-body">
        <h3>🇮🇳 Rajasthan</h3>
        <p>Jaipur's pink city, Udaipur's lake palaces, Jaisalmer desert forts — India's most royal experience.</p>
        <div class="card-meta">
          <span>💰 Budget: <strong>₹30,000–₹55,000</strong></span>
          <span>📅 Best: <strong>Oct–Mar</strong></span>
        </div>
        <div class="card-btns">
          <a href="destination-detail.php?dest=rajasthan" class="btn-info">ℹ️ More Info</a>
          <a href="live_map.php" class="btn-map">🗺️ View Map</a>
        </div>
      </div>
    </div>

    <div class="dest-card" data-cat="india romantic beach">
      <div class="card-thumb">
        <img src="https://images.unsplash.com/photo-1602216056096-3b40cc0c9944?w=600&q=80" alt="Kerala Backwaters India">
        <div class="overlay"></div>
        <div class="card-badge">Backwaters</div>
      </div>
      <div class="card-body">
        <h3>🇮🇳 Kerala</h3>
        <p>Houseboat cruises through emerald backwaters, spice gardens, Ayurveda retreats, and serene beaches.</p>
        <div class="card-meta">
          <span>💰 Budget: <strong>₹35,000–₹55,000</strong></span>
          <span>📅 Best: <strong>Sep–Mar</strong></span>
        </div>
        <div class="card-btns">
          <a href="destination-detail.php?dest=kerala" class="btn-info">ℹ️ More Info</a>
          <a href="live_map.php" class="btn-map">🗺️ View Map</a>
        </div>
      </div>
    </div>

  </div>
</section>

<footer>
  <p>© 2025 Plan Karo | <a href="index.php" style="color:var(--teal);text-decoration:none">Back to Home</a></p>
</footer>

<script>
  function filterCards(cat, btn) {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('on'));
    btn.classList.add('on');
    document.querySelectorAll('.dest-card').forEach(card => {
      const cats = card.dataset.cat || '';
      card.style.display = (cat === 'all' || cats.includes(cat)) ? '' : 'none';
    });
  }

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
</script>
</body>
</html>
