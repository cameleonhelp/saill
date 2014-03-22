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
                echo $this->Html->css('flipcountdown');
                echo $this->Html->css('tablesorter');
                
                echo $this->Html->script('jQuery/jquery');
                echo $this->Html->script('jQuery/jquery.browser');
                //echo $this->Html->script('jQuery/jquery-ui');
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
                echo $this->Html->script('flipcountdown/flipcountdown');
                //mask sur input
                echo $this->Html->script('maskedinput/maskedinput');
                //pour enregistrer image
                echo $this->Html->script('html2canvas/html2canvas');     
                echo $this->Html->script('html2canvas/plugin.html2canvas');                     
                echo $this->Html->script('html2canvas/canvas2image');   
                echo $this->Html->script('base64'); 
                //pour la timeline dans la liste des actions
                //echo $this->Html->script('timeline_js/timeline-api');
                echo $this->Html->script('chronoline/raphael-min');
                echo $this->Html->script('chronoline/chronoline');
                //pour le color picker
                echo $this->Html->script('colorpicker/colorpicker');     
                //echo $this->Html->script('docs'); 
                //sort on table
                echo $this->Html->script('tablesorter/tablesorter');
                echo $this->Html->script('tablesorter/tablesorter.widgets');                
                // compatibilité IE
                echo $this->Html->script('respond');     
                echo $this->Html->script('html5shiv'); 
                
                echo $this->Html->script('bs-custom-sncf');
                
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body <?php echo $this->Session->check('Auth.User') ? 'class="cbp-spmenu-push"' : ''; ?> style="overflow: hidden;">
    <?php 
    //maintenance du site
    if(file_exists (WWW_ROOT.'maintenance.md') && userAuth('profil_id') != 1):
        echo $this->element('layout/maintenance'); 
    else: 
    ?>
    <div id="overlay" style="display:none;"><?php echo $this->Html->image("loading.gif", array('fullBase' => true)); ?> <span class="overlaytext">Chargement en cours, veuillez patienter ...</span></div>
    <?php echo $this->element('layout/modal_ie'); ?>
    <div class="container-fluid">
        <div class="row clearfix">
            <?php if ($this->Session->check('Auth.User')): ?>
            <div class="row-fluid menu-retractable">
            <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
                <!-- DEBUT DU MENU //-->
                
                <?php echo $this->element('layout/horloge'); ?>
                <?php echo $this->element('layout/menu'); ?>
                <!-- FIN DU MENU //-->
            </nav>
                <div class="novisible" id="notvisible"><div class="vertical-text label-menu">⇡ Menu ⇡</div></div>  
            </div>
            <?php endif; ?>
            <!-- DEBUT DU HEADER //-->
            <?php echo $this->element('layout/header'); ?>
            <?php
            if($this->params['action']=="login" || $this->params['action']=='initmypassword'):
                echo $this->element('layout/subheader');
            endif;
            ?>
            <!-- FIN DU HEADER //-->
            <!-- DEBUT DU CONTENU //-->
            <div id="content" class="row" style="margin-left: 0px;margin-right: 0px;margin-top:-17px;">
            <div class="col-sm-12 column" style="margin-top:15px;">
            <div class="cursor" id="flash_message"><?php echo $this->Session->flash(); ?></div>
            <div id="container_message" name="container_message" style="cursor:pointer;" class="alert alert-danger"><ol></ol></div>
            <?php echo $this->fetch('content'); ?>
            </div>
            </div>
        </div>
        <div class="row">
            <!-- FIN DU CONTENU //-->
            <!-- DEBUT DU DEBUG //-->
            <div class="col-sm-12 column" id="debug">
            <?php       
            //debug($this->Session->read('User.history'));
            //debug($this->Session->read('User.goback'));
            //debug($this->request->data);
            //echo $this->element('sql_dump');
            //debug($etats);
            ?>
            </div>
            <!-- FIN DU DEBUG //-->
        </div>
    </div> 
    <?php endif; ?>
    <?php echo $this->element('modals/password'); ?>
<script>
$(document).on('mouseover click','.novisible',function(){
    if($(this).hasClass('active')){
         $(this).removeClass('active');
         $('body').removeClass('cbp-spmenu-push-toright');
         $('#cbp-spmenu-s1').removeClass('cbp-spmenu-open');
         if($('nav.toolbar').hasClass('fixed-active') && $("#content").scrollTop() >= 32){
             $('nav.toolbar').removeClass('fixed-active').addClass('fixed');
         }            
     }else{
         $(this).addClass('active');  
         $('body').addClass('cbp-spmenu-push-toright');
         $('#cbp-spmenu-s1').addClass('cbp-spmenu-open');
         if($('nav.toolbar').hasClass('fixed') && $("#content").scrollTop() >= 32){
             $('nav.toolbar').removeClass('fixed').addClass('fixed-active');
         }
     }       
});
</script>     
</body>
</html>
<script>   
$(document).ready(function () {
    $('.carousel').carousel();
    
    var windows_height = $(window).height();
    var cbpmenu_height = $("#menu").height();
    
    
    $("#content").scroll(function() {
        var right = $('.index').width();
        if(typeof right === "undefined") { right = $('.search').width();}        
        if ( $(this).scrollTop() >= 32){
            if($('body').hasClass('cbp-spmenu-push-toright')){
                $('nav.toolbar').removeClass('fixed').addClass('fixed-active').css('width','auto');
            } else {
                $('nav.toolbar').removeClass('fixed-active').addClass('fixed').css('width',right);
            }   
        } else {
             $('nav.toolbar').removeClass('fixed').removeClass('fixed-active').css('width','auto');
        } 

    });  
    
    $( window ).resize(function() {
        var right = $('.index').width();
        if(typeof right === "undefined") { right = $('.search').width();} 
        $('nav.toolbar').css('width',right);
    });
    
    
        /** first element focus **/
    $("#formValidate").find("input,textarea,select").filter(":not([readonly='readonly']):not([type='file']):not('.dateall'):not('.dateyear-year'):visible:first").focus();

    $(document).on('mouseup','.btn-expand',function(e){
        setTimeout(function(){$(".toolbar-form").find("input[type=text]").focus();},0);
    });    
    
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
        $("[rel=popover]").popover({placement:'auto left',trigger:'manual',html:true,container:'content'});
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

