/**
 * Pour les dates dépendance du fichiermaskedinput.js pour la place du masque de saisie sur la date
 */

/**
 * Fonction pour reculer la valeur de la progressbar
 * 
 */

+function ($) { "use strict";
    $(document).on('click', '.circle_minus.progress-bar-font', function (e) {
      var $this    = $(this);
      var selector = $this.attr('data-parent');         
      var value = $(selector).attr('data-value');
      var step = $(selector).attr('data-step');
      if (value >= 5){
        value = parseFloat(value)-parseFloat(step);
        $(selector).html(value+"%");
        $(selector).attr('data-value',value);
        $(selector).attr('style',"width:"+value+"%;");
        var style = 'progress-bar-danger progress-bar-striped';
        switch (true){
            case (value >= 0 && value < 21):           
                style = 'progress-bar-danger';
                break;
            case (value >= 21 && value < 51):
                style = 'progress-bar-warning';
                break;
            case (value >= 51 && value < 71):
                style = 'progress-bar-info';
                break;
            case (value >= 71 && value < 100):
                style = '';
                break;                
            case (value == 100):
                style = 'progress-bar-success';
                break; 
        }
        $(selector).removeClass('progress-bar-danger');
        $(selector).removeClass('progress-bar-striped');
        $(selector).removeClass('progress-bar-warning');
        $(selector).removeClass('progress-bar-info');
        $(selector).removeClass('progress-bar-success');        
        $(selector).addClass(style);
      }
      e.preventDefault();  
    })
}(window.jQuery);

/**
 * Fonction pour avancer la valeur de la progressbar
 */
+function ($) { "use strict";
    $(document).on('click', '.circle_plus.progress-bar-font', function (e) {
      var $this    = $(this);
      var selector = $this.attr('data-parent');         
      var value = $(selector).attr('data-value');
      var step = $(selector).attr('data-step');
      if (value < 100){
        value = parseFloat(value)+parseFloat(step);
        $(selector).html(value+"%");
        $(selector).attr('data-value',value);
        $(selector).attr('style',"width:"+value+"%;");
        var style = 'progress-bar-danger progress-bar-striped';
        switch (true){
            case (value >= 0 && value < 21):           
                style = 'progress-bar-danger';
                break;
            case (value >= 21 && value < 51):
                style = 'progress-bar-warning';
                break;
            case (value >= 51 && value < 71):
                style = 'progress-bar-info';
                break;
            case (value >= 71 && value < 100):
                style = '';
                break;                
            case (value == 100):
                style = 'progress-bar-success';
                break; 
        }
        $(selector).removeClass('progress-bar-danger');
        $(selector).removeClass('progress-bar-striped');
        $(selector).removeClass('progress-bar-warning');
        $(selector).removeClass('progress-bar-info');
        $(selector).removeClass('progress-bar-success');        
        $(selector).addClass(style);        
      }
      e.preventDefault();  
    })
}(window.jQuery);

/**
 * Fonction pour convertir un nombre d'heure en jour
 * @param {type} heure
 * @returns {nb de jours}
 */
function hour2day(hour){
    var jour = (hour/8) > 1 ? ' jours' : ' jour';
    return parseFloat(hour/8)+jour;
}

/**
 * Fonction pour reculer la valeur de la zone définie en data-parent
 */
+function ($) { "use strict";   
    $(document).on('click', '.circle_minus.zone-font', function (e) {
      var $this    = $(this);
      var selector = $this.attr('data-parent');         
      var value = $(selector).attr('data-value');
      var step = $(selector).attr('data-step');
      if (value > 0){
        value = parseFloat(value)-parseFloat(step);
        value = value < 0 ? 0 : value;
        $(selector).html(value+":00");
        $(selector).attr('data-value',value);
        if ($(selector).parent().find(selector+"_label").size() == 0){
            $(selector).parent().find('.circle_plus').after("<label id='"+selector.substring(1)+"_label' class='marginleft10'>"+hour2day(value)+"</label>");
        } else {
            $(selector).parent().find(selector+"_label").text(hour2day(value));
        }
      }
      e.preventDefault();      
    })
}(window.jQuery);

