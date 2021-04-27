const app = {
    
    init: function() {
        let hbgButton = document.querySelector('.hbg-menu');
        let sousMenu = document.querySelector('.sousmenu');
        let entryButton = document.querySelector('.div-scroll');
        
        hbgButton.addEventListener('click', app.handleHamburgerMenu);
        sousMenu.addEventListener('click', app.handleSousmenu);
        entryButton.addEventListener('click', app.handleEntryButton);
    },
    handleHamburgerMenu: function(){
        let hbgButton = document.querySelector('.hbg-menu');
        
        let nav = document.querySelector('nav');
        nav.classList.toggle('open');
        hbgButton.classList.toggle('open');
     
    },
    moveArrow: function() {
        //je récupère les span de mes flèches
        let up = document.querySelector('.up');
        
        let down = document.querySelector('.down');
        
        up.classList.toggle('hidden');
        down.classList.toggle('hidden');
        let sousMenuUl = document.querySelector('.sousmenu-ul');
        sousMenuUl.addEventListener('mouseleave',(() => {
            up.classList.add('hidden');
            down.classList.remove('hidden');
        }))
    },
    handleSousmenu: function () {
        let sousMenu = document.querySelector('.sousmenu');
        let sousMenuUl = document.querySelector('.sousmenu-ul');
        app.moveArrow();
        sousMenu.classList.toggle('click');
        sousMenuUl.classList.toggle('click');
      
        sousMenuUl.addEventListener('mouseleave',(() => {
            sousMenuUl.classList.remove('click');

        }))
    },
    handleEntryButton:function () {
        let home = document.querySelector('.div-home');
        let hbgButton = document.querySelector('.hbg-menu');
        let accueil = document.querySelector('.accueil');
        accueil.classList.add('accueil-remove');
        hbgButton.classList.remove('display-none');
        // hbgButton.classList.add('')
        
        home.classList.remove('display-none');
        let presentation = document.querySelector('.presentation');
        console.log(presentation);
        
    }
}

app.init();