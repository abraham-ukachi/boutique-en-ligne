console.log('connexion javascript');

let increaseButton = document.getElementById("increase");

function increaseQuantity(productId){
    console.log(productId);
}

function reduceQuantity(productId){
    console.log(productId);
}

//for increase quantity of product in cart
let allQuantity=document.querySelectorAll('.quantity');
for (const btnQ of allQuantity){
    console.log(btnQ);
   let productQuantityId = btnQ.dataset.productQuantityId;
   let productQuantity = btnQ.dataset.productQuantity;
   console.log(productQuantityId);
   console.log(productQuantity);
}
let totalDisplay = document.getElementById("total");

let allIncrease=document.querySelectorAll('.increase');

async function increaseProduct(userId, productId){
    let response = await fetch(`cart/increase/${userId}/${productId}`, {method: 'PATCH'});
    let responseData = await response.json();   
    console.log(responseData);

    if(responseData.success == true){
        // console.log(productId); PB productId et USERid sont inversés
        // console.log(userId);
        let productQuantityId = `product${userId}`;
        console.log("productQuantityId "+productQuantityId);
        let productQuantityDisplay=document.getElementById(productQuantityId);
        let numb = productQuantityDisplay.innerText;
        numb = parseInt(numb);
        numb=numb+1;
        productQuantityDisplay.innerText = numb;
        let total = responseData.total;
        totalDisplay.innerText = total/100;
        console.log(total);
    }

}

for (const btn of allIncrease){
    console.log(btn);
    console.log(allIncrease);
    btn.addEventListener("click", (e) =>{
        let idProduct = e.target.dataset.productId;
        let idUser = e.target.dataset.userId;
        console.log("id product  "+idProduct)
        increaseProduct(idProduct, idUser);
    })
}







//---------------------------------------------------
//for reduce quantity of product in cart

let allReduce=document.querySelectorAll('.reduce');

async function reduceProduct(userId, productId){
    let response = await fetch(`cart/reduce/${userId}/${productId}`, {method: 'PATCH'});
    let responseData = await response.json();   
    console.log(responseData);
    if(responseData.success == true){
        // console.log(productId); PB productId et USERid sont inversés
        // console.log(userId);
        let productQuantityId = `product${userId}`;
        console.log("productQuantityId "+productQuantityId);
        let productQuantityDisplay=document.getElementById(productQuantityId);
        let numb = productQuantityDisplay.innerText;
        numb = parseInt(numb);
        numb=numb-1;
        productQuantityDisplay.innerText = numb;
        let total = responseData.total;
        
        total = parseFloat(total);
        console.log(total);
        let newTotal=total/100;
        console.log("new total type "+typeof newTotal);

        totalDisplay.innerText = newTotal;

    }
}

for (const btn of allReduce){
    console.log(btn);
    console.log(allReduce);
    btn.addEventListener("click", (e) =>{
        let idProduct = e.target.dataset.productId;
        let idUser = e.target.dataset.userId;
        console.log("id product  "+idProduct)
        reduceProduct(idProduct, idUser);
    })
}