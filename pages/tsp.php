<?php
/**
 * Created by PhpStorm.
 * User: Barna
 * Date: 10/11/2016
 * Time: 12:58
 */
?>
<script src="https://openlayers.org/en/v3.19.1/build/ol.js"></script>
<link rel="stylesheet" href="https://openlayers.org/en/v3.19.1/css/ol.css" type="text/css">
<div class="row">
    <div class="col s12 m3 l3">
        <div class="card-panel">
            <div class="row">
                <div class="input-field col s12">
                    <input id="nbFourmi" type="number" class="validate" value="4">
                    <label for="nbFourmi">Nombre de fourmis</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="nbIter" type="number" class="validate" value="3">
                    <label for="nbIter">Nombre d'itérations</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="alpha" type="number" value="1">
                    <label for="alpha">Alpha</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="beta" type="number" value="1">
                    <label for="beta">Beta</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="evapPheromone" type="number" value="0.8">
                    <label for="evapPheromone">Taux d'évaporation du phéromone</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="chiffreQ" type="number" class="validate" value="1000">
                    <label for="chiffreQ">ChiffreQ</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <p>
                        <input type="checkbox" id="affichedet" />
                        <label for="affichedet">Afficher les détails</label>
                    </p>
                </div>
            </div>
            <a class="waves-effect waves-light btn" onclick="commencer_simulation(event)">Déployer les fourmis</a>
        </div>
    </div>
    <div class="col s12 m9 l9">
        <div id="map" class="map"></div>
        <p id="texto">Cliquer sur la carte pour sélectionner les villes.</p>
    </div>

</div>

