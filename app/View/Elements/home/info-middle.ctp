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
    $mylogiciels[]=array('nom'=>'CakePHP','version'=>'2.4.6','url'=>'http://cakephp.org/','source'=>'http://cakephp.org/','new'=>1,'date'=>'02/03/2014','description'=>"CakePHP est un framework web libre écrit en PHP distribué sous licence MIT. Il suit le motif de conception Modèle-Vue-Contrôleur et imite le fonctionnement de Ruby on Rails.");
    $mylogiciels[]=array('nom'=>'BootStrap','version'=>'3.1.1','url'=>'http://getbootstrap.com/','source'=>'http://getbootstrap.com/','new'=>0,'date'=>'02/02/2014','description'=>"Twitter Bootstrap est une collection d'outils utile à la création de sites web et applications web. C'est un ensemble qui contient des codes HTML et CSS, des formulaires, boutons, outils de navigation et autres éléments interactifs, ainsi que des extensions JavaScript.");
    $mylogiciels[]=array('nom'=>'TinyMCE','version'=>'4.0.18','url'=>'http://www.tinymce.com/','source'=>'http://www.tinymce.com/','new'=>1,'date'=>'01/03/2014','description'=>"Transforme les éléments textarea en éditeur WYSWYG.");
    $mylogiciels[]=array('nom'=>'Filemanager','version'=>'9.3.4','url'=>'http://www.responsivefilemanager.com/','source'=>'http://www.responsivefilemanager.com/','new'=>1,'date'=>'01/03/2014','description'=>"Plugin pour TinyMCE qui permet le chargement de fichier et/ou images.");
    $mylogiciels[]=array('nom'=>'jQuery','version'=>'1.11.0','url'=>'http://jquery.com/','source'=>'http://jquery.com/','new'=>0,'date'=>'02/02/2014','description'=>"jQuery est une bibliothèque JavaScript libre qui porte sur l'interaction entre JavaScript et HTML, et a pour but de simplifier des commandes communes de JavaScript.");
    $mylogiciels[]=array('nom'=>'MySQL Workbench','version'=>'6.0.9','url'=>'http://dev.mysql.com/downloads/tools/workbench/','source'=>'http://dev.mysql.com/downloads/tools/workbench/','new'=>0,'date'=>'02/02/2014','description'=>"MySQL Workbench est un logiciel de gestion et d'administration de bases de données.");
    $mylogiciels[]=array('nom'=>'Highcharts','version'=>'3.0.9','url'=>'https://github.com/highslide-software/highcharts.com/releases','source'=>'https://github.com/highslide-software/highcharts.com/releases','new'=>0,'date'=>'02/02/2014','description'=>"Highcharts est une bibliothèque Javascript qui permet de faire une panoplie de graphique.");
    $mylogiciels[]=array('nom'=>'Validate','version'=>'1.11.1','url'=>'https://github.com/jzaefferer/jquery-validation','source'=>'https://github.com/jzaefferer/jquery-validation','new'=>0,'date'=>'02/02/2014','description'=>"C'est une bibliothèque Javascript permettant de faire des validations de formulaires avant soumission.");
    $mylogiciels[]=array('nom'=>'Chronoline','version'=>'0.1.1','url'=>'https://github.com/StoicLoofah/chronoline.js','source'=>'https://github.com/StoicLoofah/chronoline.js','new'=>0,'date'=>'02/02/2014','description'=>"C'est une bibliothèque Javascript permettant de faire une rendu chronologique d'information.");
    $mylogiciels[]=array('nom'=>'Datepicker','version'=>'1.3.0','url'=>'http://eternicode.github.io/bootstrap-datepicker/','source'=>'http://eternicode.github.io/bootstrap-datepicker/','new'=>0,'date'=>'02/02/2014','description'=>"C'est une bibliothèque Javascript au même style que bootstrap pour choisir la date.");
    $mylogiciels[]=array('nom'=>'Colopicker','version'=>'2.0.0','url'=>'https://github.com/mjaalnir/bootstrap-colorpicker','source'=>'https://github.com/mjaalnir/bootstrap-colorpicker','new'=>0,'date'=>'02/02/2014','description'=>"C'est une bibliothèque Javascript au même style que bootstarp pour choisir une couleur.");
    $mylogiciels[]=array('nom'=>'MaskedInput','version'=>'1.3.1','url'=>'https://github.com/digitalBush/jquery.maskedinput/','source'=>'https://github.com/digitalBush/jquery.maskedinput/','new'=>0,'date'=>'02/02/2014','description'=>"C'est une bibliothèque Javascript qui permet de mettre un masque sur un élément input.");
    $mylogiciels[]=array('nom'=>'TeamWork jQuery-Gantt','version'=>'5.0.0','url'=>'https://github.com/robicch/jQueryGantt/','source'=>'https://github.com/robicch/jQueryGantt/','new'=>1,'date'=>'04/03/2014','description'=>"C'est une bibliothèque Javascript qui permet de faire des Gantt simplifiés.");
    $mylogiciels[]=array('nom'=>'TableSort','version'=>'2.15.5','url'=>'https://github.com/Mottie/tablesorter','source'=>'https://github.com/Mottie/tablesorter','new'=>1,'date'=>'02/02/2014','description'=>"C'est une bibliothèqe Javascript qui permet de faire des tris en cliquant sur les entêtes des tableaux.");
    $mylogiciels[]=array('nom'=>'FlipCountDown','version'=>'3.0.4','url'=>'https://github.com/xdan/flipcountdown/','source'=>'https://github.com/xdan/flipcountdown/','new'=>1,'date'=>'01/03/2014','description'=>"C'est une bibliothèque Javascript qui affiche l'heure et peut permettre ègalement de faire des décomptes.Modifié pour afficher la date.");
    $mylogiciels[]=array('nom'=>'Wamp Server','version'=>'2.2.E','url'=>'http://www.wampserver.com/#download-wrapper','source'=>'http://www.wampserver.com/#download-wrapper','new'=>0,'date'=>'02/02/2014','description'=>"Une plateforme de développement Web de type WAMP, permettant de faire fonctionner localement des scripts PHP.");
    $mylogiciels[]=array('nom'=>'Netbeans IDE','version'=>'7.4','url'=>'https://netbeans.org/downloads/index.html','source'=>'https://netbeans.org/downloads/index.html','new'=>0,'date'=>'02/02/2014','description'=>"NetBeans est un environnement de développement intégré.");
    $mylogiciels[]=array('nom'=>'Plugin CakePHP','version'=>'0.10.1','url'=>'http://plugins.netbeans.org/plugin/44579/php-cakephp-framework','source'=>'http://plugins.netbeans.org/plugin/44579/php-cakephp-framework','new'=>1,'date'=>'05/03/2014','description'=>"Plugin pour Netbeans pour prendre en compte le framework CakePHP.");
    http://taitems.github.io/jQuery.Gantt/
    ?>
    <div id="panel_apps_content" class="panel-collapse collapse">
      <div class="panel-body">
        <ul class="list-group">
          <?php foreach($mylogiciels as $mylogiciel): ?>
          <li class="list-group-item <?php echo $mylogiciel['new']==1 ? 'nouveau' : ''; ?>"><a href="<?php echo $mylogiciel['url']; ?>" target="_blank"><span class="glyphicons link  notchange margintop4 marginright10"></span></a><?php echo $mylogiciel['nom']; ?> <?php echo $mylogiciel['version']; ?></li>
          <?php endforeach; ?>
        </ul>                          
      </div>
    </div>
  </div>  
</div> 