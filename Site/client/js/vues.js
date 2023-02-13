// let creerVue = (action, donnees) => {
//     // Contrôleur vue
//     switch(action){
//         case "enregistrer":
//             break;
//         case "modifier":
//             break;
//         case "enlever" :
//             // afficherMessage(donnees);
//             break;
//         case "lister" :
//             //alert(donnees[0].titre);
//             lister(donnees);
//             break;
//     }
// }


// let lister = (listeProduits) => {
//     let contenu = `<div class='row'>
//                         <table class="table">

//                             <thead class="thead-dark">
//                                 <tr>
//                                     <th scope="col">#</th>
//                                     <th scope="col">Photo</th>
//                                     <th scope="col">Nom</th>
//                                     <th scope="col">Catégorie</th>
//                                     <th scope="col">Modèle</th>
//                                     <th scope="col">Fabricant</th>
//                                     <th scope="col">Prix</th>
//                                     <th scope="col">Qté total</th>
//                                     <th scope="col">Qté vendue</th>
//                                 </tr>
//                             </thead>

//                             <tbody>
//     `;
//     for(let unProduit  of listeProduits){
//         contenu += creerRangee(unProduit);
//     }
//     contenu += `
//                             </tbody>

//                         </table>
//                     </div>
//     `;
//     document.getElementById('affichageAdmin').innerHTML = contenu;
// }


// let creerRangee = (unProduit) => {
//     return `
//             <tr>
//                 <th scope="row">${unProduit.id_prod}</th>
//                 <td>${unProduit.id_prod}</td>
//                 <td><img src="${unProduit.chemin_img}" class="imgTable" alt="image du produit"></td>
//                 <td>@${unProduit.nom_prod}</td>
//                 <td>@${unProduit.categorie}</td>
//                 <td>@${unProduit.modele}</td>
//                 <td>@${unProduit.fabricant}</td>
//                 <td>@${unProduit.prix}</td>
//                 <td>@${unProduit.qte_totale}</td>
//                 <td>@${unProduit.qte_vendue}</td>
//             </tr>
//     `;
// }
