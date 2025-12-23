<?php
$pages = [
    'home' => 'الرئيسية',
    'about' => 'من نحن',
    'contact' => 'اتصل بنا'
];

$current = $_GET['page'] ?? 'home';
if (!array_key_exists($current, $pages)) {
    $current = 'home';
}

$content = [
    'home' => [
        'title' => 'مرحبا بكم في موقعنا',
        'body' => 'هذا موقع PHP بسيط يعرض صفحة رئيسية وتعريفية ونموذج اتصال.'
    ],
    'about' => [
        'title' => 'من نحن',
        'body' => 'نحن فريق صغير مهتم بتطوير تطبيقات الويب البسيطة والفعالة.'
    ],
    'contact' => [
        'title' => 'اتصل بنا',
        'body' => 'يمكنك التواصل معنا عبر البريد الإلكتروني info@example.com أو عبر النموذج التالي:',
        'form' => true
    ]
];

$submitted = false;
$message = '';

if ($current === 'contact' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $msg = trim($_POST['message'] ?? '');

    if ($name && $email && $msg) {
        $submitted = true;
        $message = 'شكراً لتواصلك معنا يا ' . htmlspecialchars($name) . '!';
    } else {
        $message = 'الرجاء تعبئة جميع الحقول.';
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>موقع PHP بسيط</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <header>
        <h1>موقع PHP بسيط</h1>
        <nav>
            <ul>
                <?php foreach ($pages as $key => $label): ?>
                    <li class="<?php echo $current === $key ? 'active' : ''; ?>">
                        <a href="?page=<?php echo $key; ?>"><?php echo $label; ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2><?php echo $content[$current]['title']; ?></h2>
            <p><?php echo $content[$current]['body']; ?></p>

            <?php if ($current === 'contact'): ?>
                <?php if ($message): ?>
                    <div class="message <?php echo $submitted ? 'success' : 'error'; ?>">
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>

                <?php if (!$submitted): ?>
                    <form method="post" action="?page=contact">
                        <label for="name">الاسم</label>
                        <input type="text" id="name" name="name" required />

                        <label for="email">البريد الإلكتروني</label>
                        <input type="email" id="email" name="email" required />

                        <label for="message">رسالتك</label>
                        <textarea id="message" name="message" rows="5" required></textarea>

                        <button type="submit">إرسال</button>
                    </form>
                <?php endif; ?>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <p>© <?php echo date('Y'); ?> جميع الحقوق محفوظة.</p>
    </footer>
</body>
</html>
