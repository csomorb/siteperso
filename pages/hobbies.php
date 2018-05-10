<?php
/**
 * Created by PhpStorm.
 * User: Barna
 * Date: 17/10/2016
 * Time: 09:29
 */
?>
<!-- Core JS file -->
<script src="../js/photoswipe.min.js"></script>

<!-- UI JS file -->
<script src="../js/photoswipe-ui-default.min.js"></script>
<div class="container">
    <h1 class="center">Mes centres d'intérêt</h1>

    <h2>La montagne</h2>

    <p class="just">Passionné par l'univers de la montagne et photographe amateur depuis mon jeune âge, je pratique l'alpinisme, l'escalade et le ski de randonnée.</p>

    <!-- Root element of PhotoSwipe. Must have class pswp. -->
    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

        <!-- Background of PhotoSwipe.
             It's a separate element as animating opacity is faster than rgba(). -->
        <div class="pswp__bg"></div>

        <!-- Slides wrapper with overflow:hidden. -->
        <div class="pswp__scroll-wrap">

            <!-- Container that holds slides.
                PhotoSwipe keeps only 3 of them in the DOM to save memory.
                Don't modify these 3 pswp__item elements, data is added later on. -->
            <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>

            <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
            <div class="pswp__ui pswp__ui--hidden">

                <div class="pswp__top-bar">

                    <!--  Controls are self-explanatory. Order can be changed. -->

                    <div class="pswp__counter"></div>

                    <button class="pswp__button pswp__button--close" title="Fermer (Esc)"></button>

                    <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                    <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                    <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
                    <!-- element will get class pswp__preloader--active when preloader is running -->
                    <div class="pswp__preloader">
                        <div class="pswp__preloader__icn">
                            <div class="pswp__preloader__cut">
                                <div class="pswp__preloader__donut"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                    <div class="pswp__share-tooltip"></div>
                </div>

                <button class="pswp__button pswp__button--arrow--left" title="Précédent (arrow left)">
                </button>

                <button class="pswp__button pswp__button--arrow--right" title="Suivant (arrow right)">
                </button>

                <div class="pswp__caption">
                    <div class="pswp__caption__center"></div>
                </div>

            </div>

        </div>

    </div>

    <div class="my-gallery" itemscope itemtype="http://schema.org/ImageGallery">

        <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <a href="../img/d1.jpg" itemprop="contentUrl" data-size="1024x683">
                <img src="../img/d1.jpg" itemprop="thumbnail" alt="Dans la sortie des chourums du grand Ferrand" />
            </a>
            <figcaption itemprop="caption description">Dans la sortie des chourums du grand Ferrand</figcaption>

        </figure>

        <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <a href="../img/d2.jpg" itemprop="contentUrl" data-size="1024x683">
                <img src="../img/d2.jpg" itemprop="thumbnail" alt="Grimpe à Ceüse" />
            </a>
            <figcaption itemprop="caption description">Grimpe à Ceüse</figcaption>
        </figure>

        <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <a href="../img/d3.jpg" itemprop="contentUrl" data-size="1024x683">
                <img src="../img/d3.jpg" itemprop="thumbnail" alt="Vercors" />
            </a>
            <figcaption itemprop="caption description">Traversée du Vercors</figcaption>
        </figure>

        <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <a href="../img/d4.jpg" itemprop="contentUrl" data-size="1024x683">
                <img src="../img/d4.jpg" itemprop="thumbnail" alt="Mont Blanc" />
            </a>
            <figcaption itemprop="caption description">Au sommet du Mont Blanc</figcaption>
        </figure>

        <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <a href="../img/d5.jpg" itemprop="contentUrl" data-size="1024x683">
                <img src="../img/d5.jpg" itemprop="thumbnail" alt="Ski de rando en Vanoise" />
            </a>
            <figcaption itemprop="caption description">Ski de rando en Vanoise</figcaption>
        </figure>

        <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <a href="../img/d6.jpg" itemprop="contentUrl" data-size="1024x683">
                <img src="../img/d6.jpg" itemprop="thumbnail" alt="Domes de miage" />
            </a>
            <figcaption itemprop="caption description"> Dômes de Miage</figcaption>
        </figure>

        <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <a href="../img/d7.jpg" itemprop="contentUrl" data-size="1024x683">
                <img src="../img/d7.jpg" itemprop="thumbnail" alt="Aiguille Verte" />
            </a>
            <figcaption itemprop="caption description">Lac Blanc</figcaption>
        </figure>

        <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <a href="../img/d8.jpg" itemprop="contentUrl" data-size="1024x683">
                <img src="../img/d8.jpg" itemprop="thumbnail" alt="Aiguillette d'argentière" />
            </a>
            <figcaption itemprop="caption description">Aiguilette d'Argentière</figcaption>
        </figure>

        <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <a href="../img/d9.jpg" itemprop="contentUrl" data-size="1024x683">
                <img src="../img/d9.jpg" itemprop="thumbnail" alt="couloir" />
            </a>
            <figcaption itemprop="caption description">Descente de couloir</figcaption>
        </figure>

        <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <a href="../img/d10.jpg" itemprop="contentUrl" data-size="1024x683">
                <img src="../img/d10.jpg" itemprop="thumbnail" alt="Ski" />
            </a>
            <figcaption itemprop="caption description">Ski de randonnée - Vanoise</figcaption>
        </figure>

        <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <a href="../img/d11.jpg" itemprop="contentUrl" data-size="1024x683">
                <img src="../img/d11.jpg" itemprop="thumbnail" alt="Bivouac" />
            </a>
            <figcaption itemprop="caption description">Bivouac</figcaption>
        </figure>

        <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <a href="../img/d12.jpg" itemprop="contentUrl" data-size="1024x683">
                <img src="../img/d12.jpg" itemprop="thumbnail" alt="Callanques" />
            </a>
            <figcaption itemprop="caption description">La Siotat</figcaption>
        </figure>

        <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <a href="../img/d13.jpg" itemprop="contentUrl" data-size="1024x683">
                <img src="../img/d13.jpg" itemprop="thumbnail" alt="lac" />
            </a>
            <figcaption itemprop="caption description">Au frais</figcaption>
        </figure>

        <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <a href="../img/d14.jpg" itemprop="contentUrl" data-size="1024x683">
                <img src="../img/d14.jpg" itemprop="thumbnail" alt="homme" />
            </a>
            <figcaption itemprop="caption description">L'homme est petit, la création immense</figcaption>
        </figure>

        <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <a href="../img/d15.jpg" itemprop="contentUrl" data-size="1024x683">
                <img src="../img/d15.jpg" itemprop="thumbnail" alt="homme" />
            </a>
            <figcaption itemprop="caption description">Sur le glacier</figcaption>
        </figure>

        <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <a href="../img/d16.jpg" itemprop="contentUrl" data-size="1024x683">
                <img src="../img/d16.jpg" itemprop="thumbnail" alt="igloo" />
            </a>
            <figcaption itemprop="caption description">Igloo</figcaption>
        </figure>

        <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <a href="../img/d17.jpg" itemprop="contentUrl" data-size="1024x683">
                <img src="../img/d17.jpg" itemprop="thumbnail" alt="ski" />
            </a>
            <figcaption itemprop="caption description">Tout est sous contrôle</figcaption>
        </figure>

        <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <a href="../img/d18.jpg" itemprop="contentUrl" data-size="1024x683">
                <img src="../img/d18.jpg" itemprop="thumbnail" alt="aiuille verte" />
            </a>
            <figcaption itemprop="caption description">Sous l'aiguille verte</figcaption>
        </figure>

        <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <a href="../img/d19.jpg" itemprop="contentUrl" data-size="1024x683">
                <img src="../img/d19.jpg" itemprop="thumbnail" alt="escalade" />
            </a>
            <figcaption itemprop="caption description">En grande voie</figcaption>
        </figure>

        <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <a href="../img/d20.jpg" itemprop="contentUrl" data-size="1024x683">
                <img src="../img/d20.jpg" itemprop="thumbnail" alt="escalade" />
            </a>
            <figcaption itemprop="caption description">Les calanques</figcaption>
        </figure>

        <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <a href="../img/d21.jpg" itemprop="contentUrl" data-size="1024x683">
                <img src="../img/d21.jpg" itemprop="thumbnail" alt="ski" />
            </a>
            <figcaption itemprop="caption description">Poudreuse</figcaption>
        </figure>

    </div>



    <h2>Le scoutisme</h2>



    <p class="just">Ma jeunesse fut marqué par le scoutisme, j'ai été chef d'une troupe de 35 garçons âgés de 13 à 17 ans à Chambéry pendant trois ans, cette aventure m'a aidé à développer
        mes compétences organisationnelles en amenant les scouts camper durant l'année et trois semaines chaque été. Il y avait certes le coté logistique & budget & administratif,
        mais le plus intéressant était de voir les garçons grandir et progresser au fil du temps, de prendre ses responsabilités, de leur transmettre les valeurs de l'engagement,
        la prise d'initiative, le courage, la volonté, la persévérance et le dépassement de soi.</p>
    <p class="just">
        J'ai pu développer mes compétences relationnels en adaptant mes discours au jeunes, en conduisant des réunions, en gérant des conflits, en manageant les scouts et leurs parents,
        ces derniers posaient plus de problèmes de façon générale. J'ai organisé des camps en échange avec des scouts  Allemeands, Polonais, Suisses. On a fait un grand camp
        en Hongrie, dans les Alpes et en Normandie, chaque hiver on faisait un camp hiver sous igloo de plusieurs jours.
    </p>

    <img class="responsive-img" src="../img/s.jpg" alt="Scoutisme"/>

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


