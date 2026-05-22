<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebOps Services | Site vitrine Dockerisé</title>
    <meta name="description" content="Site vitrine multi-services déployé avec Docker, Nginx, PHP-FPM et MySQL.">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <header class="navbar">
        <div class="container nav-content">
            <a href="#accueil" class="logo">WebOps<span>Services</span></a>
            <nav class="nav-links" id="navLinks">
                <a href="#services">Services</a>
                <a href="#architecture">Architecture</a>
                <a href="#contact">Contact</a>
                <a href="/admin.php?token=admin123" class="nav-button">Messages</a>
            </nav>
            <button class="menu-button" id="menuButton" aria-label="Ouvrir le menu">☰</button>
        </div>
    </header>

    <main>
        <section class="hero" id="accueil">
            <div class="container hero-grid">
                <div class="hero-text">
                    <p class="badge">Mini Projet Docker • Nginx • PHP-FPM • MySQL</p>
                    <h1>Site vitrine multi-services déployé avec des conteneurs Docker.</h1>
                    <p class="hero-description">
                        Une architecture professionnelle composée de trois services principaux : un serveur web Nginx,
                        un moteur PHP-FPM pour traiter le formulaire et une base MySQL pour stocker les demandes clients.
                    </p>
                    <div class="hero-actions">
                        <a href="#contact" class="btn btn-primary">Envoyer une demande</a>
                        <a href="#architecture" class="btn btn-secondary">Voir l’architecture</a>
                    </div>
                </div>
                <div class="hero-card">
                    <div class="terminal-header">
                        <span></span><span></span><span></span>
                    </div>
                    <pre><code>$ docker compose up -d --build
[+] Running 4/4
✔ webops-nginx    Started
✔ webops-php      Started
✔ webops-mysql    Healthy
✔ webops-adminer  Started</code></pre>
                </div>
            </div>
        </section>

        <section class="services section" id="services">
            <div class="container">
                <div class="section-heading">
                    <p class="section-label">Nos services</p>
                    <h2>Une vitrine simple, moderne et connectée à une base de données.</h2>
                </div>
                <div class="cards-grid">
                    <article class="service-card">
                        <div class="icon">🌐</div>
                        <h3>Création site web</h3>
                        <p>Conception de sites vitrines rapides, responsives et adaptés aux besoins des petites entreprises.</p>
                    </article>
                    <article class="service-card">
                        <div class="icon">🛠️</div>
                        <h3>Maintenance informatique</h3>
                        <p>Assistance, correction d’erreurs, optimisation et suivi technique pour vos solutions web.</p>
                    </article>
                    <article class="service-card">
                        <div class="icon">🔐</div>
                        <h3>Cybersécurité</h3>
                        <p>Bonnes pratiques de sécurité, durcissement de configuration et sensibilisation aux risques.</p>
                    </article>
                    <article class="service-card">
                        <div class="icon">☁️</div>
                        <h3>Cloud & DevOps</h3>
                        <p>Déploiement avec Docker, isolation des services et automatisation des environnements.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="architecture section" id="architecture">
            <div class="container architecture-grid">
                <div>
                    <p class="section-label">Architecture Docker</p>
                    <h2>Chaque service est isolé dans son propre conteneur.</h2>
                    <p>
                        Docker Compose orchestre l’ensemble du projet. Nginx reçoit les requêtes HTTP,
                        transmet les scripts PHP au conteneur PHP-FPM, puis PHP enregistre les données dans MySQL.
                    </p>
                </div>
                <div class="flow">
                    <div class="flow-item">Navigateur<br><small>localhost:3000</small></div>
                    <div class="flow-arrow">→</div>
                    <div class="flow-item">Nginx<br><small>serveur web</small></div>
                    <div class="flow-arrow">→</div>
                    <div class="flow-item">PHP-FPM<br><small>traitement formulaire</small></div>
                    <div class="flow-arrow">→</div>
                    <div class="flow-item">MySQL<br><small>table contacts</small></div>
                </div>
            </div>
        </section>

        <section class="contact section" id="contact">
            <div class="container contact-grid">
                <div>
                    <p class="section-label">Contact</p>
                    <h2>Envoyer une demande de service.</h2>
                    <p>
                        Les informations envoyées depuis ce formulaire sont validées par PHP,
                        puis enregistrées dans la table <strong>contacts</strong> de la base MySQL.
                    </p>
                    <ul class="check-list">
                        <li>Validation côté serveur</li>
                        <li>Insertion sécurisée avec requêtes préparées PDO</li>
                        <li>Stockage persistant grâce au volume Docker MySQL</li>
                    </ul>
                </div>

                <form class="contact-form" id="contactForm" method="POST" action="/submit_contact.php">
                    <div class="form-row">
                        <label for="full_name">Nom complet</label>
                        <input type="text" id="full_name" name="full_name" placeholder="Ex : Mohammed TAHRI" required>
                    </div>

                    <div class="form-row">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="exemple@email.com" required>
                    </div>

                    <div class="form-row">
                        <label for="service">Service demandé</label>
                        <select id="service" name="service" required>
                            <option value="">Sélectionner un service</option>
                            <option>Création site web</option>
                            <option>Maintenance informatique</option>
                            <option>Cybersécurité</option>
                            <option>Cloud & DevOps</option>
                            <option>Autre besoin</option>
                        </select>
                    </div>

                    <div class="form-row">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="5" placeholder="Décrivez votre besoin..." required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary full-width">Envoyer le message</button>
                    <p class="form-status" id="formStatus" aria-live="polite"></p>
                </form>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container footer-content">
            <p>© 2026 WebOps Services — Mini projet Docker.</p>
            <p>Nginx + PHP-FPM + MySQL + Docker Compose</p>
        </div>
    </footer>

    <script src="/assets/js/script.js"></script>
</body>
</html>
