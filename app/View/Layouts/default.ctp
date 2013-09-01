<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
//$version = $this->requestAction('parameters/get_version'); 
$cakeDescription = __d('cake_dev', 'SAILL '); //.htmlspecialchars($version['Parameter']['param'])
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset('utf-8'); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
        <script>
            pathserveur = '<?php echo FULL_BASE_URL.$this->params->base; ?>';
            Timeline_ajax_url=pathserveur+"/js/timeline_ajax/simile-ajax-api.js";
            Timeline_urlPrefix=pathserveur+'/js/timeline_js/';       
            Timeline_parameters='bundle=true';
        </script>    
	<?php
		echo $this->Html->meta('icon');

                echo $this->Html->css('bootstrap');
                echo $this->Html->css('editable');  
                echo $this->Html->css('datepicker'); 
                echo $this->Html->css('bootsncf');                    
                echo $this->Html->css('bootstrap.sncf');
                echo $this->Html->css('glyphicons');
                echo $this->Html->css('jscroller2');  
                echo $this->Html->css('accordionMod'); 
                
                echo $this->Html->script('jquery');
                echo $this->Html->script('bootstrap');              
                echo $this->Html->script('validate');  
                echo $this->Html->script('additional-methods');                  
                echo $this->Html->script('messages_fr'); 
                echo $this->Html->script('datepicker'); 
                echo $this->Html->script('datepicker.fr');
                echo $this->Html->script('tinymce/tinymce');
                echo $this->Html->script('jscroller2'); 
                echo $this->Html->script('datetime');
                echo $this->Html->script('navigation');
                echo $this->Html->script('highcharts');
                echo $this->Html->script('highcharts-more');
                echo $this->Html->script('modules/exporting');   
                echo $this->Html->script('modules/data');
                echo $this->Html->script('newsticker'); 
                echo $this->Html->script('accordionMod');
                //pour enregistrer image
                echo $this->Html->script('html2canvas');     
                echo $this->Html->script('canvas2image');   
                echo $this->Html->script('base64'); 
                //pour la timeline dans la liste des actions
                echo $this->Html->script('timeline_js/timeline-api');
                
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
    <?php if (isset($actions)): ?>
    <script>
        var tl;
        function onLoad() {
            SimileAjax.History.enabled = false;
            var eventSource = new Timeline.DefaultEventSource();
            var theme1 = Timeline.ClassicTheme.create(); 
            theme1.firstDayOfWeek=1; 
            theme1.autoWidth = true;
            
            var bandInfos = [
              Timeline.createBandInfo({
                  width:          "20", 
                  intervalUnit:   Timeline.DateTime.MONTH, 
                  theme:          theme1,
                  intervalPixels: 400,
                  eventSource:    eventSource,
                  overview:       true,
                  color :         "6E267B"
              }),
              Timeline.createBandInfo({
                  width:          "80", 
                  intervalUnit:   Timeline.DateTime.DAY,
                  theme:          theme1,
                  intervalPixels: 105,
                  eventSource:    eventSource
              })
            ];
            bandInfos[0].syncWith = 1;
            bandInfos[0].highlight = true;

            tl = Timeline.create(document.getElementById("timeline"), bandInfos,Timeline.HORIZONTAL);
            
            <?php echo "var timeline_data = {'events' : ["; ?>
            <?php $events = $this->requestAction('actions/timelinedata'); ?>
            <?php foreach($events as $event): ?>
                <?php echo "{'start': new Date(Date.UTC(".$event['start'].")),"; ?>
                <?php echo "'end': new Date(Date.UTC(".$event['end'].")),"; ?>
                <?php echo "'title': '".h($event['title'])."',"; ?>
                <?php echo "'description': '".h($event['description'])."',"; ?>
                <?php echo "'color': '#6E267B',"; ?>
                <?php $durationevent = $event['durationEvent']==1 ? 'false' : 'true'; ?>
                <?php echo "'durationEvent': ".$durationevent."},"; ?>                            
            <?php endforeach; ?>
            <?php echo " ]};"; ?>                
            <?php echo "var url = '.';"; ?>
            <?php echo "eventSource.loadJSON(timeline_data, url);"; ?>
            <?php echo "tl.layout();"; ?>
     
        }        
        
        var resizeTimerID = null;
        function onResize() {
            if (resizeTimerID == null) {
                resizeTimerID = window.setTimeout(function() {
                    resizeTimerID = null;
                    <?php if (isset($actions)): echo "tl.layout();"; endif; ?>     
                }, 500);
            }
        }
        
        function centerTimeline() {
            tl.getBand(0).setCenterVisibleDate(new Date());
        }        
    </script>
    <?php endif; ?>  
