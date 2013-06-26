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
                echo $this->Html->script('editable'); 
                echo $this->Html->script('validate');  
                echo $this->Html->script('additional-methods');                  
                echo $this->Html->script('messages_fr'); 
                echo $this->Html->script('datepicker');  
                echo $this->Html->script('tinymce/tinymce');
                echo $this->Html->script('jscroller2'); 
                echo $this->Html->script('datetime');
                echo $this->Html->script('navigation');
                echo $this->Html->script('jquery.session');
                echo $this->Html->script('highcharts');
                echo $this->Html->script('modules/exporting');   
                echo $this->Html->script('modules/data');
                echo $this->Html->script('newsticker'); 
                echo $this->Html->script('accordionMod');
                //pour enregistrer image
                echo $this->Html->script('html2canvas');     
                echo $this->Html->script('canvas2image');   
                echo $this->Html->script('base64'); 
                
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
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
   toolbar: "undo redo | bold italic | hr link | forecolor backcolor | numlist bullist alignleft aligncenter alignright alignjustify | searchreplace",
   height : "300",
   width : "100%"
    }); 
</script> 
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
                    <?php echo $this->Html->link('<i class="icon-home icon-white" style="margin-top:4px;margin-bottom:0px;"></i>&nbsp;S.A.I.L.L. -',array('controller'=>'pages','action'=>'home'),array('class'=>"brand",'escape' => false)); ?>
                    <?php echo $this->Html->link($title_for_layout,"#",array('class'=>"brand","style"=>"margin-left:-35px;margin-top:4px;margin-bottom:0px;",'escape' => false)); ?></div>
		<?php if (userAuth('id') > 0): ?>
                <div class="pull-right">
                    <ul class="nav pull-right">
                      <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                              <i class="icon-user icon-white"></i>&nbsp;&nbsp;<?php echo userAuth('PRENOM'); ?>. <?php echo userAuth('NOM'); ?>
                              <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                              <li><?php echo $this->Html->link('Mon profil',array('controller'=>'utilisateurs','action'=>'profil',userAuth('id')),array('escape' => false)); ?></li>
                              <li><?php echo $this->Html->link('Se déconnecter',array('controller'=>'utilisateurs','action'=>'logout'),array('escape' => false)); ?></li>
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
    /** Application d'un style sur les select **/
    $(".yesno").each( function() { $(this).next(".labelAfter").text(this.checked ? "Oui" : "Non"); });
    $(document).on('click',".yesno",function() {
        $(this).next(".labelAfter").text(this.checked ? "Oui" : "Non");
    });
    /** Messages error - info - warning - success **/
    $(".alert").alert()
    /** Cache la zone de message d'erreur pour le formulaire **/
    $("#container_message").hide();
    /** Tooltip **/
    $("[rel=tooltip]").tooltip({placement:'bottom',trigger:'hover',html:true});
    /** PopOver **/ 
    var isVisible = false;
    var clickedAway = false;
    if ($("[rel=popover]").length) {
        $("[rel=popover]").popover({placement:'bottom',trigger:'manual',html:true});
        $(document).on('click',"[rel=popover]",function(e){
            e.preventDefault;
            $(this).popover('toggle');
            clickedAway = false
            isVisible = true
        });  
    }  
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
         format: 'dd/mm/yyyy',
         weekStart: 1,
		 todayBtn: 'linked',
		 autoclose:true,
		 todayHighlight:true		 
    })
    
   $('#scroller_container').newsticker(8000);
   
   $(".dateremove").click(function(){
           d = new Date;
           $(this).parent().datepicker('update', d.getDate()+'/'+(d.getMonth()+1)+'/'+d.getFullYear());
           $(this).parent().children("input").val('');
	   $(this).parent().data('datepicker').date = null;
   }) 
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
                }).validate({ignore: "",errorContainer: container,errorLabelContainer: $("ol", container),wrapper: 'li',meta: "validate",
    highlight: function(element) {
        $(element).closest('.control-group').addClass('error');
        },
    unhighlight: function(element) {
        $(element).closest('.control-group').removeClass('error');
        }
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
      /** Accordion **/
   /*$("#accordion2").on('click',function(){
       $(this).find('.accordion-body').each(function(index){
           alert('click on accordion!'+" : "+index+" in ? "+$(this).hasClass('in'))
           $(this).collapse('hide');
        });
       
   });
   $("#expand").on("click", function(){
       if (!$(this).hasClass('disabled')){
            $(this).parents().find('.accordion-body').each(function(index){
                //alert('test1 - '+$(this).attr('id')+" : "+index)
                    $(this).removeAttr('style')
                if (!$(this).hasClass('in')) {
                    //alert('show - '+$(this).attr('id')+" : "+index)
                    $(this).collapse('show');
                }
            })
       //$(this).parents().find('#accordion2 *.accordion-body').collapse('show');
       $(this).addClass('disabled')
       $(this).parents().find('#collapse').removeClass('disabled');
       }
   });
   $("#collapse").on("click", function(){
       if (!$(this).hasClass('disabled')){       
            $(this).parents().find('.accordion-body').each(function(index){
                $(this).removeAttr('style')
                if ($(this).hasClass('in')) {
                    //alert('hide - '+$(this).attr('id')+" : "+index)
                    $(this).collapse('hide');
                }
            })       
       //$(this).parents().find('#accordion2 *.accordion-body').collapse('hide');
       $(this).addClass('disabled')
       $(this).parents().find('#expand').removeClass('disabled');   
       }
   });*/ 
});
</script>

