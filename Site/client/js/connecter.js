function connecter() {
    console.log("Début fonction connecter() de connecter.js");
    const email = document.getElementById('emailConn').value;
    const mdp = document.getElementById('mdpConn').value
    console.log("email=", email, " mdp=", mdp);
    if (email == null || email == "" || mdp == null || mdp == "") { 
        document.getElementById("msgErrConn").innerText = "Les champs 'Courriel' et 'Mot de passe' doivent être remplis.\n";
        return; 
    }
    membreSeConnecte(email, mdp); // requete ajax
}

// const btConnConn = document.getElementById("btConnConn");
// const mdpConn = document.getElementById("mdpConn")[0];

// mdpConn.addEventListener("keyup", function (event) {
//     if (event.key == "Enter") {
//         btConnConn.click();
//     }
// });

// function test000() {
//     const btConnConn = document.getElementById("btConnConn");
//     const mdpConn = document.getElementById("mdpConn")[0];

//     mdpConn.addEventListener("keyup", function (event) {
//         if (event.key == "Enter") {
//             btConnConn.click();
//         }
//     });
// }

// var connectionModal = document.getElementById("connectionModal");

// $('#connectionModal').on('keyup', function (event) {
//     alert("KEYUP");
//     // var keycode = (event.keyCode ? event.keyCode : event.which);
//     // if(keycode == '13'){
//     //   alert("AFTER ENTER clicked");
//     //   $('#getDataBt').click();   
//     // }
//   });

// $(document).keypress(function(e) {
//     if ($("#connectionModal").hasClass('show') && (e.key === "Enter")) {
//       alert("Enter is pressed");
//     }
// });

// const mdpConn = document.getElementById("mdpConn");
// mdpConn.addEventListener("keypress", function (e) {
//     alert("Enter is pressed 111");
// });

// const connectionModal = document.getElementById("connectionModal");
// connectionModal.addEventListener("keypress", function (e) {
//     alert("Enter is pressed 222");
// });

// document.getElementById("connectionModal").addEventListener("keyup", ({key}) => {
//     if (key === "Enter") {
//         alert("Enter is pressed 000");
//     }
// })