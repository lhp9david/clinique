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
        pokeballs();
    }
    if (event.target.classList.contains('battleItems')) {
        battleItems();
    }
    if (event.target.classList.contains('medicines')) {
        medicine();
    }
    if (event.target.classList.contains('TMs')) {
        TMs();
    }
    if (event.target.classList.contains('logo')) {
        News();
    }
});

// Fonctions pour afficher les elements du container

// Catégorie Pokeballs

function pokeballs() {
    document.querySelector('.container').innerHTML = `<div class="banner">
    <div class="slider-container bg-primary">
      <span><img class="xmaspikachu" src="assets/img/pokeball.png" alt=""></span>
      <span class="h5"> POKEBALLS CATEGORY </span>
      <span><img class="xmaspikachu" src="assets/img/greatball.png" alt=""></span>
      <span class="h5"> POKEBALLS CATEGORY </span>
      <span><img class="xmaspikachu" src="assets/img/ultraball.png" alt=""></span>
      <span class="h5"> POKEBALLS CATEGORY </span>
      <span><img class="xmaspikachu" src="assets/img/healball.png" alt=""></span>
      <span class="h5"> POKEBALLS CATEGORY </span>
      <span><img class="xmaspikachu" src="assets/img/diveball.png" alt=""></span>        
      
      <span class="h5"> POKEBALLS CATEGORY </span>
      <span><img class="xmaspikachu" src="assets/img/duskball.png" alt=""></span>
      <span class="h5"> POKEBALLS CATEGORY </span>
      <span><img class="xmaspikachu" src="assets/img/netball.png" alt=""></span>        
      
      <span class="h5"> POKEBALLS CATEGORY </span>
      <span><img class="xmaspikachu" src="assets/img/luxuryball.png" alt=""></span>
      <span class="h5"> POKEBALLS CATEGORY </span>
      <span><img class="xmaspikachu" src="assets/img/pokeball.png" alt=""></span>
      <span class="h5"> POKEBALLS CATEGORY </span>
      <span><img class="xmaspikachu" src="assets/img/greatball.png" alt=""></span>
      <span class="h5"> POKEBALLS CATEGORY </span>
      <span><img class="xmaspikachu" src="assets/img/ultraball.png" alt=""></span>
      <span class="h5"> POKEBALLS CATEGORY </span>
      <span><img class="xmaspikachu" src="assets/img/healball.png" alt=""></span>
      <span class="h5"> POKEBALLS CATEGORY </span>
      <span><img class="xmaspikachu" src="assets/img/diveball.png" alt=""></span>        
      
      <span class="h5"> POKEBALLS CATEGORY </span>
      <span><img class="xmaspikachu" src="assets/img/duskball.png" alt=""></span>
      <span class="h5"> POKEBALLS CATEGORY </span>
      <span><img class="xmaspikachu" src="assets/img/netball.png" alt=""></span>        
      
      <span class="h5"> POKEBALLS CATEGORY </span>
      <span><img class="xmaspikachu" src="assets/img/luxuryball.png" alt=""></span>
      <span class="h5"> POKEBALLS CATEGORY </span>
    </div>
  </div>`;

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
                anchor.innerHTML = '<div class="card-body" id=' + id + '>';

                if (category == 'Pokeballs') {

                    anchor.className = 'card card' + id + ' cardthomas text-center';
                    anchor = document.querySelector('.thomas').appendChild(anchor);

                    let cardId = document.getElementById(id);

                    let cardImg = document.createElement('img');
                    cardImg.src = 'assets/img/' + image + '';
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
                    cardAdd.dataset.name = name;
                    cardAdd.dataset.image = image;
                    cardAdd.dataset.price = price;
                    cardAdd.className = 'btn btn-primary add';
                    cardAdd.type = 'button';
                    cardAdd.textContent = "Add";
                    cardAdd = cardId.appendChild(cardAdd);

                    let cardPrice = document.createElement('div');
                    cardPrice.textContent = price + '¥';
                    cardPrice.className = "card-footer"
                    cardPrice = document.querySelector('.card' + id + '').appendChild(cardPrice);
                }
            });
        });
};

// Catégorie Battle Items

