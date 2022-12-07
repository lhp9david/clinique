// Choix et affichage des Tabs

const tabs = document.querySelectorAll('.nav-link')

window.addEventListener('click', event => {

    if (event.target.classList.contains('nav-link') || event.target.classList.contains('logo')) {
        if (event.target.classList.contains('nav-link')) { 
            event.target.classList.add('active');
            event.target.removeAttribute('href');
            tabs.forEach(element => {
                if (element != event.target) {
                    element.classList.remove('active');
                    element.setAttribute('href', '#')
                }
        });
        }
    }
    if (event.target.classList.contains('pokeballs')) {
        pokeballs ();
    }
    if (event.target.classList.contains('battleItems')) {
        battleItems ();
    }
    if (event.target.classList.contains('medicines')) {
        medicine ();
    }
    if (event.target.classList.contains('TMs')) {
        TMs ();
    }
    if (event.target.classList.contains('logo')) {
        News ();
    }
});

// Fonctions pour afficher les elements du container

function pokeballs () {
    document.querySelector('.container').innerHTML = "";

    let itemContainer = document.createElement('div');
    itemContainer.className = "thomas";
    itemContainer = document.querySelector('.container').appendChild(itemContainer);

    fetch('assets/json/store.json')
        .then(response => response.json())
        .then((data) => {
            let db = data;

            db.items.forEach(element => {

                let id = element.id;
                let name = element.name;
                let category = element.category;
                let image = element.image;
                let overview = element.overview;
                let price = element.price;

                let anchor = document.createElement('div');
                anchor.innerHTML = '<div class="card-body" id='+id+'>';
                
                if (category == 'Pokeballs') {
                    
                    anchor.className = 'card card'+id+' cardthomas text-center';
                    anchor = document.querySelector('.thomas').appendChild(anchor);

                    let cardId = document.getElementById(id);
                    
                    let cardImg = document.createElement('img');
                    cardImg.src = 'assets/img/'+image+'';
                    cardImg.alt = name;
                    cardImg.className = "cardImg"
                    cardImg = cardId.appendChild(cardImg);

                    let cardName = document.createElement('p');
                    cardName.textContent = name;
                    cardName.className = "card-title";
                    cardName = cardId.appendChild(cardName);

                    let cardOverview = document.createElement('p');
                    cardOverview.textContent = overview;
                    cardOverview.className = "card-text"
                    cardOverview = cardId.appendChild(cardOverview);

                    let cardInput = document.createElement('input');
                    cardInput.placeholder = 'Quantity';
                    cardInput.minLength = 1;
                    cardInput.maxLength = 2;
                    cardInput = cardId.appendChild(cardInput);

                    let cardAdd = document.createElement('button');
                    cardAdd.className = 'btn btn-primary add';
                    cardAdd.type = 'button';
                    cardAdd.textContent = "Add";
                    cardAdd = cardId.appendChild(cardAdd);

                    let cardPrice = document.createElement('div');
                    cardPrice.textContent = price+'¥';
                    cardPrice.className = "card-footer"
                    cardPrice = document.querySelector('.card'+id+'').appendChild(cardPrice);
                }
            });
        });
};


function battleItems () {
    document.querySelector('.container').innerHTML = "";

    let itemContainer = document.createElement('div');
    itemContainer.className = "thomas";
    itemContainer = document.querySelector('.container').appendChild(itemContainer);

    fetch('assets/json/store.json')
        .then(response => response.json())
        .then((data) => {
            let db = data;

            db.items.forEach(element => {

                let id = element.id;
                let name = element.name;
                let category = element.category;
                let image = element.image;
                let overview = element.overview;
                let price = element.price;

                

                let anchor = document.createElement('div');
                anchor.innerHTML = '<div class="card-body" id='+id+'>';
                
                    if (category == 'Battle items') {

                    anchor.className = 'card card'+id+' cardthomas text-center';
                    anchor = document.querySelector('.thomas').appendChild(anchor);

                    let cardId = document.getElementById(id);
                    
                    let cardImg = document.createElement('img');
                    cardImg.src = 'assets/img/'+image+'';
                    cardImg.alt = name;
                    cardImg.className = "cardImg"
                    cardImg = cardId.appendChild(cardImg);

                    let cardName = document.createElement('p');
                    cardName.textContent = name;
                    cardName.className = "card-title";
                    cardName = cardId.appendChild(cardName);

                    let cardOverview = document.createElement('p');
                    cardOverview.textContent = overview;
                    cardOverview.className = "card-text"
                    cardOverview = cardId.appendChild(cardOverview);

                    let cardInput = document.createElement('input');
                    cardInput.placeholder = 'Quantity';
                    cardInput.minLength = 1;
                    cardInput.maxLength = 2;
                    cardInput = cardId.appendChild(cardInput);

                    let cardAdd = document.createElement('button');
                    cardAdd.className = 'btn btn-primary add';
                    cardAdd.type = 'button';
                    cardAdd.textContent = "Add";
                    cardAdd = cardId.appendChild(cardAdd);

                    let cardPrice = document.createElement('div');
                    cardPrice.textContent = price+'¥';
                    cardPrice.className = "card-footer"
                    cardPrice = document.querySelector('.card'+id+'').appendChild(cardPrice);
                    }
                });
            });
    };