/**
 * Fonction pour avancer la valeur de la zone définie en data-parent
 */
+function ($) { "use strict";   
    $(document).on('click', '.circle_plus.zone-font', function (e) {
        var $this    = $(this);
        var selector = $this.attr('data-parent');         
        var value = $(selector).attr('data-value');
        var step = $(selector).attr('data-step');
        value = parseFloat(value)+parseFloat(step);
        $(selector).html(value+":00");
        $(selector).attr('data-value',value);
        if ($(selector).parent().find(selector+"_label").size() == 0){
            $(selector).parent().find('.circle_plus').after("<label id='"+selector.substring(1)+"_label' class='marginleft10'>"+hour2day(value)+"</label>");
        } else {
            $(selector).parent().find(selector+"_label").text(hour2day(value));
        }
        e.preventDefault();      
    })
}(window.jQuery);

/**
 * Fonction pour cache ou rendre visible le menu de gauche
 */
+function ($) { "use strict";       
    $(document).on('click', '#togglemenu', function (e) {
      var $this    = $(this);
      var selector = $this.attr('data-target'); 
      var content = $this.attr('data-content');
      $(content).hasClass('col-auto-margin') ? $(content).removeClass('col-auto-margin').addClass('col-expand'):$(content).removeClass('col-expand').addClass('col-auto-margin'); 
      $(selector).toggle();
      e.preventDefault();      
    })
}(window.jQuery);

/**
 * Fonction permettant de savoir si la hauteur d'une div est supérieure à la fenêtre
 * @param {type} div_height
 * @returns {Boolean}
 */
function isoverflow(div_height){
   var height = parseInt($(window).height())-66;
   var result = div_height > height;
   return result;
};

/**
 * Positionne ou non les boutons de scroll de la zone menu
 * Fonction utilisée à plusieurs reprise
 */
function toggleBtn(){
    if (isoverflow($('.float').height())){
        $('.float').css('top') < 60 ? $('.scroll-btn-top').fadeIn() : $('.scroll-btn-top').fadeOut();
        $('.scroll-btn-bottom').fadeIn();
    }
    else {
        $('.float').css('top',60);
        $('.scroll-btn-top').fadeOut();
        $('.scroll-btn-bottom').fadeOut();
    }        
}; 
        
/**
 * Fonction pour l'affichage du menu en fonction de l'entete cliquée
 */
+function ($) { "use strict";   
        $(document).on ("shown.bs.collapse","#menu .panel", function(e) {
            //on remplace in par collapse dans toutes les div .panel-collapse
            var bodycollapse = $("#menu .panel-collapse");
            bodycollapse.removeClass('in').removeClass('collapse').addClass('collapse');
            //je recupére les div contenant le sous-menu
            var $t = $(e.target);
            //je recupére les span avec le chevron
            var heading = $t.parents().find('*.panel-heading span');
            //je mets tous les chevron comme fermés
            heading.removeClass('chevron-down').addClass('chevron-right grey');
            //je recupére le span avec le chevron cliqué
            var this_heading = $t.prev().find('span');
            $t.removeClass('collapse').addClass('in');
            //je change la classe du chevron
            this_heading.addClass('chevron-down').removeClass('chevron-right grey');
            //$('.float').css('top',60);
            toggleBtn();
        });
        
        $(document).on ("hide.bs.collapse","#menu .panel", function(e) {

            //je recupére les div contenant le sous-menu
            var $t = $(e.target);
            //je recupére les span avec le chevron
            var heading = $t.parents().find('*.panel-heading span');
            //je mets tous les chevron comme fermés
            heading.removeClass('chevron-down').addClass('chevron-right grey');
            //je recupére le span avec le chevron cliqué
            var this_heading = $t.prev().find('span');
            $t.addClass('collapse').removeClass('in');
            //je change la classe du chevron
            this_heading.removeClass('chevron-down').addClass('chevron-right grey');
            //$('.float').css('top',60);
            toggleBtn();
        });
}(window.jQuery);