function battleItems() {
    document.querySelector('.container').innerHTML = `<div class="banner">
    <div class="slider-container bg-secondary">
      <span><img class="xmaspikachu" src="assets/img/direhit.png" alt=""></span>
      <span class="h5"> BATTLE ITEMS CATEGORY </span>
      <span><img class="xmaspikachu" src="assets/img/guardspec.png" alt=""></span>
      <span class="h5"> BATTLE ITEMS CATEGORY </span>
      <span><img class="xmaspikachu" src="assets/img/xaccuracy.png" alt=""></span>
      <span class="h5"> BATTLE ITEMS CATEGORY </span>
      <span><img class="xmaspikachu" src="assets/img/xattack.png" alt=""></span>
      <span class="h5"> BATTLE ITEMS CATEGORY </span>
      <span><img class="xmaspikachu" src="assets/img/xdefense.png" alt=""></span>        
      
      <span class="h5"> BATTLE ITEMS CATEGORY </span>
      <span><img class="xmaspikachu" src="assets/img/xsp.atk.png" alt=""></span>
      <span class="h5"> BATTLE ITEMS CATEGORY </span>
      <span><img class="xmaspikachu" src="assets/img/xsp.def.png" alt=""></span>        
      
      <span class="h5"> BATTLE ITEMS CATEGORY </span>
      <span><img class="xmaspikachu" src="assets/img/xspeed.png" alt=""></span>
      <span class="h5"> BATTLE ITEMS CATEGORY </span>
      <span><img class="xmaspikachu" src="assets/img/direhit.png" alt=""></span>
      <span class="h5"> BATTLE ITEMS CATEGORY </span>
      <span><img class="xmaspikachu" src="assets/img/guardspec.png" alt=""></span>
      <span class="h5"> BATTLE ITEMS CATEGORY </span>
      <span><img class="xmaspikachu" src="assets/img/xaccuracy.png" alt=""></span>
      <span class="h5"> BATTLE ITEMS CATEGORY </span>
      <span><img class="xmaspikachu" src="assets/img/xattack.png" alt=""></span>
      <span class="h5"> BATTLE ITEMS CATEGORY </span>
      <span><img class="xmaspikachu" src="assets/img/xdefense.png" alt=""></span>        
      
      <span class="h5"> BATTLE ITEMS CATEGORY </span>
      <span><img class="xmaspikachu" src="assets/img/xsp.atk.png" alt=""></span>
      <span class="h5"> BATTLE ITEMS CATEGORY </span>
      <span><img class="xmaspikachu" src="assets/img/xsp.def.png" alt=""></span>        
      
      <span class="h5"> BATTLE ITEMS CATEGORY </span>
      <span><img class="xmaspikachu" src="assets/img/xspeed.png" alt=""></span>
      <span class="h5"> BATTLE ITEMS CATEGORY </span>
    </div>
  </div>`;

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
                anchor.innerHTML = '<div class="card-body" id=' + id + '>';

                if (category == 'Battle items') {

                    anchor.className = 'card card' + id + ' cardthomas text-center';
                    anchor = document.querySelector('.thomas').appendChild(anchor);

                    let cardId = document.getElementById(id);

                    let cardImg = document.createElement('img');
                    cardImg.src = 'assets/img/' + image + '';
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
                    cardAdd.dataset.name = name;
                    cardAdd.dataset.image = image;
                    cardAdd.dataset.price = price;
                    cardAdd.className = 'btn btn-primary add';
                    cardAdd.type = 'button';
                    cardAdd.textContent = "Add";
                    cardAdd = cardId.appendChild(cardAdd);

                    let cardPrice = document.createElement('div');
                    cardPrice.textContent = price + '¥';
                    cardPrice.className = "card-footer"
                    cardPrice = document.querySelector('.card' + id + '').appendChild(cardPrice);
                }
            });
        });
};

// Catégorie Medicine

