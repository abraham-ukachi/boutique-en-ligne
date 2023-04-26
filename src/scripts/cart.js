console.log('connexion javascript');

let increaseButton = document.getElementById("increase");

function increaseQuantity(productId){
    console.log(productId);
}

function reduceQuantity(productId){
    console.log(productId);
}

//for increase quantity of product in cart

let allIncrease=document.querySelectorAll('.increase');

async function increaseProduct(userId, productId){
    let response = await fetch(`cart/increase/${userId}/${productId}`, {method: 'PATCH'});
    let responseData = await response.json();   
    console.log(responseData);
    const obj = JSON.parse(responseData);
console.log(obj);
    if(responseData.success == "success"){
        console.log("bonne reponse");
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

//for increase quantity of product in cart

let allReduce=document.querySelectorAll('.reduce');

async function reduceProduct(userId, productId){
    let response = await fetch(`cart/reduce/${userId}/${productId}`, {method: 'PATCH'});
    let responseData = await response.json();   
    console.log(responseData);
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