</head>
<body <?php if (isset($actions)): ?>onload="onLoad();" onresize="onResize();"<?php endif; ?>>
<div id="overlay" style="display:none;"><?php echo $this->Html->image("loading.gif", array('fullBase' => true)); ?> Travail en cours, veuillez patienter ...</div>
<script type="text/javascript">      
    tinymce.init({ 
   // General options
   language : "fr_FR",
   mode: "textareas",
   forced_root_block : false,
   force_br_newlines : true,
   force_p_newlines : false,
   resize : false,
   statusbar:false,
   plugins: "hr link textcolor table code searchreplace <?php echo $this->params['controller']=='messages' ? 'charcount' : ''; ?>",
   menubar: "file edit insert format table tools",
   toolbar: "undo redo | bold italic | hr link unlink | forecolor | backcolor | numlist bullist | alignleft aligncenter alignright alignjustify | searchreplace",
   height : "300",
   width : "100%"
    }); 
</script> 
<div class="modal hide fade" id="redModal" data-color="red">
  <div class="modal-header" style="background-color:red;color:white;">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Navigateur non recommandé</h3>
  </div>
  <div class="modal-body">
      <p style="color:red;">Vous utilisez Internet explorer, ce site ne fonctionne pas correctement avec ce navigateur.<br/>Nous vous recommandons d'utiliser Chrome ou Firefox dans leur dernière version.<br/>Merci de votre compréhension.</p>
  </div>
