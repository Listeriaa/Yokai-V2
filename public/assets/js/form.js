const newYokaiForm= {
    init:function(){
        const addYokaiForm = document.querySelector('.yokai-add');
        document.querySelector('#name').focus();
        addYokaiForm.addEventListener('submit', newYokaiForm.handleSubmitAddYokai);
    },
    handleSubmitAddYokai:function(evt){
        
        const newForm = evt.currentTarget;
        let error = document.querySelector('.alert-JS');
        console.log(error);
        
        
        //je dois vérifier que tous les champs sont remplis sauf origine qui peut être nul
        let nameInput = newForm.querySelector('#name').value;
        let kanjiInput = newForm.querySelector('#kanji').value;
        let translationInput = newForm.querySelector('#translation').value;
        let pictureInput = newForm.querySelector('#picture').value;
        let habitatInput = newForm.querySelector('#habitat').value;
        let appearanceInput = newForm.querySelector('#appearance').value;
        let behaviorInput = newForm.querySelector('#behavior').value;
        
        if(
            newYokaiForm.checkValueForm(nameInput) &&
            newYokaiForm.checkValueForm(kanjiInput) &&
            newYokaiForm.checkValueForm(translationInput) &&
            newYokaiForm.checkValueForm(pictureInput) &&
            newYokaiForm.checkValueForm(habitatInput) &&
            newYokaiForm.checkValueForm(appearanceInput) &&
            newYokaiForm.checkValueForm(behaviorInput)){
                

            } else {
                evt.preventDefault();
                
                error.classList.remove('d-none');
                
                window.scrollTo(0, 0);

                newForm.querySelector('#name').focus();
            }
        console.log(nameInput);
        //je dois vérifier que le format de l'image est bien image/....jpg

        //
    },
    checkValueForm: function (value){
        if(value!==''){
            return true;
        }else {
          return false;
        }
    },
}

newYokaiForm.init();