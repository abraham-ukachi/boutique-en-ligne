console.log("Test lien javascript utilisateurs");


//ADD SUBCATEGORIES

let subCategoriesForm = document.getElementById('subCategoriesForm');
if (subCategoriesForm){
    subCategoriesForm.addEventListener('submit', async (event) => {
    event.preventDefault();
    let categoryId = event.target.dataset.categoryId; //recupère l'ID de la catégorie dans dataset du formulaire
        console.log(categoryId);

    let form = new FormData(event.target);

    // form.append('name', 'Abraham');

    let url = `admin/category/${categoryId}`;

    let request = new Request(url, {
        method: 'POST',
        body: form
    });

    let response = await fetch(request);
    let responseData = await response.json();

    console.log(`form => `, form);
    console.log(`responseData => `, responseData);


    if (responseData.response == "ok"){
        let subCategories = document.getElementById("subCategories");

        let template = `
        <li id='' class="sub-category">
            <span>${form.get('subcategoryTitre')}</span>
            <button id="" class='deletecategory'>Supprimer</button>
        </li>`;

        subCategories.insertAdjacentHTML('beforeend', template);


        let subcategorytitre=document.getElementById("subcategorytitre");
        let subcategoryname=document.getElementById("subcategoryname");
        subcategorytitre.value='';
        subcategoryname.value='';
    }

    });
}

// DELETE things

let allDel=document.querySelectorAll('.deletecategory');

async function deleteProduct(categoryId){
    let response = await fetch(`admin/category/${categoryId}`, {method: 'DELETE'});
    let responseData = await response.json();
    if(responseData.response == true){
        let categoryElement = document.getElementById(categoryId);
        console.log(categoryElement);
        categoryElement.remove();
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