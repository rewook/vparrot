$(document).ready( function() {
    let vehicules = $("#vehicule-list li");

    //Filtre Prix
    $( "#slider-range" ).slider({
        range: true,
        min: 400,
        max: 50000,
        values: [ 1000, 30000 ],
        slide: function( event, ui ) {
            $( "#amount" ).val( ui.values[ 0 ] + "€ -"  + ui.values[ 1 ] + " €" );

        }
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
        " - $" + $( "#slider-range" ).slider( "values", 1 ) );

    //Filtre Kilometre
    $( "#slider-kilometre" ).slider({
        range: true,
        min: 400,
        max: 400000,
        values: [ 1000, 200000 ],
        slide: function( event, ui ) {
            $( "#kilometre" ).val( ui.values[ 0 ] + "€ -"  + ui.values[ 1 ] + " €" );

        }
    });
    $( "#kilometre" ).val( $( "#slider-kilometre" ).slider( "values", 0 ) +
        " - " + $( "#slider-kilometre" ).slider( "values", 1 ) );

    //Filtre Année mise en circulation
    var date_en_cours = new Date();
    var annee_en_cours = date_en_cours.getFullYear();
    var anneeMax= annee_en_cours;
    var anneeMin = annee_en_cours - 25;
    $( "#slider-annee_mec" ).slider({
        range: true,
        min: anneeMin,
        max: anneeMax,
        values: [ anneeMin, anneeMax ],
        slide: function( event, ui ) {
            $( "#annee_mec" ).val( ui.values[ 0 ] + " - "  + ui.values[ 1 ]);

        }
    });
    $( "#annee_mec" ).val( $( "#slider-annee_mec" ).slider( "values", 0 ) +
        " - " + $( "#slider-annee_mec" ).slider( "values", 1 ) );

    $( "#slider-range, #slider-kilometre, #slider-annee_mec" ).on("slidechange",function (event,ui){
            var prixMin = $("#slider-range").slider("values", 0);
            var prixMax = $("#slider-range").slider("values", 1);
            var kilometreMin =$("#slider-kilometre").slider("values", 0);
            var kilometreMax =$("#slider-kilometre").slider("values", 1);
            var anneeMin = $("#slider-annee_mec").slider("values", 0);
            var anneeMax = $("#slider-annee_mec").slider("values", 1);

            console.log(prixMin,prixMax);
            let urlprix = "/filtreprix";
            // Envoyer une requête AJAX pour récupérer les résultats filtrés
            $.ajax({
                url: urlprix,
                type: "POST",
                data: {
                    minPrix: prixMin,
                    maxPrix: prixMax,
                    minKilometre: kilometreMin,
                    maxKilometre: kilometreMax,
                    minAnnee: anneeMin,
                    maxAnnee: anneeMax,

                },
                success: function(response) {
                   console.log(response); // Mettre à jour la partie de la page affichant les résultats

                    $('.card-container').empty();
                    var occasions = response.occasions;
                    // Parcourir les données du tableau et mettre à jour les cards
                    var rowHTML = ''; // Initialise une variable pour stocker le HTML de la ligne actuelle
                    occasions.forEach(function(element, index) {
                        var imagePath = element.imageocc;
                        console.log(index);
                        // Ajoute le HTML de la card à la ligne actuelle
                        rowHTML += `<div class="card border-0 col-md-4 col-sm-4 col-lg-4 col-xs-4">
                        <div class="card-title mt-3">${element.titre}</div>
                        <img src="${imagePath}"  class="card-img-top" alt="image du service">
                        <div class="card-body mt-1">                            
                                <p class="card-text mt-2">Année: <b>${element.annee}</b>, Kilométrage: <b>${element.kilometrage} Km</b>, Tarif: <b>${element.prix} €</b></p>
                                <a href="#"><input type="button" class="btn btn-secondary" value="En savoir + ..."></a> 
                        </div></div>
                        `;


                        // Ajoute la ligne au conteneur chaque fois qu'on a ajouté trois cards
                         if ((index + 1) % 3 === 0 || (index + 1) === response.occasions.length) {
                             $('.card-container').append('<div class="card-row">' + rowHTML + '</div>');
                             rowHTML = ''; // Réinitialise la variable rowHTML pour la prochaine ligne
                         }
                        // if ((index + 1) % 3 === 0 || (index + 1) === response.occasions.length) {
                        //     rowHTML += '</div><div class="row">';
                        // }
                    });

                }
            });

                }
            );
});











