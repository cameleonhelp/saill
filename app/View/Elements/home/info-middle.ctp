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
    $mylogiciels[]=array('nom'=>'CakePHP','version'=>'2.5.0','date'=>'30/04/2014','url'=>'http://cakephp.org/','source'=>'https://github.com/cakephp/cakephp/releases/','description'=>"CakePHP est un framework web libre écrit en PHP distribué sous licence MIT. Il suit le motif de conception Modèle-Vue-Contrôleur et imite le fonctionnement de Ruby on Rails.");
    $mylogiciels[]=array('nom'=>'BootStrap','version'=>'3.1.1','date'=>'02/02/2014','url'=>'http://getbootstrap.com/','source'=>'https://github.com/twbs/bootstrap/releases/','description'=>"Twitter Bootstrap est une collection d'outils utile à la création de sites web et applications web. C'est un ensemble qui contient des codes HTML et CSS, des formulaires, boutons, outils de navigation et autres éléments interactifs, ainsi que des extensions JavaScript.");
    $mylogiciels[]=array('nom'=>'TinyMCE','version'=>'4.0.25','date'=>'01/05/2014','url'=>'http://www.tinymce.com/','source'=>'https://github.com/tinymce/tinymce/releases/','description'=>"Transforme les éléments textarea en éditeur WYSWYG.");
    $mylogiciels[]=array('nom'=>'Filemanager','version'=>'9.3.4','date'=>'01/03/2014','url'=>'http://www.responsivefilemanager.com/','source'=>'https://github.com/trippo/ResponsiveFilemanager/releases/','description'=>"Plugin pour TinyMCE qui permet le chargement de fichier et/ou images.");
    $mylogiciels[]=array('nom'=>'jQuery','version'=>'1.11.1','date'=>'02/05/2014','url'=>'http://jquery.com/','source'=>'https://github.com/jquery/jquery/releases/','description'=>"jQuery est une bibliothèque JavaScript libre qui porte sur l'interaction entre JavaScript et HTML, et a pour but de simplifier des commandes communes de JavaScript.");
    $mylogiciels[]=array('nom'=>'MySQL Workbench','version'=>'6.1.4','date'=>'04/04/2014','url'=>'http://dev.mysql.com/downloads/tools/workbench/','source'=>'http://dev.mysql.com/downloads/tools/workbench/','description'=>"MySQL Workbench est un logiciel de gestion et d'administration de bases de données.");
    $mylogiciels[]=array('nom'=>'Highcharts','version'=>'4.0.1','date'=>'25/04/2014','url'=>'http://www.highcharts.com','source'=>'https://github.com/highslide-software/highcharts.com/releases/','description'=>"Highcharts est une bibliothèque Javascript qui permet de faire une panoplie de graphique.");
    $mylogiciels[]=array('nom'=>'Validate','version'=>'1.12.0','date'=>'02/04/2014','url'=>'http://jqueryvalidation.org','source'=>'https://github.com/jzaefferer/jquery-validation/releases/','description'=>"C'est une bibliothèque Javascript permettant de faire des validations de formulaires avant soumission.");
    $mylogiciels[]=array('nom'=>'Chronoline','version'=>'0.1.1','date'=>'02/02/2014','url'=>'http://stoicloofah.github.io/chronoline.js/','source'=>'https://github.com/StoicLoofah/chronoline.js/releases/','description'=>"C'est une bibliothèque Javascript permettant de faire une rendu chronologique d'information.");
    $mylogiciels[]=array('nom'=>'Datepicker','version'=>'1.3.0','date'=>'02/02/2014','url'=>'http://eternicode.github.io/bootstrap-datepicker/','source'=>'https://github.com/eternicode/bootstrap-datepicker/releases/','description'=>"C'est une bibliothèque Javascript au même style que bootstrap pour choisir la date.");
    $mylogiciels[]=array('nom'=>'Colopicker','version'=>'2.0.0','date'=>'02/02/2014','url'=>'http://mjolnic.github.io/bootstrap-colorpicker','source'=>'https://github.com/mjaalnir/bootstrap-colorpicker/releases/','description'=>"C'est une bibliothèque Javascript au même style que bootstarp pour choisir une couleur.");
    $mylogiciels[]=array('nom'=>'MaskedInput','version'=>'1.3.1','date'=>'02/02/2014','url'=>'http://digitalbush.com/projects/masked-input-plugin//','source'=>'https://github.com/digitalBush/jquery.maskedinput/releases/','description'=>"C'est une bibliothèque Javascript qui permet de mettre un masque sur un élément input.");
    $mylogiciels[]=array('nom'=>'TeamWork jQuery-Gantt','version'=>'5.0.0','date'=>'04/03/2014','url'=>'http://gantt.twproject.com/','source'=>'https://github.com/robicch/jQueryGantt/','description'=>"C'est une bibliothèque Javascript qui permet de faire des Gantt simplifiés.");
    $mylogiciels[]=array('nom'=>'TableSorter','version'=>'2.16.3','date'=>'01/05/2014','url'=>'http://mottie.github.io/tablesorter/docs/','source'=>'https://github.com/Mottie/tablesorter/releases/','description'=>"C'est une bibliothèqe Javascript qui permet de faire des tris en cliquant sur les entêtes des tableaux.");
    $mylogiciels[]=array('nom'=>'FlipCountDown','version'=>'3.0.4','date'=>'01/03/2014','url'=>'http://xdsoft.net/jqplugins/flipcountdown/','source'=>'https://github.com/xdan/flipcountdown/releases/','description'=>"C'est une bibliothèque Javascript qui affiche l'heure et peut permettre ègalement de faire des décomptes.Modifié pour afficher la date.");
    $mylogiciels[]=array('nom'=>'X-editable','version'=>'1.5.1','date'=>'03/04/2014','url'=>'http://vitalets.github.io/x-editable/','source'=>'https://github.com/vitalets/x-editable/releases/','description'=>"Plugin jQuery pour editer dnas le tableau le contenu de cellule.");    
    $mylogiciels[]=array('nom'=>'Wamp Server','version'=>'2.2.E','date'=>'02/02/2014','url'=>'http://www.wampserver.com/#download-wrapper','source'=>'http://www.wampserver.com/#download-wrapper','description'=>"Une plateforme de développement Web de type WAMP, permettant de faire fonctionner localement des scripts PHP.");
    $mylogiciels[]=array('nom'=>'Netbeans IDE','version'=>'8.0','date'=>'20/03/2014','url'=>'https://netbeans.org/downloads/index.html','source'=>'https://netbeans.org/downloads/index.html','description'=>"NetBeans est un environnement de développement intégré.");
    $mylogiciels[]=array('nom'=>'Plugin CakePHP','version'=>'0.12.3','date'=>'09/04/2014','url'=>'http://plugins.netbeans.org/plugin/44579/php-cakephp-framework','source'=>'https://github.com/junichi11/cakephp-netbeans/releases/','description'=>"Plugin pour Netbeans pour prendre en compte le framework CakePHP.");
    //http://taitems.github.io/jQuery.Gantt/
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
                    <?php 
                    //TODO comparer la date par rapport à la date du jour et si < 30 jours alors $new = 'nouveau'
                    $today = new DateTime(); 
                    $lastupdate = new DateTime(CUSDate($mylogiciel['date']));
                    if($today->diff($lastupdate)->format("%a") < 30):
                        $new = 'nouveau';
                    else:
                        $new = '';
                    endif;
                    ?>
                    <div class="item">
                    <div class="">
                        <ul>
                            <li><b>Nom :</b> <?php echo $mylogiciel['nom']; ?></li>
                            <li><b>Version :</b> <?php echo $mylogiciel['version']; ?></li>
                            <li><b>Mise à jour le :</b> <span class="<?php echo $new; ?>"><?php echo $mylogiciel['date']; ?></span></li>
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