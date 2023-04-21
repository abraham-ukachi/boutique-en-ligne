console.log("Test lien javascript");
//déclarer le formulaire pour y associer une fonction quand on soumet
let formRegisterProduct = document.getElementById('registerProductForm');
let formProductUpdate = document.getElementById('productUpdateForm');
let categorySelect = document.getElementById('category');

async function registerProduct(name, description, price, category, subcategory, stock, image) {
    let response = await fetch(`admin/product/create`, {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({name, description, price, category, subcategory, stock, image})
    });
    let resData = await response.json();
    console.log(resData);
}


function handleFormSubmitOld(event) {
    event.preventDefault();

    // let formData = new FormDataEvent(event.target);

    console.log(event);
    let name = event.target[0].value;
    let description = event.target[1].value;
    let price = event.target[2].value;
    let category = event.target[3].value;
    let subcategory = event.target[4].value;
    let stock = event.target[5].value;

    let imageInput = event.target[6]; // <input type=file...>
    let image = imageInput.files[0]; 
    
    console.log(name, description, price, category, subcategory, stock);

    // console.log('formData => ', formData);
    console.log(`imageInput ==> `, imageInput);
    console.log(`image ==> `, image);

    registerProduct(name, description, price, category, subcategory, stock, image);
}





// formRegisterProduct.addEventListener('submit', handleFormSubmit);


let submitButton = document.getElementById('envoie');

if(categorySelect){
    categorySelect.addEventListener('change', async (event) => {
    let categoryId = event.currentTarget.value;
    console.log(categoryId);

    let response = await fetch(`api/sub_categories/${categoryId}`);
    let subcategories = await response.json();
    console.log(subcategories);

    let subCategoriesElement = document.getElementById('subcategories');
    subCategoriesElement.innerHTML = "<option value=''>Choisissez une sous-categorie</option>";

    subcategories.forEach(subcategory => {
        let optionTemplate = `<option value='${subcategory.id}'>${subcategory.titre}</option>`;
        subCategoriesElement.insertAdjacentHTML('beforeend', optionTemplate);
        console.log(subcategory.titre);
    });
});

}

// faire un fetch de toutes les sous categorie avec category Id
//creer une route api-subcategory/
// fetch url
if (formRegisterProduct){
    formRegisterProduct.addEventListener('submit', async (event) => {
    event.preventDefault();

    let form = new FormData(event.target);

    // form.append('name', 'Abraham');

    let url = 'admin/product/create';

    let request = new Request(url, {
        method: 'POST',
        body: form
    });

    let response = await fetch(request);
    let responseData = await response.text();

    console.log(`form => `, form);
    console.log(`responseData => `, responseData);

    });
}

if (formProductUpdate){
    formProductUpdate.addEventListener('submit', async (event) => {
    event.preventDefault();
    let productId = event.target.dataset.productId; //recupère la valeur de productId dans dataset du formulaire
        console.log(productId);
    let form = new FormData(event.target);
    form.append( 'productId', productId );
    let price = form.get('productprice');
    price = price.replace('€', '');
    price = price.replace(',', '.');
    price = parseFloat(price) * 100;
    console.log(price);
    form.set('productprice', price);

    let url = 'admin/product/update';

    let request = new Request(url, {
        method: 'POST',
        body: form
    });

    let response = await fetch(request);
    let responseData = await response.text();

    console.log(`form => `, form);
    console.log(`responseData => `, responseData);

    });
}

// DELETE things

let allDel=document.querySelectorAll('.deleteproduct');

async function deleteProduct(productId){
    let response = await fetch(`admin/product/${productId}`, {method: 'DELETE'});
    let responseData = await response.json();
    if(responseData.response == 'ok'){
        let productElement = document.getElementById(productId);
        console.log(productElement);
        productElement.remove();
    }
    console.log(responseData);

    // if(response.status == 'ok') {
    //     console.log('product has been delete');
    // }
}

for (const btn of allDel){

    console.log(btn);
    btn.addEventListener("click", (e) =>{
        let idDelete= e.target.id
        console.log("delete  "+idDelete)
        deleteProduct(idDelete);
    })
}



