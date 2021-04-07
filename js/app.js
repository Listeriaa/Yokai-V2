const app = {
    
    init: function() {
        let hbgButton = document.querySelector(".hbg-menu");
        let sousMenu = document.querySelector('.sousmenu .hover_nav');
        let isOpen = false;
        hbgButton.addEventListener("click", app.handleHamburgerMenu);
        sousMenu.addEventListener('hover', app.moveArrow);
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
    },
    moveArrow: function() {
        //je récupère les span de mes flèches
        let up = document.querySelector('.up');
        console.log(up);
        let down = document.querySelector('.down');
        console.log(down);
        up.classList.toggle('hidden');
        down.classList.toggle('hidden');
    }
}

app.init();