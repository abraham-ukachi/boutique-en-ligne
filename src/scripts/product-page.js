import { MAIN_PART, ASIDE_PART, FULL_PART } from "../app.js";
import { SUCCESS_TOAST, GOOD_TOAST, BAD_TOAST, ERROR_TOAST } from "../app.js";

let reviewBtn = document.getElementById('review-btn');
let reviewProductForm = document.getElementById('review-product-form');

function resetForm(){
    let select = reviewProductForm.querySelector("select");
    let input = reviewProductForm.querySelector("input");
    input.value = "";
    select.value = "";
}

function addReview(data) {
    let reviewTemplate = `
    <div class="review">
 
        <h2>${data.firstname + " " + data.lastname}</h2>
        <span class="rating">${data.ratings}</span>
        <p class="review">${data.comment}</p>
        <span class="date">${data.created_at}</span>
        
    </div>
    `;
    let reviews = document.querySelector(".reviews");
    reviews.insertAdjacentHTML("afterbegin", reviewTemplate);
}


reviewProductForm.addEventListener('submit', async(ev) => {
    ev.preventDefault();

    let productId = ev.currentTarget.dataset.productId;
    let form = new FormData(ev.currentTarget);

    form.append('product-id', productId);

    let reviewInputValue = form.get("review-input");
    let url = "review";
    let request = new Request(url, {method: 'POST', body: form});
    let response = await fetch(request);
    let responseData = await response.json();

    if(responseData.success){
        resetForm();
        addReview(responseData.data);
        mbApp.showToast({message: "Votre review a bien été ajoutée !", part: ASIDE_PART, type: SUCCESS_TOAST }, 5, true);

    }

});


reviewBtn.addEventListener('click', () => !!mbApp.asideEl.hidden ? mbApp.openAside() : mbApp.closeAside());