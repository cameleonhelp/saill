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
                echo $this->Html->css('glyphicons'); 
                echo $this->Html->css('font-awesome'); 
                echo $this->Html->css('chronoline');
                echo $this->Html->css('datepicker');
                echo $this->Html->css('colorpicker');
                echo $this->Html->css('bs-custom-sncf');
                echo $this->Html->css('iosswitch');
                
                echo $this->Html->script('jQuery/jquery');
                echo $this->Html->script('bootstrap');              
                echo $this->Html->script('validate/validate');  
                echo $this->Html->script('validate/additional-methods');                  
                echo $this->Html->script('validate/messages_fr'); 
                echo $this->Html->script('datepicker/datepicker'); 
                echo $this->Html->script('datepicker/datepicker.fr');
                echo $this->Html->script('tinymce/tinymce');
                echo $this->Html->script('tinymce/initTinyMCE');
                echo $this->Html->script('datetime');
                echo $this->Html->script('highcharts/highcharts');
                echo $this->Html->script('highcharts/highcharts-more');
                echo $this->Html->script('highcharts/modules/exporting');   
                echo $this->Html->script('highcharts/modules/data');
                //mask sur input
                echo $this->Html->script('maskedinput/maskedinput');
                //pour enregistrer image
                echo $this->Html->script('html2canvas');     
                echo $this->Html->script('canvas2image');   
                echo $this->Html->script('base64'); 
                //pour la timeline dans la liste des actions
                //echo $this->Html->script('timeline_js/timeline-api');
                echo $this->Html->script('chronoline/raphael-min');
                echo $this->Html->script('chronoline/chronoline');
                //pour le color picker
                echo $this->Html->script('colorpicker/colorpicker');     
                echo $this->Html->script('docs'); 

                // compatibilité IE
                echo $this->Html->script('respond');     
                echo $this->Html->script('html5shiv'); 
                
                echo $this->Html->script('bs-custom-sncf');
                
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
    <?php if(file_exists (WWW_ROOT.'maintenance.md') && userAuth('profil_id') != 1):
            echo $this->element('maintenance'); 
          else: ?>
    <div id="overlay" style="display:none;"><?php echo $this->Html->image("loading.gif", array('fullBase' => true)); ?> <span class="overlaytext">Chargement en cours, veuillez patienter ...</span></div>
    <!--insert Add red modal //-->
    <div class="modal fade" id="ieredModal" data-color="red" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header" style="background-color:red;color:white;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4>Navigateur non recommandé</h4>
            </div>
            <div class="modal-body">
              <p style="color:red;">Vous utilisez Internet explorer, ce site ne fonctionne pas correctement avec ce navigateur.<br/>Nous vous recommandons d'utiliser Chrome ou Firefox dans leur dernière version.<br/>Merci de votre compréhension.</p>
            </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- /insert Add red modal //-->        
    <div id="wrap">   
       <!-- Fixed navbar -->
       <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
         <div class="navbar-header">
           <?php if (userAuth('id') > 0): ?>
           <button type="button" id="togglemenu" class="navbar-btn" data-target="#panelcontainerleft" data-content="#content">
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
           </button>
           <?php else: ?>
             <div style="margin-left:10px;float:left;">&nbsp;</div>
           <?php endif; ?>
             <div class="pull-left margintop5"><?php echo $this->Html->link($this->Html->image('logo-sncf-galactic.png'),"https://www.int.sncf.fr/",array('escape' => false,'target'=>'blank')); ?></div>
             <div class="pull-left">
             <?php echo $this->Html->link('<span class="glyphicons home hard-grey margintop4 icons-navbar size14"></span>&nbsp;S.A.I.L.L. -',array('controller'=>'pages','action'=>'home'),array('class'=>"navbar-brand showoverlay",'escape' => false)); ?>
             <?php echo $this->Html->link($title_for_layout,"#",array('class'=>"navbar-brand","style"=>"margin-left:-20px;margin-top:0px;margin-bottom:0px;",'escape' => false)); ?>
             </div>
         </div>
         <?php if (userAuth('id') > 0): ?>
           <div class="marginright20">
             <ul class="nav navbar-nav navbar-right">
               <li class="dropdown">
                 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicons user size14 hard-grey marginright10"></span><?php echo userAuth('PRENOM'); ?>. <?php echo userAuth('NOM'); ?><b class="caret"></b></a>
                 <ul class="dropdown-menu">
                    <li><?php echo $this->Html->link('<span class="glyphicons nameplate margintop4 size14 notchange" ></span> Mon profil',array('controller'=>'utilisateurs','action'=>'profil',userAuth('id')),array('escape' => false,'class'=>'showoverlay')); ?></li>
                    <li class="divider"></li>
                    <li><?php echo $this->Html->link('<span class="glyphicons log_out margintop4 size14 notchange" ></span> Se déconnecter',array('controller'=>'utilisateurs','action'=>'logout'),array('class'=>'showoverlay','escape' => false)); ?></li>
                 </ul>
               </li>
             </ul>            
         </div><!--/.nav-collapse -->
         <?php endif; ?>	
       </nav>       
       <div class="container page-header">
        <div class="row" >            
            <?php $valmenu = userAuth('id')>0  ? userAuth('MENU') : 1 ; ?>
            <?php $valmenu = $this->Session->check('userMenu') ? $this->Session->read('userMenu') : $valmenu; ?>
            <?php echo $this->Form->input('MENU', array('type'=>'hidden','value'=>$valmenu)); ?>
            <div id="panelcontainerleft">
            <div id='panelcontrol' class='float'>
                <?php if (userAuth('id')>0) echo $this->element('server'); ?>
                <div id="telecommand">
                <?php if (userAuth('id')>0) echo $this->element('menu'); ?>
                </div>
                <?php if (userAuth('id')>0) echo $this->element('infos'); ?>          
            </div>
            </div>
            <?php $class = $valmenu==1 ? 'col-auto-margin' : 'col-expand'; ?>
            <div id='content' class="<?php echo $class; ?>"> 
                <div class="cursor marginright20" id="flash_message"><?php echo $this->Session->flash(); ?></div>
                <div id="container_message" name="container_message" style="cursor:pointer;width: 98%;" class="alert alert-danger"><ol></ol></div>
                <?php echo $this->fetch('content'); ?>
                <div><?php       
