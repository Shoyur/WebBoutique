const reqLireMembre = (action, email, pourValiderEnregistrement) => {
    let formMembre = new FormData();
    formMembre.append("action", action);
    formMembre.append("email", email);
    $.ajax({
        type: "POST",
        url: "serveur/Membre/routes.php",
        data: formMembre,
        dataType: "text",
        async: false,
        cache: false,
        contentType: false,
        processData: false,
    })
        .done((reponse) => {
            reponse = JSON.parse(reponse);
            if (pourValiderEnregistrement) {
                let existe = Object.keys(reponse).length > 0 ? true : false;
                validerFormEnregPartTwo(existe);
            } else {
                //
            }
        })
        .fail((e) => {
            alert(`Problème: ${e.responseText}`);
        });
};