</div>    
   <?php //debug(PHP_OS); ?>
   <div id="allcontainer" class="container" style="margin-top: 50px;margin-bottom: 50px;">  
          <div class="navbar navbar-fixed-top navbar-inverse">
            <div class="navbar-inner">
                <?php if (userAuth('id') > 0): ?>
                <div class="pull-left">
                <button type="button" id="togglemenu" class="btn btn-navbar" rel="tooltip" data-title="Caher ou afficher le menu">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                </div>
                <?php endif; ?>	
                <div class="pull-left"><?php echo $this->Html->link($this->Html->image('logo-sncf-galactic.png',array('style'=>'margin-left:10px;margin-right:10px;')),"https://www.int.sncf.fr/",array('escape' => false)); ?>&nbsp;&nbsp;</div>
                <div>
                    <?php echo $this->Html->link('<span class="glyphicons home hard-grey icons-navbar size14"></span>&nbsp;S.A.I.L.L. -',array('controller'=>'pages','action'=>'home'),array('class'=>"brand showoverlay",'escape' => false)); ?>
                    <?php echo $this->Html->link($title_for_layout,"#",array('class'=>"brand","style"=>"margin-left:-35px;margin-top:0px;margin-bottom:0px;",'escape' => false)); ?></div>
		<?php if (userAuth('id') > 0): ?>
                <div class="pull-right">
                    <ul class="nav pull-right">
                      <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                              <span class="glyphicons user hard-grey icons-navbar size14"></span></i>&nbsp;&nbsp;<?php echo userAuth('PRENOM'); ?>. <?php echo userAuth('NOM'); ?>
                              <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                              <li><?php echo $this->Html->link('Mon profil',array('controller'=>'utilisateurs','action'=>'profil',userAuth('id')),array('escape' => false,'class'=>'showoverlay')); ?></li>
                              <li><?php echo $this->Html->link('Se déconnecter',array('controller'=>'utilisateurs','action'=>'logout'),array('class'=>'showoverlay','escape' => false)); ?></li>
                            </ul>
                      </li>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
          </div>       
        <div class="row-fluid" >
            <div id="telecommand" class="span4">
            <?php if (userAuth('id')>0) echo $this->element('server'); ?>
            <?php if (userAuth('id')>0) echo $this->element('menu'); ?>
            <code class="box-info"  style="margin-top: 10px;">
                <div class="text-normal">Navigateurs compatibles :</div>
                <div class='text-center'>
                    <?php echo $this->Html->link($this->Html->image("firefox.png",array("height" => "24px","width" => "24px")),"http://www.mozilla.org/fr/firefox/new/",array('escape' => false,'target'=>'_blank','rel'=>"tooltip",'data-title'=>"Firefox<br/>Recommandé")) ?>
                    <?php echo $this->Html->link($this->Html->image("chrome.png",array("height" => "24px","width" => "24px")),"http://www.google.fr/intl/fr/chrome/business/browser/admin//",array('escape' => false,'target'=>'_blank','rel'=>"tooltip",'data-title'=>"Chrome<br/>Recommandé")) ?>
                    <?php echo $this->Html->link($this->Html->image("noie.png",array("height" => "24px","width" => "24px")),"http://www.internetexplorer.fr",array('escape' => false,'target'=>'_blank','rel'=>"tooltip",'data-title'=>"Internet Explorer<br/> NON compatible HTML5")) ?>                
                </div>
                <div class="text-normal">Résolution recommandée :</div>
                <div class='text-center'><?php echo $this->Html->image("1280.png",array('rel'=>"tooltip",'data-title'=>"Résolution minimum<br />recommandée")); ?></div>
            </code>
            <code class="box-info">
                <div class="text-normal">Réalisé à partir de :</div>
                <div class='text-left' style="color:#000;margin-left:10px;margin-top:5px;"><?php echo $this->Html->link($this->Html->image("cakephp.png",array("height" => "24px","width" => "24px")),"http://cakephp.org/",array('escape' => false,'target'=>'_blank','rel'=>"tooltip",'data-title'=>"CakePHP")) ?> CakePHP<br/>
                <?php echo $this->Html->link($this->Html->image("bootstrap.png",array("height" => "24px","width" => "24px")),"http://twitter.github.com/bootstrap/",array('escape' => false,'target'=>'_blank','rel'=>"tooltip",'data-title'=>"BootStrap")) ?> Bootstrap<br/>
                <?php echo $this->Html->link($this->Html->image("mySQL.png",array("height" => "24px","width" => "24px")),"http://dev.mysql.com/downloads/tools/workbench/",array('escape' => false,'target'=>'_blank','rel'=>"tooltip",'data-title'=>"MYSQL")) ?> MySQL<br/>                      
                <?php echo $this->Html->link($this->Html->image("jquery.png",array("height" => "24px","width" => "24px")),"http://www.jquery.com/",array('escape' => false,'target'=>'_blank','rel'=>"tooltip",'data-title'=>"JQuery")) ?> JQuery<br/>           
                <?php echo $this->Html->link($this->Html->image("tinymce.png",array("height" => "24px","width" => "24px")),"http://www.tinymce.com/",array('escape' => false,'target'=>'_blank','rel'=>"tooltip",'data-title'=>"TinyMCE")) ?> TinyMCE<br/>                                      
                <?php echo $this->Html->link($this->Html->image("html5.png",array("height" => "24px")),"http://www.w3.org/html/wg/drafts/html/master/",array('escape' => false,'target'=>'_blank','rel'=>"tooltip",'data-title'=>"HTML 5")) ?> HTML 5  
                </div>
            </code>            
            </div>
            <div id="maxcontent" class="span32"> 
		<div id="content">
                        <div style="cursor:pointer;"><?php echo $this->Session->flash(); ?></div>
                        <div id="container_message" name="container_message" class="alert alert-error"><ol><li></li></ol></div>
			
			<?php echo $this->fetch('content'); ?>
		</div>
            </div> 
        </div>
        <div class="navbar navbar-fixed-bottom navbar-inverse">
            <div class="navbar-inner">    
                <div class="navbar-text text-white">
                    <ul id="scroller_container" class='newsticker' style="color:#EFEFEF;margin-left:10px;">
                        <?php echo $this->element('messages_defilant'); ?>
                    </ul>
                </div>
            </div>           
        </div>
    </div> 
