<?php

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../src/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée.']);
    exit;
}

$fullName = trim($_POST['full_name'] ?? '');
$email = trim($_POST['email'] ?? '');
$service = trim($_POST['service'] ?? '');
$message = trim($_POST['message'] ?? '');

$errors = [];

if ($fullName === '' || mb_strlen($fullName) < 3) {
    $errors[] = 'Le nom complet doit contenir au moins 3 caractères.';
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Adresse email invalide.';
}

$allowedServices = [
    'Création site web',
    'Maintenance informatique',
    'Cybersécurité',
    'Cloud & DevOps',
    'Autre besoin'
];

if (!in_array($service, $allowedServices, true)) {
    $errors[] = 'Service sélectionné invalide.';
}

if ($message === '' || mb_strlen($message) < 10) {
    $errors[] = 'Le message doit contenir au moins 10 caractères.';
}

if ($errors !== []) {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => implode(' ', $errors)]);
    exit;
}

try {
    $pdo = getPDO();

    $stmt = $pdo->prepare(
        'INSERT INTO contacts (full_name, email, service, message, ip_address)
         VALUES (:full_name, :email, :service, :message, :ip_address)'
    );

    $stmt->execute([
        ':full_name' => $fullName,
        ':email' => $email,
        ':service' => $service,
        ':message' => $message,
        ':ip_address' => $_SERVER['REMOTE_ADDR'] ?? null,
    ]);

    echo json_encode([
        'success' => true,
        'message' => 'Votre message a été enregistré avec succès dans la base de données.'
    ]);
} catch (Throwable $exception) {
    error_log($exception->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Erreur serveur. Veuillez réessayer plus tard.'
    ]);
}
