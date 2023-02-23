let validerFormEnregPartOne = () => {
    const pass = document.getElementById("mdp").value;
    const cpass = document.getElementById("cmdp").value;
    if (pass !== cpass) {
        document.getElementById("msgErrEnreg").innerHTML =
            "Les mots de passe sont différents!";
        setInterval(() => {
            document.getElementById("msgErrEnreg").innerHTML = "";
        }, 5000);
    } else {
        const email = document.getElementById("email").value;
        membreExiste(email); // requete ajax
    }
};

let validerFormEnregPartTwo = (reponse) => {
    if (reponse == "false") {
        document.getElementById("enreg_btn").removeAttribute("disabled");
    } else {
        document.getElementById("msgErrEnreg").innerHTML =
            "Un compte associé avec cette adresse courriel existe déjà!";
        setInterval(() => {
            document.getElementById("msgErrEnreg").innerHTML = "";
        }, 5000);
    }
};
