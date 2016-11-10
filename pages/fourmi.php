<?php
/**
 * Created by PhpStorm.
 * User: Barna
 * Date: 10/11/2016
 * Time: 12:45
 */?>
<div class="row">
    <div class="col s12 m3 l3">
        <div class="card-panel">
            <div class="row">
                <div class="input-field col s12">
                    <input id="nbfourmidepart" type="number" class="validate" value="15">
                    <label for="nbfourmidepart">Nombre de fourmis au départ</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="longuerbranche1" type="number" class="validate" value="5">
                    <label for="longuerbranche1">Longeur de la branche 1</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="longuerbranche2" type="number" class="validate" value="5">
                    <label for="longuerbranche2">Longeur de la branche 2</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="lapsdetemps" type="number" class="validate" value="1">
                    <label for="lapsdetemps">Laps de de temps </label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="quantitepheromone" type="number" class="validate" value="0">
                    <label for="quantitepheromone">Quantité de phéromone s'évaporant</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <p>
                        <input type="checkbox" id="probapheromon" />
                        <label for="probapheromon">Suivre le chemin de phérommone maximum</label>
                    </p>
                </div>
            </div>
            <a class="waves-effect waves-light btn" onclick="commencerSimulation()">Simuler</a>
        </div>
    </div>
    <div class="col s12 m8 l8">
        <svg width="960" height="700"></svg>
    </div>
    <div class="col s12 m1 l1">
        <p> Appuyer sur les touches espace ou a pour avancer dans la simulation </p>
        <p> Xp : Le nombre de fourmis Partant du nid vers la nourriture</p>
        <p> Xr : Le nombre de fourmis Rentrant de la nourriture vers le nid</p>
        <p> La quantité de phéromone est indiquée en rouge</p>
    </div>
</div>
<div class="row">
    <div class="col s12">

    </div>
