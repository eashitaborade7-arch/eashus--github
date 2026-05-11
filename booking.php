<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Booking — Plan Karo</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

  <!-- Leaflet CSS (OpenStreetMap library) -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

  <style>
    :root {
      --navy:    #0f1b2d;
      --teal:    #0ea5a4;
      --gold:    #f59e0b;
      --white:   #ffffff;
      --light:   #f0f6ff;
      --card-bg: rgba(255,255,255,0.96);
      --shadow:  0 8px 32px rgba(15,27,45,0.18);
    }

    *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }

    body {
      font-family: 'Poppins', sans-serif;
      background: var(--navy);
      color: #111;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    /* ── Navigation ── */
    nav {
      display: flex;
      justify-content: center;
      align-items: center;
      background: #0f1b2d;
      padding: 14px 20px;
      position: sticky;
      top: 0;
      z-index: 2000;
      border-bottom: 2px solid var(--teal);
      gap: 6px;
      flex-wrap: wrap;
    }
    nav a {
      color: #cbd5e1;
      text-decoration: none;
      padding: 7px 16px;
      border-radius: 20px;
      font-size: 0.92rem;
      font-weight: 500;
      transition: all 0.25s;
      letter-spacing: 0.3px;
    }
    nav a:hover        { background: var(--teal); color: #fff; }
    nav a.active       { background: var(--gold); color: var(--navy); font-weight: 600; }

    /* ── Hero strip ── */
    .hero-strip {
      background: linear-gradient(135deg, #0f1b2d 0%, #1a3a5c 60%, #0ea5a4 100%);
      padding: 28px 24px 24px;
      text-align: center;
      position: relative;
      overflow: hidden;
    }
    .hero-strip::before {
      content: '';
      position: absolute;
      inset: 0;
      background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%230ea5a4' fill-opacity='0.07'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    .hero-strip h1 {
      font-family: 'Playfair Display', serif;
      font-size: clamp(1.8rem, 4vw, 2.8rem);
      color: var(--white);
      position: relative;
      letter-spacing: 1px;
    }
    .hero-strip h1 span { color: var(--gold); }
    .hero-strip p {
      color: #94a3b8;
      font-size: 0.95rem;
      margin-top: 6px;
      position: relative;
    }

    /* ── Layout wrapper ── */
    .layout {
      display: grid;
      grid-template-columns: 300px 1fr;
      flex: 1;
      min-height: 0;
    }

    /* ── Sidebar ── */
    .sidebar {
      background: #111e2f;
      display: flex;
      flex-direction: column;
      overflow-y: auto;
      max-height: calc(100vh - 110px);
      position: sticky;
      top: 57px;
    }

    .sidebar-header {
      padding: 18px 16px 10px;
      border-bottom: 1px solid rgba(255,255,255,0.07);
    }
    .sidebar-header h3 {
      color: var(--teal);
      font-size: 0.8rem;
      letter-spacing: 2px;
      text-transform: uppercase;
      font-weight: 600;
    }

    /* Search box */
    .search-wrap {
      padding: 12px 16px;
      border-bottom: 1px solid rgba(255,255,255,0.06);
    }
    .search-wrap input {
      width: 100%;
      padding: 9px 14px;
      border-radius: 10px;
      border: 1.5px solid rgba(14,165,164,0.3);
      background: rgba(255,255,255,0.05);
      color: #e2e8f0;
      font-family: 'Poppins', sans-serif;
      font-size: 13px;
      outline: none;
      transition: border-color 0.2s;
    }
    .search-wrap input::placeholder { color: #64748b; }
    .search-wrap input:focus { border-color: var(--teal); }

    /* Category filter tabs */
    .filter-tabs {
      display: flex;
      flex-wrap: wrap;
      gap: 6px;
      padding: 10px 16px;
      border-bottom: 1px solid rgba(255,255,255,0.06);
    }
    .tab {
      padding: 5px 12px;
      border-radius: 20px;
      border: 1.5px solid rgba(14,165,164,0.3);
      background: transparent;
      color: #94a3b8;
      font-size: 12px;
      font-family: 'Poppins', sans-serif;
      cursor: pointer;
      transition: all 0.2s;
    }
    .tab:hover, .tab.on {
      background: var(--teal);
      border-color: var(--teal);
      color: #fff;
    }

    /* Destination list */
    .dest-list { padding: 8px 0; flex: 1; }
    .dest-item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 10px 16px;
      cursor: pointer;
      transition: background 0.2s;
      border-left: 3px solid transparent;
    }
    .dest-item:hover { background: rgba(14,165,164,0.08); border-left-color: var(--teal); }
    .dest-item.selected { background: rgba(14,165,164,0.15); border-left-color: var(--gold); }

    .dest-emoji { font-size: 22px; flex-shrink: 0; }
    .dest-info  { min-width: 0; }
    .dest-name  { color: #e2e8f0; font-size: 14px; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .dest-tag   { color: #64748b; font-size: 11px; margin-top: 1px; }
    .dest-budget{ color: var(--gold); font-size: 11px; font-weight: 600; }

    /* ── Map area ── */
    .map-area {
      display: flex;
      flex-direction: column;
    }

    /* Info bar above map */
    .map-infobar {
      background: var(--card-bg);
      padding: 10px 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      border-bottom: 1px solid #e2e8f0;
      flex-wrap: wrap;
      gap: 8px;
    }
    .selected-info { font-size: 14px; color: #374151; }
    .selected-info strong { color: var(--teal); }
    .map-controls { display: flex; gap: 8px; }
    .ctrl-btn {
      padding: 6px 14px;
      border-radius: 8px;
      border: 1.5px solid #d1d5db;
      background: #fff;
      font-size: 12px;
      font-family: 'Poppins', sans-serif;
      cursor: pointer;
      color: #374151;
      font-weight: 500;
      transition: all 0.2s;
    }
    .ctrl-btn:hover { background: var(--teal); color: #fff; border-color: var(--teal); }
    .ctrl-btn.danger:hover { background: #ef4444; border-color: #ef4444; color:#fff; }

    /* The actual map */
    #map {
      flex: 1;
      min-height: 500px;
    }

    /* ── Info popup card (custom) ── */
    .leaflet-popup-content-wrapper {
      border-radius: 12px !important;
      box-shadow: 0 10px 30px rgba(0,0,0,0.2) !important;
      padding: 0 !important;
      overflow: hidden;
    }
    .leaflet-popup-content {
      margin: 0 !important;
      width: 220px !important;
    }
    .popup-card { font-family: 'Poppins', sans-serif; }
    .popup-card .popup-header {
      background: linear-gradient(135deg, #0f1b2d, #1a3a5c);
      color: #fff;
      padding: 12px 14px 10px;
    }
    .popup-card .popup-header h4 { font-size: 15px; margin:0; }
    .popup-card .popup-header p  { font-size: 11px; color: #94a3b8; margin: 3px 0 0; }
    .popup-card .popup-body { padding: 12px 14px; }
    .popup-card .popup-body p { font-size: 12px; color: #4b5563; margin: 4px 0; }
    .popup-card .popup-body .budget { color: var(--teal); font-weight: 700; font-size: 14px; }
    .popup-book {
      display: block; width: 100%;
      background: var(--teal); color: #fff;
      border: none; padding: 9px;
      font-family: 'Poppins', sans-serif;
      font-size: 13px; font-weight: 600;
      cursor: pointer; text-align: center;
      text-decoration: none;
      transition: background 0.2s;
    }
    .popup-book:hover { background: #0b8786; }

    /* ── Stats bar at bottom ── */
    .stats-bar {
      background: var(--card-bg);
      border-top: 1px solid #e2e8f0;
      padding: 10px 20px;
      display: flex;
      gap: 24px;
      flex-wrap: wrap;
    }

    .booking-wrap {
      background: #f8fbff;
      border-top: 1px solid #dbe8f5;
      padding: 24px 20px 28px;
    }
    .booking-card {
      max-width: 1100px;
      margin: 0 auto;
      background: #fff;
      border: 1px solid #dbe8f5;
      border-radius: 14px;
      padding: 18px;
      box-shadow: var(--shadow);
    }
    .booking-card h2 {
      margin: 0 0 6px;
      color: #0f1b2d;
      font-size: 1.25rem;
    }
    .booking-card p {
      margin: 0 0 14px;
      color: #64748b;
      font-size: 0.9rem;
    }
    .booking-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
    }
    .booking-row { margin-bottom: 10px; }
    .booking-row label {
      display: block;
      margin-bottom: 6px;
      color: #0f766e;
      font-size: 12px;
      font-weight: 700;
      letter-spacing: .03em;
      text-transform: uppercase;
    }
    .booking-row input,
    .booking-row select,
    .booking-row textarea {
      width: 100%;
      border: 1px solid #cbd5e1;
      border-radius: 10px;
      padding: 10px 12px;
      font-family: 'Poppins', sans-serif;
      font-size: 14px;
      outline: none;
    }
    .booking-row textarea {
      min-height: 92px;
      resize: vertical;
    }
    .booking-summary {
      margin: 14px 0;
      padding: 10px 12px;
      border-radius: 10px;
      background: #eff6ff;
      border: 1px solid #bfdbfe;
      color: #1e3a8a;
      font-size: 13px;
    }
    .booking-btn {
      width: 100%;
      border: none;
      border-radius: 10px;
      padding: 12px;
      background: linear-gradient(135deg, #0ea5a4, #0b8786);
      color: #fff;
      font-size: 14px;
      font-weight: 700;
      cursor: pointer;
    }
    .stat { display: flex; flex-direction: column; }
    .stat-val { font-size: 18px; font-weight: 700; color: var(--teal); }
    .stat-lbl { font-size: 11px; color: #6b7280; }

    /* ── Live pulse dot ── */
    .live-dot {
      display: inline-block;
      width: 10px; height: 10px;
      background: #22c55e;
      border-radius: 50%;
      margin-right: 6px;
      animation: pulse 1.5s ease-in-out infinite;
    }
    @keyframes pulse {
      0%, 100% { box-shadow: 0 0 0 0 rgba(34,197,94,0.4); }
      50%       { box-shadow: 0 0 0 6px rgba(34,197,94,0); }
    }

    /* ── Responsive ── */
    @media (max-width: 768px) {
      .layout { grid-template-columns: 1fr; }
      .sidebar { max-height: 280px; position: static; }
      #map { min-height: 400px; }
      .booking-grid { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>

  <!-- Navigation -->
  <nav>
    <a href="index.php">🏠 Home</a>
    <a href="destination.php">🌍 Destinations</a>
    <a href="packages.php">🏨 Packages</a>
    <a href="suggestion.php">✨ Travel Locater</a>
    <a href="contact.php">📞 Contact</a>
    <a href="booking.php" class="active">📦 Booking</a>
    <a href="live_map.php">🗺️ Live Map</a>
    <a href="login.php">🔑 Log In</a>
  </nav>

  <!-- Hero strip -->
  <div class="hero-strip">
    <h1>📦 Plan Karo <span>Booking</span></h1>
    <p><span class="live-dot"></span>Book hotels and tours quickly with live destination selection</p>
  </div>

  <!-- Main layout -->
  <div class="layout">

    <!-- ── Sidebar ── -->
    <div class="sidebar">
      <div class="sidebar-header">
        <h3>📍 Explore Destinations</h3>
      </div>

      <!-- Search -->
      <div class="search-wrap">
        <input type="text" id="searchInput" placeholder="🔍 Search destination..." oninput="filterDests(this.value)">
      </div>

      <!-- Category tabs -->
      <div class="filter-tabs">
        <button class="tab on" onclick="filterByCategory('all', this)">All</button>
        <button class="tab" onclick="filterByCategory('beach', this)">🏖️ Beach</button>
        <button class="tab" onclick="filterByCategory('mountain', this)">🏔️ Mountain</button>
        <button class="tab" onclick="filterByCategory('adventure', this)">⚡ Adventure</button>
        <button class="tab" onclick="filterByCategory('romantic', this)">💕 Romantic</button>
        <button class="tab" onclick="filterByCategory('international', this)">✈️ International</button>
      </div>

      <!-- Destination list -->
      <div class="dest-list" id="destList"></div>
    </div>

    <!-- ── Map area ── -->
    <div class="map-area">

      <!-- Info bar -->
      <div class="map-infobar">
        <div class="selected-info" id="infoBar">
          Click any destination to zoom in 👆
        </div>
        <div class="map-controls">
          <button class="ctrl-btn" onclick="resetMap()">🌏 Reset View</button>
          <button class="ctrl-btn" onclick="showAllMarkers()">📍 All Pins</button>
          <button class="ctrl-btn danger" onclick="clearSelection()">✕ Clear</button>
        </div>
      </div>

      <!-- The map -->
      <div id="map"></div>

      <!-- Stats bar -->
      <div class="stats-bar">
        <div class="stat"><span class="stat-val" id="totalDests">22</span><span class="stat-lbl">Destinations</span></div>
        <div class="stat"><span class="stat-val">🆓</span><span class="stat-lbl">Free Map (OSM)</span></div>
        <div class="stat"><span class="stat-val">5</span><span class="stat-lbl">Categories</span></div>
        <div class="stat"><span class="stat-val">© OSM</span><span class="stat-lbl">OpenStreetMap</span></div>
      </div>
    </div>

  </div><!-- end .layout -->

  <section class="booking-wrap">
    <div class="booking-card">
      <h2>Hotel & Tour Booking Form</h2>
      <p>Fill your details, then continue to payment.</p>
      <form method="get" action="payment.php" id="bookingForm">
        <div class="booking-grid">
          <div class="booking-row">
            <label for="fullName">Full Name</label>
            <input id="fullName" name="name" required>
          </div>
          <div class="booking-row">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" required>
          </div>
          <div class="booking-row">
            <label for="phone">Phone</label>
            <input id="phone" type="tel" placeholder="Optional">
          </div>
          <div class="booking-row">
            <label for="bookingType">Booking Type</label>
            <select id="bookingType">
              <option value="Hotel Booking">Hotel Booking</option>
              <option value="Tour Package">Tour Package</option>
            </select>
          </div>
          <div class="booking-row">
            <label for="destinationInput">Destination</label>
            <input id="destinationInput" placeholder="e.g. Dubai">
          </div>
          <div class="booking-row">
            <label for="hotelInput">Hotel / Package Name</label>
            <input id="hotelInput" placeholder="e.g. Atlantis The Palm">
          </div>
          <div class="booking-row">
            <label for="checkinDate">Check-in Date</label>
            <input id="checkinDate" type="date">
          </div>
          <div class="booking-row">
            <label for="checkoutDate">Check-out Date</label>
            <input id="checkoutDate" type="date">
          </div>
          <div class="booking-row">
            <label for="travellers">Travellers</label>
            <input id="travellers" type="number" min="1" value="2">
          </div>
          <div class="booking-row">
            <label for="tripAmount">Amount (INR)</label>
            <input id="tripAmount" name="amount" required>
          </div>
        </div>
        <div class="booking-row">
          <label for="notes">Special Requests</label>
          <textarea id="notes" placeholder="Any meal, room, pickup requests..."></textarea>
        </div>
        <div class="booking-summary" id="bookingSummary">
          Trip Summary: Select destination/hotel or use Book Now link to auto-fill.
        </div>
        <input type="hidden" id="tripField" name="trip">
        <button type="submit" class="booking-btn">Continue to Payment</button>
      </form>
    </div>
  </section>


  <!-- Leaflet JS -->
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  <script>
    // ── All destinations data ──
    const destinations = [
      // India - Beach
      { name:"Goa",           lat:15.2993, lng:74.1240, emoji:"🏖️", category:"beach",       budget:"₹25,000–₹40,000", tag:"India · Beach",       desc:"Golden sands, vibrant nightlife & Portuguese charm." },
      { name:"Andaman Islands",lat:11.7401, lng:92.6586, emoji:"🏝️", category:"beach",       budget:"₹50,000–₹80,000", tag:"India · Island",       desc:"Crystal clear waters & untouched coral reefs." },

      // India - Mountain
      { name:"Manali",        lat:32.2396, lng:77.1887, emoji:"🏔️", category:"mountain",    budget:"₹30,000–₹45,000", tag:"India · Mountain",     desc:"Snow-capped peaks & Himalayan adventure." },
      { name:"Kashmir",       lat:34.0837, lng:74.7973, emoji:"❄️", category:"mountain",    budget:"₹40,000–₹70,000", tag:"India · Mountain",     desc:"Heaven on earth — Dal Lake & snow valleys." },
      { name:"Shimla",        lat:31.1048, lng:77.1734, emoji:"🌨️", category:"mountain",    budget:"₹25,000–₹35,000", tag:"India · Hill station", desc:"Colonial charm & cool Himalayan breezes." },
      { name:"Auli",          lat:30.5165, lng:79.5628, emoji:"⛷️", category:"mountain",    budget:"₹30,000–₹50,000", tag:"India · Skiing",       desc:"India's premier ski destination." },
      { name:"Leh-Ladakh",   lat:34.1526, lng:77.5771, emoji:"🏔️", category:"mountain",    budget:"₹60,000–₹90,000", tag:"India · High altitude", desc:"Roof of India — stark beauty & monasteries." },
      { name:"Spiti Valley",  lat:32.2461, lng:78.0338, emoji:"🗻", category:"mountain",    budget:"₹50,000–₹75,000", tag:"India · Valley",       desc:"Cold desert beauty & Tibetan culture." },

      // India - Adventure
      { name:"Rishikesh",     lat:30.0869, lng:78.2676, emoji:"🌊", category:"adventure",   budget:"₹20,000–₹35,000", tag:"India · Adventure",    desc:"White water rafting & yoga capital of the world." },

      // India - Romantic
      { name:"Udaipur",       lat:24.5854, lng:73.7125, emoji:"🏯", category:"romantic",    budget:"₹35,000–₹50,000", tag:"India · Romantic",     desc:"City of lakes — royal palaces & sunsets." },
      { name:"Ooty",          lat:11.4102, lng:76.6950, emoji:"🌸", category:"romantic",    budget:"₹30,000–₹45,000", tag:"India · Hill station", desc:"Queen of hill stations — misty gardens." },
      { name:"Munnar",        lat:10.0889, lng:77.0595, emoji:"🍃", category:"romantic",    budget:"₹25,000–₹40,000", tag:"India · Kerala",       desc:"Rolling tea estates & cool misty air." },

      // India - Relax
      { name:"Kerala Backwaters",lat:9.4981, lng:76.3388, emoji:"🌿", category:"romantic",  budget:"₹35,000–₹55,000", tag:"India · Kerala",       desc:"Serene houseboats on emerald backwaters." },
      { name:"Coorg",         lat:12.3375, lng:75.8069, emoji:"☕", category:"romantic",    budget:"₹25,000–₹40,000", tag:"India · Karnataka",    desc:"Coffee estates & misty Western Ghats." },
      { name:"Pondicherry",   lat:11.9416, lng:79.8083, emoji:"🇫🇷", category:"beach",      budget:"₹20,000–₹30,000", tag:"India · Beach",        desc:"French colony vibes, beaches & ashrams." },

      // International
      { name:"Dubai",         lat:25.2048, lng:55.2708, emoji:"🏙️", category:"international",budget:"₹1,20,000+",     tag:"UAE · Luxury",         desc:"Burj Khalifa, deserts & world-class luxury." },
      { name:"Japan (Tokyo)", lat:35.6762, lng:139.6503,emoji:"🇯🇵", category:"international",budget:"₹1,50,000+",    tag:"Japan · Culture",      desc:"Mount Fuji, cherry blossoms & anime culture." },
      { name:"Italy (Rome)",  lat:41.9028, lng:12.4964, emoji:"🇮🇹", category:"international",budget:"₹1,40,000+",    tag:"Italy · Heritage",     desc:"Colosseum, Vatican & pasta perfection." },
      { name:"South Korea",   lat:37.5665, lng:126.9780,emoji:"🇰🇷", category:"international",budget:"₹1,20,000+",    tag:"Korea · K-pop",        desc:"Seoul, K-pop, palaces & modern energy." },
      { name:"Turkey",        lat:39.9334, lng:32.8597, emoji:"🇹🇷", category:"international",budget:"₹1,00,000+",    tag:"Turkey · Heritage",    desc:"Cappadocia balloons, bazaars & Bosphorus." },
      { name:"Spain",         lat:40.4168, lng:-3.7038, emoji:"🇪🇸", category:"international",budget:"₹1,30,000+",    tag:"Spain · Culture",      desc:"Flamenco, tapas, Sagrada Família & beaches." },
      { name:"USA",           lat:37.0902, lng:-95.7129,emoji:"🇺🇸", category:"international",budget:"₹2,00,000+",    tag:"USA · Grand",          desc:"Grand Canyon, NYC & the American dream." },
    ];

    let map, markers = [], selectedIdx = null, activeCategory = 'all';

    // ── Init map ──
    function initMap() {
      map = L.map('map', { zoomControl: true }).setView([22.5, 82], 5);

      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© <a href="https://www.openstreetmap.org/copyright" target="_blank">OpenStreetMap</a> contributors | Plan Karo',
        maxZoom: 18
      }).addTo(map);

      addAllMarkers();
      renderSidebar(destinations);
      preselectFromQuery();
    }

    function normalizeName(value) {
      return (value || '')
        .toLowerCase()
        .replace(/[^a-z0-9]+/g, ' ')
        .trim();
    }

    function preselectFromQuery() {
      const params = new URLSearchParams(window.location.search);
      const hotel = params.get('hotel');
      const dest = params.get('dest');
      const price = params.get('price');
      const pkg = params.get('pkg');
      const members = params.get('members');
      const days = params.get('days');

      if (dest) document.getElementById('destinationInput').value = dest;
      if (hotel) document.getElementById('hotelInput').value = hotel;
      if (price) document.getElementById('tripAmount').value = String(price).replace(/[^\d.]/g, '');
      if (pkg && !hotel) document.getElementById('hotelInput').value = pkg;
      if (pkg) document.getElementById('bookingType').value = 'Tour Package';
      if (members && Number(members) > 0) document.getElementById('travellers').value = members;
      updateTripSummary();

      if (!hotel && !dest) return;

      if (dest) {
        const targetDest = normalizeName(dest);
        const idx = destinations.findIndex(d => {
          const byName = normalizeName(d.name);
          const byTag = normalizeName(d.tag);
          return byName.includes(targetDest) || byTag.includes(targetDest) || targetDest.includes(byName);
        });

        if (idx !== -1) {
          selectDest(idx);
          if (hotel || price) {
            const extras = [];
            if (hotel) extras.push(`🏨 ${hotel}`);
            if (price) extras.push(`💰 ${price}`);
            if (extras.length > 0) {
              document.getElementById('infoBar').innerHTML += ` &nbsp;|&nbsp; ${extras.join(' &nbsp;|&nbsp; ')}`;
            }
          }
          return;
        }
      }

      const parts = ['Selected hotel booking'];
      if (hotel) parts.push(`Hotel: ${hotel}`);
      if (dest) parts.push(`Destination: ${dest}`);
      if (price) parts.push(`Price: ${price}`);
      document.getElementById('infoBar').innerHTML = `<strong>${parts.join(' | ')}</strong>`;
    }

    // ── Custom marker icon ──
    function makeIcon(emoji, selected = false) {
      return L.divIcon({
        html: `<div style="
          background:${selected ? '#f59e0b' : '#0ea5a4'};
          color:white;
          border-radius:50% 50% 50% 0;
          transform:rotate(-45deg);
          width:${selected?40:34}px;
          height:${selected?40:34}px;
          display:flex;align-items:center;justify-content:center;
          font-size:${selected?18:15}px;
          box-shadow:0 4px 12px rgba(0,0,0,0.3);
          border:2px solid ${selected?'#fff':'rgba(255,255,255,0.7)'};
          transition:all 0.2s;
        "><span style="transform:rotate(45deg)">${emoji}</span></div>`,
        className: '',
        iconSize: [selected?40:34, selected?40:34],
        iconAnchor: [selected?20:17, selected?40:34],
        popupAnchor: [0, -34]
      });
    }

    // ── Add all markers to map ──
    function addAllMarkers() {
      markers.forEach(m => map.removeLayer(m));
      markers = [];

      destinations.forEach((dest, i) => {
        const marker = L.marker([dest.lat, dest.lng], { icon: makeIcon(dest.emoji) })
          .addTo(map)
          .bindPopup(popupHTML(dest, i), { maxWidth: 240 });

        marker.on('click', () => selectDest(i));
        markers.push(marker);
      });
    }

    // ── Popup HTML ──
    function popupHTML(dest, i) {
      return `
        <div class="popup-card">
          <div class="popup-header">
            <h4>${dest.emoji} ${dest.name}</h4>
            <p>${dest.tag}</p>
          </div>
          <div class="popup-body">
            <p>${dest.desc}</p>
            <p class="budget">💰 ${dest.budget}</p>
          </div>
          <a href="booking.php" class="popup-book">Book This Trip →</a>
        </div>`;
    }

    // ── Render sidebar list ──
    function renderSidebar(list) {
      const container = document.getElementById('destList');
      container.innerHTML = '';

      if (list.length === 0) {
        container.innerHTML = '<p style="color:#64748b;padding:20px;font-size:13px;text-align:center;">No destinations found 😕</p>';
        return;
      }

      list.forEach((dest) => {
        const globalIdx = destinations.indexOf(dest);
        const div = document.createElement('div');
        div.className = 'dest-item' + (selectedIdx === globalIdx ? ' selected' : '');
        div.id = 'item-' + globalIdx;
        div.innerHTML = `
          <div class="dest-emoji">${dest.emoji}</div>
          <div class="dest-info">
            <div class="dest-name">${dest.name}</div>
            <div class="dest-tag">${dest.tag}</div>
            <div class="dest-budget">${dest.budget}</div>
          </div>`;
        div.onclick = () => selectDest(globalIdx);
        container.appendChild(div);
      });
    }

    // ── Select a destination ──
    function selectDest(i) {
      // Deselect previous
      if (selectedIdx !== null) {
        markers[selectedIdx].setIcon(makeIcon(destinations[selectedIdx].emoji, false));
        const prev = document.getElementById('item-' + selectedIdx);
        if (prev) prev.classList.remove('selected');
      }

      selectedIdx = i;
      const dest = destinations[i];

      // Zoom map
      map.flyTo([dest.lat, dest.lng], 10, { duration: 1.2 });
      markers[i].setIcon(makeIcon(dest.emoji, true));
      markers[i].openPopup();

      // Highlight sidebar
      const item = document.getElementById('item-' + i);
      if (item) { item.classList.add('selected'); item.scrollIntoView({ behavior:'smooth', block:'nearest' }); }

      // Update info bar
      document.getElementById('infoBar').innerHTML =
        `<strong>${dest.emoji} ${dest.name}</strong> — ${dest.tag} &nbsp;|&nbsp; 💰 ${dest.budget}`;
      document.getElementById('destinationInput').value = dest.name;
      updateTripSummary();
    }

    // ── Filter by search text ──
    function filterDests(query) {
      const q = query.toLowerCase();
      const filtered = destinations.filter(d =>
        (activeCategory === 'all' || d.category === activeCategory) &&
        (d.name.toLowerCase().includes(q) || d.tag.toLowerCase().includes(q))
      );
      renderSidebar(filtered);
    }

    // ── Filter by category tab ──
    function filterByCategory(cat, btn) {
      activeCategory = cat;
      document.querySelectorAll('.tab').forEach(t => t.classList.remove('on'));
      btn.classList.add('on');

      const query = document.getElementById('searchInput').value;
      filterDests(query);
    }

    // ── Reset map to India overview ──
    function resetMap() {
      map.flyTo([22.5, 82], 5, { duration: 1.5 });
      if (selectedIdx !== null) {
        markers[selectedIdx].setIcon(makeIcon(destinations[selectedIdx].emoji, false));
      }
      selectedIdx = null;
      document.getElementById('infoBar').innerHTML = 'Click any destination to zoom in 👆';
    }

    // ── Show all markers (fit bounds) ──
    function showAllMarkers() {
      const group = L.featureGroup(markers);
      map.flyToBounds(group.getBounds().pad(0.1), { duration: 1.5 });
    }

    // ── Clear selection ──
    function clearSelection() {
      if (selectedIdx !== null) {
        markers[selectedIdx].setIcon(makeIcon(destinations[selectedIdx].emoji, false));
        const item = document.getElementById('item-' + selectedIdx);
        if (item) item.classList.remove('selected');
        selectedIdx = null;
      }
      document.getElementById('infoBar').innerHTML = 'Click any destination to zoom in 👆';
      document.getElementById('searchInput').value = '';
      filterDests('');
      updateTripSummary();
    }

    function buildTripLabel() {
      const bookingType = document.getElementById('bookingType').value;
      const destination = document.getElementById('destinationInput').value.trim();
      const hotelOrPackage = document.getElementById('hotelInput').value.trim();
      if (hotelOrPackage && destination) return `${bookingType}: ${hotelOrPackage} - ${destination}`;
      if (destination) return `${bookingType}: ${destination}`;
      if (hotelOrPackage) return `${bookingType}: ${hotelOrPackage}`;
      return bookingType;
    }

    function updateTripSummary() {
      const destination = document.getElementById('destinationInput').value.trim() || 'Not selected';
      const hotelOrPackage = document.getElementById('hotelInput').value.trim() || 'Not selected';
      const travellers = document.getElementById('travellers').value || '1';
      const amount = document.getElementById('tripAmount').value.trim() || '0';
      const bookingType = document.getElementById('bookingType').value;
      document.getElementById('tripField').value = buildTripLabel();
      document.getElementById('bookingSummary').textContent =
        `Trip Summary: ${bookingType} | Destination: ${destination} | Hotel/Package: ${hotelOrPackage} | Travellers: ${travellers} | Amount: INR ${amount}`;
    }

    ['bookingType','destinationInput','hotelInput','travellers','tripAmount','checkinDate','checkoutDate'].forEach((id) => {
      document.getElementById(id).addEventListener('input', updateTripSummary);
      document.getElementById(id).addEventListener('change', updateTripSummary);
    });

    // ── Boot ──
    window.addEventListener('DOMContentLoaded', initMap);
  </script>

</body>
</html>
