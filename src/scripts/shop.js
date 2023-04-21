let subCatListEl = document.getElementById('subCategoriesList'); // returns nav subCategoriesList
let productsListEl = document.getElementById('productsList');
let categoryLinkEl = document.querySelectorAll('.category-link');

let categoryId = document.body.dataset.categoryId; // storage of dataset put in the body of shop-page named category-id
let categoryName = document.body.dataset.categoryName; // storage of dataset put in the body of shop-page named category-name
let subCategoryName = document.body.dataset.subCategoryName; // storage of dataset put in the body of shop-page named sub-category-name
let subCategoryId = document.body.dataset.subCategoryId;  // storage of dataset put in the body of shop-page named sub-category-id

// function for empty the div that contains sub categories
function emptySubCategories() {
    subCatListEl.innerHTML = "";
}

// function for empty the div that contains sub categories
function emptyProducts() {
    productsListEl.innerHTML = "";
}

window.addEventListener('popstate', (ev) => {
    let splitUrl = location.pathname.split('/');
    let categoryName = splitUrl[3];
    let subCategoryName = splitUrl[4];
    if (categoryName) {
        let categoryEl = document.querySelector(`.category-link[data-category-name=${categoryName}]`);
        let categoryId = categoryEl.dataset.categoryId;

        showAllSubCategories(categoryId, categoryName)
        showProductsByCategory(categoryId);
    } else {
        emptySubCategories();
        emptyProducts();
    }
})


/**
 * Fetch api/sub_categories
 * @param categoryId
 * @param categoryName
 * @param subCategoryName
 * @returns {Promise<void>}
 */
async function showAllSubCategories(categoryId, categoryName, subCategoryName) {
    subCatListEl.innerHTML = "";

    let response = await fetch(`api/sub_categories/${categoryId}`); // fetch on api/sub_categories/categoryId
    let subcategories = await response.json(); // json response

    subcategories.forEach(subcategory => { // loop on response subcategories
        let subCatId = subcategory.id; // storage subcategory.id
        let subCatName = subcategory.name.replaceAll(' ', '-'); // replace some characters
        let linkTemplate = `<li><button class="sub-category-link" onclick="handleSubCategoryLinkClick(this)" data-category-name="${categoryName} " data-category-id="${categoryId}" data-sub-category-name="${subCatName}"data-sub-category-id="${subCatId}" link="shop/${categoryName}/${subCatName}" ${(subCategoryName == subcategory.name) ? 'active' : ''}>${subcategory.name}</button></li>`; // display category and subcategory names
        subCatListEl.insertAdjacentHTML("beforeend", linkTemplate);
    })
}

/**
 * Function that show products filter by category.
 * @param categoryId
 * @returns {Promise<void>}
 */
async function showProductsByCategory(categoryId) {
    productsListEl.innerHTML = "";

    let response = await fetch(`api/products/${categoryId}`);
    let productsByCategory = await response.json();

    productsByCategory.forEach(product => {
        let productId = product.id;
        let productName = product.name;
        let productPrice = product.price;
        let productImage = product.image;
        let productDescription = product.description;
        let productTemplate = `<li>${getProductTemplate(productId, productImage, productName, productDescription, productPrice)}</li>`
        productsListEl.insertAdjacentHTML("beforeend", productTemplate);
    })
}

/**
 * This function is a template for display our products
 * @param productId
 * @param productImage
 * @param productName
 * @param productDescription
 * @param productPrice
 * @returns {string}
 */
function getProductTemplate(productId, productImage, productName, productDescription, productPrice) {
    return `
    <div class="product" data-id="${productId}">
        <img src="assets/images/products/${productImage}" width="300" height="300"/>
        <h3>${productName}</h3>
        <p> ${productDescription} </p>
       <div><span>Prix : ${productPrice}</span><button><a href="/boutique-en-ligne/product/${productId}">Voir le produit</a></button></div>
    </div>
    `
}

/**
 * This function show our products filtered by sub category
 * @param categoryId
 * @param subCategoryId
 * @returns {Promise<void>}
 */
async function showProductsBySubCategory(categoryId, subCategoryId) {
    productsListEl.innerHTML = "";

    let response = await fetch(`api/products/${categoryId}/${subCategoryId}`);
    let productsBySubCategory = await response.json();

    productsBySubCategory.forEach(product => {
        let productId = product.id;
        let productName = product.name;
        let productPrice = product.price;
        let productImage = product.image;
        let productDescription = product.description;
        let productTemplate = `<li>${getProductTemplate(productId, productImage, productName, productDescription, productPrice)}</li>`;
        productsListEl.insertAdjacentHTML("beforeend", productTemplate);
    })
}


showAllSubCategories(categoryId, categoryName, subCategoryName);

/**
 * We throw this function onclick on button category. We get dataset and use theme inside our two functions
 * showAllSubCategories and showProductsByCategory.
 * Then, we get pathname then put inside url the category name.
 * we also call the function notifyCategoryLinks  to enable categories in red.
 * @param el
 */
function handleCategoryLinkClick(el) {
    let categoryId = el.dataset.categoryId;
    let categoryName = el.dataset.categoryName;
    showAllSubCategories(categoryId, categoryName)
    showProductsByCategory(categoryId);
    let path = location.pathname.split('/');
    window.history.pushState({}, '', 'shop/' + `${categoryName}`);
    notifyCategoryLinks(categoryId);
}

/**
 *
 * @param el
 */
function handleSubCategoryLinkClick(el) {
    let subCategoryId = el.dataset.subCategoryId;
    let subCategoryName = el.dataset.subCategoryName;
    let categoryId = el.dataset.categoryId;
    let categoryName = el.dataset.categoryName.replace(' ', '');
    showProductsBySubCategory(categoryId, subCategoryId);
    let path = location.pathname.split('/');
    window.history.pushState({}, '', 'shop/' + `${categoryName}` + '/' + `${subCategoryName}`);
    notifySubCategoryLinks(subCategoryId);

}

/**
 * This function allow us to set attribute on our category active for show it in red
 * @param categoryId
 */
function notifyCategoryLinks(categoryId) {
    categoryLinkEl.forEach(catLinkEl => {
        if (catLinkEl.dataset.categoryId == categoryId) {
            catLinkEl.setAttribute('active', '');
        } else {
            catLinkEl.removeAttribute('active');
        }
    })
}

/**
 * This function allow us to set attribute on our sub category active for show it in red
 * @param subCategoryId
 */
function notifySubCategoryLinks(subCategoryId) {
    let subCategoryLinkEl = document.querySelectorAll('.sub-category-link');
    subCategoryLinkEl.forEach(subCatLinkEl => {
        if (subCatLinkEl.dataset.subCategoryId == subCategoryId) {
            subCatLinkEl.setAttribute('active', '');
        } else {
            subCatLinkEl.removeAttribute('active');
        }
    })
}