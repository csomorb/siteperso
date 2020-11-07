<?php
/**
 * Created by PhpStorm.
 * User: Barnabas Csomor
 * Date: 12/10/2016
 * Time: 23:50
 */
?>

<div class="parallax-container">
    <div class="parallax"><img src="../img/a1.png" class="responsive-img" alt="Barnabas Csomor"></div>
</div>
<div class="section white">
    <div class="row container">
        <div class="col s12 m6 l3">
            <img src="../img/a3.JPG" class="responsive-img" alt="Csomor Barnabas">
        </div>
        <div class="col s12 m6 l9">
        <h2 class="header">Who am I ?</h2>
        <p class="grey-text text-darken-3 lighten-3">29 ans, développeur Full Stack, d'origine hongroise,
            je suis passioné par les nouvelles technologies du web et le dévloppement mobile.</p>
        </div>
    </div>
    <div class="row container">
        <a href="/dev">
            <div class="col s12 m4 l4 t1">
               <h3 class="center">Développement web</h3>
                <p class="p-black">
                    J'ai commencé à m'intéresser au développement web il y a 10 ans, depuis j'ai acquis des compétances dans différents domaines. Vous pouvez lire ici mes compétences.
                </p>
            </div>
        </a>
        <a href="/parcours">
            <div class="col s12 m4 l4 t2">
                <h3 class="center">Mon parcours</h3>
                <p class="p-black">
                    Après un master informatique spécialisé dans le web, j'ai continué en tant que développeur JavaScript pour un ERP durant 1 an, puis en tant que dev Full Stack, vous pouvez lire ici mon parcours universitaire et mes expériences professionnelles.
                </p>
            </div>
        </a>
        <a href="/hobbies">
            <div class="col s12 m4 l4 t3">
                <h3 class="center">Mes autres centres d'intérêt</h3>
                <p class="p-black">
                    Marié depuis peu, je pratique plusieurs sports de montagne, dont l'alpinisme, le ski de rando et l'escalade. Je m'étais engagé dans le scoutisme durant plusieurs années. J'ai passé 5 mois en Asie, 3 mois en écosse et voyagé dans d'autres pays d'europe.
                </p>
            </div>
        </a>
    </div>
</div>
<div class="parallax-container">
    <div class="parallax"><img src="../img/a2.jpg" class="responsive-img" alt="Coder bien"></div>
</div>
<div id="contact" class="section white">
    <div class="row container">
        <h2 class="header">Contact</h2>
        <p class="grey-text text-darken-3 lighten-3">
            Barnabas Csomor<br/>
            Développeur Web<br/>
            E-mail: csomorbarnabas@yahoo.com <br/>
            Téléphone: <a href="tel:0771799678">07 71 79 96 78</a> <br/>
            <a href="../files/cv_Barnabas_Csomor.pdf" target="_blank">Mon Curiculum Vitae</a>
        </p>
    </div>

</div>

<script>
    $(document).ready(function(){
        $('.t1,.t2,.t3').hide();
        var options = [
            {selector: '.t1', offset: 400, callback: function(el) { $(el).fadeIn("slow");}},
            {selector: '.t2', offset: 400, callback: function(el) { $(el).fadeIn(3000);}},
            {selector: '.t3', offset: 400, callback: function(el) { $(el).fadeIn(4000);}},
          ];
        Materialize.scrollFire(options);
        $('.parallax').parallax();
    });
</script>