</body>
</html>
<script>
$(document).ready(function () {
    /** Initialisation des durée des actions **/
    $('#ActionDUREEPREVUE').val()=='' ? $('#ActionLblDUREEPREVUE').text('0 jour') : $('#ActionLblDUREEPREVUE').text(($('#ActionDUREEPREVUE').val()/8)+' jours');
    $('#ActionDUREEREELLE').val()=='' ? $('#ActionLblDUREEREELLE').text('0 jour') : $('#ActionLblDUREEREELLE').text(($('#ActionDUREEREELLE').val()/8)+' jours');
    var avancement = $('#ActionAVANCEMENT').val() < 0 ? 0 : $('#ActionAVANCEMENT').val() > 100 ? 100 : $('#ActionAVANCEMENT').val();
    avancement = Math.round(avancement/10)*10;
    $('#ActionAVANCEMENT').val(avancement);
    $('#progressbar').attr('style',"width:"+avancement+"%;");
    
    /** Fermeture du message en cliquant dessus **/
    $('#flashMessage').on('click',function(){$(this).hide();});
    
    /** Fermeture du message au bout de 10 secondes **/
    setTimeout(function(){$('#flashMessage').fadeToggle();}, 10000);
    
    /** Ajout de Oui/Non dans le label aprés la case à cocher **/
    $(".yesno").each( function() { $(this).next(".labelAfter").text(this.checked ? "Oui" : "Non"); });
    
    /** Chagenement du label aprés un clique sur la case à cocher **/
    $(document).on('click',".yesno",function() {
        $(this).next(".labelAfter").text(this.checked ? "Oui" : "Non");
    });
    /** Messages error - info - warning - success **/
    $(".alert").alert()
    /** Cache la zone de message d'erreur pour le formulaire **/
    $("#container_message").hide();
    /** Tooltip **/
    /** placement auto depuis la version 3.0.0 de bootstrap **/
    $("[rel=tooltip]").tooltip({placement:'auto',trigger:'hover',html:true});
    /** PopOver **/ 
    /** placement auto depuis la version 3.0.0 de bootstrap **/
    var isVisible = false;
    var clickedAway = false;
    /** permet de cacher les autres popover si on clique dans le body **/
    if ($("[rel=popover]").length) {
        $("[rel=popover]").popover({placement:'auto',trigger:'manual',html:true});
        $(document).on('click',"[rel=popover]",function(e){
            e.preventDefault;
            $(this).popover('toggle');
            clickedAway = false
            isVisible = true
        });  
    }  
    
    /** permet d'affciher un overlay pour éviter les doubles cliques **/
    $(document).on('click','.menu1 .accordion-inner > ul > li > a, .showoverlay:not(".disabled")',function(e){
        var overlay = $('#overlay');
        overlay.show();          
    });
    
    /** permet de cacher le menu ou de l'afficher **/
    $(document).on('click','#togglemenu',function(e){
        $("#telecommand").toggle();
        if($("#maxcontent").hasClass('span32')) {
            $("#maxcontent").removeClass('span32').addClass('spanmax');
            $("#allcontainer").addClass('spanmax');
        } else {
            $("#maxcontent").removeClass('spanmax').addClass('span32');
            $("#allcontainer").removeClass('spanmax');
        }
    });
    
    /** permet de cacher les autres popover si on clique dans le body **/
    $(document).on('click',"html",function(e) {
        if(isVisible & clickedAway)
        {
          $("[rel=popover]").popover('hide')
          isVisible = clickedAway = false
        }
        else
        {
          clickedAway = true
        }
    });
    /** DatePicker **/	        
    $(".date").datepicker({
        format: "dd/mm/yyyy",
        weekStart: 1,
        todayBtn: 'linked',
        language: "fr",
        autoclose: true,
        todayHighlight: true,
        orientation : 'auto'
    })
    
    /** affichage du message en bas de page pendant 10 secondes **/
    $('#scroller_container').newsticker(10000);
   
    /** permet de supprimer dans les zones de date **/
    $(".dateremove").click(function(){
            d = new Date;
            $(this).parent().datepicker('update', d.getDate()+'/'+(d.getMonth()+1)+'/'+d.getFullYear());
            $(this).parent().children("input").val('');
            $(this).parent().data('datepicker').date = null;
    }) 
    
    /** permet de mettre la date par défaut au 05/01/Y+1 dans les zones de date **/
    $(".datedefault").click(function(){
        d = new Date;
        $(this).parent().children("input").val('05/01/'+(d.getFullYear()+1));
        $(this).parent().datepicker('update', '05/01/'+(d.getFullYear()+1));
    }) 

    /** Connexion validation du formulaire **/
    var container = $('#container_message');
    $("#formValidate").submit(function() {
                     // update underlying textarea before submit validation
                     tinyMCE.triggerSave();
                     var overlay = $('#overlay');
                     if ($("#formValidate").valid()) overlay.show();                         
             }).validate({ignore: "",errorContainer: container,errorLabelContainer: $("ol", container),wrapper: 'li',meta: "validate",
    highlight: function(element) {
        $(element).closest('.control-group').addClass('error');
        },
    unhighlight: function(element) {
        $(element).closest('.control-group').removeClass('error');
        }
   });

    $(document).keyup(function(e) {
      if (e.keyCode == 27) {$('#overlay').hide(); }   // esc
    });    
    
    /** Check all **/
    $('.checkall').on('click',function (e) {
         $(this).parents('.table').find(':checkbox').prop('checked', this.checked);
    }); 
    
    /** Aide au calcul du Tarif TTC **/
    $('#calculer').on('click',function(e){
        e.preventDefault();
        var tjmHt = $("input[id=prixht]").val();
        var locaux = $("input[id=locaux]").val();
        var fraisdsit = $("input[id=fraisdsit]").val();
        var fraisdiv = $("input[id=fraisdiv]").val();
        var tjm_locaux =parseFloat(tjmHt) + parseFloat(locaux);
        var tjm_locaux_dsit = parseFloat(tjm_locaux)*parseFloat(fraisdsit);
        var totalBrut = parseFloat(tjm_locaux_dsit)*parseFloat(fraisdiv);
        totalBrut = !isNaN(totalBrut) ? totalBrut : 0;       
        $("input[id=total]").val(parseFloat(totalBrut.toFixed(2)));       
    });
    
    $('#UtiliseoutilOutilId').on('change',function(){
        if (this.value != ''){
            $('#UtiliseoutilDossierpartageId').attr('disabled', 'disabled');
            $('#UtiliseoutilListediffusionId').attr('disabled', 'disabled');
        } else {
            $('#UtiliseoutilDossierpartageId').removeAttr('disabled');
            $('#UtiliseoutilListediffusionId').removeAttr('disabled');
        }
    });
   
    $('#UtiliseoutilDossierpartageId').on('change',function(){
        if (this.value != ''){
            $('#UtiliseoutilOutilId').attr('disabled', 'disabled');
            $('#UtiliseoutilListediffusionId').attr('disabled', 'disabled');
        } else {
            $('#UtiliseoutilOutilId').removeAttr('disabled');
            $('#UtiliseoutilListediffusionId').removeAttr('disabled');
        }
    });
   
    $('#UtiliseoutilListediffusionId').on('change',function(){
        if (this.value != ''){
            $('#UtiliseoutilDossierpartageId').attr('disabled', 'disabled');
            $('#UtiliseoutilOutilId').attr('disabled', 'disabled');
        } else {
            $('#UtiliseoutilDossierpartageId').removeAttr('disabled');
            $('#UtiliseoutilOutilId').removeAttr('disabled');
        }
    }); 
   
    $('#DotationMaterielinformatiquesId').on('change',function(){
        if (this.value != ''){
            $('#DotationTypematerielId').attr('disabled', 'disabled');
        } else {
            $('#DotationTypematerielId').removeAttr('disabled');
        }
    });  
   
    $('#DotationTypematerielId').on('change',function(){
        if (this.value != ''){
            $('#DotationMaterielinformatiquesId').attr('disabled', 'disabled');
        } else {
            $('#DotationMaterielinformatiquesId').removeAttr('disabled');
        }
    });  
   
    /** Changement de l'avancement d'une action **/
    $('#ActionAVANCEMENT').on('change',function(e){
        e.preventDefault();
        var avancement = $('#ActionAVANCEMENT').val() < 0 ? 0 : $('#ActionAVANCEMENT').val() > 100 ? 100 : $('#ActionAVANCEMENT').val();
        avancement = Math.round(avancement/10)*10;
        $('#ActionAVANCEMENT').val(avancement);
        $('#progressbar').attr('style',"width:"+avancement+"%;");
    });
   
    $('#ActionDUREEPREVUE').on('change',function(e){
        e.preventDefault();
        var jour = ($('#ActionDUREEPREVUE').val()/8) > 1 ? ' jours' : ' jour';
        $('#ActionLblDUREEPREVUE').text(($('#ActionDUREEPREVUE').val()/8)+jour);       
    });
   
    $('#ActionDUREEREELLE').on('change',function(e){
        e.preventDefault();
        var jour = ($('#ActionDUREEREELLE').val()/8) > 1 ? ' jours' : ' jour';
        $('#ActionLblDUREEREELLE').text(($('#ActionDUREEREELLE').val()/8)+jour);       
    });

    $('#ActionSTATUT').on('change',function(e){
        e.preventDefault();
        if ($('#ActionSTATUT').val() == 'terminée' || $('#ActionSTATUT').val() == 'livré') {
             avancement = 100;
             $('#ActionAVANCEMENT').val(avancement);
             $('#progressbar').attr('style',"width:"+avancement+"%;");           
        } else {
              avancement = 0;
             $('#ActionAVANCEMENT').val(avancement);
             $('#progressbar').attr('style',"width:"+avancement+"%;");          
        }
    });
   
    $('#updateCompteur').on('click',function(e){
        e.preventDefault();
        var conges = $('#UtilisateurCONGE').val();
        var rq = $('#UtilisateurRQ').val();
        var vt = $('#UtilisateurVT').val();
        $('#UtilisateurCONGE').val(parseFloat(conges)-parseFloat($('#totConge').text()));
        $('#UtilisateurRQ').val(parseFloat(rq)-parseFloat($('#totRQ').text()));
        $('#UtilisateurVT').val(parseFloat(vt)-parseFloat($('#totVT').text()));
    });
   
    /*pour l'affichage de la fenetre modal si navigateur = msie*/
    var navigateur = navigator.userAgent.toLowerCase().indexOf('msie');
    if (navigateur > -1) {
         $('#redModal').modal();
    }
    
    /*mise en place de showoverlay sur prev first prev et last*/
    $('[rel=first]').parent('span').addClass('showoverlay');
    $('[rel=prev]').parent('span').addClass('showoverlay');
    $('[rel=next]').parent('span').addClass('showoverlay');
    $('[rel=last]').parent('span').addClass('showoverlay');
});
</script>