</div>
<script src="../js/d3.min.js"></script>
<script src="../js/fisheye.js"></script>
<script>
    function commencerSimulation(){
        /*********************** DEBUT Génération du graphe **********************************/
        /*
         graphe
         -> node : tableau des noeuds du graphe
         -> id : id pour représenter le noeud
         -> group : couleur du noeud
         -> nbfourmip : le nombre de fourmi Partant du nid vers la nourriture
         -> nbfourmir : le nombre de fourmi Rentrant de la nourriture vers le nid
         -> pheromone :  la quantité de phéromone, la quantité minimale est 1
         -> tmp : utilisé lors du mouvement des fourmis
         -> link : tableau des liens du graphe
         -> source : la source de l'arc
         -> target : la destination de l'arc
         -> value : utilisé pour le calcul de la largeur de l'arc, éventuellement pour faire varier les arcs en fonction de la phéromone...
         */
        //Génération du nid et de la nouriture
        graph = { nodes : [
            { id : "nid" , group : 1 , nbfourmip : parseInt(document.getElementById("nbfourmidepart").value) , nbfourmir : 0 , pheromone : 1 , tmp : 0 },
            { id : "emb1" , group : 2 , nbfourmip : 0 , nbfourmir : 0 , pheromone : 1 , tmp : 0 },
            { id : "emb2" , group : 2 , nbfourmip : 0 , nbfourmir : 0 , pheromone : 1 , tmp : 0 },
            { id : "food" , group : 3 , nbfourmip : 0 , nbfourmir : 0 , pheromone : 1 , tmp : 0 }
        ],
            links : [
                { source : "nid" , target : "emb1" , value : 1 },
                { source : "emb2" , target : "food" , value : 1 }
            ]
        }
        //Génération du premier chemin
        for (var i = 0; i < document.getElementById("longuerbranche1").value ; i++ ){
            // Génération des cellules
            var cellule = { id : "c1_" + i , groupe : 2 , nbfourmip : 0 , nbfourmir : 0 , pheromone : 1 , tmp : 0 };
            graph.nodes.push(cellule);
            // Liaison des cellules entre elles
            if (i > 0){
                var ancienne = i-1;
                var liaison = { source : "c1_" + ancienne , target : "c1_"+i , value : 1 };
                graph.links.push(liaison);
            }
        }
        // Liaison du premier chemin et du nid
        var liaison = { source : "emb1" , target : "c1_0" , value : 1 }
        graph.links.push(liaison);
        // Liaison du premier chemin et de la nourriture
        liaison = { source : "c1_" + ( document.getElementById("longuerbranche1").value-1 ), target : "emb2" , value : 1 };
        graph.links.push(liaison);

        // Génération du deuxième chemin
        for (var i = 0; i < document.getElementById("longuerbranche2").value ; i++ ){
            // Génération des cellules
            var cellule = { id : "c2_" + i , groupe : 2 , nbfourmip : 0 , nbfourmir : 0 , pheromone : 1 , tmp : 0 };
            graph.nodes.push(cellule);
            // Liaison des cellules entre elles
            if (i > 0){
                var ancienne = i-1;
                var liaison = { source : "c2_" + ancienne , target : "c2_"+i , value : 1 };
                graph.links.push(liaison);
            }
        }
        // Liaison du deuxieme chemin et du nid
        var liaison = { source : "emb1" , target : "c2_0" , value : 1 }
        graph.links.push(liaison);
        // Liaison du deuxième chemin et de la nourriture
        liaison = { source : "c2_" + ( document.getElementById("longuerbranche2").value-1 ), target : "emb2" , value : 1 };
        graph.links.push(liaison);
        // console.log(graph); // Pour voire le graphe enlever le commentaire

        /***********************FIN Generation graphe**********************************/

        //Effacer le svg pour réinitialiser sans recharger la page
        $( "svg" ).empty();

        // Récupération de la hauteur et de la largeur du svg, utilisé lors de la mise à l'échelle
        var svg = d3.select("svg"),
            width = +svg.attr("width"),
            height = +svg.attr("height");

        var color = d3.scaleOrdinal(d3.schemeCategory20);

        // Lancement de la simulation du graphe
        var simulation = d3.forceSimulation()
            .force("link", d3.forceLink().id(function(d) { return d.id; }))
            .force("charge", d3.forceManyBody())
            .force("center", d3.forceCenter(width / 2, height / 2));

        // databinding des liens
        var link = svg.append("g")
            .attr("class", "links")
            .selectAll("line")
            .data(graph.links)
            .enter().append("line")
            .attr("stroke-width", function(d) { return Math.sqrt(d.value); });

        // databinding des noeuds
        var node = svg.append("g")
            .attr("class", "nodes")
            .selectAll("circle")
            .data(graph.nodes)
            .enter().append("circle")
            .attr("r", 5)
            .attr("fill", function(d) { return color(d.group); })
            .call(d3.drag()
                .on("start", dragstarted)
                .on("drag", dragged)
                .on("end", dragended));

        // ajout dy nom des noeuds, visible au passage de la souris
        node.append("title")
            .text(function(d) { return d.id; });

        simulation
            .nodes(graph.nodes)
            .on("tick", ticked);

        simulation.force("link")
            .links(graph.links);

        // Binding du texte du nombre de fourmis qui partent chercher la nouriture de chaque noeud
        textfourmip = svg.selectAll("text")
            .data(graph.nodes)
            .enter()
            .append("text").text(function(d) {
                return d.nbfourmip + "p";
            }).attr("font-size", "11px");

        // Binding du texte du nombre de fourmis qui rentrent avec la nouriture
        textfourmir = svg.selectAll("text.r")
            .data(graph.nodes)
            .enter()
            .append("text").text(function(d) {
                return d.nbfourmir + "r" ;
            }).attr("font-size", "11px");

        // Binding du texte de la phéromone
        textpheromone = svg.selectAll("text.ph")
            .data(graph.nodes)
            .enter()
            .append("text").text(function(d) {
                return d.pheromone + "p" ;
            }).attr("font-size", "11px")
            .attr("fill", "red");

        // Appliqué pour recalculer les cordonnées du graphe quand il y a un changement
        function ticked() {
            link
                .attr("x1", function(d) { return d.source.x; })
                .attr("y1", function(d) { return d.source.y; })
                .attr("x2", function(d) { return d.target.x; })
                .attr("y2", function(d) { return d.target.y; });
            node
                .attr("cx", function(d) { return d.x; })
                .attr("cy", function(d) { return d.y; });
            textfourmip
                .attr("x", function(d) { return d.x; })
                .attr("y", function(d) { return d.y - 5; });
            textfourmir
                .attr("x", function(d) { return d.x; })
                .attr("y", function(d) { return d.y + 15; });
            textpheromone
                .attr("x", function(d) { return d.x})
                .attr("y", function(d) { return d.y + 27; });
        }

        // Appliqué au débu du drag
        function dragstarted(d) {
            if (!d3.event.active) simulation.alphaTarget(0.3).restart();
            d.fx = d.x;
            d.fy = d.y;
        }

        // Appliqué lors du déplacement
        function dragged(d) {
            d.fx = d3.event.x;
            d.fy = d3.event.y;
        }

        // Appliqué à la fin du déplacement
        function dragended(d) {
            if (!d3.event.active) simulation.alphaTarget(0);
            d.fx = null;
            d.fy = null;
        }

        // Initialisation du fisheye pour la distortion
        var fisheye = d3.fisheye.circular()
            .radius(200)
            .distortion(2);

        // calcul des cordoonées lors du ficheyes
        svg.on("mousemove", function() {
            fisheye.focus(d3.mouse(this));

            node.each(function(d) { d.fisheye = fisheye(d); })
                .attr("cx", function(d) { return d.fisheye.x; })
                .attr("cy", function(d) { return d.fisheye.y; })
                .attr("r", function(d) { return d.fisheye.z * 4.5; });
            link.attr("x1", function(d) { return d.source.fisheye.x; })
                .attr("y1", function(d) { return d.source.fisheye.y; })
                .attr("x2", function(d) { return d.target.fisheye.x; })
                .attr("y2", function(d) { return d.target.fisheye.y; });
            textfourmip
                . attr("x", function(d) { return d.fisheye.x; })
                . attr("y", function(d) { return d.fisheye.y - 5; });
            textfourmir
                . attr("x", function(d) { return d.fisheye.x; })
                . attr("y", function(d) { return d.fisheye.y + 15; });
            textpheromone
                . attr("x", function(d) { return d.fisheye.x; })
                . attr("y", function(d) { return d.fisheye.y + 27; });
        });
    }
    /*************** FIN Initialisation *******************/


    d3.select("body").on("keydown", function () {
        // On fait une étape de la simulationquand on appuie sur la touche espace, a , ou flèche droite
        if (event.keyCode === 32 || event.keyCode === 65 || event.keyCode === 39) {
            // On parcours la boucle le nombre de laps de temps fois, pour n'effectuer l'affichage seulement à la fin
            for (var i = 0; i < document.getElementById("lapsdetemps").value; i++) {

                //si une fourmi atteint la nouriture on inverse sa direction
                var indexfood = graph.nodes.findIndex(function (e, i, a) {
                    if (e.id === "food") return i;
                });
                graph.nodes[indexfood].nbfourmir = graph.nodes[indexfood].nbfourmip;

                // on s'occupe dans un premier temps des fourmis qui vont depuis le nid vers la nourriture
                graph.nodes.forEach(function (node) {
                    // compteur pour le nombre de chemins
                    compteur = 0;
                    // compte la phéromone total depuis une cellule
                    totalpheromone = 0;
                    //on compte le nombre dechemins
                    graph.links.forEach(function (link) {
                        if (link.source.id == node.id) {
                            compteur = ++compteur;
                            // On calcule le phéromone total
                            totalpheromone += link.target.pheromone;
                        }
                    });
                    // On laisse de la phéromone
                    node.pheromone += node.nbfourmip;
                    // Le nid a toujours le phéromone de fourmis le quitant
                    if (node.id === "nid") node.pheromone = parseInt(document.getElementById("nbfourmidepart").value);

                    //faire progresser les fourmis en fonction du nombre de chemins et de la phéromone
                    //console.log("Les  fourmis " + node.nbfourmip + " se divisent en" + compteur + "avec un totalpheromone de" + totalpheromone);
                    graph.links.forEach(function (link) {
                        if (link.source.id == node.id) {
                            //calcul du nb de fourmi à déplacer
                            var nb_fourmi_a_deplacer = node.nbfourmip;
                            // si on a le choix entre plusieur chemins
                            if (compteur > 1) {
                                var pheromaxi = document.getElementById("probapheromon").checked;
                                // si on suit le chemin de phéromone maimum et qu'on n'a pas égalité, marche seulement pour 2 branches
                                if (pheromaxi && link.target.pheromone / totalpheromone !== 0.5) {
                                    if (link.target.pheromone / totalpheromone < 0.5) {
                                        // on suit le chemin de phromone maimum
                                        nb_fourmi_a_deplacer = 0;
                                    }
                                }
                                else {
                                    // on répartit les fourmis en fonction du phéromone
                                    nb_fourmi_a_deplacer = (node.nbfourmip * link.target.pheromone / totalpheromone >> 0);
                                    totalpheromone -= link.target.pheromone;
                                }
                                // on décrémente le compteur
                                compteur -= compteur;
                            }

                            //déplacer les fourmis dans le tmp
                            link.target.tmp += nb_fourmi_a_deplacer;

                            //supprimer les fourmis déplacé
                            node.nbfourmip -= nb_fourmi_a_deplacer;
                        }
                    });
                });

                // On actualise les fourmis dans nos données
                graph.nodes.forEach(function (node) {
                    node.nbfourmip = node.tmp;
                    if (node.id === "nid") node.nbfourmip = parseInt(document.getElementById("nbfourmidepart").value);
                    node.tmp = 0;
                });

                // Le retour des fourmis
                // Sensiblement le meme que pour les fourmis partant du nid à la différence des souces et des targets dans le graphe

                graph.nodes.forEach(function (node) {
                    compteur = 0;
                    totalpheromone = 0;
                    //on compte le nombre dechemins
                    graph.links.forEach(function (link) {
                        if (link.target.id == node.id) {
                            compteur = ++compteur;
                            totalpheromone = parseInt(totalpheromone) + parseInt(link.source.pheromone);
                        }
                    });
                    //Laisser du phéromone
                    node.pheromone += node.nbfourmir;
                    if (node.id === "nid") node.pheromone = parseInt(document.getElementById("nbfourmidepart").value);
                    /*faire progresser les fourmis en fonction du nombre de chemins, puis de la phéromone*/
                    //   console.log("Les  fourmis "+ node.nbfourmir +" se divisent en" +compteur + "avec un totalpheromone de" + totalpheromone);
                    graph.links.forEach(function (link) {
                        if (link.target.id == node.id) {
                            //calcul du nb de fourmi
                            var nb_fourmi_a_deplacer = node.nbfourmir;
                            if (compteur > 1) {
                                var pheromaxi = document.getElementById("probapheromon").checked;
                                if (pheromaxi && link.source.pheromone / totalpheromone != 0.5) {
                                    if (link.source.pheromone / totalpheromone < 0.5) {
                                        // on suit le chemin de phromone maimum
                                        nb_fourmi_a_deplacer = 0;
                                    }
                                }
                                else {
                                    nb_fourmi_a_deplacer = (node.nbfourmir * link.source.pheromone / totalpheromone >> 0);
                                    totalpheromone -= link.source.pheromone;
                                }
                                compteur -= compteur;
                            }

                            //déplacer les fourmis
                            link.source.tmp += nb_fourmi_a_deplacer;

                            //supprimer les fourmis déplacé si il ne s'agit pas du lit
                            node.nbfourmir -= nb_fourmi_a_deplacer;
                        }
                    });
                });

                var diminuepheromone = parseInt(document.getElementById("quantitepheromone").value)

                graph.nodes.forEach(function (node) {
                    // on met à jour le nombre de fourmis rentrant
                    node.nbfourmir = node.tmp;
                    // on diminue la phéromone
                    node.pheromone = node.pheromone - diminuepheromone;
                    // on considère que on peut avoir au minimum 1 de pheromone
                    if (node.pheromone < 1) node.pheromone = 1;
                    if (node.id === "nid") node.pheromone = parseInt(document.getElementById("nbfourmidepart").value);
                    node.tmp = 0;
                });


            }
            //mise à jour de l'affichage
            textfourmip.transition().text(function (d) {
                if (d.id === "food") return d.nbfourmip;
                return d.nbfourmip + "p";
            });
            textfourmir.transition().text(function (d) {
                if (d.id === "food") return "";
                return d.nbfourmir + "r";
            });
            textpheromone.transition().text(function (d) {
                return d.pheromone;
            });
        }
    });
</script>

