<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Destination Detail — Plan Karo</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root { --navy:#0f1b2d; --teal:#0ea5a4; --gold:#f59e0b; --white:#fff; --dark2:#111e2f; --muted:#94a3b8; }
    *,*::before,*::after{margin:0;padding:0;box-sizing:border-box;}
    html{scroll-behavior:smooth;}
    body{font-family:'Poppins',sans-serif;background:var(--navy);color:var(--white);}
    nav{position:fixed;top:0;left:0;right:0;z-index:1000;display:flex;align-items:center;justify-content:space-between;padding:16px 40px;background:rgba(15,27,45,0.95);backdrop-filter:blur(12px);border-bottom:1px solid rgba(14,165,164,0.2);}
    .logo{font-family:'Playfair Display',serif;font-size:1.7rem;color:var(--white);text-decoration:none;}
    .logo span{color:var(--gold);}
    .nav-links{display:flex;gap:6px;align-items:center;}
    .nav-links a{color:var(--muted);text-decoration:none;padding:8px 16px;border-radius:25px;font-size:0.88rem;font-weight:500;transition:all 0.25s;}
    .nav-links a:hover{color:var(--white);background:rgba(14,165,164,0.15);}
    .nav-links a.btn-login{background:var(--teal);color:var(--white);}

    .dest-hero {
      min-height:60vh; display:flex; align-items:flex-end; justify-content:flex-start;
      padding:100px 60px 50px;
      background:linear-gradient(135deg,#0f1b2d,#0a3d4f);
      position:relative; overflow:hidden;
    }
    .dest-hero .hero-bg-emoji {
      position:absolute; right:-40px; top:50%; transform:translateY(-50%);
      font-size:20rem; opacity:0.08; user-select:none;
    }
    .dest-hero-content { position:relative; z-index:1; }
    .breadcrumb { display:flex; gap:8px; align-items:center; margin-bottom:16px; }
    .breadcrumb a { color:var(--teal); text-decoration:none; font-size:0.85rem; }
    .breadcrumb span { color:var(--muted); font-size:0.85rem; }
    .dest-hero h1 { font-family:'Playfair Display',serif; font-size:clamp(2.5rem,5vw,4rem); margin-bottom:12px; line-height:1.1; }
    .dest-hero p { color:#cbd5e1; font-size:1rem; max-width:600px; line-height:1.8; margin-bottom:24px; }
    .hero-tags { display:flex; gap:10px; flex-wrap:wrap; }
    .tag { padding:6px 14px; background:rgba(14,165,164,0.15); border:1px solid rgba(14,165,164,0.3); border-radius:20px; font-size:0.78rem; color:var(--teal); }
    .tag.gold { background:rgba(245,158,11,0.1); border-color:rgba(245,158,11,0.3); color:var(--gold); }

    .content { max-width:1200px; margin:0 auto; padding:60px 40px; }
    .two-col { display:grid; grid-template-columns:2fr 1fr; gap:40px; margin-bottom:60px; }
    .info-section h2 { font-family:'Playfair Display',serif; font-size:1.8rem; margin-bottom:20px; }
    .info-section h2 span { color:var(--gold); }
    .info-section p { color:#cbd5e1; line-height:1.9; margin-bottom:16px; font-size:0.95rem; }
    .tip-box { background:rgba(14,165,164,0.07); border:1px solid rgba(14,165,164,0.2); border-radius:16px; padding:24px; }
    .tip-box h3 { font-size:1rem; font-weight:700; color:var(--teal); margin-bottom:14px; }
    .tip-box ul { list-style:none; display:flex; flex-direction:column; gap:10px; }
    .tip-box ul li { font-size:0.88rem; color:#cbd5e1; display:flex; gap:10px; align-items:flex-start; }
    .tip-box ul li::before { content:'💡'; flex-shrink:0; }

    .sidebar-cards { display:flex; flex-direction:column; gap:16px; }
    .info-card { background:var(--dark2); border:1px solid rgba(255,255,255,0.07); border-radius:16px; padding:20px; }
    .info-card h4 { font-size:0.8rem; font-weight:700; color:var(--teal); letter-spacing:1.5px; text-transform:uppercase; margin-bottom:14px; }
    .info-row { display:flex; justify-content:space-between; align-items:center; padding:8px 0; border-bottom:1px solid rgba(255,255,255,0.05); font-size:0.88rem; }
    .info-row:last-child { border-bottom:none; }
    .info-row .val { color:var(--gold); font-weight:600; }

    .section-title { font-family:'Playfair Display',serif; font-size:2rem; margin-bottom:8px; }
    .section-title span { color:var(--gold); }
    .section-sub { color:var(--muted); font-size:0.9rem; margin-bottom:36px; }

    .hotels-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(280px,1fr)); gap:24px; margin-bottom:60px; }
    .hotel-card { background:var(--dark2); border:1px solid rgba(255,255,255,0.06); border-radius:18px; overflow:hidden; transition:all 0.35s; }
    .hotel-card:hover { transform:translateY(-6px); border-color:rgba(14,165,164,0.3); box-shadow:0 20px 50px rgba(0,0,0,0.4); }
    .hotel-thumb { height:160px; display:flex; align-items:center; justify-content:center; font-size:4rem; position:relative; }
    .hotel-thumb .hotel-stars { position:absolute; bottom:10px; right:12px; background:rgba(15,27,45,0.8); padding:3px 8px; border-radius:6px; font-size:0.75rem; color:var(--gold); }
    .hotel-body { padding:18px 16px; }
    .hotel-body h3 { font-size:1rem; font-weight:700; margin-bottom:6px; }
    .hotel-body .hotel-loc { color:var(--muted); font-size:0.8rem; margin-bottom:12px; }
    .hotel-price { display:flex; align-items:baseline; gap:6px; margin-bottom:14px; }
    .hotel-price .amount { font-family:'Playfair Display',serif; font-size:1.4rem; color:var(--gold); }
    .hotel-price .per { font-size:0.75rem; color:var(--muted); }
    .btn-book { width:100%; padding:11px; border-radius:10px; background:linear-gradient(135deg,var(--teal),#0b8786); color:#fff; font-family:'Poppins',sans-serif; font-size:0.88rem; font-weight:600; border:none; cursor:pointer; transition:all 0.3s; text-align:center; display:block; text-decoration:none; }
    .btn-book:hover { transform:translateY(-2px); box-shadow:0 8px 25px rgba(14,165,164,0.35); }

    .map-link-bar { background:var(--dark2); border:1px solid rgba(14,165,164,0.2); border-radius:16px; padding:24px 28px; display:flex; align-items:center; justify-content:space-between; margin-bottom:40px; flex-wrap:wrap; gap:16px; }
    .map-link-bar p { color:#cbd5e1; font-size:0.95rem; }
    .btn-map-big { padding:12px 28px; background:var(--gold); color:var(--navy); border-radius:10px; font-weight:700; font-size:0.9rem; text-decoration:none; transition:all 0.25s; }
    .btn-map-big:hover { transform:translateY(-2px); box-shadow:0 8px 25px rgba(245,158,11,0.4); }

    footer{background:#080f1a;padding:40px;text-align:center;border-top:1px solid rgba(255,255,255,0.05);}
    footer p{color:var(--muted);font-size:0.85rem;}

    @media(max-width:768px) {
      .two-col{grid-template-columns:1fr;}
      .dest-hero{padding:110px 24px 40px;}
      .content{padding:40px 20px;}
      nav { padding:14px 20px; }
      .nav-links { display:none; }
    }
  </style>
</head>
<body>
<nav>
  <a href="index.php" class="logo">Plan <span>Karo</span></a>
  <div class="nav-links">
    <a href="index.php">🏠 Home</a>
    <a href="destination.php">🌍 Destinations</a>
    <a href="packages.php">📦 Packages</a>
    <a href="live_map.php">🗺️ Live Map</a>
    <a href="contact.php">📞 Contact</a>
    <a href="admin/login.php">🛠️ Admin</a>
    <a href="login.php" class="btn-login">🔑 Login</a>
  </div>
</nav>

<div class="dest-hero" id="destHero">
  <div class="hero-bg-emoji" id="heroEmoji">🏙️</div>
  <div class="dest-hero-content">
    <div class="breadcrumb">
      <a href="index.php">Home</a>
      <span>›</span>
      <a href="destination.php">Destinations</a>
      <span>›</span>
      <span id="destName">Loading…</span>
    </div>
    <h1 id="destTitle">Destination</h1>
    <p id="destDesc">Loading destination information…</p>
    <div class="hero-tags" id="destTags"></div>
  </div>
</div>

<div class="content">
  <div class="two-col">
    <div class="info-section">
      <h2>About <span id="destAboutName">This Destination</span></h2>
      <p id="destAboutP1"></p>
      <p id="destAboutP2"></p>
      <div class="tip-box">
        <h3>✈️ Travel Tips</h3>
        <ul id="travelTips"></ul>
      </div>
    </div>
    <div class="sidebar-cards">
      <div class="info-card">
        <h4>🗺️ Quick Facts</h4>
        <div class="info-row"><span>Best Season</span><span class="val" id="factSeason">—</span></div>
        <div class="info-row"><span>Avg. Budget</span><span class="val" id="factBudget">—</span></div>
        <div class="info-row"><span>Currency</span><span class="val" id="factCurrency">—</span></div>
        <div class="info-row"><span>Language</span><span class="val" id="factLang">—</span></div>
        <div class="info-row"><span>Flight Time</span><span class="val" id="factFlight">—</span></div>
      </div>
    </div>
  </div>

  <div class="map-link-bar">
    <p>🗺️ Explore <span id="destNameInline">this destination</span> on our interactive live map</p>
    <a href="live_map.php" class="btn-map-big">🗺️ Open Live Map</a>
  </div>

  <h2 class="section-title">Suggested <span>Hotels</span></h2>
  <p class="section-sub" id="hotelSubtitle">Top-rated stays at this destination</p>
  <div class="hotels-grid" id="hotelsGrid"></div>
</div>

<footer>
  <p>© 2025 Plan Karo | <a href="destination.php" style="color:var(--teal);text-decoration:none">← Back to Destinations</a></p>
</footer>

<script>
const destinations = {
  usa: {
    name:'USA', flag:'🇺🇸', emoji:'🗽', color:'#1a2a3a',
    desc:'Land of dreams — from the Grand Canyon to the New York skyline, the USA offers world-class experiences for every kind of traveler.',
    tags:['International','Best: Sep–Nov','✈️ Direct Flights'],
    about1:'The United States of America is the world\'s most visited destination, offering an unmatched diversity of landscapes, cultures, and experiences. From the neon-lit boulevards of Las Vegas to the pristine wilderness of Yellowstone, every state tells a unique story.',
    about2:'New York City\'s skyline, the Golden Gate Bridge in San Francisco, the magic of Disney World in Orlando, and the raw beauty of the Grand Canyon make the USA an endlessly fascinating destination. American hospitality, diverse food, and world-class infrastructure make every trip comfortable and memorable.',
    tips:['Apply for US B1/B2 visa at least 2–3 months in advance','Travel insurance is highly recommended in the USA','Credit cards are widely accepted — carry some USD cash too','Best cities to fly into: New York, Los Angeles, Chicago, Miami','Uber/Lyft work seamlessly across major cities'],
    season:'Sep – Nov', budget:'₹2,00,000+', currency:'USD ($)', lang:'English', flight:'~16 hrs',
    hotels:[
      {name:'The Plaza Hotel',loc:'New York City',price:'₹32,000',stars:'⭐⭐⭐⭐⭐',emoji:'🏙️',bg:'#1a2a3a'},
      {name:'The Beverly Hills Hotel',loc:'Los Angeles',price:'₹28,000',stars:'⭐⭐⭐⭐⭐',emoji:'🌴',bg:'#1a3a1a'},
      {name:'Bellagio Hotel',loc:'Las Vegas',price:'₹22,000',stars:'⭐⭐⭐⭐⭐',emoji:'🎰',bg:'#2a1a0d'},
      {name:'Grand Canyon Lodge',loc:'Grand Canyon',price:'₹15,000',stars:'⭐⭐⭐⭐',emoji:'🏜️',bg:'#3a1a0a'},
      {name:'The Ritz-Carlton Chicago',loc:'Chicago',price:'₹25,000',stars:'⭐⭐⭐⭐⭐',emoji:'🏙️',bg:'#0d1a2a'},
      {name:'Four Seasons Miami',loc:'Miami',price:'₹30,000',stars:'⭐⭐⭐⭐⭐',emoji:'🏖️',bg:'#0d2a1a'},
      {name:'Hotel Del Coronado',loc:'San Diego',price:'₹20,000',stars:'⭐⭐⭐⭐',emoji:'🌊',bg:'#0d1a3a'},
      {name:'The Mark Hotel',loc:'New York City',price:'₹18,000',stars:'⭐⭐⭐⭐',emoji:'🗽',bg:'#1a1a2a'},
    ]
  },
  dubai: {
    name:'Dubai', flag:'🇦🇪', emoji:'🏙️', color:'#2a1a0d',
    desc:'The city that defies imagination — Burj Khalifa, desert safaris, gold souks, and world-class luxury all in one dazzling destination.',
    tags:['International','Best: Oct–Apr','💰 Luxury'],
    about1:'Dubai is the ultimate luxury destination — a city that rose from the desert to become the world\'s playground. The Burj Khalifa pierces the clouds at 828 meters, the Palm Jumeirah creates an artificial island paradise, and the Dubai Mall is a world unto itself.',
    about2:'Beyond the skyscrapers, Dubai offers thrilling desert safaris, traditional abra boat rides on Dubai Creek, the bustling Gold and Spice Souks, and the relaxed beach communities of JBR and Jumeirah. With direct flights from major Indian cities, Dubai is a top choice for Indian travelers.',
    tips:['Visa on arrival for Indian passport holders (for most cases)','Dress modestly in public places and malls','Dubai Metro connects key attractions cheaply','Best shopping: Dubai Mall, Mall of the Emirates, Gold Souk','Desert safari is a must — book it for the second day'],
    season:'Oct – Apr', budget:'₹1,20,000+', currency:'AED (د.إ)', lang:'Arabic/English', flight:'~3-4 hrs',
    hotels:[
      {name:'Burj Al Arab',loc:'Jumeirah, Dubai',price:'₹1,20,000',stars:'⭐⭐⭐⭐⭐',emoji:'🏛️',bg:'#2a1a0d'},
      {name:'Atlantis The Palm',loc:'Palm Jumeirah',price:'₹55,000',stars:'⭐⭐⭐⭐⭐',emoji:'🏖️',bg:'#0d2a3a'},
      {name:'Address Downtown',loc:'Downtown Dubai',price:'₹42,000',stars:'⭐⭐⭐⭐⭐',emoji:'🌆',bg:'#1a0d2a'},
      {name:'Jumeirah Beach Hotel',loc:'Jumeirah',price:'₹35,000',stars:'⭐⭐⭐⭐⭐',emoji:'🌊',bg:'#0d1a2a'},
      {name:'Four Seasons DIFC',loc:'DIFC, Dubai',price:'₹48,000',stars:'⭐⭐⭐⭐⭐',emoji:'🏙️',bg:'#0d2a1a'},
      {name:'Ritz-Carlton JBR',loc:'JBR, Dubai',price:'₹38,000',stars:'⭐⭐⭐⭐⭐',emoji:'🎉',bg:'#1a2a0d'},
      {name:'Hyatt Regency Creek',loc:'Deira, Dubai',price:'₹18,000',stars:'⭐⭐⭐⭐',emoji:'⛵',bg:'#0d1a0d'},
      {name:'Premier Inn Dubai',loc:'Silicon Oasis',price:'₹8,000',stars:'⭐⭐⭐',emoji:'🏨',bg:'#1a1a1a'},
    ]
  },
  japan: {
    name:'Japan', flag:'🇯🇵', emoji:'🗾', color:'#1a0a0a',
    desc:'Where ancient tradition meets futuristic innovation — cherry blossoms, bullet trains, Mount Fuji, and the world\'s most disciplined beauty.',
    tags:['International','Best: Mar–Apr','🌸 Cherry Blossoms'],
    about1:'Japan is a country of extraordinary contrasts — ultramodern cities like Tokyo and Osaka coexist with ancient temples, traditional ryokan inns, and centuries-old samurai culture. The cherry blossom season (Hanami) from late March to early April is among the world\'s most beautiful natural phenomena.',
    about2:'From the serene Arashiyama bamboo grove in Kyoto to the electric Shibuya crossing in Tokyo, the ancient Hiroshima Peace Memorial to the fresh sushi markets of Tsukiji — Japan offers experiences that are genuinely unlike anywhere else on Earth. The bullet train (Shinkansen) network makes exploring multiple cities fast and effortless.',
    tips:['Get a Japan Rail Pass before leaving India — saves huge costs','Carry cash — many places still don\'t accept cards','IC card (Suica/Pasmo) is essential for urban transport','March–April for cherry blossoms; Nov for autumn foliage','Download Google Translate with Japanese offline pack'],
    season:'Mar – Apr / Nov', budget:'₹1,50,000+', currency:'JPY (¥)', lang:'Japanese', flight:'~7-8 hrs',
    hotels:[
      {name:'Park Hyatt Tokyo',loc:'Shinjuku, Tokyo',price:'₹45,000',stars:'⭐⭐⭐⭐⭐',emoji:'🗾',bg:'#1a0a0a'},
      {name:'Aman Tokyo',loc:'Otemachi, Tokyo',price:'₹60,000',stars:'⭐⭐⭐⭐⭐',emoji:'🏯',bg:'#0d1a0d'},
      {name:'The Ritz Kyoto',loc:'Kyoto',price:'₹38,000',stars:'⭐⭐⭐⭐⭐',emoji:'⛩️',bg:'#1a0d0d'},
      {name:'Hoshino Resorts Kai',loc:'Kyoto',price:'₹35,000',stars:'⭐⭐⭐⭐⭐',emoji:'🎑',bg:'#0a1a0d'},
      {name:'Hyatt Regency Osaka',loc:'Osaka',price:'₹28,000',stars:'⭐⭐⭐⭐',emoji:'🦡',bg:'#0d0d1a'},
      {name:'Hotel Gajoen Tokyo',loc:'Meguro, Tokyo',price:'₹42,000',stars:'⭐⭐⭐⭐⭐',emoji:'🎎',bg:'#1a1a0d'},
      {name:'Fujiya Hotel',loc:'Hakone',price:'₹25,000',stars:'⭐⭐⭐⭐',emoji:'🗻',bg:'#0d1a1a'},
      {name:'APA Hotel Shinjuku',loc:'Tokyo',price:'₹8,000',stars:'⭐⭐⭐',emoji:'🏙️',bg:'#1a1a1a'},
    ]
  },
  india: {
    name:'India', flag:'🇮🇳', emoji:'🕌', color:'#0d1a3a',
    desc:'A universe of experiences — from Goa\'s golden beaches to Kashmir\'s snow valleys, India is your home of infinite wonders.',
    tags:['Domestic','Best: Oct–Mar','🏯 Heritage'],
    about1:'India is not a destination — it\'s a feeling. The world\'s most spiritually rich country offers everything from the snow-capped peaks of the Himalayas to the emerald backwaters of Kerala, from the Thar desert of Rajasthan to the tropical beaches of Andaman. Each state has its own culture, cuisine, and character.',
    about2:'The Golden Triangle (Delhi–Agra–Jaipur) is a must for first-timers. The Taj Mahal at sunrise is one of humanity\'s greatest monuments. Goa\'s beach parties, Kerala\'s Ayurveda retreats, Varanasi\'s ghats at dawn, and Ladakh\'s lunar landscapes — India challenges, inspires, and transforms every traveler.',
    tips:['Book trains on IRCTC well in advance, especially for popular routes','Drink only bottled/filtered water to avoid stomach issues','Best time: October to March for most regions','Respect local customs, especially at temples and religious sites','Download MakeMyTrip or Ixigo for domestic bookings'],
    season:'Oct – Mar', budget:'₹20,000–₹80,000', currency:'INR (₹)', lang:'Hindi/English', flight:'Domestic',
    hotels:[
      {name:'Taj Mahal Palace',loc:'Mumbai',price:'₹45,000',stars:'⭐⭐⭐⭐⭐',emoji:'🏛️',bg:'#1a0d0d'},
      {name:'The Oberoi Udaivilas',loc:'Udaipur',price:'₹55,000',stars:'⭐⭐⭐⭐⭐',emoji:'🏯',bg:'#2a1a0d'},
      {name:'ITC Grand Chola',loc:'Chennai',price:'₹22,000',stars:'⭐⭐⭐⭐⭐',emoji:'🐘',bg:'#1a0a0a'},
      {name:'The Leela Palace',loc:'Delhi',price:'₹30,000',stars:'⭐⭐⭐⭐⭐',emoji:'🏙️',bg:'#0d1a0d'},
      {name:'Taj Exotica',loc:'Goa',price:'₹18,000',stars:'⭐⭐⭐⭐⭐',emoji:'🏖️',bg:'#0d2a1a'},
      {name:'Wildflower Hall',loc:'Shimla',price:'₹25,000',stars:'⭐⭐⭐⭐⭐',emoji:'❄️',bg:'#0d1a2a'},
      {name:'Ananda In The Himalayas',loc:'Uttarakhand',price:'₹35,000',stars:'⭐⭐⭐⭐⭐',emoji:'🏔️',bg:'#0a1a1a'},
      {name:'The Srinagar Houseboat',loc:'Kashmir',price:'₹12,000',stars:'⭐⭐⭐⭐',emoji:'⛵',bg:'#0d0d1a'},
    ]
  },
  goa:{
    name:'Goa', flag:'🇮🇳', emoji:'🏖️', color:'#0d2a1a',
    desc:'Sun, sand, and sensational vibes — Goa is India\'s beach paradise with Portuguese heritage, vibrant nightlife, and golden shores.',
    tags:['Beach','Best: Nov–Feb','🌊 Watersports'],
    about1:'Goa, India\'s smallest state, is a beach paradise packed with stunning beaches, charming Portuguese-era architecture, and a party vibe that\'s uniquely its own. North Goa buzzes with nightlife at Baga, Calangute, and Anjuna, while South Goa offers peaceful luxury at Palolem and Agonda.',
    about2:'Beyond the beaches, Goa enchants with its 400-year-old spice plantations, the UNESCO-listed churches of Old Goa, delicious Goan seafood cuisine, and the famous Saturday Night Market at Arpora. Water sports including parasailing, jet skiing, and scuba diving are available across the coastline.',
    tips:['Best time: November to February for perfect beach weather','Renting a scooter is the best way to explore Goa','Try Goan seafood — fish curry rice, prawn balchão, bebinca','Friday flea market at Mapusa, Saturday Night Market at Arpora','Book hotels early for Christmas/New Year — prices spike!'],
    season:'Nov – Feb', budget:'₹25,000–₹40,000', currency:'INR (₹)', lang:'Konkani/English', flight:'~1.5–2 hrs',
    hotels:[
      {name:'Taj Exotica Resort',loc:'Benaulim, South Goa',price:'₹22,000',stars:'⭐⭐⭐⭐⭐',emoji:'🏖️',bg:'#0d2a1a'},
      {name:'The Leela Goa',loc:'Cavelossim',price:'₹20,000',stars:'⭐⭐⭐⭐⭐',emoji:'🌴',bg:'#0a2a0a'},
      {name:'Alila Diwa Goa',loc:'Majorda',price:'₹15,000',stars:'⭐⭐⭐⭐⭐',emoji:'🌊',bg:'#0d1a1a'},
      {name:'W Goa',loc:'Vagator',price:'₹18,000',stars:'⭐⭐⭐⭐⭐',emoji:'🎉',bg:'#1a0d1a'},
      {name:'Novotel Goa Dona Sylvia',loc:'Cavelossim',price:'₹10,000',stars:'⭐⭐⭐⭐',emoji:'🏊',bg:'#0d2a0a'},
      {name:'Cidade de Goa',loc:'Vainguinim',price:'₹12,000',stars:'⭐⭐⭐⭐',emoji:'⛪',bg:'#0d1a2a'},
      {name:'Caravela Beach Resort',loc:'Varca',price:'₹8,000',stars:'⭐⭐⭐⭐',emoji:'🐚',bg:'#1a2a0d'},
      {name:'Pousada Tauma',loc:'Calangute',price:'₹5,000',stars:'⭐⭐⭐',emoji:'🌺',bg:'#2a1a0d'},
    ]
  }
};

// Default fallback
const defaultDest = destinations.usa;

function loadDestination() {
  const params = new URLSearchParams(window.location.search);
  const key = params.get('dest') || 'usa';
  const d = destinations[key] || defaultDest;
  
  document.title = d.name + ' — Plan Karo';
  document.getElementById('destHero').style.background = `linear-gradient(135deg, ${d.color}, #0f1b2d)`;
  document.getElementById('heroEmoji').textContent = d.emoji;
  document.getElementById('destName').textContent = d.name;
  document.getElementById('destTitle').innerHTML = d.flag + ' ' + d.name;
  document.getElementById('destDesc').textContent = d.desc;
  document.getElementById('destAboutName').textContent = d.name;
  document.getElementById('destAboutP1').textContent = d.about1;
  document.getElementById('destAboutP2').textContent = d.about2;
  document.getElementById('destNameInline').textContent = d.name;
  document.getElementById('factSeason').textContent = d.season;
  document.getElementById('factBudget').textContent = d.budget;
  document.getElementById('factCurrency').textContent = d.currency;
  document.getElementById('factLang').textContent = d.lang;
  document.getElementById('factFlight').textContent = d.flight;
  document.getElementById('hotelSubtitle').textContent = 'Top-rated hotels in ' + d.name;
  
  const tagsEl = document.getElementById('destTags');
  d.tags.forEach((t,i) => {
    const s = document.createElement('span');
    s.className = 'tag' + (i===2?' gold':'');
    s.textContent = t;
    tagsEl.appendChild(s);
  });
  
  const tipsEl = document.getElementById('travelTips');
  d.tips.forEach(tip => {
    const li = document.createElement('li');
    li.textContent = tip;
    tipsEl.appendChild(li);
  });
  
  const hotelsEl = document.getElementById('hotelsGrid');
  d.hotels.forEach(h => {
    hotelsEl.innerHTML += `
      <div class="hotel-card">
        <div class="hotel-thumb" style="background:linear-gradient(135deg,${h.bg||'#1a2a3a'},#0f1b2d)">
          <span style="font-size:4rem">${h.emoji}</span>
          <div class="hotel-stars">${h.stars}</div>
        </div>
        <div class="hotel-body">
          <h3>${h.name}</h3>
          <div class="hotel-loc">📍 ${h.loc}</div>
          <div class="hotel-price">
            <span class="amount">${h.price}</span>
            <span class="per">/ night</span>
          </div>
          <a href="booking.php?hotel=${encodeURIComponent(h.name)}&dest=${encodeURIComponent(d.name)}&price=${encodeURIComponent(h.price)}" class="btn-book">🏨 Book Now</a>
        </div>
      </div>`;
  });
}

loadDestination();
</script>
</body>
</html>
