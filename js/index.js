//Pop Up Adicionar Categoria
let popUps = document.querySelector(".pop-up");

function popAddCategoryGame (e) {
    if (e == "open"){
        popUps.style.display = "block";
    } else if (e == "close"){
        popUps.style.display = "none";
    }
}