function medicine() {
    document.querySelector('.container').innerHTML = `<div class="banner">
    <div class="slider-container bg-success">
    <span><img class="xmaspikachu" src="assets/img/antidote.png" alt=""></span>
    <span class="h5"> MEDICINE CATEGORY </span>
    <span><img class="xmaspikachu" src="assets/img/awakening.png" alt=""></span>
    <span class="h5"> MEDICINE CATEGORY </span>
    <span><img class="xmaspikachu" src="assets/img/bunrheal.png" alt=""></span>
    <span class="h5"> MEDICINE CATEGORY </span>
    <span><img class="xmaspikachu" src="assets/img/iceheal.png" alt=""></span>
    <span class="h5"> MEDICINE CATEGORY </span>
    <span><img class="xmaspikachu" src="assets/img/fullrestore.png" alt=""></span>        
    
    <span class="h5"> MEDICINE CATEGORY </span>
    <span><img class="xmaspikachu" src="assets/img/potion.png" alt=""></span>
    <span class="h5"> MEDICINE CATEGORY </span>
    <span><img class="xmaspikachu" src="assets/img/superpotion.png" alt=""></span>        
    
    <span class="h5"> MEDICINE CATEGORY </span>
    <span><img class="xmaspikachu" src="assets/img/hyperpotion.png" alt=""></span>
    <span class="h5"> MEDICINE CATEGORY </span>
    <span><img class="xmaspikachu" src="assets/img/maxpotion.png" alt=""></span>
    <span class="h5"> MEDICINE CATEGORY </span>
    <span><img class="xmaspikachu" src="assets/img/ether.png" alt=""></span>
    <span class="h5"> MEDICINE CATEGORY </span>
    <span><img class="xmaspikachu" src="assets/img/maxether.png" alt=""></span>
    <span class="h5"> MEDICINE CATEGORY </span>
    <span><img class="xmaspikachu" src="assets/img/elixir.png" alt=""></span>
    <span class="h5"> MEDICINE CATEGORY </span>
    <span><img class="xmaspikachu" src="assets/img/maxelixir.png" alt=""></span>        
    
    <span class="h5"> MEDICINE CATEGORY </span>
    <span><img class="xmaspikachu" src="assets/img/revive.png" alt=""></span>
    <span class="h5"> MEDICINE CATEGORY </span>
    <span><img class="xmaspikachu" src="assets/img/maxrevive.png" alt=""></span>        
    <span class="h5"> MEDICINE CATEGORY </span>
    </div>
  </div>`;

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
                anchor.innerHTML = '<div class="card-body" id=' + id + '>';

                if (category == 'Medicine') {

                    anchor.className = 'card card' + id + ' cardthomas text-center';
                    anchor = document.querySelector('.thomas').appendChild(anchor);

                    let cardId = document.getElementById(id);

                    let cardImg = document.createElement('img');
                    cardImg.src = 'assets/img/' + image + '';
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
                    cardAdd.dataset.name = name;
                    cardAdd.dataset.image = image;
                    cardAdd.dataset.price = price;
                    cardAdd.className = 'btn btn-primary add';
                    cardAdd.type = 'button';
                    cardAdd.textContent = "Add";
                    cardAdd = cardId.appendChild(cardAdd);

                    let cardPrice = document.createElement('div');
                    cardPrice.textContent = price + '¥';
                    cardPrice.className = "card-footer"
                    cardPrice = document.querySelector('.card' + id + '').appendChild(cardPrice);
                }
            });
        });
};

// Catégorie TMs