//debug($this->Session->read('User.history'));
//debug($this->Session->read('User.goback'));
//debug($this->request->data);
//echo $this->element('sql_dump'); ?></div>
            </div> 
        </div>
        <div class="navbar navbar-fixed-bottom navbar-inverse">
            <div class="navbar-inner">  
                <div class="text-muted credit marginleft10">
                    <div class="pull-left"><span class="glyphicons right_arrow yellow margintop5 marginright-5 flash1"></span><span class="glyphicons chevron-right red margintop5 flash2"></span></div>
                    <ul id="ticker" class="ticker">
                        <?php echo $this->element('messages_defilant'); ?>
                    </ul>
                </div>               
            </div>           
        </div>
       </div>
    </div> 
    <?php endif; ?>
</body>
</html>
<script>
$(document).ready(function () {
    /** first element focus **/
    $("#formValidate").find("input,textarea,select").filter(":not([readonly='readonly']):not([type='file']):not('.dateyear-year'):visible:first").focus();
    /** Initialisation des durée des actions **/
    $('#ActionDUREEPREVUE').val()=='' ? $('#ActionLblDUREEPREVUE').text('0 jour') : $('#ActionLblDUREEPREVUE').text(($('#ActionDUREEPREVUE').val()/8)+' jours');
    $('#ActionDUREEREELLE').val()=='' ? $('#ActionLblDUREEREELLE').text('0 jour') : $('#ActionLblDUREEREELLE').text(($('#ActionDUREEREELLE').val()/8)+' jours');
    var avancement = $('#ActionAVANCEMENT').val() < 0 ? 0 : $('#ActionAVANCEMENT').val() > 100 ? 100 : $('#ActionAVANCEMENT').val();
    avancement = Math.round(avancement/10)*10;
    $('#ActionAVANCEMENT').val(avancement);
    $('#progressbar').attr('style',"width:"+avancement+"%;");
    
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
    //$("[rel=tooltip]").tooltip({placement:'auto bottom',trigger:'hover',html:true});
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

    $(document).on('click', '#togglemenu', function (e) {
      $.ajax({
        dataType: "html",
        type: "POST",
        url: "<?php echo $this->Html->url(array('controller'=>'utilisateurs','action'=>'setmenuvisible')); ?>/"
      });
      var newval = $("#MENU").val()==1 ? 0 : 1;
      $("#MENU").val(newval);
    })
    
    if ($("#MENU").val()==1) {
        $("#panelcontainerleft").show();
    } else {
        $("#panelcontainerleft").hide();
    }
    /** permet d'affciher un overlay pour éviter les doubles cliques **/
    $(document).on('click','.menu1 .accordion-inner > ul > li > a, .showoverlay:not(".disabled")',function(e){
        var overlay = $('#overlay');
        overlay.show();          
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
   
    var container = $('#container_message');
    $("#formValidate").submit(function() {
                     // update underlying textarea before submit validation
                     tinyMCE.triggerSave();
                     var overlay = $('#overlay');
                     if ($("#formValidate").valid()){ overlay.show(); }                       
     }).validate({ignore: "",errorContainer: container,errorLabelContainer: $("ol", container),wrapper: 'li',meta: "validate",
            highlight: function(element) {
                $(element).closest('.form-control').parents().parent('.form-group').addClass('has-error');
                },
            unhighlight: function(element) {
                $(element).closest('.form-control').parents().parent('.form-group').removeClass('has-error');
                }
    });  
    
    /*mise en place de showoverlay sur prev first prev et last*/
    $('[rel=first]').parent('span').addClass('showoverlay');
    $('[rel=prev]').parent('span').addClass('showoverlay');
    $('[rel=next]').parent('span').addClass('showoverlay');
    $('[rel=last]').parent('span').addClass('showoverlay');
});
</script>

