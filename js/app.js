const app = {
    
    init: function() {
        let hbgButton = document.querySelector(".hbg-menu");
        let isOpen = false;
        hbgButton.addEventListener("click", app.handleHamburgerMenu);
    },
    handleHamburgerMenu: function(){
        let hbgButton = document.querySelector(".hbg-menu");
        let h1 = document.querySelector('h1');
        let nav = document.querySelector('nav');
        nav.classList.toggle('open');
        hbgButton.classList.toggle('open');
        h1.classList.toggle('open');
    }
}

app.init();