/**
 * Fonction pour l'affichage du menu en fonction de l'entete cliquée
 */
+function ($) { "use strict";   
        $(document).on ("shown.bs.collapse hidden.bs.collapse",".panel:not(#menu .panel)", function(e) {
            //$('.float').css('top',60);
            toggleBtn();
        });
}(window.jQuery);
/**
 * Fonction pour l'affichage du calendrier dans les input avec la classe date
 */
+function ($) { "use strict";       
    $(document).on('click', '.date-addon-calendar', function (e) {
      var $this    = $(this); 
      var target   = $this.attr('data-target'); 
      $(target).focus();
      e.preventDefault();      
    })
}(window.jQuery);

/**
 * Fonction pour supprimer la date de la zone calendrier dans les input avec la classe date
 */
+function ($) { "use strict";       
    $(document).on('click', '.date-addon-clean', function (e) {
      var $this    = $(this); 
      var target   = $this.attr('data-target'); 
      $(target).val('');
      e.preventDefault();      
    })
}(window.jQuery);

/**
 * Fonction pour mettre la date de la zone calendrier dans les input avec la classe date à la date de data-default
 */
+function ($) { "use strict";       
    $(document).on('click', '.date-addon-default', function (e) {
      var $this    = $(this); 
      var target   = $this.attr('data-target'); 
      var date   = $this.attr('data-default');
      $(target).val(date);
      e.preventDefault();      
    })
}(window.jQuery);

/**
 * flash avec la couleur blanche
 */
+function ($) { "use strict";  
    function interval(coef){
        var coef = parseInt(coef);
        var round = Math.round(Math.random()*coef);
        round = round < 100 ? 100 : round;
        return round;
    }
    
    setInterval(function(){$('.flash1').toggleClass('yellow hardgrey')},interval('2000')); 
    setInterval(function(){$('.flash2').toggleClass('red hardgrey')},interval('2000'));
    setInterval(function(){$('.flash1').toggleClass('hardgrey yellow')},interval('1000')); 
    setInterval(function(){$('.flash2').toggleClass('hardgrey red')},interval('1000'));      
}(window.jQuery);

/**
 * Fonction pour fermer les popover en cliquant sur une partie de la page
 */
+function ($) { "use strict";       
    /**
    * Add the equals method to the jquery objects
    */
    $.fn.equals = function(compareTo) {
      if (!compareTo || this.length !== compareTo.length) {
        return false;
      }
      for (var i = 0; i < this.length; ++i) {
        if (this[i] !== compareTo[i]) {
          return false;
        }
      }
      return true;
    };

    /**
     * Activate popover message for all concerned fields
     */
    var popoverOpened = null;
    $(function() { 
        $('[data-rel=popover]').popover({
            html: true,
            placement:'auto',
            trigger: 'click'
        });
        $('[data-rel=popover]').unbind("click");
        $('[data-rel=popover]').bind("click", function(e) {
            e.stopPropagation();
            if($(this).equals(popoverOpened)) return;
            if(popoverOpened !== null) {
                popoverOpened.popover("hide");            
            }
            $(this).popover('show');
            popoverOpened = $(this);
            e.preventDefault();
        });

        $(document).click(function(e) {
            if(popoverOpened !== null) {
                popoverOpened.popover("hide");   
                popoverOpened = null;
            }        
        });
    }); 
}(window.jQuery);

/**
 * Message de bas de page function pour les changer
 * tick = message défilant vers le haut
 * tick_opacity = message disparaisant avant l'apparition du suivant
 */
