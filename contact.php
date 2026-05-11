<?php
declare(strict_types=1);

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/validation.php';

$errors = [];
$success = '';
$form = [
    'name' => '',
    'email' => '',
    'phone' => '',
    'type' => 'General Enquiry',
    'message' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form['name'] = cleanInput($_POST['name'] ?? '');
    $form['email'] = cleanInput($_POST['email'] ?? '');
    $form['phone'] = cleanInput($_POST['phone'] ?? '');
    $form['type'] = cleanInput($_POST['type'] ?? 'General Enquiry');
    $form['message'] = cleanInput($_POST['message'] ?? '');

    if ($form['name'] === '' || strlen($form['name']) < 2) {
        $errors[] = 'Please enter a valid full name.';
    }
    if (!isValidEmail($form['email'])) {
        $errors[] = 'Please enter a valid email address.';
    }
    if ($form['phone'] !== '' && !isValidPhone($form['phone'])) {
        $errors[] = 'Phone number should contain 10 to 15 digits.';
    }
    if ($form['message'] === '' || strlen($form['message']) < 10) {
        $errors[] = 'Message must be at least 10 characters long.';
    }

    if (!$errors) {
        try {
            $pdo = getDbConnection();
            $stmt = $pdo->prepare(
                'INSERT INTO contact_messages (full_name, email, phone, enquiry_type, message) VALUES (:name, :email, :phone, :type, :message)'
            );
            $stmt->execute([
                ':name' => $form['name'],
                ':email' => $form['email'],
                ':phone' => $form['phone'] !== '' ? $form['phone'] : null,
                ':type' => $form['type'],
                ':message' => $form['message'],
            ]);

            $success = 'Message sent successfully. Our team will contact you soon.';
            $form = ['name' => '', 'email' => '', 'phone' => '', 'type' => 'General Enquiry', 'message' => ''];
        } catch (Throwable $e) {
            $errors[] = 'Unable to submit message right now. Please try again.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us - Plan Karo</title>
  <style>
    body { font-family: Arial, sans-serif; background:#0f1b2d; color:#fff; margin:0; }
    .container { max-width: 760px; margin: 40px auto; padding: 24px; background:#111e2f; border-radius:12px; }
    h1 { margin-top:0; color:#f59e0b; }
    a { color:#0ea5a4; text-decoration:none; }
    .msg { padding:10px 12px; border-radius:8px; margin-bottom:14px; }
    .ok { background:#14532d; }
    .err { background:#7f1d1d; }
    .row { margin-bottom:12px; }
    label { display:block; margin-bottom:6px; font-size:13px; color:#93c5fd; }
    input, select, textarea { width:100%; padding:10px; border-radius:8px; border:1px solid #334155; background:#0b1220; color:#fff; }
    textarea { min-height:120px; }
    button { background:#0ea5a4; border:none; color:#fff; padding:10px 16px; border-radius:8px; font-weight:700; cursor:pointer; }
  </style>
</head>
<body>
  <div class="container">
    <p><a href="index.php">← Back to Home</a></p>
    <h1>Contact Us</h1>
    <p>Need help with booking or planning? Send us your query.</p>

    <?php if ($success !== ''): ?>
      <div class="msg ok"><?= esc($success) ?></div>
    <?php endif; ?>

    <?php if ($errors): ?>
      <div class="msg err">
        <?php foreach ($errors as $error): ?>
          <div>- <?= esc($error) ?></div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <form method="post" action="">
      <div class="row">
        <label for="name">Full Name</label>
        <input id="name" name="name" value="<?= esc($form['name']) ?>" required>
      </div>
      <div class="row">
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="<?= esc($form['email']) ?>" required>
      </div>
      <div class="row">
        <label for="phone">Phone (optional)</label>
        <input id="phone" name="phone" value="<?= esc($form['phone']) ?>">
      </div>
      <div class="row">
        <label for="type">Enquiry Type</label>
        <select id="type" name="type">
          <?php
          $types = ['General Enquiry', 'Booking Support', 'Payment Issue', 'Cancel / Refund', 'Custom Trip Planning', 'Feedback'];
          foreach ($types as $type):
          ?>
            <option value="<?= esc($type) ?>" <?= $form['type'] === $type ? 'selected' : '' ?>><?= esc($type) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="row">
        <label for="message">Message</label>
        <textarea id="message" name="message" required><?= esc($form['message']) ?></textarea>
      </div>
      <button type="submit">Send Message</button>
    </form>
  </div>
</body>
</html>
