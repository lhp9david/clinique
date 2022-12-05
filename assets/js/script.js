// JSON

fetch('assets/json/store.json')
    .then(response => response.json())
    .then((data) => {
        let db = data;
        console.log(db.items);

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
                
                anchor.className = 'card text-center';
                anchor = document.getElementById('pokeballs').appendChild(anchor);

                let cardId = document.getElementById(id);
                
                let cardImg = document.createElement('img');
                cardImg.src = 'assets/img/'+image+'';
                cardImg = cardId.appendChild(cardImg);

                let cardName = document.createElement('div');
                cardName.textContent = name;
                cardName = cardId.appendChild(cardName);

                let cardOverview = document.createElement('div');
                cardOverview.textContent = overview;
                cardOverview = cardId.appendChild(cardOverview);

                let cardInput = document.createElement('input');
                cardInput.placeholder = 'Quantité';
                cardInput = cardId.appendChild(cardInput);

                let cardPrice = document.createElement('div');
                cardPrice.textContent = price+'¥';
                cardPrice = cardId.appendChild(cardPrice);

            }
            // else if (category == 'Battle items') {

            //     let cardImg = document.createElement('img');
            //     cardImg.src = 'assets/img/'+image+'';
            //     cardImg = cardId.appendChild(cardImg);

            //     let cardName = document.createElement('div');
            //     cardName.textContent = name;
            //     cardName = cardId.appendChild(cardName);

            //     let cardOverview = document.createElement('div');
            //     cardOverview.textContent = overview;
            //     cardOverview = cardId.appendChild(cardOverview);

            //     let cardInput = document.createElement('input');
            //     cardInput.placeholder = 'Quantité';
            //     cardInput = cardId.appendChild(cardInput);

            //     let cardPrice = document.createElement('div');
            //     cardPrice.textContent = price+'¥';
            //     cardPrice = cardId.appendChild(cardPrice);
            // }
            // else if (category == 'Medicine') {

            //     let cardImg = document.createElement('img');
            //     cardImg.src = 'assets/img/'+image+'';
            //     cardImg = cardId.appendChild(cardImg);

            //     let cardName = document.createElement('div');
            //     cardName.textContent = name;
            //     cardName = cardId.appendChild(cardName);

            //     let cardOverview = document.createElement('div');
            //     cardOverview.textContent = overview;
            //     cardOverview = cardId.appendChild(cardOverview);

            //     let cardInput = document.createElement('input');
            //     cardInput.placeholder = 'Quantité';
            //     cardInput = cardId.appendChild(cardInput);

            //     let cardPrice = document.createElement('div');
            //     cardPrice.textContent = price+'¥';
            //     cardPrice = cardId.appendChild(cardPrice);
            // }
            // else if (category == 'Machines') {

            //     let cardImg = document.createElement('img');
            //     cardImg.src = 'assets/img/'+image+'';
            //     cardImg = cardId.appendChild(cardImg);

            //     let cardName = document.createElement('div');
            //     cardName.textContent = name;
            //     cardName = cardId.appendChild(cardName);

            //     let cardOverview = document.createElement('div');
            //     cardOverview.textContent = overview;
            //     cardOverview = cardId.appendChild(cardOverview);

            //     let cardInput = document.createElement('input');
            //     cardInput.placeholder = 'Quantité';
            //     cardInput = cardId.appendChild(cardInput);

            //     let cardPrice = document.createElement('div');
            //     cardPrice.textContent = price+'¥';
            //     cardPrice = cardIds.appendChild(cardPrice);
            // }

    });
    });


// UX

// let regex = /^[1-9]{1}[0-9]{0,1}$/;

// window.addEventListener('keydown', element => {
//     if ((element.key === 'Enter')) {
//         if (regex.test(element.target.value)) {
//             console.log('hello')
//             quantity = element.target.value;
//             console.log(quantity);
            










//         } 
//         else {
//             message.textContent = "Veuillez saisir un élément valide";
//         };
//     };
// });

// Modal