+function ($) {"use strict";  
    function tick(){
        $('#ticker li:first').slideUp( function () { $(this).appendTo($('#ticker')).slideDown(); });
    }
    
    function tick_opacity(){
    $('#ticker li:first').animate({'opacity':0}, 1000, function () { $(this).appendTo($('#ticker')).css('opacity', 1); });
    }
    
    function interval(){
        var round = Math.round(Math.random()*10000);
        round = round < 5000 ? 5000 : round;
        return round;
    }
    
    $(document).on('mouseover','#ticker',function(){window.clearInterval(intervalID);});
    $(document).on('mouseout','#ticker',function(){intervalID = window.setInterval(function(){tick_opacity()}, interval());});
    
    var intervalID = window.setInterval(function(){ tick_opacity() }, interval()); 
    
}(window.jQuery);

/**
 * Fonction pour selectionner toutes les checkbox ayant la class selectable
 */
+function ($) { "use strict";  
    $(document).on('click','.selectall',function(){
        $(this).parents().parents().find('input.selectable:checkbox').prop('checked', this.checked);
        var value = "";
        if ($(this).is(':checked')){
                $("input.selectable:checkbox").each(
                        function() {
                            if (value==""){
                                value=$(this).attr('data-id');                    
                            }else{
                                value += "-"+$(this).attr('data-id');
                            }
                        });          
            }else{
                value = "";
            }        
        $(this).attr("data-select",value);
        //alert($(this).attr("data-select"));
    });
}(window.jQuery);

/**
 * Fonction pour mettre à jour la valeur de data-select suite à une modification d'une checkbox selectable
 */
+function ($) { "use strict";  
    $(document).on('click','.selectable',function(){
        var value = $('input.selectall:checkbox').attr("data-select");
        if ($(this).is(':checked')){
            if (value==""){
                value = $(this).attr('data-id');                     
            }else{
                value += "-"+$(this).attr('data-id');
            }
        } else {
            var list = value;
            var tmp = "";
            value = "";
            tmp = list.replace($(this).attr('data-id')+"-", "");
            if (tmp == list) tmp = list.replace("-"+$(this).attr('data-id'), ""); 
            value = tmp;
        }
        $('input.selectall:checkbox').attr("data-select",value);
        //alert($('input.selectall:checkbox').attr("data-select"));
    });
}(window.jQuery);

/**
 * Event sur le click des boutons de scroll de la zone menu
 */
+function($){"use strict";
       $(document).on('click','.scroll-btn-bottom',function () {
            var top = parseInt($('.float').css('top'))-33;
            top < 60 ? $('.scroll-btn-top').fadeIn() : $('.scroll-btn-top').fadeOut();
            var diff = parseInt($(window).height() - $('.float').height())-33;
            top > diff ? $('.scroll-btn-bottom').fadeIn() : $('.scroll-btn-bottom').fadeOut();
            $('.float').css('top',top);
        });
        $(document).on('click','.scroll-btn-top',function () {
            var top = parseInt($('.float').css('top'))+33;
            top < 60 ? $('.scroll-btn-top').fadeIn() : $('.scroll-btn-top').fadeOut();
            var diff = parseInt($(window).height() - $('.float').height())-33;
            top > diff ? $('.scroll-btn-bottom').fadeIn() : $('.scroll-btn-bottom').fadeOut();            
            $('.float').css('top',top);
        });        
}(window.jQuery);

/** 
 * Aide au calcul du Tarif TTC 
 */
+function($){"use strict";
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
}(window.jQuery);
    
/**
 * Interception de l'utilisation de la touche Escape pour cahcer l'overlay
 */    
+function($){
    $(document).keyup(function(e) {
      if (e.keyCode == 27) {$('#overlay').hide(); }   // esc
    });      
}(window.jQuery);
/**
 * Functions en cas de changement sur la page des ouvertures de droits pour activier ou désactiver les selects
 */    
+function($){"use strict";
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
}(window.jQuery);

/*
 * Function en cas de changement sur la page de dotation pour activer ou déscativer les selects
 */
+function($){"use strict";
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
}(window.jQuery);

/*
 * Function pour afficher Oui ou Non aprés les cases à cocher avec la class YesNo
 */
