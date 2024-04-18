document.addEventListener("DOMContentLoaded", function () {
    const showModalButtons = document.querySelectorAll("[data-show-modal]");
    const closeModalButtons = document.querySelectorAll("[data-close-modal]");
    const modales = document.querySelectorAll(".modale");

    const showModalButtonsAlive = document.querySelectorAll("[data-show-modal-alive]");
    const closeModalButtonsAlive = document.querySelectorAll("[data-close-modal-alive]");
    const modalesAlive = document.querySelectorAll(".modale_alive");

    showModalButtons.forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault();
            document.querySelector('.overlay_modale_produits').classList.add('active');
            const modalId = this.getAttribute("data-show-modal");
            const modal = document.querySelector(`[data-modal-id="${modalId}"]`);
            modal.classList.toggle('visible');
        });
    });

    showModalButtonsAlive.forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault();
            const modalId = this.getAttribute("data-show-modal-alive");
            const modal = document.querySelector(`[data-modal-id-alive="${modalId}"]`);
            document.querySelector('.overlay_modale_produits').classList.add('active');
            modal.classList.toggle('visible');
        });
    });

    closeModalButtons.forEach(button => {
        button.addEventListener("click", function () {
            const modalId = this.getAttribute("data-close-modal");
            const modal = document.querySelector(`[data-modal-id="${modalId}"]`);
            document.querySelector('.overlay_modale_produits').classList.remove('active');
            modal.classList.remove('visible');
        });
    });

    closeModalButtonsAlive.forEach(button => {
        button.addEventListener("click", function () {
            const modalId = this.getAttribute("data-close-modal-alive");
            const modal = document.querySelector(`[data-modal-id-alive="${modalId}"]`);
            document.querySelector('.overlay_modale_produits').classList.remove('active');
            modal.classList.remove('visible');
        });
    });

    function closeFromEverywhere() {
        const overlay = document.querySelector('.overlay_modale_produits');
        if (overlay) {
            overlay.classList.remove('active');
        }
        modales.forEach(modale => {
            modale.classList.remove('visible');
        });
        modalesAlive.forEach(modale => {
            modale.classList.remove('visible');
        });
    }

    document.addEventListener('click', (e) => {
        const isInsideModalButton = Array.from(showModalButtons).some(button => button.contains(e.target));
        const isInsideModalContent = Array.from(modales).some(modale => modale.contains(e.target));

        const isInsideModalButtonAlive = Array.from(showModalButtonsAlive).some(button => button.contains(e.target));
        const isInsideModalContentAlive = Array.from(modalesAlive).some(modale => modale.contains(e.target));

        if (!isInsideModalButton && !isInsideModalContent && !isInsideModalButtonAlive && !isInsideModalContentAlive) {
            closeFromEverywhere();
        }
    });


    const menuBugerButton = document.querySelector('.menu_burger');
    const navBar = document.querySelector('.nav_bar')
    const menu_burger_close = document.querySelector('.menu_burger_close')

    menuBugerButton.addEventListener('click', (e) => {
        navBar.classList.add('visible')
        menuBugerButton.classList.add('disabled')
        menu_burger_close.classList.add('visible')
    })

    menu_burger_close.addEventListener('click', (e) => {
        navBar.classList.remove('visible')
        menuBugerButton.classList.remove('disabled')
        menu_burger_close.classList.remove('visible')
    })





    const filtreForm = document.querySelector('#filtre_form')

    if (filtreForm) {
        filtreForm.addEventListener('submit', (e) => {
            e.preventDefault();

            const categorie = filtreForm.querySelector('select[name="categorie"]').value;



            const produitsSections = document.querySelectorAll('.filtre');

            produitsSections.forEach(section => {
                const h2Element = section.querySelector('h2');
                const splittedText = h2Element.textContent.split('|');
                const trimedText = splittedText[1].trim();

                if (categorie === 'tous') {
                    // Si la catégorie sélectionnée est "tous", afficher toutes les sections
                    section.classList.remove('non_visible');
                    section.classList.add('visible');
                } else if (trimedText !== categorie) {
                    // Si la catégorie sélectionnée est différente de la partie de texte après "|", masquer la section
                    section.classList.remove('visible');
                    section.classList.add('non_visible');
                } else {
                    // Si la catégorie sélectionnée correspond à la partie de texte après "|", afficher la section
                    section.classList.remove('non_visible');
                    section.classList.add('visible');
                }
            });
        })
    }


});
