<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/db.php';

$expectedToken = getenv('ADMIN_TOKEN') ?: 'admin123';
$providedToken = $_GET['token'] ?? '';

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

if (!hash_equals($expectedToken, $providedToken)) {
    http_response_code(403);
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Accès admin</title>
        <link rel="stylesheet" href="/assets/css/style.css">
    </head>
    <body class="admin-body">
        <main class="admin-wrapper">
            <section class="admin-card">
                <h1>Accès refusé</h1>
                <p>Ajoutez le token admin dans l’URL :</p>
                <code>/admin.php?token=admin123</code>
                <a href="/" class="btn btn-primary">Retour au site</a>
            </section>
        </main>
    </body>
    </html>
    <?php
    exit;
}

try {
    $pdo = getPDO();
    $stmt = $pdo->query('SELECT * FROM contacts ORDER BY created_at DESC');
    $messages = $stmt->fetchAll();
} catch (Throwable $exception) {
    $messages = [];
    $error = $exception->getMessage();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages reçus | WebOps Services</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="admin-body">
    <main class="admin-page">
        <div class="admin-header">
            <div>
                <p class="section-label">Administration</p>
                <h1>Messages reçus</h1>
                <p>Liste des demandes enregistrées dans la base MySQL.</p>
            </div>
            <a href="/" class="btn btn-secondary">Retour au site</a>
        </div>

        <?php if (isset($error)): ?>
            <div class="alert error">Erreur de connexion à la base : <?= e($error) ?></div>
        <?php endif; ?>

        <div class="table-card">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Service</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($messages === []): ?>
                        <tr><td colspan="6">Aucun message pour le moment.</td></tr>
                    <?php endif; ?>

                    <?php foreach ($messages as $message): ?>
                        <tr>
                            <td><?= e((string) $message['id']) ?></td>
                            <td><?= e($message['full_name']) ?></td>
                            <td><?= e($message['email']) ?></td>
                            <td><?= e($message['service']) ?></td>
                            <td><?= e($message['message']) ?></td>
                            <td><?= e($message['created_at']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
