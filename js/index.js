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
    for(i = 0; i < divEditUser.length; i++){
        divEditUser[i].classList.add("invisible");
    }
    divEditUser[e].classList.remove("invisible");
}

//Sub Menu do Perfil
let subMenuPerfil = document.querySelector(".sub-menu-perfil");
let subMenuNome = document.querySelector(".sub-menu-nome");
let opened = 0;

function subMenuBar () {
    if (opened == 0){
        subMenuPerfil.style.display = "flex";
        subMenuNome.style.color = "var(--white)";
        opened = 1;
    } else if (opened == 1){
        subMenuPerfil.style.display = "none";
        subMenuNome.style.color = "var(--white-gray)";
        opened = 0;
    }
}