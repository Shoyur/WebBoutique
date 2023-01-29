async function membreExiste(email) {
    $.ajax({
        url: "serveur/existeMembre.php",
        type: "POST",
        data: {"email": email},
        dataType: 'text',
        success: (reponse) => {
            validerFormEnregPartTwo(reponse);
        },
        fail: (e) => {
            alert(`Problème: ${e.message()}`);
        }
    });
}



// async function getProduits() {
//     $.ajax({
//         url: "serveur/getProduits.php",
//         type: "GET",
//         data: {},
//         dataType: 'json',
//         success: (reponse) => {
//             console.log(reponse);
//             initialiser(reponse);
//         },
//         fail: (e) => {
//             alert(`Problème: ${e.message()}`);
//         }
//     });
// }

