//Pop Up Genércio
let popUps = document.querySelector(".pop-up");

function popUpGen (e) {
    if (e == "open"){
        popUps.style.display = "block";
    } else if (e == "close"){
        popUps.style.display = "none";
    }
}

//Separação Editar Perfil Usuário
let divEditUser = document.querySelectorAll(".div-edit-user");

function divEditActive (e) {
    var i;
    console.log(e);
    console.log(divEditUser[e]);
    for(i = 0; i < divEditUser.length; i++){
        divEditUser[i].classList.add("invisible");
    }
    divEditUser[e].classList.remove("invisible");
}