<div class="panel-group" id="panel_apps"> 
  <div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#panel_apps" href="#panel_apps_content">
          Composants utilisés
        </a>
      </h3>
    </div>
    <?php 
    /**
     * Création d'un objet logiciels avec les information à afficher
     */
    $mylogiciels[]=array('nom'=>'CakePHP','version'=>'2.4.6','url'=>'http://cakephp.org/','source'=>'https://github.com/cakephp/cakephp/releases','new'=>1,'date'=>'02/03/2014','description'=>"CakePHP est un framework web libre écrit en PHP distribué sous licence MIT. Il suit le motif de conception Modèle-Vue-Contrôleur et imite le fonctionnement de Ruby on Rails.");
    $mylogiciels[]=array('nom'=>'BootStrap','version'=>'3.1.1','url'=>'http://getbootstrap.com/','source'=>'https://github.com/twbs/bootstrap/releases','new'=>0,'date'=>'02/02/2014','description'=>"Twitter Bootstrap est une collection d'outils utile à la création de sites web et applications web. C'est un ensemble qui contient des codes HTML et CSS, des formulaires, boutons, outils de navigation et autres éléments interactifs, ainsi que des extensions JavaScript.");
    $mylogiciels[]=array('nom'=>'TinyMCE','version'=>'4.0.20','url'=>'http://www.tinymce.com/','source'=>'https://github.com/tinymce/tinymce/releases/','new'=>1,'date'=>'19/03/2014','description'=>"Transforme les éléments textarea en éditeur WYSWYG.");
    $mylogiciels[]=array('nom'=>'Filemanager','version'=>'9.3.4','url'=>'http://www.responsivefilemanager.com/','source'=>'https://github.com/trippo/ResponsiveFilemanager/','new'=>1,'date'=>'01/03/2014','description'=>"Plugin pour TinyMCE qui permet le chargement de fichier et/ou images.");
    $mylogiciels[]=array('nom'=>'jQuery','version'=>'1.11.0','url'=>'http://jquery.com/','source'=>'https://github.com/jquery/jquery/releases/','new'=>0,'date'=>'02/02/2014','description'=>"jQuery est une bibliothèque JavaScript libre qui porte sur l'interaction entre JavaScript et HTML, et a pour but de simplifier des commandes communes de JavaScript.");
    $mylogiciels[]=array('nom'=>'MySQL Workbench','version'=>'6.0.9','url'=>'http://dev.mysql.com/downloads/tools/workbench/','source'=>'http://dev.mysql.com/downloads/tools/workbench/','new'=>0,'date'=>'02/02/2014','description'=>"MySQL Workbench est un logiciel de gestion et d'administration de bases de données.");
    $mylogiciels[]=array('nom'=>'Highcharts','version'=>'3.0.9','url'=>'http://www.highcharts.com','source'=>'https://github.com/highslide-software/highcharts.com/releases','new'=>0,'date'=>'02/02/2014','description'=>"Highcharts est une bibliothèque Javascript qui permet de faire une panoplie de graphique.");
    $mylogiciels[]=array('nom'=>'Validate','version'=>'1.11.1','url'=>'http://jqueryvalidation.org','source'=>'https://github.com/jzaefferer/jquery-validation','new'=>0,'date'=>'02/02/2014','description'=>"C'est une bibliothèque Javascript permettant de faire des validations de formulaires avant soumission.");
    $mylogiciels[]=array('nom'=>'Chronoline','version'=>'0.1.1','url'=>'http://stoicloofah.github.io/chronoline.js/','source'=>'https://github.com/StoicLoofah/chronoline.js','new'=>0,'date'=>'02/02/2014','description'=>"C'est une bibliothèque Javascript permettant de faire une rendu chronologique d'information.");
    $mylogiciels[]=array('nom'=>'Datepicker','version'=>'1.3.0','url'=>'http://eternicode.github.io/bootstrap-datepicker/','source'=>'https://github.com/eternicode/bootstrap-datepicker/releases/','new'=>0,'date'=>'02/02/2014','description'=>"C'est une bibliothèque Javascript au même style que bootstrap pour choisir la date.");
    $mylogiciels[]=array('nom'=>'Colopicker','version'=>'2.0.0','url'=>'http://mjolnic.github.io/bootstrap-colorpicker','source'=>'https://github.com/mjaalnir/bootstrap-colorpicker','new'=>0,'date'=>'02/02/2014','description'=>"C'est une bibliothèque Javascript au même style que bootstarp pour choisir une couleur.");
    $mylogiciels[]=array('nom'=>'MaskedInput','version'=>'1.3.1','url'=>'http://digitalbush.com/projects/masked-input-plugin//','source'=>'https://github.com/digitalBush/jquery.maskedinput/','new'=>0,'date'=>'02/02/2014','description'=>"C'est une bibliothèque Javascript qui permet de mettre un masque sur un élément input.");
    $mylogiciels[]=array('nom'=>'TeamWork jQuery-Gantt','version'=>'5.0.0','url'=>'http://gantt.twproject.com/','source'=>'https://github.com/robicch/jQueryGantt/','new'=>1,'date'=>'04/03/2014','description'=>"C'est une bibliothèque Javascript qui permet de faire des Gantt simplifiés.");
    $mylogiciels[]=array('nom'=>'TableSort','version'=>'2.15.11','url'=>'http://mottie.github.io/tablesorter/docs/','source'=>'https://github.com/Mottie/tablesorter','new'=>1,'date'=>'19/03/2014','description'=>"C'est une bibliothèqe Javascript qui permet de faire des tris en cliquant sur les entêtes des tableaux.");
    $mylogiciels[]=array('nom'=>'FlipCountDown','version'=>'3.0.4','url'=>'http://xdsoft.net/jqplugins/flipcountdown/','source'=>'https://github.com/xdan/flipcountdown/','new'=>1,'date'=>'01/03/2014','description'=>"C'est une bibliothèque Javascript qui affiche l'heure et peut permettre ègalement de faire des décomptes.Modifié pour afficher la date.");
    $mylogiciels[]=array('nom'=>'Wamp Server','version'=>'2.2.E','url'=>'http://www.wampserver.com/#download-wrapper','source'=>'http://www.wampserver.com/#download-wrapper','new'=>0,'date'=>'02/02/2014','description'=>"Une plateforme de développement Web de type WAMP, permettant de faire fonctionner localement des scripts PHP.");
    $mylogiciels[]=array('nom'=>'Netbeans IDE','version'=>'8.0','url'=>'https://netbeans.org/downloads/index.html','source'=>'https://netbeans.org/downloads/index.html','new'=>0,'date'=>'20/03/2014','description'=>"NetBeans est un environnement de développement intégré.");
    $mylogiciels[]=array('nom'=>'Plugin CakePHP','version'=>'0.11.0','url'=>'http://plugins.netbeans.org/plugin/44579/php-cakephp-framework','source'=>'https://github.com/junichi11/cakephp-netbeans','new'=>1,'date'=>'20/03/2014','description'=>"Plugin pour Netbeans pour prendre en compte le framework CakePHP.");
    http://taitems.github.io/jQuery.Gantt/
    ?>
    <div id="panel_apps_content" class="panel-collapse collapse">
      <div class="panel-body">
        <div id="carousel-composant" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators" style="top:95%;display:inline-table;width:85%;left:37%;">
              <li data-target="#carousel-composant" data-slide-to="0" class="active"></li>   
                <?php 
                    $i = 1;
                    foreach ($mylogiciels as $mylogiciel) { ?>
                        <li data-target="#carousel-composant" data-slide-to="<?php echo $i; ?>"></li>                        
                <?php
                    $i++;                
                    }
                ?>        
          </ol>
          <!-- Wrapper for slides -->
          <div class="carousel-inner">
              <div class="item active">
                  <div style="padding-bottom:10px;">
                  Voici la liste des composants utilisés pour la réalisation de cet outil.<br/>
                  Il s'agit de composants sous licence MIT ce qui les rend parfait pour une utilisation dans des applications commerciales.<br>
                  <?php echo "Dernière modification : " . get_page_mod_time(); ?>
                  </div>
              </div>
               <?php foreach($mylogiciels as $mylogiciel): ?>
                    <div class="item">
                    <div class="">
                        <ul>
                            <li><b>Nom :</b> <?php echo $mylogiciel['nom']; ?></li>
                            <li><b>Version :</b> <?php echo $mylogiciel['version']; ?></li>
                            <li><b>Mise à jour le :</b> <?php echo $mylogiciel['date']; ?></li>
                            <li><b>Description :</b> <?php echo $mylogiciel['description']; ?></li>
                            <li><b>Site :</b> <a href="<?php echo $mylogiciel['url']; ?>" target="_blank"><span class="glyphicons link  notchange margintop4"></span> <?php echo $mylogiciel['url']; ?></a></li>
                            <li><b>Source :</b> <a href="<?php echo $mylogiciel['source']; ?>" target="_blank"><span class="glyphicons link  notchange margintop4"></span> <?php echo $mylogiciel['source']; ?></a></li>
                        </ul> 
                    </div>
                    </div>
                  <?php endforeach; ?>             
          </div>
        </div>                 
      </div>
    </div>
  </div>  
</div> 