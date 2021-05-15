const app = {
    home: document.querySelector('.div-home'),

    hbgButton: document.querySelector('.hbg-menu'),

    nav: document.querySelector('nav'),
    accueil: document.querySelector('.accueil'),
    presentation: document.querySelector('.presentation'),
    footer: document.querySelector('footer'),

    init: function () {

        //let sousMenu = document.querySelector('.sousmenu');
        let entryButton = document.querySelector('.div-scroll');
        let title = document.title;
        app.hbgButton.addEventListener('click', app.handleHamburgerMenu);
        //sousMenu.addEventListener('click', app.handleSousmenu);
        let session = sessionStorage.getItem('alreadyload');
        width = screen.width;
        
        console.log(title);

        if (title == "Yōkai on the watch" && session == null) {

            entryButton.addEventListener('click', app.handleEntryButton);
        } else {
            document.addEventListener('DOMContentLoaded', app.alreadyLoaded(width));
        }
    },
    handleHamburgerMenu: function () {

        app.nav.classList.toggle('open');
        app.hbgButton.classList.toggle('open');

    },
    // moveArrow: function () {
    //     //je récupère les span de mes flèches
    //     let up = document.querySelector('.up');

    //     let down = document.querySelector('.down');

    //     up.classList.toggle('hidden');
    //     down.classList.toggle('hidden');
    //     let sousMenuUl = document.querySelector('.sousmenu-ul');
    //     sousMenuUl.addEventListener('mouseleave', (() => {
    //         up.classList.add('hidden');
    //         down.classList.remove('hidden');
    //     }))
    // },
    // handleSousmenu: function () {
    //     let sousMenu = document.querySelector('.sousmenu');
    //     let sousMenuUl = document.querySelector('.sousmenu-ul');
    //     app.moveArrow();
    //     sousMenu.classList.toggle('click');
    //     sousMenuUl.classList.toggle('click');

    //     sousMenuUl.addEventListener('mouseleave', (() => {
    //         sousMenuUl.classList.remove('click');

    //     }))
    // },
    handleEntryButton: function () {
        console.log("test");
        let presentation = document.querySelector('.presentation');
        let footer = document.querySelector('footer');
        app.accueil.classList.add('accueil-remove');

        setTimeout(app.showNavElements, 250);

        setTimeout(() => {
            presentation.classList.remove('display-none')
        }, 750);
        setTimeout(() => {
            footer.classList.remove('display-none')
        }, 750);
        sessionStorage.setItem('alreadyload', 'true');

    },
    showNavElements: function () {

        app.hbgButton.classList.remove('display-none');
        app.home.classList.remove('display-none');
        app.nav.classList.remove('display-none')
    },

    alreadyLoaded: function (width) {
        title = document.title;
        

        if (title == "Yōkai on the watch") {
            app.accueil.classList.add('notransition');
            app.presentation.classList.add('notransition');
            app.accueil.classList.add('accueil-remove');
            app.presentation.classList.remove('display-none');
        };
        if (width > 700) {
            app.hbgButton.classList.add('notransition');
            app.home.classList.add('notransition');
            app.nav.classList.add('notransition');
        }
        app.footer.classList.add('notransition');
        app.hbgButton.classList.remove('display-none');
        app.home.classList.remove('display-none');
        app.nav.classList.remove('display-none');
        app.footer.classList.remove('display-none');
    }


}

document.addEventListener('DOMContentLoaded', app.init);