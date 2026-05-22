# Mini Projet Docker — Site vitrine multi-services

Projet complet de déploiement de serveurs web via conteneurs Docker.

## Objectif

Créer un site vitrine multi-services avec une page de contact. Les messages envoyés par les visiteurs sont traités par PHP et enregistrés dans une base de données MySQL.

## Technologies utilisées

- Docker
- Docker Compose
- Nginx
- PHP-FPM
- MySQL
- Adminer pour consulter la base de données facilement

## Architecture

```text
Navigateur
   |
   | http://localhost:3000
   v
Nginx container
   |
   | FastCGI :9000
   v
PHP-FPM container
   |
   | PDO MySQL
   v
MySQL container
```

## Structure du projet

```text
mini-projet-docker-complet/
├── app/
│   ├── public/
│   │   ├── index.php
│   │   ├── submit_contact.php
│   │   ├── admin.php
│   │   └── assets/
│   │       ├── css/style.css
│   │       └── js/script.js
│   └── src/
│       └── db.php
├── mysql/
│   └── init.sql
├── nginx/
│   ├── Dockerfile
│   └── default.conf
├── php/
│   └── Dockerfile
├── docker-compose.yml
├── .env
└── README.md
```

## Lancer le projet

Depuis la racine du projet :

```bash
docker compose up -d --build
```

Puis ouvrir :

```text
http://localhost:3000
```

## Voir les messages enregistrés

Interface admin simple :

```text
http://localhost:3000/admin.php?token=admin123
```

## Consulter la base via Adminer

Ouvrir :

```text
http://localhost:8080
```

Informations de connexion :

```text
Système      : MySQL
Serveur      : mysql
Utilisateur  : webops_user
Mot de passe : webops_pass
Base         : webops_db
```

## Vérifier les conteneurs

```bash
docker compose ps
```

## Voir les logs

```bash
docker compose logs -f nginx

docker compose logs -f php

docker compose logs -f mysql
```

## Vérifier la table MySQL depuis le terminal

```bash
docker compose exec mysql mysql -u webops_user -p webops_db -e "SELECT * FROM contacts;"
```

Mot de passe :

```text
webops_pass
```

## Réinitialiser complètement la base

Attention : cette commande supprime les données enregistrées.

```bash
docker compose down -v

docker compose up -d --build
```

## Rôle de chaque conteneur

### Nginx

Il sert les fichiers du site et transmet les fichiers PHP au conteneur PHP-FPM.

### PHP-FPM

Il exécute le code PHP. Dans ce projet, il valide les données du formulaire et écrit dans MySQL avec PDO.

### MySQL

Il stocke les messages envoyés depuis le formulaire de contact dans la table `contacts`.

### Adminer

Il permet de consulter la base de données depuis le navigateur.