function TMs() {
    document.querySelector('.container').innerHTML = `<div class="banner">
    <div class="slider-container bg-info">
    <span><img class="xmaspikachu" src="assets/img/tmdragon.png" alt=""></span>
    <span class="h5"> TMS CATEGORY </span>
    <span><img class="xmaspikachu" src="assets/img/tmelectric.png" alt=""></span>
    <span class="h5"> TMS CATEGORY </span>
    <span><img class="xmaspikachu" src="assets/img/tmfairy.png" alt=""></span>
    <span class="h5"> TMS CATEGORY </span>
    <span><img class="xmaspikachu" src="assets/img/tmfire.png" alt=""></span>
    <span class="h5"> TMS CATEGORY </span>
    <span><img class="xmaspikachu" src="assets/img/tmflying.png" alt=""></span>        
    
    <span class="h5"> TMS CATEGORY </span>
    <span><img class="xmaspikachu" src="assets/img/tmgrass.png" alt=""></span>
    <span class="h5"> TMS CATEGORY </span>
    <span><img class="xmaspikachu" src="assets/img/tmice.png" alt=""></span>        
    
    <span class="h5"> TMS CATEGORY </span>
    <span><img class="xmaspikachu" src="assets/img/tmpoison.png" alt=""></span>
    <span class="h5"> TMS CATEGORY </span>
    <span><img class="xmaspikachu" src="assets/img/tmwater.png" alt=""></span>
    <span class="h5"> TMS CATEGORY </span>
    <span><img class="xmaspikachu" src="assets/img/tmdragon.png" alt=""></span>
    <span class="h5"> TMS CATEGORY </span>
    <span><img class="xmaspikachu" src="assets/img/tmelectric.png" alt=""></span>
    <span class="h5"> TMS CATEGORY </span>
    <span><img class="xmaspikachu" src="assets/img/tmfairy.png" alt=""></span>
    <span class="h5"> TMS CATEGORY </span>
    <span><img class="xmaspikachu" src="assets/img/tmfire.png" alt=""></span>
    <span class="h5"> TMS CATEGORY </span>
    <span><img class="xmaspikachu" src="assets/img/tmflying.png" alt=""></span>        
    
    <span class="h5"> TMS CATEGORY </span>
    <span><img class="xmaspikachu" src="assets/img/tmgrass.png" alt=""></span>
    <span class="h5"> TMS CATEGORY </span>
    <span><img class="xmaspikachu" src="assets/img/tmice.png" alt=""></span>        
    
    <span class="h5"> TMS CATEGORY </span>
    <span><img class="xmaspikachu" src="assets/img/tmpoison.png" alt=""></span>
    <span class="h5"> TMS CATEGORY </span>
    
    </div>
  </div>`;

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
                anchor.innerHTML = '<div class="card-body" id=' + id + '>';

                if (category == 'TMs') {

                    anchor.className = 'card card' + id + ' cardthomas text-center';
                    anchor = document.querySelector('.thomas').appendChild(anchor);

                    let cardId = document.getElementById(id);

                    let cardImg = document.createElement('img');
                    cardImg.src = 'assets/img/' + image + '';
                    cardImg.alt = name;
                    cardImg.className = "cardImg1"
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
                    cardAdd.dataset.name = name;
                    cardAdd.dataset.image = image;
                    cardAdd.dataset.price = price;
                    cardAdd.className = 'btn btn-primary add';
                    cardAdd.type = 'button';
                    cardAdd.textContent = "Add";
                    cardAdd = cardId.appendChild(cardAdd);

                    let cardPrice = document.createElement('div');
                    cardPrice.textContent = price + '¥';
                    cardPrice.className = "card-footer"
                    cardPrice = document.querySelector('.card' + id + '').appendChild(cardPrice);
                }
            });
        });
};

// La "landing" page d'accueil  

function News() {
    document.querySelector('.container').innerHTML = "";
}

// Panier

let regex = /^[1-9]{1}[0-9]{0,1}$/;

// A la pression de la touche Enter

// window.addEventListener('keydown', element => {
//     if ((element.key === 'Enter')) {
//         if (regex.test(element.target.value)) {
//             let quantity = element.target.value;
//             let id = element.target.parentNode.id;
//             element.target.value = "";
//         } 
//         else {
//             console.log("Veuillez saisir un élément valide");
//             // message.textContent = "Veuillez saisir un élément valide";
//         };
//     };
// });

// Au click sur le button "Add"

