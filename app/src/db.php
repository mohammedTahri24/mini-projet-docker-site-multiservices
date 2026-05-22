<?php

declare(strict_types=1);

function getPDO(): PDO
{
    $host = getenv('DB_HOST') ?: 'mysql';
    $dbName = getenv('DB_NAME') ?: 'webops_db';
    $user = getenv('DB_USER') ?: 'webops_user';
    $password = getenv('DB_PASSWORD') ?: 'webops_pass';

    $dsn = "mysql:host={$host};dbname={$dbName};charset=utf8mb4";

    return new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
}