function medicine () {
    document.querySelector('.container').innerHTML = "";

    let itemContainer = document.createElement('div');
    itemContainer.className = "thomas";
    itemContainer = document.querySelector('.container').appendChild(itemContainer);

    fetch('assets/json/store.json')
        .then(response => response.json())
        .then((data) => {
            let db = data;

            db.items.forEach(element => {

                let id = element.id;
                let name = element.name;
                let category = element.category;
                let image = element.image;
                let overview = element.overview;
                let price = element.price;

                let anchor = document.createElement('div');
                anchor.innerHTML = '<div class="card-body" id='+id+'>';

                    if (category == 'Medicine') {

                        anchor.className = 'card card'+id+' cardthomas text-center';
                        anchor = document.querySelector('.thomas').appendChild(anchor);
    
                        let cardId = document.getElementById(id);
                        
                        let cardImg = document.createElement('img');
                        cardImg.src = 'assets/img/'+image+'';
                        cardImg.alt = name;
                        cardImg.className = "cardImg"
                        cardImg = cardId.appendChild(cardImg);
    
                        let cardName = document.createElement('p');
                        cardName.textContent = name;
                        cardName.className = "card-title";
                        cardName = cardId.appendChild(cardName);
    
                        let cardOverview = document.createElement('p');
                        cardOverview.textContent = overview;
                        cardOverview.className = "card-text"
                        cardOverview = cardId.appendChild(cardOverview);
    
                        let cardInput = document.createElement('input');
                        cardInput.placeholder = 'Quantity';
                        cardInput.minLength = 1;
                        cardInput.maxLength = 2;
                        cardInput = cardId.appendChild(cardInput);
    
                        let cardAdd = document.createElement('button');
                        cardAdd.className = 'btn btn-primary add';
                        cardAdd.type = 'button';
                        cardAdd.textContent = "Add";
                        cardAdd = cardId.appendChild(cardAdd);
    
                        let cardPrice = document.createElement('div');
                        cardPrice.textContent = price+'¥';
                        cardPrice.className = "card-footer"
                        cardPrice = document.querySelector('.card'+id+'').appendChild(cardPrice);
                    }
                });
            });
    };

function TMs () {
    document.querySelector('.container').innerHTML = "";

    let itemContainer = document.createElement('div');
    itemContainer.className = "thomas";
    itemContainer = document.querySelector('.container').appendChild(itemContainer);

    fetch('assets/json/store.json')
        .then(response => response.json())
        .then((data) => {
            let db = data;

            db.items.forEach(element => {

                let id = element.id;
                let name = element.name;
                let category = element.category;
                let image = element.image;
                let overview = element.overview;
                let price = element.price;

                let anchor = document.createElement('div');
                anchor.innerHTML = '<div class="card-body" id='+id+'>';

                if (category == 'TMs') {

                    anchor.className = 'card card'+id+' cardthomas text-center';
                    anchor = document.querySelector('.thomas').appendChild(anchor);

                    let cardId = document.getElementById(id);
                    
                    let cardImg = document.createElement('img');
                    cardImg.src = 'assets/img/'+image+'';
                    cardImg.alt = name;
                    cardImg.className = "cardImg"
                    cardImg = cardId.appendChild(cardImg);

                    let cardName = document.createElement('p');
                    cardName.textContent = name;
                    cardName.className = "card-title";
                    cardName = cardId.appendChild(cardName);

                    let cardOverview = document.createElement('p');
                    cardOverview.textContent = overview;
                    cardOverview.className = "card-text"
                    cardOverview = cardId.appendChild(cardOverview);

                    let cardInput = document.createElement('input');
                    cardInput.placeholder = 'Quantity';
                    cardInput.minLength = 1;
                    cardInput.maxLength = 2;
                    cardInput = cardId.appendChild(cardInput);

                    let cardAdd = document.createElement('button');
                    cardAdd.className = 'btn btn-primary add';
                    cardAdd.type = 'button';
                    cardAdd.textContent = "Add";
                    cardAdd = cardId.appendChild(cardAdd);

                    let cardPrice = document.createElement('div');
                    cardPrice.textContent = price+'¥';
                    cardPrice.className = "card-footer"
                    cardPrice = document.querySelector('.card'+id+'').appendChild(cardPrice);
                }
                });
            });
    };

function News () {
    document.querySelector('.container').innerHTML = "";
}

// Object 





// UX

let regex = /^[1-9]{1}[0-9]{0,1}$/;

window.addEventListener('keydown', element => {
    if ((element.key === 'Enter')) {
        if (regex.test(element.target.value)) {
            quantity = element.target.value;
            console.log(quantity);
            let id = element.target.parentNode.id;
            console.log(id); 
        } 
        else {
            console.log("Veuillez saisir un élément valide");
            // message.textContent = "Veuillez saisir un élément valide";
        };
    };
});

window.addEventListener('click', element => {
    console.log(element.target.classList.contains('add'))
    if ((element.target.classList.contains('add'))) {
        if (regex.test(element.target.previousSibling.value)) {
            quantity = element.target.previousSibling.value;
            console.log(quantity);
            let id = element.target.parentNode.id;
            console.log(id); 
        } 
        else {
            console.log("Veuillez saisir un élément valide");
            // message.textContent = "Veuillez saisir un élément valide";
        };
    };
});


// Modal

function cart () {
fetch('assets/json/store.json')
        .then(response => response.json())
        .then((data) => {
            let db = data;

            let id = element.id;
            let name = element.name;
            let category = element.category;
            let image = element.image;
            let overview = element.overview;
            let price = element.price;



        
        });
    };