window.addEventListener('click', element => {

    // Affichage du panier

    if (element.target.classList.contains('add')) {
        if (regex.test(element.target.previousSibling.value)) {

            let itemId = element.target.parentNode.id;
            let quantity = element.target.previousSibling.value;

            let checkIds = document.querySelectorAll('.modal-body ul li');

            let i = 0
            if (checkIds.length != 0) {

                checkIds.forEach(element => {
                    if (element.className == itemId) {
                        i++
                        
                        if (i == 1) {
                            console.log('Cas n°3 : Doublons');
                            console.log(element.children[4].value)
                            let changeQuantity = parseInt(element.children[4].value) + parseInt(quantity);
                            element.children[4].value = changeQuantity;
                        }
                    }
                    
                });

            };

            if (checkIds.length == 0) {
                console.log('Cas n°1 : Premier article ajouté au panier')
                let modal = document.querySelector('.modal-body ul');

                let modalLine = document.createElement('li');
                modalLine.className = itemId;
                modalLine = modal.appendChild(modalLine);

                let modalImage = document.createElement('div');
                modalImage.className = 'modalImg';
                modalImage.innerHTML = '<img class="cartItem" src="assets/img/' + element.target.dataset.image + '"/>';
                modalImage = modalLine.appendChild(modalImage);

                let modalName = document.createElement('div');
                modalName.className = 'modalName h5 text';
                modalName.textContent = element.target.dataset.name
                modalName = modalLine.appendChild(modalName);

                let modalPrice = document.createElement('div');
                modalPrice.className = 'modalPrice'
                modalPrice.innerHTML = `(<span class="total">${element.target.dataset.price}</span>¥)`;
                modalPrice = modalLine.appendChild(modalPrice);

                // Calcul du total par objet

                let modalTotal = document.createElement('div');
                modalTotal.className = 'modalTotal fw-bold text-success';
                modalTotal.innerHTML = `<span class="itemsTotal">${element.target.dataset.price * quantity}</span>¥`
                modalTotal = modalLine.appendChild(modalTotal);

                let modalQuantity = document.createElement('input');
                modalQuantity.className = 'modalQuantity';
                modalQuantity.type = "text";
                modalQuantity.disabled = true;
                modalQuantity.value = quantity;
                modalQuantity = modalLine.appendChild(modalQuantity);

                // Création des boutons

                let editBtn = document.createElement('button');
                editBtn.classList.add('btn');
                editBtn.classList.add('btn-light');
                editBtn.type = 'button';
                editBtn.innerHTML = '<img class="Editer" src="https://img.icons8.com/color-glass/38/null/edit--v1.png"/>';
                editBtn = modalLine.appendChild(editBtn);

                let removeBtn = document.createElement('button');
                removeBtn.classList.add("btn");
                removeBtn.classList.add('btn-light');
                removeBtn.type = 'button';
                removeBtn.innerHTML = '<img class="Supprimer" src="https://img.icons8.com/fluency/38/null/delete-forever.png"/>';
                removeBtn = modalLine.appendChild(removeBtn);

            }

            else if (i == 0) {
                console.log('Cas n°2 : Pas de doublons')
                let modal = document.querySelector('.modal-body ul');

                let modalLine = document.createElement('li');
                modalLine.className = itemId;
                modalLine = modal.appendChild(modalLine);

                let modalImage = document.createElement('div');
                modalImage.className = 'modalImg';
                modalImage.innerHTML = '<img class="cartItem" src="assets/img/' + element.target.dataset.image + '"/>';
                modalImage = modalLine.appendChild(modalImage);

                let modalName = document.createElement('div');
                modalName.className = 'modalName h5 text';
                modalName.textContent = element.target.dataset.name
                modalName = modalLine.appendChild(modalName);

                let modalPrice = document.createElement('div');
                modalPrice.className = 'modalPrice'
                modalPrice.innerHTML = `(<span class="total">${element.target.dataset.price}</span>¥)`;
                modalPrice = modalLine.appendChild(modalPrice);

                // Calcul du total par objet

                let modalTotal = document.createElement('div');
                modalTotal.className = 'modalTotal fw-bold text-success';
                modalTotal.innerHTML = `<span class="itemsTotal">${element.target.dataset.price * quantity}</span>¥`
                modalTotal = modalLine.appendChild(modalTotal);

                let modalQuantity = document.createElement('input');
                modalQuantity.className = 'modalQuantity';
                modalQuantity.type = "text";
                modalQuantity.disabled = true;
                modalQuantity.value = quantity;
                modalQuantity = modalLine.appendChild(modalQuantity);

                // Création des boutons

                let editBtn = document.createElement('button');
                editBtn.classList.add('btn');
                editBtn.classList.add('btn-light');
                editBtn.type = 'button';
                editBtn.innerHTML = '<img class="Editer" src="https://img.icons8.com/color-glass/38/null/edit--v1.png"/>';
                editBtn = modalLine.appendChild(editBtn);

                let removeBtn = document.createElement('button');
                removeBtn.classList.add("btn");
                removeBtn.classList.add('btn-light');
                removeBtn.type = 'button';
                removeBtn.innerHTML = '<img class="Supprimer" src="https://img.icons8.com/fluency/38/null/delete-forever.png"/>';
                removeBtn = modalLine.appendChild(removeBtn);

            }

            // Toast

            const toastLiveExample = document.getElementById('liveToast')
            const toast = new bootstrap.Toast(toastLiveExample)
            toast.show()
            
        }
        else {

            // Toast : Message d'erreur

            const toastLiveExample = document.getElementById('liveToast1')
            const toast = new bootstrap.Toast(toastLiveExample)
            toast.show()
        };
    };

    // Edition du panier 

    if (element.target.classList == 'Editer') {
        
        element.target.src = "https://img.icons8.com/color-glass/38/null/verified-account--v1.png";
        element.target.className = 'Valider';
        let modif = element.target.parentNode.previousSibling;
        modif.disabled = false;

    } else if (element.target.classList == 'Valider') {
        let modif = element.target.parentNode.previousSibling;
        modif.disabled = true;
        element.target.src = "https://img.icons8.com/color-glass/38/null/edit--v1.png"
        element.target.className = 'Editer';

        // Recalcul du prix

        let unitPrice = element.target.parentNode.parentNode.children[2].children[0].innerText;
        let total = element.target.parentNode.parentNode.children[3]
        total.innerHTML = `<span class="itemsTotal">${unitPrice * modif.value}</span>¥`;

    };

    // Suppression

    if (element.target.classList.contains('Supprimer')) {
        element.target.parentNode.parentNode.remove();
    }

    // Vider le panier + Icone panier vide 

    let deleteAll = document.querySelector('#deleteAll');
    deleteAll.addEventListener('click', () => {
        document.querySelector('.modal-body ul').innerHTML = "";
        document.querySelector('.deleteAll').innerText = 'Your Shopping Cart is empty';
        document.querySelector('#ShoppingCart').src = 'assets/img/panier.png';
    });

    // Icone du panier rempli

    document.querySelector('#ShoppingCart').src = "assets/img/panier-fill.png"

    // Supprimer tout le panier 

    document.querySelector('.deleteAll').innerText = ''

    // Vider l'input des cards

    let clearInput = document.querySelectorAll('.card-body input');
    clearInput.forEach(element => {
        element.value = '';
    });

    // Sauvegarde dans un JSON 

    if (element.target.classList.contains('checkOut')) {

        let allItems = document.querySelectorAll('.modal-body ul li');
        let cart = []
        allItems.forEach(element => {

            let item = {
                itemId: element.className,
                img: element.firstChild.firstChild.src,
                name: element.children[1].textContent,
                price: element.children[2].children[0].textContent,
                quantity: element.children[4].value
            }
            console.log(element.className);
            console.log(element.firstChild.firstChild.src);
            console.log(element.children[1].textContent);
            console.log(element.children[2].children[0].textContent);
            console.log(element.children[4].value);

            cart.push(item)
        });

        localStorage.setItem("panier", JSON.stringify(cart));

    };
});

