let subCatListEl = document.getElementById('subCategoriesList'); // returns nav subCategoriesList

let categoryId = document.body.dataset.categoryId; // storage of dataset put in the body of shop-page named category-id
let categoryName = document.body.dataset.categoryName; // storage of dataset put in the body of shop-page named category-name
let subCategoryName = document.body.dataset.subCategoryName; // storage of dataset put in the body of shop-page named sub-category-name

/**
 * Fetch api/sub_categories
 * @param categoryId
 * @param categoryName
 * @param subCategoryName
 * @returns {Promise<void>}
 */

async function showAllSubCategories(categoryId, categoryName, subCategoryName){
    let response = await fetch(`api/sub_categories/${categoryId}`); // fetch on api/sub_categories/categoryId
    let subcategories = await response.json(); // json response

    subcategories.forEach(subcategory => { // loop on response subcategories
        let subCatId = subcategory.id; // storage subcategory.id
        let subCatName = subcategory.name.replaceAll(' ', '-'); // replace some characters
        let linkTemplate = `<li><a href="shop/${categoryName}/${subCatName}" ${(subCategoryName == subcategory.name) ? 'active' : ''}>${subcategory.name}</a></li>`; // display category and subcategory names
        subCatListEl.insertAdjacentHTML("beforeend", linkTemplate); 
    })
}





showAllSubCategories(categoryId, categoryName, subCategoryName);