<script>
    var raster = new ol.layer.Tile({
        source: new ol.source.OSM()
    });

    var sourcePoint = new ol.source.Vector({wrapX: false});
    var sourceTrait = new ol.source.Vector({wrapX: false});

    var vectorPoint = new ol.layer.Vector({
        source: sourcePoint
    });

    var vectorTrait = new ol.layer.Vector({
        source: sourceTrait
    });

    var map = new ol.Map({
        layers: [raster, vectorPoint, vectorTrait ],
        target: 'map',
        view: new ol.View({
            center: ol.proj.fromLonLat([5.72 , 45.2]),
            zoom: 6
        })
    });


    //  devient false quand on commence à générer le graphe, l'utilisateur arrete ainsi de dessiner sur la carte
    var ajoutPoint = true;

    // l'utilisateur dessine sur la carte
    var draw; // global pour qu'on puisse l'enlever plus tard
    function addInteraction() {
        var value = 'Point';
        if (ajoutPoint) {
            draw = new ol.interaction.Draw({
                source: sourcePoint,
                type: /** @type {ol.geom.GeometryType} */ ('Point')
            });
            map.addInteraction(draw);
        }
    }



    function commencer_simulation(event){
        var afDet = document.getElementById("affichedet").checked;

        // évite le rechargement de la carte
        event.preventDefault();
        // le tableau des points que l'utilisateur à dessiner
        var tabPoint = sourcePoint.getFeatures();
        var nbVilles = tabPoint.length;

        sourceTrait.clear();

        // pour retenir le chemin optimal
        var distanceMin = Number.MAX_SAFE_INTEGER;
        var cheminMin = [];
        // on vérifie que l'utilisateur a bien saisi au moins 3 villes
        if (nbVilles < 3){
            alert("Il faut au moins 3 villes! ");
            return false;
        }
        // bloque l'ajout de point par l'utilisateur
        ajoutPoint = false;
        // structure chemin contient les infos sur les chemins, la distance et la phéromone
        var structureChemin = new Array();
        for(var i = 0 ; i < nbVilles ; i++){
            structureChemin[i] = new Array();
        }

        // initialisation de la structure des chemins
        for (var i = 0 ; i < nbVilles ; i++ ){
            for (var j = 0 ; j < nbVilles ; j++ ){
                if (i !== j ){
                    // récupération des coordonnées du point a et du point b
                    var coordA = tabPoint[i].getGeometry().getCoordinates();
                    var coordB = tabPoint[j].getGeometry().getCoordinates();

                    // création des chemins sur la carte
                    var linestring_feature = new ol.Feature({
                        geometry: new ol.geom.LineString(
                            [coordA, coordB]
                        )
                    });
                    // affichage des chemins
                    sourceTrait.addFeature(linestring_feature);

                    // calcul de la distance, nous obtenons les distences précis au mm près
                    var distance =  Math.sqrt( Math.pow(coordB[0]-coordA[0], 2 ) + Math.pow(coordB[1]-coordA[1], 2 ) );
                    // on simplifie la distance au km près pour simplifier les calculs
                    distance = ~~(distance / 1000);
                    //pour afficher les distances entre les villes en km décommenter la ligne
                    //   console.log(distance);
                    structureChemin[i][j] = {pheromone : 1,
                        distance : distance};
                }
                else{
                    structureChemin[i][j] = {};
                }
            }
        }

        if (afDet) {
            console.log("Structure des chemins" + structureChemin);
        }
        // mise en place des fourmis
        var nbFourmi = parseInt(document.getElementById("nbFourmi").value);
        if (nbFourmi < 1 ){
            alert("Il doit y avoire au moins une fourmie");
            return false;
        }
        var structureFourmi = new Array();
        // compteur pour répartir les villes
        var compteur = 0;

        for (var i = 0 ; i < nbFourmi ; i++){

            var listeTabou = new Array(nbVilles);
            listeTabou.fill(false);

            structureFourmi.push({ villeActuelle : compteur,
                listeTabou : listeTabou,
                longueurItineraire : 0,
                villeDepart : compteur,
                memoire : [compteur]             // pour mémoriser le chemin parcouru
            });
            // ajout de la ville actuelle dans la liste tabou
            structureFourmi[i].listeTabou[compteur] = true;
            // décomenter pour avoir au moins une fourmie sur chaque ville
            /* if (compteur < tabPoint.length -1)
             compteur++;
             else*/
            compteur = getRandomInt(0 , tabPoint.length);
        }
        // Pour afficher la structure des chemins et des fourmis décommenter les lignes

        //console.log(structureFourmi);
        // Pour supprimer le draw de la carte, permet d'éviter les bugs
        map.removeInteraction(draw);

        /*************Cycle fourmi********************************/
            // récupération du nombre d'itération
        var nbIter = parseInt(document.getElementById("nbIter").value);
        // récupération d'alpha
        var alpha = document.getElementById("alpha").value;
        // récupération de beta
        var beta = document.getElementById("beta").value;
        // pour chaque itération
        for( var i = 0 ; i < nbIter ; i++){
            // pour chaque fourmi
            for( var j = 0 ; j < nbFourmi ; j++ ){
                // tant que toutes les villes n'ont pas été visités
                while (structureFourmi[j].listeTabou.some(function(e,i,t){ return e === false }) ) {
                    // déterminer statistiquement le chemin à suivre
                    // détermination des villes qui ne sont pas dans le tabou et calculer leurs intensité et leur visibilité
                    var tableauProba = new Array(nbVilles);
                    tableauProba.fill(0);
                    for (var k = 0 ; k < nbVilles ; k++ ){
                        // si la ville n'est pas tabou
                        if ( ! structureFourmi[j].listeTabou[k] && structureFourmi[j].villeActuelle !== k){
                            // calcul de la proba
                            if (afDet) {
                                console.log("alpha = " + Math.pow(structureChemin[structureFourmi[j].villeActuelle][k].pheromone, alpha));
                                console.log("beta = " + Math.pow(1 / structureChemin[structureFourmi[j].villeActuelle][k].distance, beta));
                            }
                            tableauProba[k] = Math.pow(structureChemin[structureFourmi[j].villeActuelle][k].pheromone, alpha ) * Math.pow(1/structureChemin[structureFourmi[j].villeActuelle][k].distance, beta );
                        }
                    }
                    // calcule de la somme des probas
                    //var sommeProba = tableauProba.reduce(function(a,b){ return a + b }, 0);
                    // pour rechercher la ville de proba max, il suffit de retourner le maimumdu tableau
                    var indexProbaMax = indexOfMax(tableauProba);

                    if (afDet) {
                        console.log("tableau des probas" + tableauProba);
                    }

                    // incrémenter la longueur de l'itinéraire
                    structureFourmi[j].longueurItineraire += structureChemin[structureFourmi[j].villeActuelle][indexProbaMax].distance;

                    // placer la ville actuelle dans la liste tabou et se déplacer sur la ville suivante
                    //structureFourmi[j].listeTabou[structureFourmi[j].villeActuelle] = true;
                    structureFourmi[j].listeTabou[indexProbaMax] = true;
                    structureFourmi[j].villeActuelle = indexProbaMax;
                    structureFourmi[j].memoire.push(indexProbaMax);
                    if (afDet) {
                        console.log("longeur de l'itinéraire " + structureFourmi[j].longueurItineraire);
                    }
                }
                // si toutes les villes ont été visités on retourne au point de départ, on incrémente la longueur de l'itinéraire
                structureFourmi[j].longueurItineraire += structureChemin[structureFourmi[j].villeActuelle][structureFourmi[j].villeDepart].distance;
            }

            /*************************Mise à jour du phéromone**************************/
                // on diminue la phéromone
            var evapPheromone = document.getElementById("evapPheromone").value;
            for (var j = 0 ; j < nbVilles ; j++){
                for (var k = 0 ; k < nbVilles ; k++){
                    if ( k !== j){
                        structureChemin[j][k].pheromone = structureChemin[j][k].pheromone * evapPheromone;
                        // si moins que 1 remise à un
                        // if (structureChemin[j][k].pheromone < 1)
                        //    structureChemin[j][k].pheromone = 1;
                    }
                }
            }
            // on ajoute la phéromone que chaque fourmie a laisé
            var chiffreQ = document.getElementById("chiffreQ").value ;


            structureFourmi.forEach( function(f){
                // parcours de la mémoire
                if (afDet) {
                    console.log("longeur de l'itinéraire" + f.longueurItineraire);
                }
                for (var j = 0 ; j < nbVilles-1 ; j++){
                    if (afDet) {
                        console.log("pheromone avant: " + structureChemin[f.memoire[j]][f.memoire[j + 1]].pheromone);
                    }
                    structureChemin[f.memoire[j]][f.memoire[j+1]].pheromone += chiffreQ / f.longueurItineraire;
                    if (afDet) {
                        console.log("pheromone après: " + structureChemin[f.memoire[j]][f.memoire[j + 1]].pheromone);
                    }
                    structureChemin[f.memoire[j+1]][f.memoire[j]].pheromone += chiffreQ / f.longueurItineraire;
                }
                // le dernier et le premierif (afDet)
                if (afDet) {
                    console.log("pheromone avant: " + structureChemin[f.memoire[f.memoire.length-1]][f.memoire[0]].pheromone);
                }
                structureChemin[f.memoire[f.memoire.length-1]][f.memoire[0]].pheromone += chiffreQ / f.longueurItineraire;
                if (afDet) {
                    console.log("pheromone après: " + structureChemin[f.memoire[f.memoire.length-1]][f.memoire[0]].pheromone);
                }
                if (afDet) {
                    console.log("pheromone avant: " + structureChemin[f.memoire[0]][f.memoire[f.memoire.length-1]].pheromone);
                }
                structureChemin[f.memoire[0]][f.memoire[f.memoire.length-1]].pheromone += chiffreQ / f.longueurItineraire;
                if (afDet) {
                    console.log("pheromone après: " + structureChemin[f.memoire[0]][f.memoire[f.memoire.length-1]].pheromone);
                }


                // si une fourmi a fait un meilleur score on garde sa mémoire
                if(f.longueurItineraire < distanceMin){
                    if (afDet) {
                        console.log("Ancienne distance: " + f.longueurItineraire + " Nouvelle Distance : " + distanceMin);
                    }
                    distanceMin = f.longueurItineraire;
                    cheminMin = f.memoire;
                }
            });

            // on remet à 0 la mémoire des fourmis
            structureFourmi.forEach(function(f){
                f.listeTabou.fill(false);
                f.listeTabou[f.villeDepart] = true;
                f.memoire = [f.villeDepart];
                f.villeActuelle = f.villeDepart;
                f.longueurItineraire = 0;
            });

            //affichage des chemins
            if (afDet) {
                for (var t = 0; t < nbVilles; t++) {
                    for (var v = t + 1; v < nbVilles; v++) {
                        console.log(t + " -> " + v + " = " + structureChemin[t][v].pheromone);
                    }
                }
            }

        }

        if (afDet) {
            console.log("le chemin minaml mesure : " + distanceMin);
            console.log(cheminMin);
        }

        document.getElementById("texto").innerHTML = "Le chemin de longueur minimal trouvé par les fourmis est de " + distanceMin + " km. <br/>" ;

        /*Dessiner le chemin minimal en rouge*/
        console.log(cheminMin);
        for (var i = 0 ; i < cheminMin.length-1 ; i++){
            var coordA = tabPoint[cheminMin[i]].getGeometry().getCoordinates();
            var coordB = tabPoint[cheminMin[i+1]].getGeometry().getCoordinates();
            var linestring_feature = new ol.Feature({
                geometry: new ol.geom.LineString(
                    [coordA, coordB]
                )
            });
            var monstyle = new ol.style.Style({
                stroke: new ol.style.Stroke({
                    color: 'red',
                    width: 5
                })
            })
            linestring_feature.setStyle(monstyle);
            sourceTrait.addFeature(linestring_feature);
        }
        var coordA = tabPoint[cheminMin[0]].getGeometry().getCoordinates();
        var coordB = tabPoint[cheminMin[cheminMin.length-1]].getGeometry().getCoordinates();
        var linestring_feature = new ol.Feature({
            geometry: new ol.geom.LineString(
                [coordA, coordB]
            )
        });
        var monstyle = new ol.style.Style({
            stroke: new ol.style.Stroke({
                color: 'red',
                width: 5
            })
        });
        linestring_feature.setStyle(monstyle);
        sourceTrait.addFeature(linestring_feature);

    }

    // fin simulation


    addInteraction();

    // fonction qui renvoie l'inde du maimum du tableau
    function indexOfMax(arr) {
        if (arr.length === 0) {
            return -1;
        }

        var max = arr[0];
        var maxIndex = 0;

        for (var i = 1; i < arr.length; i++) {
            if (arr[i] > max) {
                maxIndex = i;
                max = arr[i];
            }
        }

        return maxIndex;
    }

    // On renvoie un entier aléatoire entre une valeur min (incluse)
    // et une valeur max (exclue).
    // Attention : si on utilisait Math.round(), on aurait une distribution
    // non uniforme !
    function getRandomInt(min, max) {
        min = Math.ceil(min);
        max = Math.floor(max);
        return Math.floor(Math.random() * (max - min)) + min;
    }


</script>