// Initialisation - Récupération des données JSON

let local = JSON.parse(localStorage.getItem('panier'));

if (local != null) {
    local.forEach(element => {

        let itemId = element.itemId;
        let name = element.name;
        //    let category = element.category;
        let image = element.img;
        let price = element.price;
        let quantity = element.quantity;

        // Reconstruction de la structure HTML du panier

        let modal = document.querySelector('.modal-body ul');

        let modalLine = document.createElement('li');
        modalLine.className = itemId;
        modalLine = modal.appendChild(modalLine);

        let modalImage = document.createElement('div');
        modalImage.className = 'modalImg';
        modalImage.innerHTML = '<img class="cartItem" src="'+image+'"/>';
        modalImage = modalLine.appendChild(modalImage);

        let modalName = document.createElement('div');
        modalName.className = 'modalName h5 text';
        modalName.textContent = name
        modalName = modalLine.appendChild(modalName);

        let modalPrice = document.createElement('div');
        modalPrice.className = 'modalPrice'
        modalPrice.innerHTML = `(<span class="total">${price}</span>¥)`;
        modalPrice = modalLine.appendChild(modalPrice);

        // Calcul du total par objet

        let modalTotal = document.createElement('div');
        modalTotal.className = 'modalTotal fw-bold text-success';
        modalTotal.innerHTML = `<span class="itemsTotal">${price * quantity}</span>¥`
        modalTotal = modalLine.appendChild(modalTotal);

        let modalQuantity = document.createElement('input');
        modalQuantity.className = 'modalQuantity';
        modalQuantity.type = "text";
        modalQuantity.disabled = true;
        modalQuantity.value = quantity;
        modalQuantity = modalLine.appendChild(modalQuantity);

        // Création des boutons

        let editBtn = document.createElement('button');
        editBtn.classList.add('btn');
        editBtn.classList.add('btn-light');
        editBtn.type = 'button';
        editBtn.innerHTML = '<img class="Editer" src="https://img.icons8.com/color-glass/38/null/edit--v1.png"/>';
        editBtn = modalLine.appendChild(editBtn);

        let removeBtn = document.createElement('button');
        removeBtn.classList.add("btn");
        removeBtn.classList.add('btn-light');
        removeBtn.type = 'button';
        removeBtn.innerHTML = '<img class="Supprimer" src="https://img.icons8.com/fluency/38/null/delete-forever.png"/>';
        removeBtn = modalLine.appendChild(removeBtn);

    });
};

