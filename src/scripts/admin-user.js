console.log("Test lien javascript utilisateurs");


//UPDATE USER

let userUpdateForm = document.getElementById('userUpdateForm');

if (userUpdateForm){
    userUpdateForm.addEventListener('submit', async (event) => {
    event.preventDefault();
    let userId = event.target.dataset.userId; //recupère la valeur de productId dans dataset du formulaire
        console.log(userId);
    let form = new FormData(event.target);
    form.append( 'userId', userId );

    let url = 'admin/user/update';

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

let allDel=document.querySelectorAll('.deleteUser');

async function deleteUser(userId){
    let response = await fetch(`admin/user/${userId}`, {method: 'DELETE'});
    let responseData = await response.json();
    if(responseData.response == 'ok'){
        let userElement = document.getElementById(userId);
        console.log(userElement);
        userElement.remove();
    }
    console.log(responseData);
}

for (const btn of allDel){
    console.log(btn);
    btn.addEventListener("click", (e) =>{
        let idDelete= e.target.id
        console.log("delete  "+idDelete)
        deleteUser(idDelete);
    })
}

//CREATE NEW USER

//déclarer le formulaire pour y associer une fonction quand on soumet
let formCreateUser = document.getElementById('userCreateForm');


if (formCreateUser){
    formCreateUser.addEventListener('submit', async (event) => {
    event.preventDefault();

    let form = new FormData(event.target);

    // form.append('name', 'Abraham');

    let url = 'admin/user/create';

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




