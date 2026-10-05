```php
<?php
require_once 'config/database.php';

$berhasil = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $pesan = trim($_POST['pesan'] ?? '');

    if ($nama === '' || $email === '' || $pesan === '') {
        $error = 'Semua kolom wajib diisi.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Format email tidak valid.';
    } else {
        $stmt = $conn->prepare(
            "INSERT INTO contacts (nama, email, pesan)
             VALUES (?, ?, ?)"
        );

        $stmt->bind_param("sss", $nama, $email, $pesan);
        $stmt->execute();
        $stmt->close();

        $berhasil = true;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eaf4ff;
            color: #333;
            margin: 40px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
        }

        label {
            display: block;
            margin-top: 15px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        button {
            margin-top: 15px;
            padding: 10px 18px;
            background-color: #1877d2;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .success {
            color: green;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Kontak</h1>

        <h2>Kirim pesan</h2>

        <p>
            Form ini mendemonstrasikan proses INSERT ke database
            dengan prepared statement.
        </p>

        <?php if ($berhasil): ?>
            <p class="success">
                Pesan berhasil disimpan ke database.
            </p>
        <?php endif; ?>

        <?php if ($error !== ''): ?>
            <p class="error">
                <?= htmlspecialchars($error) ?>
            </p>
        <?php endif; ?>

        <form method="POST" action="process_contact.php">
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama"
                   required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email"
                   required>

            <label for="pesan">Pesan</label>
            <textarea id="pesan" name="pesan"
                      rows="5" required></textarea>

            <button type="submit">Kirim Pesan</button>
        </form>
    </div>
</body>
</html>
```
