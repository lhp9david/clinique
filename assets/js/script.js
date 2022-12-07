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

function pokeballs() {
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


function battleItems() {
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

function medicine() {
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

function TMs() {
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
                anchor.innerHTML = '<div class="card-body" id=' + id + '>';

                if (category == 'TMs') {

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

function News() {
    document.querySelector('.container').innerHTML = "";
}

// Panier

let regex = /^[1-9]{1}[0-9]{0,1}$/;

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


window.addEventListener('click', element => {

    // Affichage du panier

    if (element.target.classList.contains('add')) {
        if (regex.test(element.target.previousSibling.value)) {

            let id = element.target.parentNode.id;
            let quantity = element.target.previousSibling.value;

            let modal = document.querySelector('.modal-body ul');
            
            let modalLine = document.createElement('li');
            modalLine = modal.appendChild(modalLine);

            let modalImage = document.createElement('div');
            modalImage.innerHTML = '<img class="cartItem" src="assets/img/'+element.target.dataset.image+'"/>';
            modalImage = modalLine.appendChild(modalImage);

            let modalName = document.createElement('div');
            modalName.className = 'h5 text';
            modalName.textContent = element.target.dataset.name
            modalName = modalLine.appendChild(modalName);

            let modalPrice = document.createElement('div');
            modalPrice.className = 'modalPrice';
            modalPrice.textContent = element.target.dataset.price+'¥';
            modalPrice = modalLine.appendChild(modalPrice);

            let modalQuantity = document.createElement('div');
            modalQuantity.className = 'modalQuantity';
            modalQuantity.textContent = quantity;
            modalQuantity = modalLine.appendChild(modalQuantity);

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
        else {
            message.textContent = "Veuillez saisir un élément valide";
        };
    };
        // Edition du panier 

    // Edition 

    if (element.target.classList == 'Valider') {
        let modif = element.target.parentNode.previousSibling.value;
        let quantityDiv = document.createElement('div');
        quantityDiv.className = 'modalQuantity';
        quantityDiv.textContent = modif;
        element.target.parentNode.previousSibling.replaceWith(quantityDiv);
        console.log(element.target.parentNode.parentNode.firstChild);
        element.target.src = "https://img.icons8.com/color-glass/38/null/edit--v1.png"
    };


    if (element.target.classList == 'Editer') {
        let quantityInput = document.createElement('input');
        quantityInput.classList = 'modalQuantityInput'
        quantityInput.value = element.target.parentNode.previousSibling.textContent;
        element.target.parentNode.previousSibling.replaceWith(quantityInput);
        console.log(element.target);
        element.target.src = "https://img.icons8.com/color-glass/38/null/verified-account--v1.png";
        element.target.classList = 'Valider'
        }

    //Suppression

    if (element.target.classList.contains('Supprimer')) {
        element.target.parentNode.parentNode.remove();
    }

        // Sauvegarde dans un JSON 

//         let array = document.querySelectorAll('li');

//         let listTextContent = [];
//         array.forEach(element => {
//             console.log(element.textContent);
//             listTextContent.push(element.textContent);
//         });
//         console.log(listTextContent)

//         localStorage.setItem("list", JSON.stringify(listTextContent));

});


// Initialisation - Récupération des données JSON

// let local = JSON.parse(localStorage.getItem('list'));

// if (local != null) {
//     local.forEach(element => {

//         let flex = document.createElement('div');
//         flex.id = 'flex';
//         flex = list.appendChild(flex);

//         let newLi = document.createElement('li');
//         newLi.textContent = element;
//         newLi = flex.appendChild(newLi);

//         let flexBtn = document.createElement('div');
//         flexBtn = flex.appendChild(flexBtn);

//         let removeBtn = document.createElement('button');
//         removeBtn.classList.add("remove");
//         removeBtn.type = 'button';

//         removeBtn.textContent = "-";
//         removeBtn = flexBtn.appendChild(removeBtn);

//         let editBtn = document.createElement('button');
//         editBtn.classList.add('edit');
//         editBtn.type = 'button';

//         editBtn.textContent = 'Edit';
//         editBtn = flexBtn.appendChild(editBtn);
//     });
// };






