console.log('connexion javascript');

let increaseButton = document.getElementById("increase");

function increaseQuantity(productId){
    console.log(productId);
}

function reduceQuantity(productId){
    console.log(productId);
}

let allIncrease=document.querySelectorAll('.increase');

async function increaseProduct(userId, productId){
    let response = await fetch(`cart/increase/${userId}/${productId}`, {method: 'PATCH'});
    let responseData = await response.text();   
    console.log(responseData);
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