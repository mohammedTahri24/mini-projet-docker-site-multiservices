CREATE DATABASE IF NOT EXISTS webops_db
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE webops_db;

CREATE TABLE IF NOT EXISTS contacts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(120) NOT NULL,
  email VARCHAR(160) NOT NULL,
  service VARCHAR(100) NOT NULL,
  message TEXT NOT NULL,
  ip_address VARCHAR(45) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO contacts (full_name, email, service, message, ip_address)
VALUES
('Client Démo', 'client.demo@example.com', 'Création site web', 'Bonjour, je souhaite avoir un devis pour un site vitrine.', '127.0.0.1');
