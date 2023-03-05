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

// const reqEnregistrerMembre = () => {
//     let formMembre = new FormData(
//         document.getElementById("formEnregistrerMembre")
//     );
//     formMembre.append("action", "enregistrer");
//     $.ajax({
//         type: "POST",
//         url: "serveur/Membre/routes.php",
//         data: formMembre,
//         dataType: "text",
//         async: false,
//         cache: false,
//         contentType: false,
//         processData: false,
//     })
//         .done((reponse) => {
//             reponse = JSON.parse(reponse);
//             if (reponse.OK) {
//                 alert(reponse.message);
//                 reqCreerAuth(formMembre);
//             } else {
//                 //
//             }
//         })
//         .fail((e) => {
//             alert(`Problème: ${e.responseText}`);
//         });
// };

// const reqCreerAuth = (formMembre) => {
//     $.ajax({
//         type: "POST",
//         url: "serveur/Auth/routes.php",
//         data: formMembre,
//         dataType: "text",
//         async: false,
//         cache: false,
//         contentType: false,
//         processData: false,
//     })
//         .done((reponse) => {
//             reponse = JSON.parse(reponse);
//             if (reponse.OK) {
//                 //
//             } else {
//                 //
//             }
//         })
//         .fail((e) => {
//             alert(`Problème: ${e.responseText}`);
//         });
// };
