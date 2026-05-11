<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/validation.php';
require_once __DIR__ . '/config/database.php';

$errors = [];
$success = '';
$dbNotice = '';
$receipt = null;

$form = [
    'full_name' => cleanInput($_GET['name'] ?? ''),
    'email' => cleanInput($_GET['email'] ?? ''),
    'trip' => cleanInput($_GET['trip'] ?? 'Custom Trip'),
    'amount' => cleanInput($_GET['amount'] ?? '25000'),
    'method' => 'proxy',
    'upi_id' => '',
    'card_number' => '',
    'card_name' => '',
    'expiry' => '',
    'cvv' => '',
    'bank' => '',
];

$methods = ['proxy', 'upi', 'card', 'netbanking'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form['full_name'] = cleanInput($_POST['full_name'] ?? '');
    $form['email'] = cleanInput($_POST['email'] ?? '');
    $form['trip'] = cleanInput($_POST['trip'] ?? 'Custom Trip');
    $form['amount'] = cleanInput($_POST['amount'] ?? '0');
    $form['method'] = cleanInput($_POST['method'] ?? 'proxy');
    $form['upi_id'] = cleanInput($_POST['upi_id'] ?? '');
    $form['card_number'] = cleanInput($_POST['card_number'] ?? '');
    $form['card_name'] = cleanInput($_POST['card_name'] ?? '');
    $form['expiry'] = cleanInput($_POST['expiry'] ?? '');
    $form['cvv'] = cleanInput($_POST['cvv'] ?? '');
    $form['bank'] = cleanInput($_POST['bank'] ?? '');

    if ($form['full_name'] === '' || strlen($form['full_name']) < 2) {
        $errors[] = 'Please enter a valid full name.';
    }
    if (!isValidEmail($form['email'])) {
        $errors[] = 'Please enter a valid email address.';
    }
    if (!is_numeric($form['amount']) || (float) $form['amount'] <= 0) {
        $errors[] = 'Please enter a valid payment amount.';
    }
    if (!in_array($form['method'], $methods, true)) {
        $errors[] = 'Please choose a valid payment method.';
    }

    if ($form['method'] === 'upi' && !preg_match('/^[a-zA-Z0-9.\-_]{2,}@[a-zA-Z]{2,}$/', $form['upi_id'])) {
        $errors[] = 'Please enter a valid UPI ID.';
    }

    if ($form['method'] === 'card') {
        $cardDigits = digitsOnly($form['card_number']);
        if (strlen($cardDigits) < 12 || strlen($cardDigits) > 19) {
            $errors[] = 'Please enter a valid card number.';
        }
        if ($form['card_name'] === '' || strlen($form['card_name']) < 2) {
            $errors[] = 'Please enter the card holder name.';
        }
        if (!preg_match('/^(0[1-9]|1[0-2])\/\d{2}$/', $form['expiry'])) {
            $errors[] = 'Expiry must be in MM/YY format.';
        }
        if (!preg_match('/^\d{3,4}$/', $form['cvv'])) {
            $errors[] = 'Please enter a valid CVV.';
        }
    }

    if ($form['method'] === 'netbanking' && $form['bank'] === '') {
        $errors[] = 'Please select your bank for net banking.';
    }

    if (!$errors) {
        $paymentId = 'PKPAY' . date('YmdHis') . random_int(100, 999);
        $receiptNo = 'RCP-' . date('Ymd') . '-' . random_int(10000, 99999);
        $amountValue = (float) $form['amount'];
        $displayMethod = match ($form['method']) {
            'proxy' => 'Proxy Payment (Test)',
            'upi' => 'UPI',
            'card' => 'Credit/Debit Card',
            default => 'Net Banking',
        };
        try {
            $pdo = getDbConnection();
            $stmt = $pdo->prepare(
                'INSERT INTO payment_receipts 
                (receipt_no, transaction_id, customer_name, customer_email, trip_name, amount, payment_method, payment_status)
                VALUES (:receipt_no, :transaction_id, :customer_name, :customer_email, :trip_name, :amount, :payment_method, :payment_status)'
            );
            $stmt->execute([
                ':receipt_no' => $receiptNo,
                ':transaction_id' => $paymentId,
                ':customer_name' => $form['full_name'],
                ':customer_email' => $form['email'],
                ':trip_name' => $form['trip'],
                ':amount' => $amountValue,
                ':payment_method' => $displayMethod,
                ':payment_status' => 'paid',
            ]);
        } catch (Throwable $e) {
            $dbNotice = 'Payment done, but receipt was not saved. Import latest database.sql to create payment_receipts table.';
        }
        $receipt = [
            'receipt_no' => $receiptNo,
            'transaction_id' => $paymentId,
            'customer_name' => $form['full_name'],
            'customer_email' => $form['email'],
            'trip_name' => $form['trip'],
            'amount' => $amountValue,
            'payment_method' => $displayMethod,
            'paid_at' => date('Y-m-d H:i:s'),
        ];
        $success = "Payment successful via {$displayMethod}. Transaction ID: {$paymentId}";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment - Plan Karo</title>
  <style>
    :root{--navy:#0f1b2d;--teal:#0ea5a4;--gold:#f59e0b;--light:#f1f7ff}
    *{box-sizing:border-box}
    body{margin:0;font-family:Arial,sans-serif;background:var(--light);color:#111827}
    .top{background:linear-gradient(120deg,#0f1b2d,#1f3a5f);padding:16px}
    .top a{color:#cbd5e1;text-decoration:none;margin-right:10px}
    .hero{max-width:950px;margin:8px auto;color:#fff}
    .hero h1{margin:0;color:#fbbf24}
    .wrap{max-width:950px;margin:20px auto;padding:0 16px 24px}
    .card{background:#fff;border:1px solid #dbe8f5;border-radius:12px;padding:16px}
    .grid{display:grid;grid-template-columns:1fr 1fr;gap:12px}
    .row{margin-bottom:12px}
    label{display:block;font-size:13px;font-weight:700;margin-bottom:6px;color:#0f766e}
    input,select{width:100%;padding:10px;border-radius:8px;border:1px solid #cbd5e1}
    .methods{display:grid;grid-template-columns:repeat(2,1fr);gap:10px;margin-bottom:8px}
    .method-card{border:1px solid #bfdbfe;background:#f8fbff;padding:10px;border-radius:10px}
    .hint{font-size:12px;color:#64748b}
    .submit{background:var(--teal);border:none;color:#fff;font-weight:700;padding:11px 16px;border-radius:8px;cursor:pointer}
    .print-btn{display:inline-block;background:#1d4ed8;color:#fff;font-weight:700;padding:11px 16px;border-radius:8px;text-decoration:none}
    .ok,.err{padding:10px;border-radius:8px;margin-bottom:12px;color:#fff}
    .ok{background:#166534}.err{background:#991b1b}
    .notice{background:#92400e;color:#fff;padding:10px;border-radius:8px;margin-bottom:12px}
    .proxy{background:#fffbeb;border:1px solid #fcd34d;color:#92400e;border-radius:10px;padding:10px;margin-bottom:12px}
    .receipt{margin-top:14px;border:1px solid #bfdbfe;background:#eff6ff;border-radius:10px;overflow:hidden}
    .receipt h3{margin:0;padding:10px 12px;background:#dbeafe;color:#1e3a8a;font-size:15px}
    .receipt table{width:100%;border-collapse:collapse}
    .receipt td{padding:8px 12px;border-top:1px solid #bfdbfe;font-size:13px}
    .receipt td:first-child{font-weight:700;color:#1e3a8a;width:180px}
    @media (max-width:760px){.grid,.methods{grid-template-columns:1fr}}
  </style>
</head>
<body>
  <div class="top">
    <a href="index.php">🏠 Home</a>
    <a href="booking.php">📦 Booking</a>
    <a href="payment.php">💳 Payment</a>
  </div>
  <div class="hero">
    <h1>💳 Secure Payment</h1>
    <p>Complete your booking quickly. Proxy option is available for testing.</p>
  </div>

  <div class="wrap">
    <div class="card">
      <div class="proxy">
        <strong>Proxy Payment Option Available:</strong> choose <b>Proxy Payment (Test)</b> to simulate successful payment instantly.
      </div>

      <?php if ($success !== ''): ?><div class="ok"><?= esc($success) ?></div><?php endif; ?>
      <?php if ($dbNotice !== ''): ?><div class="notice"><?= esc($dbNotice) ?></div><?php endif; ?>
      <?php if ($errors): ?>
        <div class="err"><?php foreach ($errors as $error): ?><div>- <?= esc($error) ?></div><?php endforeach; ?></div>
      <?php endif; ?>

      <?php if ($receipt !== null): ?>
        <div class="receipt">
          <h3>Payment Receipt</h3>
          <table>
            <tr><td>Receipt No</td><td><?= esc((string) $receipt['receipt_no']) ?></td></tr>
            <tr><td>Transaction ID</td><td><?= esc((string) $receipt['transaction_id']) ?></td></tr>
            <tr><td>Customer</td><td><?= esc((string) $receipt['customer_name']) ?> (<?= esc((string) $receipt['customer_email']) ?>)</td></tr>
            <tr><td>Trip</td><td><?= esc((string) $receipt['trip_name']) ?></td></tr>
            <tr><td>Amount</td><td>₹<?= esc(number_format((float) $receipt['amount'], 2)) ?></td></tr>
            <tr><td>Method</td><td><?= esc((string) $receipt['payment_method']) ?></td></tr>
            <tr><td>Status</td><td>Paid</td></tr>
            <tr><td>Paid At</td><td><?= esc((string) $receipt['paid_at']) ?></td></tr>
          </table>
        </div>
      <?php endif; ?>

      <form method="post" action="">
        <div class="grid">
          <div class="row">
            <label for="full_name">Full Name</label>
            <input id="full_name" name="full_name" value="<?= esc($form['full_name']) ?>" required>
          </div>
          <div class="row">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="<?= esc($form['email']) ?>" required>
          </div>
        </div>

        <div class="grid">
          <div class="row">
            <label for="trip">Trip / Package</label>
            <input id="trip" name="trip" value="<?= esc($form['trip']) ?>" required>
          </div>
          <div class="row">
            <label for="amount">Amount (INR)</label>
            <input id="amount" name="amount" value="<?= esc($form['amount']) ?>" required>
          </div>
        </div>

        <div class="row">
          <label>Payment Method</label>
          <div class="methods">
            <label class="method-card"><input type="radio" name="method" value="proxy" <?= $form['method'] === 'proxy' ? 'checked' : '' ?>> Proxy Payment (Test)<div class="hint">Best for demo and local project</div></label>
            <label class="method-card"><input type="radio" name="method" value="upi" <?= $form['method'] === 'upi' ? 'checked' : '' ?>> UPI<div class="hint">Pay using UPI ID</div></label>
            <label class="method-card"><input type="radio" name="method" value="card" <?= $form['method'] === 'card' ? 'checked' : '' ?>> Card<div class="hint">Credit / Debit card</div></label>
            <label class="method-card"><input type="radio" name="method" value="netbanking" <?= $form['method'] === 'netbanking' ? 'checked' : '' ?>> Net Banking<div class="hint">Pay from your bank</div></label>
          </div>
        </div>

        <div class="grid">
          <div class="row">
            <label for="upi_id">UPI ID (for UPI)</label>
            <input id="upi_id" name="upi_id" placeholder="name@upi" value="<?= esc($form['upi_id']) ?>">
          </div>
          <div class="row">
            <label for="bank">Bank (for Net Banking)</label>
            <select id="bank" name="bank">
              <option value="">Select bank</option>
              <option value="SBI" <?= $form['bank'] === 'SBI' ? 'selected' : '' ?>>SBI</option>
              <option value="HDFC" <?= $form['bank'] === 'HDFC' ? 'selected' : '' ?>>HDFC</option>
              <option value="ICICI" <?= $form['bank'] === 'ICICI' ? 'selected' : '' ?>>ICICI</option>
              <option value="Axis" <?= $form['bank'] === 'Axis' ? 'selected' : '' ?>>Axis</option>
            </select>
          </div>
        </div>

        <div class="grid">
          <div class="row">
            <label for="card_number">Card Number (for Card)</label>
            <input id="card_number" name="card_number" placeholder="1234 5678 9012 3456" value="<?= esc($form['card_number']) ?>">
          </div>
          <div class="row">
            <label for="card_name">Card Holder Name</label>
            <input id="card_name" name="card_name" placeholder="Name on card" value="<?= esc($form['card_name']) ?>">
          </div>
        </div>

        <div class="grid">
          <div class="row">
            <label for="expiry">Expiry (MM/YY)</label>
            <input id="expiry" name="expiry" placeholder="08/28" value="<?= esc($form['expiry']) ?>">
          </div>
          <div class="row">
            <label for="cvv">CVV</label>
            <input id="cvv" name="cvv" placeholder="123" value="<?= esc($form['cvv']) ?>">
          </div>
        </div>

        <?php if ($receipt === null): ?>
          <button class="submit" type="submit">Pay Now</button>
        <?php else: ?>
          <a class="print-btn" href="#" onclick="window.print(); return false;">Print Receipt</a>
        <?php endif; ?>
      </form>
    </div>
  </div>
</body>
</html>
