/* Calcul de l'url de base */
if (!window.location.origin)
     window.location.origin = window.location.protocol+"//"+window.location.host;
var path = window.location.pathname.split( '/' );
var ds = "/";
var pathname = window.location.host=="saill.dsit.sncf.fr" ? "" : ds+path[1]+ds+path[2];
var baseurl = window.location.origin+pathname;


/* fin du calcul url de base */
tinymce.init({ 
   // General options
   language : "fr_FR",
   mode: "textareas",
   forced_root_block : false,
   force_br_newlines : true,
   force_p_newlines : false,
   resize : false,
   statusbar:false,
   skin : 'flat',
   plugins: "hr link textcolor table code searchreplace responsivefilemanager",
   menubar: "file edit insert format table tools",
   toolbar: "undo redo | bold italic | hr link unlink | forecolor | backcolor | numlist bullist | alignleft aligncenter alignright alignjustify | responsivefilemanager  | searchreplace",
   height : "300",
   relative_urls: false,
   convert_urls: false,
   external_filemanager_path:baseurl+"/js/tinymce/plugins/filemanager/",
   filemanager_title:"Gestionnaire de fichier",
   external_plugins: { "filemanager" : baseurl+"/js/tinymce/plugins/responsivefilemanager/plugin.min.js"},
   width : "100%",
   editor_deselector : "mceNoEditor"
    }); 