let subCatListEl = document.getElementById('subCategoriesList'); // returns nav subCategoriesList

/**
 * Fetch api/sub_categories
 * @param categoryId
 * @param categoryName
 * @param subCategoryName
 * @returns {Promise<void>}
 */
async function showAllSubCategories(categoryId, categoryName, subCategoryName){
    let response = await fetch(`api/sub_categories/${categoryId}`);
    let subcategories = await response.json();

    subcategories.forEach(subcategory => {
        let subCatId = subcategory.id;
        let subCatName = subcategory.name.replaceAll(' ', '-');
        let linkTemplate = `<li><a href="shop/${categoryName}/${subCatName}" ${(subCategoryName == subcategory.name) ? 'active' : ''}>${subcategory.name}</a></li>`;
        subCatListEl.insertAdjacentHTML("beforeend", linkTemplate);
    })
}




let categoryId = document.body.dataset.categoryId; // storage of dataset category-id
let categoryName = document.body.dataset.categoryName; // storage of dataset category-name
let subCategoryName = document.body.dataset.subCategoryName; // storage of dataset sub-category-name

showAllSubCategories(categoryId, categoryName, subCategoryName);

