<?php
/**
 * Created by PhpStorm.
 * User: Barnabas Csomor
 * Date: 12/10/2016
 * Time: 23:50
 */
?>

<div class="parallax-container">
    <div class="parallax"><img src="../img/a1.png" class="responsive-img"></div>
</div>
<div class="section white">
    <div class="row container">
        <div class="col s12 l4">
            <img src="../img/a3.JPG" class="responsive-img" alt="Csomor Barnabas">
        </div>
        <div class="col s12 l8">
        <h2 class="header">Who am I ?</h2>
        <p class="grey-text text-darken-3 lighten-3">25 ans, en master 2 Web Informatique et Connaissance à l'Université Grenoble Alpes, de nationalité hongroise,
            je suis passioné par les nouvelles technologies du web et les sports de montagne.</p>
        </div>
    </div>
    <div class="row container">
        <div class="col s12 m4 l4">
           <h3 class="center"><a href="/dev">Développement web</a></h3>
            <p>
                J'ai commencé à m'intéresser au développement web il y a 8 ans, depuis j'ai acquis des compétances dans différents domaines lors des cours, de la création de sites web et de stages.
            </p>
        </div>
        <div class="col s12 m4 l4">
            <h3 class="center"><a href="/dev">Mon parcours</a></h3>
            <p>
                Après avoir obtenu mon baccalauréat en Hongrie, j'ai décidé de partir pour la France pour me former en informatique, vous pouvez lire ici mon parcours universitaire et mes expériences professionnelles.
            </p>
        </div>
        <div class="col s12 m4 l4">
            <h3 class="center"><a href="/hobbies">Mes autres centres d'intérêt</a></h3>
            <p>
                Je pratique plusieurs sports de montagne, dont l'alpinisme, le ski de rando et l'escalade. Je m'étais engagé dans le scoutisme durant plusieurs années. J'ai voyagé dans d'autres pays, continent.
            </p>
        </div>
    </div>
</div>
<div class="parallax-container">
    <div class="parallax"><img src="../img/a2.png" class="responsive-img"></div>
</div>
<div id="contact" class="section white">
    <div class="row container">
        <h2 class="header">Contact</h2>
        <p class="grey-text text-darken-3 lighten-3">
            Barnabas Csomor</br>
            Développeur Web<br/>
            E-mail: csomorbarnabas@yahoo.com <br/>
            Téléphone: 07 81 36 88 90 <br/>
            <a href="../files/cv_Barnabas_Csomor.pdf" target="_blank">Mon Curiculum Vitae</a>
        </p>
    </div>

</div>

<script>
    $(document).ready(function(){
        $('.parallax').parallax();
    });
</script>

