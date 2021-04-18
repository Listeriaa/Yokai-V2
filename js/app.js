const app = {
    
    init: function() {
        let hbgButton = document.querySelector(".hbg-menu");
        let sousMenu = document.querySelector('.sousmenu');
        let isOpen = false;
        hbgButton.addEventListener("click", app.handleHamburgerMenu);
        
        sousMenu.addEventListener('click', app.handleSousmenu);
        
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
    }
}

app.init();