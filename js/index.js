//Pop Up Genércio
let popUps = document.querySelector(".pop-up");
let plusCat = document.querySelector(".plus-category");
let closeCat = document.querySelector(".close-category");

function popUpGen (e) {
    if (e == "open"){
        popUps.style.display = "block";
    } else if (e == "close"){
        popUps.style.display = "none";
    }
}

function popUpCat (e) {
    if (e == "open"){
        popUps.style.display = "flex";
        plusCat.style.display = "none";
        closeCat.style.display = "flex";
    } else if (e == "close"){
        popUps.style.display = "none";
        plusCat.style.display = "flex";
        closeCat.style.display = "none";
    }
}

//Pop Up Mensagem
let popUpMessage = document.querySelector(".pop-up-message");

function popUpMes (e) {
    popUpMessage.style.display = "none";
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
let ativo = "cor";
let desativo = "cor";

function subMenuBar (tema) {
    if(tema == "light"){
        ativo = "var(--black)";
        desativo = "var(--black-gray)";
    } else {
        ativo = "var(--white)";
        desativo = "var(--white-gray)";
    }
    if (opened == 0){
        subMenuPerfil.style.display = "flex";
        subMenuNome.style.color = ativo;
        opened = 1;
    } else if (opened == 1){
        subMenuPerfil.style.display = "none";
        subMenuNome.style.color = desativo;
        opened = 0;
    }
}