const app = {
    
    init: function() {
        let hbgButton = document.querySelector(".hbg-menu");
        let isOpen = false;
        hbgButton.addEventListener("click", app.handleHamburgerMenu);
    },
    handleHamburgerMenu: function(){
        let hbgButton = document.querySelector(".hbg-menu");
        
        let nav = document.querySelector('nav');
        nav.classList.toggle('open');
        hbgButton.classList.toggle('open');
       
        // window.addEventListener('click', (()=> {
        //     nav.classList.remove('open');
        // hbgButton.classList.remove('open');
        
        // }))
    }
}

app.init();