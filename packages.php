<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Packages — Plan Karo</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root{--navy:#0f1b2d;--teal:#0ea5a4;--gold:#f59e0b;--white:#fff;--dark2:#111e2f;--muted:#94a3b8;}
    *,*::before,*::after{margin:0;padding:0;box-sizing:border-box;}
    html{scroll-behavior:smooth;}
    body{font-family:'Poppins',sans-serif;background:var(--navy);color:var(--white);}
    nav{position:fixed;top:0;left:0;right:0;z-index:1000;display:flex;align-items:center;justify-content:space-between;padding:16px 40px;background:rgba(15,27,45,0.95);backdrop-filter:blur(12px);border-bottom:1px solid rgba(14,165,164,0.2);}
    .logo{font-family:'Playfair Display',serif;font-size:1.7rem;color:var(--white);text-decoration:none;}
    .logo span{color:var(--gold);}
    .nav-links{display:flex;gap:6px;align-items:center;}
    .nav-links a{color:var(--muted);text-decoration:none;padding:8px 16px;border-radius:25px;font-size:0.88rem;font-weight:500;transition:all 0.25s;}
    .nav-links a:hover{color:var(--white);background:rgba(14,165,164,0.15);}
    .nav-links a.active{color:var(--navy);background:var(--gold);font-weight:600;}
    .nav-links a.btn-login{background:var(--teal);color:var(--white);}

    .page-hero{padding:140px 40px 70px;text-align:center;background:linear-gradient(180deg,var(--dark2),var(--navy));}
    .page-hero h1{font-family:'Playfair Display',serif;font-size:clamp(2.5rem,5vw,4rem);margin-bottom:12px;}
    .page-hero h1 span{color:var(--gold);}
    .page-hero p{color:var(--muted);font-size:1rem;max-width:560px;margin:0 auto;line-height:1.8;}

    .section{padding:70px 40px;}
    .section-header{margin-bottom:40px;}
    .section-badge{display:inline-block;background:rgba(14,165,164,0.1);border:1px solid rgba(14,165,164,0.3);color:var(--teal);font-size:0.72rem;font-weight:600;letter-spacing:3px;text-transform:uppercase;padding:6px 18px;border-radius:30px;margin-bottom:16px;}
    .section-title{font-family:'Playfair Display',serif;font-size:clamp(2rem,4vw,2.8rem);margin-bottom:10px;}
    .section-title span{color:var(--gold);}
    .section-sub{color:var(--muted);font-size:0.95rem;line-height:1.8;}

    /* Packages Grid */
    .pkg-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:24px;max-width:1200px;margin:0 auto;}
    .pkg-card{background:var(--dark2);border:1px solid rgba(255,255,255,0.06);border-radius:20px;overflow:hidden;transition:all 0.35s;}
    .pkg-card:hover{transform:translateY(-8px);border-color:rgba(14,165,164,0.3);box-shadow:0 24px 60px rgba(0,0,0,0.4);}
    .pkg-thumb{height:200px;position:relative;overflow:hidden;}
    .pkg-thumb img{width:100%;height:100%;object-fit:cover;transition:transform 0.5s ease;display:block;}
    .pkg-card:hover .pkg-thumb img{transform:scale(1.08);}
    .pkg-label{position:absolute;top:14px;left:14px;background:rgba(14,165,164,0.9);color:#fff;font-size:0.7rem;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;padding:5px 12px;border-radius:8px;}
    .pkg-label.gold{background:rgba(245,158,11,0.9);color:var(--navy);}
    .pkg-body{padding:24px 20px;}
    .pkg-top{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:12px;}
    .pkg-top h3{font-size:1.1rem;font-weight:700;max-width:60%;}
    .pkg-price{text-align:right;}
    .pkg-price .amount{font-family:'Playfair Display',serif;font-size:1.5rem;color:var(--gold);}
    .pkg-price small{display:block;font-size:0.72rem;color:var(--muted);}
    .pkg-details{display:flex;gap:14px;flex-wrap:wrap;margin:12px 0 18px;}
    .pkg-detail{font-size:0.8rem;color:var(--muted);display:flex;align-items:center;gap:5px;}
    .btn-book{display:block;width:100%;padding:13px;border-radius:12px;background:linear-gradient(135deg,var(--teal),#0b8786);color:#fff;font-family:'Poppins',sans-serif;font-weight:600;font-size:0.9rem;text-decoration:none;text-align:center;transition:all 0.3s;border:none;cursor:pointer;}
    .btn-book:hover{transform:translateY(-2px);box-shadow:0 8px 25px rgba(14,165,164,0.35);}

    /* Custom Trip Planner */
    .planner-section{background:var(--dark2);}
    .planner-box{max-width:900px;margin:0 auto;background:rgba(255,255,255,0.02);border:1px solid rgba(14,165,164,0.2);border-radius:24px;padding:48px;}
    .planner-grid{display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:24px;}
    .form-group{display:flex;flex-direction:column;gap:8px;}
    .form-group label{font-size:0.82rem;font-weight:600;color:var(--teal);letter-spacing:1px;text-transform:uppercase;}
    .form-group input, .form-group select{
      padding:14px 18px;border-radius:12px;border:1.5px solid rgba(255,255,255,0.1);
      background:rgba(255,255,255,0.05);color:var(--white);
      font-family:'Poppins',sans-serif;font-size:0.95rem;outline:none;transition:border-color 0.25s;
      appearance:none;
    }
    .form-group input::placeholder{color:var(--muted);}
    .form-group input:focus, .form-group select:focus{border-color:var(--teal);}
    .form-group select option{background:#1a2a3a;color:var(--white);}

    .budget-display{background:linear-gradient(135deg,rgba(14,165,164,0.1),rgba(245,158,11,0.08));border:1px solid rgba(14,165,164,0.3);border-radius:16px;padding:28px;margin:24px 0;text-align:center;}
    .budget-display .label{font-size:0.82rem;color:var(--muted);letter-spacing:2px;text-transform:uppercase;margin-bottom:8px;}
    .budget-display .amount{font-family:'Playfair Display',serif;font-size:3rem;color:var(--gold);}
    .budget-display .breakdown{margin-top:16px;display:grid;grid-template-columns:repeat(3,1fr);gap:16px;}
    .budget-display .b-item{background:rgba(255,255,255,0.04);border-radius:10px;padding:12px;}
    .budget-display .b-item .b-val{font-size:1.1rem;font-weight:700;color:var(--teal);}
    .budget-display .b-item .b-lbl{font-size:0.72rem;color:var(--muted);margin-top:4px;}

    footer{background:#080f1a;padding:40px;text-align:center;border-top:1px solid rgba(255,255,255,0.05);}
    footer p{color:var(--muted);font-size:0.85rem;}

    @media(max-width:768px){
      nav{padding:14px 20px;}
      .nav-links{display:none;}
      .section,.page-hero{padding:60px 20px;}
      .page-hero{padding-top:110px;}
      .planner-grid{grid-template-columns:1fr;}
      .planner-box{padding:28px 20px;}
      .budget-display .breakdown{grid-template-columns:1fr;}
    }
  </style>
</head>
<body>
<nav>
  <a href="index.php" class="logo">Plan <span>Karo</span></a>
  <div class="nav-links">
    <a href="index.php">🏠 Home</a>
    <a href="destination.php">🌍 Destinations</a>
    <a href="packages.php" class="active">📦 Packages</a>
    <a href="live_map.php">🗺️ Live Map</a>
    <a href="contact.php">📞 Contact</a>
    <a href="admin/login.php">🛠️ Admin</a>
    <a href="login.php" class="btn-login">🔑 Login</a>
  </div>
</nav>

<div class="page-hero">
  <h1>Travel <span>Packages</span></h1>
  <p>Curated all-inclusive travel deals for every destination and budget. Just pick, pack, and go!</p>
</div>

<!-- PACKAGES -->
<section class="section" style="background:var(--navy)">
  <div class="section-header">
    <span class="section-badge">All Packages</span>
    <h2 class="section-title">Handpicked <span>Travel Deals</span></h2>
    <p class="section-sub">All packages include hotel stays, transfers, and guided activities.</p>
  </div>
  <div class="pkg-grid">

    <div class="pkg-card">
      <div class="pkg-thumb">
        <img src="https://images.unsplash.com/photo-1582672060674-bc2bd808a8b5?w=600&q=80" alt="Dubai Burj Khalifa">
        <div class="pkg-label gold">🔥 Popular</div>
      </div>
      <div class="pkg-body">
        <div class="pkg-top">
          <h3>Dubai Luxury Escape</h3>
          <div class="pkg-price"><span class="amount">₹85,000</span><small>per person</small></div>
        </div>
        <div class="pkg-details">
          <span class="pkg-detail">📅 7 Days</span>
          <span class="pkg-detail">🏨 Atlantis The Palm</span>
          <span class="pkg-detail">✈️ Flights</span>
          <span class="pkg-detail">🇦🇪 Dubai</span>
        </div>
        <a href="booking.php?pkg=Dubai+Luxury+Escape&price=85000&hotel=Atlantis+The+Palm&days=7&dest=Dubai" class="btn-book">Book Package →</a>
      </div>
    </div>

    <div class="pkg-card">
      <div class="pkg-thumb">
        <img src="https://images.unsplash.com/photo-1492571350019-22de08371fd3?w=600&q=80" alt="Mount Fuji Japan">
        <div class="pkg-label">✈️ International</div>
      </div>
      <div class="pkg-body">
        <div class="pkg-top">
          <h3>Japan Cultural Journey</h3>
          <div class="pkg-price"><span class="amount">₹1,10,000</span><small>per person</small></div>
        </div>
        <div class="pkg-details">
          <span class="pkg-detail">📅 10 Days</span>
          <span class="pkg-detail">🏨 Park Hyatt Tokyo</span>
          <span class="pkg-detail">✈️ Flights</span>
          <span class="pkg-detail">🇯🇵 Japan</span>
        </div>
        <a href="booking.php?pkg=Japan+Cultural+Journey&price=110000&hotel=Park+Hyatt+Tokyo&days=10&dest=Japan" class="btn-book">Book Package →</a>
      </div>
    </div>

    <div class="pkg-card">
      <div class="pkg-thumb">
        <img src="https://images.unsplash.com/photo-1512343879784-a960bf40e7f2?w=600&q=80" alt="Goa Beach">
        <div class="pkg-label gold">🇮🇳 India</div>
      </div>
      <div class="pkg-body">
        <div class="pkg-top">
          <h3>Goa Beach Getaway</h3>
          <div class="pkg-price"><span class="amount">₹25,000</span><small>per person</small></div>
        </div>
        <div class="pkg-details">
          <span class="pkg-detail">📅 5 Days</span>
          <span class="pkg-detail">🏨 Taj Exotica</span>
          <span class="pkg-detail">🚂 Train</span>
          <span class="pkg-detail">🇮🇳 Goa</span>
        </div>
        <a href="booking.php?pkg=Goa+Beach+Getaway&price=25000&hotel=Taj+Exotica+Goa&days=5&dest=Goa" class="btn-book">Book Package →</a>
      </div>
    </div>

    <div class="pkg-card">
      <div class="pkg-thumb">
        <img src="https://images.unsplash.com/photo-1566837945700-30057527ade0?w=600&q=80" alt="Kashmir Himalaya">
        <div class="pkg-label">🏔️ Mountain</div>
      </div>
      <div class="pkg-body">
        <div class="pkg-top">
          <h3>Kashmir Himalayan Dream</h3>
          <div class="pkg-price"><span class="amount">₹55,000</span><small>per person</small></div>
        </div>
        <div class="pkg-details">
          <span class="pkg-detail">📅 7 Days</span>
          <span class="pkg-detail">🏨 Vivanta Dal View</span>
          <span class="pkg-detail">✈️ Flights</span>
          <span class="pkg-detail">🇮🇳 Kashmir</span>
        </div>
        <a href="booking.php?pkg=Kashmir+Himalayan+Dream&price=55000&hotel=Vivanta+Dal+View&days=7&dest=Kashmir" class="btn-book">Book Package →</a>
      </div>
    </div>

    <div class="pkg-card">
      <div class="pkg-thumb">
        <img src="https://images.unsplash.com/photo-1499092346302-2a4cd7571c7f?w=600&q=80" alt="New York City USA">
        <div class="pkg-label">🇺🇸 USA</div>
      </div>
      <div class="pkg-body">
        <div class="pkg-top">
          <h3>USA East Coast Explorer</h3>
          <div class="pkg-price"><span class="amount">₹1,80,000</span><small>per person</small></div>
        </div>
        <div class="pkg-details">
          <span class="pkg-detail">📅 12 Days</span>
          <span class="pkg-detail">🏨 The Plaza Hotel</span>
          <span class="pkg-detail">✈️ Flights</span>
          <span class="pkg-detail">🇺🇸 USA</span>
        </div>
        <a href="booking.php?pkg=USA+East+Coast+Explorer&price=180000&hotel=The+Plaza+Hotel&days=12&dest=USA" class="btn-book">Book Package →</a>
      </div>
    </div>

    <div class="pkg-card">
      <div class="pkg-thumb">
        <img src="https://images.unsplash.com/photo-1538485399081-7191377e8241?w=600&q=80" alt="Seoul South Korea">
        <div class="pkg-label">🇰🇷 Korea</div>
      </div>
      <div class="pkg-body">
        <div class="pkg-top">
          <h3>South Korea K-Culture Tour</h3>
          <div class="pkg-price"><span class="amount">₹95,000</span><small>per person</small></div>
        </div>
        <div class="pkg-details">
          <span class="pkg-detail">📅 8 Days</span>
          <span class="pkg-detail">🏨 Lotte Hotel Seoul</span>
          <span class="pkg-detail">✈️ Flights</span>
          <span class="pkg-detail">🇰🇷 Seoul</span>
        </div>
        <a href="booking.php?pkg=South+Korea+K-Culture+Tour&price=95000&hotel=Lotte+Hotel+Seoul&days=8&dest=South+Korea" class="btn-book">Book Package →</a>
      </div>
    </div>

    <div class="pkg-card">
      <div class="pkg-thumb">
        <img src="https://images.unsplash.com/photo-1552832230-c0197dd311b5?w=600&q=80" alt="Rome Colosseum Italy">
        <div class="pkg-label">🇮🇹 Europe</div>
      </div>
      <div class="pkg-body">
        <div class="pkg-top">
          <h3>Italy Heritage Discovery</h3>
          <div class="pkg-price"><span class="amount">₹1,25,000</span><small>per person</small></div>
        </div>
        <div class="pkg-details">
          <span class="pkg-detail">📅 9 Days</span>
          <span class="pkg-detail">🏨 Hotel Hassler Rome</span>
          <span class="pkg-detail">✈️ Flights</span>
          <span class="pkg-detail">🇮🇹 Italy</span>
        </div>
        <a href="booking.php?pkg=Italy+Heritage+Discovery&price=125000&hotel=Hotel+Hassler+Rome&days=9&dest=Italy" class="btn-book">Book Package →</a>
      </div>
    </div>

    <div class="pkg-card">
      <div class="pkg-thumb">
        <img src="https://images.unsplash.com/photo-1506973035872-a4ec16b8e8d9?w=600&q=80" alt="Sydney Opera House Australia">
        <div class="pkg-label">🇦🇺 Australia</div>
      </div>
      <div class="pkg-body">
        <div class="pkg-top">
          <h3>Australia Grand Tour</h3>
          <div class="pkg-price"><span class="amount">₹1,60,000</span><small>per person</small></div>
        </div>
        <div class="pkg-details">
          <span class="pkg-detail">📅 11 Days</span>
          <span class="pkg-detail">🏨 Park Hyatt Sydney</span>
          <span class="pkg-detail">✈️ Flights</span>
          <span class="pkg-detail">🇦🇺 Australia</span>
        </div>
        <a href="booking.php?pkg=Australia+Grand+Tour&price=160000&hotel=Park+Hyatt+Sydney&days=11&dest=Australia" class="btn-book">Book Package →</a>
      </div>
    </div>

  </div>
</section>

<!-- CUSTOM TRIP PLANNER -->
<section class="section planner-section">
  <div class="section-header" style="text-align:center">
    <span class="section-badge">Custom Planner</span>
    <h2 class="section-title">🧳 Build Your <span>Own Trip</span></h2>
    <p class="section-sub">Enter your preferences and we'll calculate your estimated budget instantly.</p>
  </div>
  <div class="planner-box">
    <div class="planner-grid">
      <div class="form-group">
        <label>📍 From Location</label>
        <input type="text" id="fromLoc" placeholder="e.g. Mumbai, Delhi" oninput="calcBudget()">
      </div>
      <div class="form-group">
        <label>✈️ To Destination</label>
        <select id="toDest" onchange="calcBudget()">
          <option value="">Select Destination…</option>
          <option value="goa" data-hotel="5000" data-flight="3000">Goa, India</option>
          <option value="manali" data-hotel="4000" data-flight="4000">Manali, India</option>
          <option value="kashmir" data-hotel="8000" data-flight="6000">Kashmir, India</option>
          <option value="rajasthan" data-hotel="6000" data-flight="5000">Rajasthan, India</option>
          <option value="kerala" data-hotel="7000" data-flight="5000">Kerala, India</option>
          <option value="dubai" data-hotel="25000" data-flight="18000">Dubai, UAE</option>
          <option value="japan" data-hotel="30000" data-flight="35000">Japan</option>
          <option value="usa" data-hotel="32000" data-flight="60000">USA</option>
          <option value="italy" data-hotel="28000" data-flight="45000">Italy</option>
          <option value="south-korea" data-hotel="22000" data-flight="30000">South Korea</option>
          <option value="france" data-hotel="30000" data-flight="50000">France</option>
          <option value="australia" data-hotel="35000" data-flight="55000">Australia</option>
        </select>
      </div>
      <div class="form-group">
        <label>👥 Number of Members</label>
        <input type="number" id="members" min="1" max="20" value="2" placeholder="2" oninput="calcBudget()">
      </div>
      <div class="form-group">
        <label>📅 Number of Days</label>
        <input type="number" id="days" min="1" max="30" value="5" placeholder="5" oninput="calcBudget()">
      </div>
      <div class="form-group" style="grid-column:span 2">
        <label>🏨 Hotel Category</label>
        <select id="hotelCat" onchange="calcBudget()">
          <option value="1">⭐⭐⭐ Budget (3-Star)</option>
          <option value="1.8" selected>⭐⭐⭐⭐ Comfort (4-Star)</option>
          <option value="3">⭐⭐⭐⭐⭐ Luxury (5-Star)</option>
        </select>
      </div>
    </div>

    <div class="budget-display" id="budgetDisplay" style="display:none">
      <div class="label">Estimated Total Budget</div>
      <div class="amount" id="totalBudget">₹0</div>
      <div class="breakdown">
        <div class="b-item"><div class="b-val" id="flightCost">—</div><div class="b-lbl">✈️ Flights</div></div>
        <div class="b-item"><div class="b-val" id="hotelCost">—</div><div class="b-lbl">🏨 Hotels</div></div>
        <div class="b-item"><div class="b-val" id="miscCost">—</div><div class="b-lbl">🎟️ Activities & Misc</div></div>
      </div>
    </div>

    <div id="bookPlannerWrap" style="display:none">
      <a href="#" id="bookPlannerBtn" class="btn-book" style="margin-top:0">🚀 Book This Custom Trip →</a>
    </div>
  </div>
</section>

<footer>
  <p>© 2025 Plan Karo | <a href="index.php" style="color:var(--teal);text-decoration:none">Back to Home</a></p>
</footer>

<script>
function calcBudget() {
  const dest = document.getElementById('toDest');
  const selOpt = dest.options[dest.selectedIndex];
  if (!selOpt.value) { document.getElementById('budgetDisplay').style.display='none'; document.getElementById('bookPlannerWrap').style.display='none'; return; }
  
  const members = parseInt(document.getElementById('members').value) || 1;
  const days = parseInt(document.getElementById('days').value) || 1;
  const hotelMult = parseFloat(document.getElementById('hotelCat').value);
  
  const baseHotel = parseInt(selOpt.dataset.hotel) || 5000;
  const baseFlight = parseInt(selOpt.dataset.flight) || 5000;
  
  const flightTotal = baseFlight * members;
  const hotelTotal = baseHotel * hotelMult * days;
  const miscTotal = Math.round((flightTotal + hotelTotal) * 0.2);
  const grand = flightTotal + hotelTotal + miscTotal;
  
  const fmt = n => '₹' + n.toLocaleString('en-IN');
  document.getElementById('flightCost').textContent = fmt(flightTotal);
  document.getElementById('hotelCost').textContent = fmt(hotelTotal);
  document.getElementById('miscCost').textContent = fmt(miscTotal);
  document.getElementById('totalBudget').textContent = fmt(grand);
  document.getElementById('budgetDisplay').style.display='block';
  document.getElementById('bookPlannerWrap').style.display='block';
  
  const from = encodeURIComponent(document.getElementById('fromLoc').value || 'India');
  const destName = encodeURIComponent(selOpt.textContent);
  document.getElementById('bookPlannerBtn').href = `booking.php?pkg=Custom+Trip+to+${destName}&price=${grand}&dest=${destName}&days=${days}&members=${members}&custom=1`;
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
