let validerFormEnregPartOne = () => {
    const pass = document.getElementById('mdp').value;
    const cpass = document.getElementById('cmdp').value;
    if(pass !== cpass){
        document.getElementById('msgErrEnreg').innerHTML = "Les mots de passe sont différents!";
        setInterval(() => {
            document.getElementById('msgErrEnreg').innerHTML = "";
        },5000);
    }else{
        const email = document.getElementById('email').value;
        membreExiste(email);
    }
}

let validerFormEnregPartTwo = (reponse) => {
    if(reponse == 'false'){
        document.getElementById('enreg_btn').removeAttribute('disabled');
    }else{
        document.getElementById('msgErrEnreg').innerHTML = "Un compte associé avec cette adresse courriel existe déjà!";
        setInterval(() => {
            document.getElementById('msgErrEnreg').innerHTML = "";
        },5000);
    }
}









let initialiser = (reponse) => {
    console.log("la réponse "+reponse);
    for(let i = 0; i < reponse.length; i++){
        let produit = `
            <div class="product-img">
                <img src="${reponse[i].chemin_img}" alt="">
                <div class="product-label">
                    <span class="sale">-30%</span>
                    <span class="new">NEW</span>
                </div>
            </div>
            <div class="product-body">
                <p class="product-category">${reponse[i].categorie}</p>
                <h3 class="product-name"><a href="#">${reponse[i].nom_prod.substring(0,15)}</a></h3>
                <h4 class="product-price">$${reponse[i].prix} <del class="product-old-price">$990.00</del></h4>
                <div class="product-rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <div class="product-btns">
                    <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                    <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                    <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                </div>
            </div>
            <div class="add-to-cart">
                <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
            </div>`;
            let idIndexHTML = "produit"+(i+1);
            
            console.log(idIndexHTML);
            document.getElementById("produit1").innerHTML = produit;
    }
};
 







