const menuButton = document.getElementById('menuButton');
const navLinks = document.getElementById('navLinks');
const contactForm = document.getElementById('contactForm');
const formStatus = document.getElementById('formStatus');

if (menuButton && navLinks) {
    menuButton.addEventListener('click', () => {
        navLinks.classList.toggle('open');
    });
}

if (contactForm && formStatus) {
    contactForm.addEventListener('submit', async (event) => {
        event.preventDefault();

        formStatus.textContent = 'Envoi en cours...';
        formStatus.className = 'form-status';

        try {
            const response = await fetch(contactForm.action, {
                method: 'POST',
                body: new FormData(contactForm),
            });

            const data = await response.json();

            if (!response.ok || !data.success) {
                throw new Error(data.message || 'Une erreur est survenue.');
            }

            formStatus.textContent = data.message;
            formStatus.classList.add('success');
            contactForm.reset();
        } catch (error) {
            formStatus.textContent = error.message;
            formStatus.classList.add('error');
        }
    });
}
