<div class="panel-group" id="panel_navigateur">
  <div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#panel_navigateur" href="#panel_navigateur_content">
          Navigateurs compatibles
        </a>
      </h3>
    </div>
    <div id="panel_navigateur_content" class="panel-collapse collapse">
      <div class="panel-body">
        <ul class="list-group">
          <li class="list-group-item"><a href="https://catalogue-solutions.sncf.fr/index.php/Firefox" target="_blank"><span class="glyphicons link notchange marginright10 margintop4"></span></a>Firefox</li>
          <li class="list-group-item"><a href="https://catalogue-solutions.sncf.fr/index.php/Google_Chrome" target="_blank"><span class="glyphicons link notchange marginright10 margintop4"></span></a>Chrome</li>
          <li class="list-group-item"><a href="https://catalogue-solutions.sncf.fr/index.php/Safari" target="_blank"><span class="glyphicons link notchange marginright10 margintop4"></span></a>Safari</li>
          <li class="list-group-item">
              <div class="free" data-toggle="popover" data-rel="popover" data-content="Compatible IE10<br>partiellement compatible IE8." data-original-title="" title="">
                  <span class="glyphicons circle_question_mark yellow notchange marginright10 margintop4"></span></div>Internet Explorer</li>
        </ul>
      </div>
    </div>
  </div>  
</div>
<div class="panel-group" id="panel_resolution">
  <div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#panel_resolution" href="#panel_resolution_content">
          Résolution recommandée
        </a>
      </h3>
    </div>
    <div id="panel_resolution_content" class="panel-collapse collapse">
        <div class="panel-body text-center"><span class="glyphicons imac size14 margintop4 marginright10"></span> 1280x1024<span class="text-indice">1</span><br><span class="text-medium">1 : Résolution optimale<br>Testé en 1024x768 et supérieure</span></div>
    </div>
  </div>  
</div> 
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
    $mylogiciels[]=array('nom'=>'CakePHP','version'=>'2.4.3','url'=>'http://cakephp.org/','new'=>1);
    $mylogiciels[]=array('nom'=>'BootStrap','version'=>'3.0.2','url'=>'http://getbootstrap.com/','new'=>0);
    $mylogiciels[]=array('nom'=>'TinyMCE','version'=>'4.0.11','url'=>'http://www.tinymce.com/','new'=>1);
    $mylogiciels[]=array('nom'=>'jQuery','version'=>'1.10.2','url'=>'http://jquery.com/','new'=>0);
    $mylogiciels[]=array('nom'=>'MySQL Workbench','version'=>'6.0.8','url'=>'http://dev.mysql.com/downloads/tools/workbench/','new'=>0);
    $mylogiciels[]=array('nom'=>'Highcharts','version'=>'3.0.7','url'=>'https://github.com/highslide-software/highcharts.com/releases','new'=>0);
    $mylogiciels[]=array('nom'=>'Validate','version'=>'1.11.1','url'=>'https://github.com/jzaefferer/jquery-validation','new'=>0);
    $mylogiciels[]=array('nom'=>'Chronoline','version'=>'0.1.1','url'=>'https://github.com/StoicLoofah/chronoline.js','new'=>0);
    $mylogiciels[]=array('nom'=>'Datepicker','version'=>'1.2.0','url'=>'http://eternicode.github.io/bootstrap-datepicker/','new'=>0);
    $mylogiciels[]=array('nom'=>'Colopicker','version'=>'1.0.0','url'=>'https://github.com/mjaalnir/bootstrap-colorpicker','new'=>0);
    $mylogiciels[]=array('nom'=>'MaskedInput','version'=>'1.3.1','url'=>'https://github.com/digitalBush/jquery.maskedinput/','new'=>0);
    $mylogiciels[]=array('nom'=>'Wamp Server','version'=>'2.2.E','url'=>'http://www.wampserver.com/#download-wrapper','new'=>0);
    $mylogiciels[]=array('nom'=>'Netbeans IDE','version'=>'7.4','url'=>'https://netbeans.org/downloads/index.html','new'=>0);
    $mylogiciels[]=array('nom'=>'Plugin CakePHP','version'=>'0.9.8','url'=>'http://plugins.netbeans.org/plugin/44579/php-cakephp-framework','new'=>1);
    ?>
    <div id="panel_apps_content" class="panel-collapse collapse">
      <div class="panel-body">
        <ul class="list-group">
          <?php foreach($mylogiciels as $mylogiciel): ?>
          <li class="list-group-item <?php echo $mylogiciel['new']==1 ? 'nouveau' : ''; ?>"><a href="<?php echo $mylogiciel['url']; ?>" target="_blank"><span class="glyphicons link marginright10 notchange margintop4"></span></a><?php echo $mylogiciel['nom']; ?> <?php echo $mylogiciel['version']; ?></li>
          <?php endforeach; ?>
        </ul>                          
      </div>
    </div>
  </div>  
</div> 