-function ($){"use strict";
    /** Ajout de Oui/Non dans le label aprés la case à cocher **/
    $(".yesno").each( function() { $(this).next(".labelAfter").text(this.checked ? "Oui" : "Non"); });
    
    /** Chagenement du label aprés un clique sur la case à cocher **/
    $(document).on('click',".yesno",function() {
        $(this).next(".labelAfter").text(this.checked ? "Oui" : "Non");
    }); 
}(window.jQuery);

/**
 * Fermeture des messages au bour de 20 secondes ou sur click du message
 */
+function ($) {"use strict";  
    
    setTimeout(function(){ jQuery(".alert").hide(); }, 20000);
    
    $(document).on('click','.alert',function(e){
        $(this).hide();
    })

    
}(window.jQuery);

$(document).ready(function () {
    /*
     * pour l'affichage de la fenetre modal si navigateur = msie
     */
    var navigateur = navigator.userAgent.toLowerCase().indexOf('msie');
    if (navigateur > -1) {
         $('#ieredModal').modal();
    }
    
    /*
     * on cahce tout ce qui doit être caché au démarrage 
     */
    
    /*
     * Initilaisation des tooltips
     */
    $("[rel=tooltip]").tooltip({placement:'auto bottom',container:'body',trigger:'hover',html:true});
     /*
     * Initialisation des popover
     */
    $("[data-rel=popover]").popover({placement:'auto',trigger:'click',html:true});        
    /*
     * Initialisation des bouton de scroll de la zone menu
     */
    $('.scroll-btn-top').hide();
    $('.scroll-btn-bottom').hide(); 
    toggleBtn();
    $(window).resize(function(){
        toggleBtn();
    });
    
    /*
     * Initialisation des differents types de calendrier possible en fonction de la classe
     */
    $('.date').datepicker({
        format: "dd/mm/yyyy",
        weekStart: 1,
        todayBtn: true,
        language: "fr",
        daysOfWeekDisabled: "0,6",
        calendarWeeks: false,
        autoclose: true,
        todayHighlight: true
    });
    $('.date').mask('99/99/9999',{placeholder:".."});
    $('.dateall').datepicker({
        format: "dd/mm/yyyy",
        weekStart: 1,
        todayBtn: true,
        language: "fr",
        calendarWeeks: false,
        autoclose: true,
        todayHighlight: true
    });
    $('.dateall').mask('99/99/9999',{placeholder:".."});    
    $('.dateweek').datepicker({
        format: "dd/mm/yyyy",
        weekStart: 1,
        todayBtn: true,
        language: "fr",
        daysOfWeekDisabled: "0,6",
        calendarWeeks: true,
        autoclose: true,
        todayHighlight: true
    });  
    $('.dateweek').mask('99/99/9999',{placeholder:".."});
    $('.datemonth').datepicker({
        format: "dd/mm/yyyy",
        weekStart: 1,
        startView: 1,
        todayBtn: true,
        language: "fr",
        daysOfWeekDisabled: "0,6",
        calendarWeeks: true,
        autoclose: true,
        todayHighlight: true
    });     
    $('.datemonth').mask('99/99/9999',{placeholder:".."});
    $('.dateyear').datepicker({
        format: "dd/mm/yyyy",
        weekStart: 1,
        startView: 2,
        todayBtn: true,
        language: "fr",
        daysOfWeekDisabled: "0,6",
        calendarWeeks: true,
        autoclose: true,
        todayHighlight: true
    }); 
    $('.dateyear').mask('99/99/9999',{placeholder:".."});
    $('.dateyear-year').datepicker({
    format: "yyyy",
    startView: 2,
    minViewMode: 2,
    todayBtn: "linked",
    language: "fr",
    orientation: "top auto",
    autoclose: true
});
    $('.dateyear-year').mask('9999',{placeholder:"A"});
    $('.year-only').mask('9999',{placeholder:"A"});
    $('.projet-galilei').mask('99999-9999999999',{placeholder:"0"});
    $('.activite-galilei').mask('999999999999999',{placeholder:"0"});
    $('.dateonly').mask('99/99/9999',{placeholder:".."});
    //$('.frais').mask('9999.99',{placeholder:"0"});
});