</div>

<script>
    var initPhotoSwipeFromDOM = function(gallerySelector) {

        // parse slide data (url, title, size ...) from DOM elements
        // (children of gallerySelector)
        var parseThumbnailElements = function(el) {
            var thumbElements = el.childNodes,
                numNodes = thumbElements.length,
                items = [],
                figureEl,
                linkEl,
                size,
                item;

            for(var i = 0; i < numNodes; i++) {

                figureEl = thumbElements[i]; // <figure> element

                // include only element nodes
                if(figureEl.nodeType !== 1) {
                    continue;
                }

                linkEl = figureEl.children[0]; // <a> element

                size = linkEl.getAttribute('data-size').split('x');

                // create slide object
                item = {
                    src: linkEl.getAttribute('href'),
                    w: parseInt(size[0], 10),
                    h: parseInt(size[1], 10)
                };



                if(figureEl.children.length > 1) {
                    // <figcaption> content
                    item.title = figureEl.children[1].innerHTML;
                }

                if(linkEl.children.length > 0) {
                    // <img> thumbnail element, retrieving thumbnail url
                    item.msrc = linkEl.children[0].getAttribute('src');
                }

                item.el = figureEl; // save link to element for getThumbBoundsFn
                items.push(item);
            }

            return items;
        };

        // find nearest parent element
        var closest = function closest(el, fn) {
            return el && ( fn(el) ? el : closest(el.parentNode, fn) );
        };

        // triggers when user clicks on thumbnail
        var onThumbnailsClick = function(e) {
            e = e || window.event;
            e.preventDefault ? e.preventDefault() : e.returnValue = false;

            var eTarget = e.target || e.srcElement;

            // find root element of slide
            var clickedListItem = closest(eTarget, function(el) {
                return (el.tagName && el.tagName.toUpperCase() === 'FIGURE');
            });

            if(!clickedListItem) {
                return;
            }

            // find index of clicked item by looping through all child nodes
            // alternatively, you may define index via data- attribute
            var clickedGallery = clickedListItem.parentNode,
                childNodes = clickedListItem.parentNode.childNodes,
                numChildNodes = childNodes.length,
                nodeIndex = 0,
                index;

            for (var i = 0; i < numChildNodes; i++) {
                if(childNodes[i].nodeType !== 1) {
                    continue;
                }

                if(childNodes[i] === clickedListItem) {
                    index = nodeIndex;
                    break;
                }
                nodeIndex++;
            }



            if(index >= 0) {
                // open PhotoSwipe if valid index found
                openPhotoSwipe( index, clickedGallery );
            }
            return false;
        };

        // parse picture index and gallery index from URL (#&pid=1&gid=2)
        var photoswipeParseHash = function() {
            var hash = window.location.hash.substring(1),
                params = {};

            if(hash.length < 5) {
                return params;
            }

            var vars = hash.split('&');
            for (var i = 0; i < vars.length; i++) {
                if(!vars[i]) {
                    continue;
                }
                var pair = vars[i].split('=');
                if(pair.length < 2) {
                    continue;
                }
                params[pair[0]] = pair[1];
            }

            if(params.gid) {
                params.gid = parseInt(params.gid, 10);
            }

            return params;
        };

        var openPhotoSwipe = function(index, galleryElement, disableAnimation, fromURL) {
            var pswpElement = document.querySelectorAll('.pswp')[0],
                gallery,
                options,
                items;

            items = parseThumbnailElements(galleryElement);

            // define options (if needed)
            options = {

                // define gallery index (for URL)
                galleryUID: galleryElement.getAttribute('data-pswp-uid'),

                getThumbBoundsFn: function(index) {
                    // See Options -> getThumbBoundsFn section of documentation for more info
                    var thumbnail = items[index].el.getElementsByTagName('img')[0], // find thumbnail
                        pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                        rect = thumbnail.getBoundingClientRect();

                    return {x:rect.left, y:rect.top + pageYScroll, w:rect.width};
                }

            };

            // PhotoSwipe opened from URL
            if(fromURL) {
                if(options.galleryPIDs) {
                    // parse real index when custom PIDs are used
                    // http://photoswipe.com/documentation/faq.html#custom-pid-in-url
                    for(var j = 0; j < items.length; j++) {
                        if(items[j].pid == index) {
                            options.index = j;
                            break;
                        }
                    }
                } else {
                    // in URL indexes start from 1
                    options.index = parseInt(index, 10) - 1;
                }
            } else {
                options.index = parseInt(index, 10);
            }

            // exit if index not found
            if( isNaN(options.index) ) {
                return;
            }

            if(disableAnimation) {
                options.showAnimationDuration = 0;
            }

            // Pass data to PhotoSwipe and initialize it
            gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
            gallery.init();
        };

        // loop through all gallery elements and bind events
        var galleryElements = document.querySelectorAll( gallerySelector );

        for(var i = 0, l = galleryElements.length; i < l; i++) {
            galleryElements[i].setAttribute('data-pswp-uid', i+1);
            galleryElements[i].onclick = onThumbnailsClick;
        }

        // Parse URL and open gallery if it contains #&pid=3&gid=1
        var hashData = photoswipeParseHash();
        if(hashData.pid && hashData.gid) {
            openPhotoSwipe( hashData.pid ,  galleryElements[ hashData.gid - 1 ], true, true );
        }
    };

    // execute above function
    initPhotoSwipeFromDOM('.my-gallery');


</script>



