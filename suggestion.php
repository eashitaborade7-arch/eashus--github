<?php
declare(strict_types=1);

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/validation.php';
$emailConfig = require __DIR__ . '/config/email.php';

$errors = [];
$success = '';
$form = [
    'name' => '',
    'email' => '',
    'mood' => '',
    'budget' => '',
    'month' => '',
    'notes' => '',
];

$moods = ['summer' => 'Summer', 'winter' => 'Winter', 'romantic' => 'Romantic', 'adventure' => 'Adventure', 'relax' => 'Relax', 'fun' => 'Fun & Party'];
$budgets = ['budget' => 'Budget (< 30k)', 'mid' => 'Mid-range (30k - 80k)', 'luxury' => 'Luxury (80k+)'];
$months = ['Any', 'Jan-Feb', 'Mar-Apr', 'May-Jun', 'Jul-Aug', 'Sep-Oct', 'Nov-Dec'];
$destinationSuggestions = [
    'summer' => [
        ['name' => 'Goa', 'img' => 'https://images.unsplash.com/photo-1512343879784-a960bf40e7f2?w=600&q=80', 'budget' => '25,000 - 45,000', 'tag' => 'Beach', 'info' => 'Sunny beaches, nightlife, and chill cafes.'],
        ['name' => 'Pondicherry', 'img' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=600&q=80', 'budget' => '20,000 - 35,000', 'tag' => 'Coastal', 'info' => 'French vibe streets and peaceful sea side.'],
        ['name' => 'Andaman', 'img' => 'https://images.unsplash.com/photo-1483683804023-6ccdb62f86ef?w=600&q=80', 'budget' => '45,000 - 80,000', 'tag' => 'Island', 'info' => 'Blue waters and water sports adventure.'],
        ['name' => 'Bali', 'img' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=600&q=80', 'budget' => '70,000 - 1,10,000', 'tag' => 'International', 'info' => 'Beaches, temples, and tropical relaxation.'],
    ],
    'winter' => [
        ['name' => 'Kashmir', 'img' => 'https://images.unsplash.com/photo-1598091383021-15ddea10925d?w=600&q=80', 'budget' => '35,000 - 70,000', 'tag' => 'Snow', 'info' => 'Snow valleys and beautiful mountain views.'],
        ['name' => 'Shimla', 'img' => 'https://images.unsplash.com/photo-1549692520-acc6669e2f0c?w=600&q=80', 'budget' => '22,000 - 40,000', 'tag' => 'Hill', 'info' => 'Cold weather, mall road, and old charm.'],
        ['name' => 'Auli', 'img' => 'https://images.unsplash.com/photo-1418985991508-e47386d96a71?w=600&q=80', 'budget' => '30,000 - 55,000', 'tag' => 'Ski', 'info' => 'Perfect for snow fun and ski lovers.'],
        ['name' => 'Manali', 'img' => 'https://images.unsplash.com/photo-1626621341517-bbf3d9990a23?w=600&q=80', 'budget' => '28,000 - 50,000', 'tag' => 'Mountain', 'info' => 'Cozy winter cafes and mountain stays.'],
    ],
    'romantic' => [
        ['name' => 'Udaipur', 'img' => 'https://images.unsplash.com/photo-1599661046827-dacde697654c?w=600&q=80', 'budget' => '30,000 - 55,000', 'tag' => 'Lake City', 'info' => 'Romantic sunsets and royal palaces.'],
        ['name' => 'Munnar', 'img' => 'https://images.unsplash.com/photo-1602216056096-3b40cc0c9944?w=600&q=80', 'budget' => '24,000 - 45,000', 'tag' => 'Nature', 'info' => 'Tea gardens and misty calm mornings.'],
        ['name' => 'Ooty', 'img' => 'https://images.unsplash.com/photo-1587474260584-136574528ed5?w=600&q=80', 'budget' => '25,000 - 42,000', 'tag' => 'Hills', 'info' => 'Cool weather and peaceful couple vibe.'],
        ['name' => 'Paris', 'img' => 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?w=600&q=80', 'budget' => '1,20,000 - 1,90,000', 'tag' => 'International', 'info' => 'Classic romantic destination with iconic views.'],
    ],
    'adventure' => [
        ['name' => 'Rishikesh', 'img' => 'https://images.unsplash.com/photo-1477587458883-47145ed94245?w=600&q=80', 'budget' => '18,000 - 35,000', 'tag' => 'Rafting', 'info' => 'River rafting and thrilling outdoor activities.'],
        ['name' => 'Leh Ladakh', 'img' => 'https://images.unsplash.com/photo-1593181629936-11c609b8db9b?w=600&q=80', 'budget' => '45,000 - 90,000', 'tag' => 'Road Trip', 'info' => 'Bike trips and high altitude adventure.'],
        ['name' => 'Spiti', 'img' => 'https://images.unsplash.com/photo-1544735716-392fe2489ffa?w=600&q=80', 'budget' => '40,000 - 75,000', 'tag' => 'Valley', 'info' => 'Raw landscapes and offbeat roads.'],
        ['name' => 'Bir Billing', 'img' => 'https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=600&q=80', 'budget' => '20,000 - 38,000', 'tag' => 'Paragliding', 'info' => 'Best place for paragliding in India.'],
    ],
    'relax' => [
        ['name' => 'Kerala Backwaters', 'img' => 'https://images.unsplash.com/photo-1593693411515-c20261bcad6e?w=600&q=80', 'budget' => '30,000 - 55,000', 'tag' => 'Houseboat', 'info' => 'Slow travel, calm water, pure peace.'],
        ['name' => 'Coorg', 'img' => 'https://images.unsplash.com/photo-1524492412937-b28074a5d7da?w=600&q=80', 'budget' => '22,000 - 40,000', 'tag' => 'Coffee Estate', 'info' => 'Nature, coffee, and stress-free vibes.'],
        ['name' => 'Gokarna', 'img' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=600&q=80', 'budget' => '20,000 - 35,000', 'tag' => 'Beach', 'info' => 'Less crowd, more calm and sunsets.'],
        ['name' => 'Alleppey', 'img' => 'https://images.unsplash.com/photo-1518509562904-e7ef99cdcc86?w=600&q=80', 'budget' => '28,000 - 45,000', 'tag' => 'Backwater', 'info' => 'Perfect for a soft and quiet holiday.'],
    ],
    'fun' => [
        ['name' => 'Goa Nightlife', 'img' => 'https://images.unsplash.com/photo-1512343879784-a960bf40e7f2?w=600&q=80', 'budget' => '25,000 - 45,000', 'tag' => 'Party', 'info' => 'Beach clubs, music, and fun nights.'],
        ['name' => 'Mumbai', 'img' => 'https://images.unsplash.com/photo-1570168007204-dfb528c6958f?w=600&q=80', 'budget' => '22,000 - 40,000', 'tag' => 'City Life', 'info' => 'Food, nightlife, and non-stop energy.'],
        ['name' => 'Bangalore', 'img' => 'https://images.unsplash.com/photo-1596176530529-78163a4f7af2?w=600&q=80', 'budget' => '18,000 - 35,000', 'tag' => 'Pub Scene', 'info' => 'Great cafes, pubs, and city vibes.'],
        ['name' => 'Dubai', 'img' => 'https://images.unsplash.com/photo-1512453979798-5ea266f8880c?w=600&q=80', 'budget' => '90,000 - 1,50,000', 'tag' => 'Luxury Fun', 'info' => 'Luxury shopping and exciting city life.'],
    ],
];
$recommendedDestinations = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form['name'] = cleanInput($_POST['name'] ?? '');
    $form['email'] = cleanInput($_POST['email'] ?? '');
    $form['mood'] = cleanInput($_POST['mood'] ?? '');
    $form['budget'] = cleanInput($_POST['budget'] ?? '');
    $form['month'] = cleanInput($_POST['month'] ?? '');
    $form['notes'] = cleanInput($_POST['notes'] ?? '');

    if ($form['name'] === '' || strlen($form['name']) < 2) {
        $errors[] = 'Please enter a valid name.';
    }
    if (!isValidEmail($form['email'])) {
        $errors[] = 'Please enter a valid email.';
    }
    if (!array_key_exists($form['mood'], $moods)) {
        $errors[] = 'Please choose your travel mood.';
    }
    if (!array_key_exists($form['budget'], $budgets)) {
        $errors[] = 'Please select a budget range.';
    }
    if (!in_array($form['month'], $months, true)) {
        $errors[] = 'Please select a preferred travel month range.';
    }

    if (!$errors) {
        try {
            $pdo = getDbConnection();
            $stmt = $pdo->prepare(
                'INSERT INTO travel_suggestions (full_name, email, mood, budget, travel_month, notes) VALUES (:name, :email, :mood, :budget, :travel_month, :notes)'
            );
            $stmt->execute([
                ':name' => $form['name'],
                ':email' => $form['email'],
                ':mood' => $form['mood'],
                ':budget' => $form['budget'],
                ':travel_month' => $form['month'],
                ':notes' => $form['notes'] !== '' ? $form['notes'] : null,
            ]);

            // Send confirmation and suggestion summary email.
            $selectedMood = $moods[$form['mood']] ?? ucfirst($form['mood']);
            $selectedBudget = $budgets[$form['budget']] ?? $form['budget'];

            $subject = 'Your Plan Karo Travel Suggestion';
            $message = "Hi {$form['name']},\n\n";
            $message .= "Thanks for using Plan Karo. Here is your saved travel suggestion:\n";
            $message .= "- Mood: {$selectedMood}\n";
            $message .= "- Budget: {$selectedBudget}\n";
            $message .= "- Preferred Month: {$form['month']}\n";
            if ($form['notes'] !== '') {
                $message .= "- Notes: {$form['notes']}\n";
            }
            $message .= "\nOur team will send destination options soon.\n";
            $message .= "\nSafar yadoon ka,\nPlan Karo Team";

            $fromName = $emailConfig['from_name'] ?? 'Plan Karo';
            $fromEmail = $emailConfig['from_email'] ?? 'noreply@plankaro.local';
            $headers = "From: {$fromName} <{$fromEmail}>\r\n";
            $headers .= "Reply-To: {$emailConfig['admin_email']}\r\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

            $sentToUser = @mail($form['email'], $subject, $message, $headers);
            $sentToAdmin = false;
            if (!empty($emailConfig['admin_email'])) {
                $adminSubject = "New Suggestion Submitted - {$form['name']}";
                $adminBody = "A new suggestion has been submitted.\n\n";
                $adminBody .= "Name: {$form['name']}\nEmail: {$form['email']}\nMood: {$selectedMood}\nBudget: {$selectedBudget}\nMonth: {$form['month']}\nNotes: {$form['notes']}\n";
                $sentToAdmin = @mail((string) $emailConfig['admin_email'], $adminSubject, $adminBody, $headers);
            }

            if ($sentToUser) {
                $success = 'Suggestion saved and email sent successfully.';
            } else {
                $success = 'Suggestion saved successfully. Email sending is not active on server yet.';
            }
            if (!$sentToAdmin && !empty($emailConfig['admin_email'])) {
                $success .= ' (Admin notification email not sent.)';
            }
            $recommendedDestinations = array_slice($destinationSuggestions[$form['mood']] ?? [], 0, 4);
            $form = ['name' => '', 'email' => '', 'mood' => '', 'budget' => '', 'month' => '', 'notes' => ''];
        } catch (Throwable $e) {
            $errors[] = 'Unable to save your suggestion right now.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chill Suggestion - Plan Karo</title>
  <style>
    :root{--navy:#0f1b2d;--teal:#0ea5a4;--gold:#f59e0b;--bg:#f1f7ff;--card:#ffffff;--text:#1f2937}
    *{box-sizing:border-box}
    body{font-family:Arial,sans-serif;background:var(--bg);color:var(--text);margin:0}
    .top{background:linear-gradient(120deg,#0f1b2d,#1f3a5f);padding:18px}
    .nav{max-width:980px;margin:0 auto;display:flex;gap:12px;flex-wrap:wrap}
    .nav a{color:#cbd5e1;text-decoration:none;padding:7px 12px;border-radius:20px}
    .nav a:hover{background:rgba(14,165,164,.2);color:#fff}
    .hero{max-width:980px;margin:16px auto 0;color:#fff}
    .hero h1{margin:0;color:#fbbf24}
    .hero p{margin:6px 0 0;color:#cbd5e1}
    .wrap{max-width:980px;margin:20px auto;padding:0 16px 30px}
    .card{background:var(--card);border:1px solid #dbe8f5;border-radius:14px;padding:16px}
    .mood-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:10px;margin:10px 0 14px}
    .mood-btn{border:1px solid #bfdbfe;background:#f8fbff;border-radius:10px;padding:12px;cursor:pointer;font-weight:700}
    .mood-btn:hover{border-color:#0ea5a4;background:#ecfeff}
    .mood-btn.active{background:#ccfbf1;border-color:#0ea5a4}
    .mood-btn small{display:block;font-weight:400;color:#475569;margin-top:4px}
    .grid{display:grid;grid-template-columns:1fr 1fr;gap:12px}
    .row{margin-bottom:12px}
    label{display:block;font-size:13px;margin-bottom:6px;color:#0f766e;font-weight:700}
    input,select,textarea{width:100%;padding:10px;border-radius:8px;border:1px solid #cbd5e1;background:#fff;color:#0f172a}
    textarea{min-height:90px}
    button[type=submit]{background:#0ea5a4;color:#fff;border:none;padding:11px 16px;border-radius:8px;font-weight:700;cursor:pointer}
    .fun-box{margin-top:14px;background:#f8fafc;border:1px dashed #94a3b8;border-radius:10px;padding:12px}
    .fun-box strong{color:#334155}
    .results{margin-top:16px}
    .results h3{margin:0 0 10px 0;color:#0f766e}
    .dest-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:12px}
    .dest-card{background:#fff;border:1px solid #cbd5e1;border-radius:10px;overflow:hidden}
    .dest-card img{width:100%;height:140px;object-fit:cover;display:block}
    .dest-link{display:block}
    .dest-body{padding:10px}
    .tag-chip{display:inline-block;background:#e0f2fe;color:#075985;padding:3px 8px;border-radius:16px;font-size:12px;margin-bottom:6px}
    .dest-name{font-weight:700;margin-bottom:4px}
    .dest-budget{color:#0f766e;font-size:13px;font-weight:700;margin-bottom:4px}
    .dest-info{font-size:13px;color:#475569}
    .vibe{margin:8px 0 0;color:#334155;font-size:14px}
    .sr{position:absolute;left:-9999px}
    @media (max-width:760px){.grid,.mood-grid,.dest-grid{grid-template-columns:1fr}}
  </style>
</head>
<body>
  <div class="top">
    <div class="nav">
      <a href="index.php">🏠 Home</a>
      <a href="destination.php">🌍 Destinations</a>
      <a href="live_map.php">🗺️ Live Map</a>
    </div>
    <div class="hero">
      <h1>✨ Chill Travel Suggestion</h1>
      <p>Simple, normal, fun page - pick your vibe and we suggest your trip style.</p>
    </div>
  </div>

  <div class="wrap">
    <div class="card">
    

    <form method="post" action="">
      <div class="grid">
        <div class="row">
          <label for="name">Full Name</label>
          <input id="name" name="name" value="<?= esc($form['name']) ?>" required>
        </div>
        <div class="row">
          <label for="email">Email</label>
          <input id="email" type="email" name="email" value="<?= esc($form['email']) ?>" required>
        </div>
      </div>

      <div class="row">
        <label>Pick Your Mood</label>
        <div class="mood-grid" id="moodGrid">
          <?php
          $moodEmoji = ['summer' => '☀️', 'winter' => '❄️', 'romantic' => '💕', 'adventure' => '⚡', 'relax' => '🌿', 'fun' => '🎉'];
          $moodHint = ['summer' => 'Beach and sunshine', 'winter' => 'Snow and cozy', 'romantic' => 'Calm and cute', 'adventure' => 'Thrill and action', 'relax' => 'Peace and slow', 'fun' => 'Party and vibes'];
          foreach ($moods as $value => $label):
          ?>
            <button type="button" class="mood-btn <?= $form['mood'] === $value ? 'active' : '' ?>" data-value="<?= esc($value) ?>">
              <?= esc($moodEmoji[$value]) ?> <?= esc($label) ?>
              <small><?= esc($moodHint[$value]) ?></small>
            </button>
          <?php endforeach; ?>
        </div>
        <input class="sr" id="moodInput" type="text" name="mood" value="<?= esc($form['mood']) ?>" required>
        <p class="vibe" id="vibeText">Current vibe: <?= $form['mood'] !== '' && isset($moods[$form['mood']]) ? esc($moods[$form['mood']]) : 'Not selected yet' ?></p>
      </div>

      <div class="grid">
        <div class="row">
          <label for="budget">Budget</label>
          <select id="budget" name="budget" required>
            <option value="">Choose budget</option>
            <?php foreach ($budgets as $value => $label): ?>
              <option value="<?= esc($value) ?>" <?= $form['budget'] === $value ? 'selected' : '' ?>><?= esc($label) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="row">
          <label for="month">Preferred Travel Month</label>
          <select id="month" name="month" required>
            <option value="">Choose month range</option>
            <?php foreach ($months as $month): ?>
              <option value="<?= esc($month) ?>" <?= $form['month'] === $month ? 'selected' : '' ?>><?= esc($month) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

      <div class="row">
        <label for="notes">Extra Preferences (optional)</label>
        <textarea id="notes" name="notes" placeholder="Food, activities, duration, etc."><?= esc($form['notes']) ?></textarea>
      </div>
      <button type="submit">Save My Suggestion</button>
    </form>

    <div class="fun-box">
      <strong>Fun ideas (from your old style page):</strong>
      <div>- Add destination cards after submit based on selected mood.</div>
      <div>- Add one-tap buttons: "Explore" and "Open Live Map".</div>
      <div>- Show random quote: "Safar yadoon ka, tension free plan karo."</div>
    </div>

    <?php if ($recommendedDestinations): ?>
      <div class="results">
        <h3>🎯 Top 4 Destination Suggestions For You</h3>
        <div class="dest-grid">
          <?php foreach ($recommendedDestinations as $dest): ?>
            <div class="dest-card">
              <a class="dest-link" href="live_map.php?place=<?= urlencode($dest['name']) ?>" title="Open <?= esc($dest['name']) ?> on live map">
                <img src="<?= esc($dest['img']) ?>" alt="<?= esc($dest['name']) ?>">
              </a>
              <div class="dest-body">
                <span class="tag-chip"><?= esc($dest['tag']) ?></span>
                <div class="dest-name"><?= esc($dest['name']) ?></div>
                <div class="dest-budget">Budget: ₹<?= esc($dest['budget']) ?></div>
                <div class="dest-info"><?= esc($dest['info']) ?></div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endif; ?>
    </div>
  </div>
  <script>
    (function () {
      const moodButtons = document.querySelectorAll('.mood-btn');
      const moodInput = document.getElementById('moodInput');
      const vibeText = document.getElementById('vibeText');
      moodButtons.forEach((btn) => {
        btn.addEventListener('click', function () {
          moodButtons.forEach((b) => b.classList.remove('active'));
          this.classList.add('active');
          moodInput.value = this.dataset.value;
          vibeText.textContent = 'Current vibe: ' + this.textContent.trim().split('\n')[0];
        });
      });
    })();

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
