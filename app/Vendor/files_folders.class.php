<?php
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

/**
 * Description of files
 *
 * @author JLR
 */
class files_folder {
    //put your code here
    var $dir = WWW_ROOT;
    
    var $admin_dir = 'files/admin';
    
    var $all_dir = 'files/all';
    
    var $sql_backup_dir = 'files/sql_backup';
    
    var $ics_files_dir = 'files/icsfiles';
    
    var $diradmin = '';
    
    var $dirall = '';
    
    var $dirsql = '';
    
    var $dirics = '';
    
    var $data = array();
    
    var $urlbase = '';
    
    /**
     * Méthode qui attribut les droits complets sur les différents dossiers
     * 
     * @param string $base
     */
    public function __construct($base=null) {
        $this->diradmin = new Folder($this->dir.$this->admin_dir,true,0777);
        $this->diraall = new Folder($this->dir.$this->all_dir,true,0777);
        $this->dirics = new Folder($this->dir.$this->ics_files_dir,true,0777);
        $this->dirsql = new Folder($this->dir.$this->sql_backup_dir,true,0777);
        $this->urlbase = $base;
    }
    
    /**
     * Méthode qui liste tous les fichiers pour les administrateurs
     * 
     * @return array
     */
    public function getAdmFiles(){
        $files = $this->diradmin->findRecursive('.*\.*');
        return $this->arrayfiles($files,$this->admin_dir);
    }
    
    /**
     * Méthode qui liste tous les fichiers pour tous les acteurs
     * 
     * @return array
     */
    public function getAllFiles(){
        $files = $this->dirall->find('.*\.*');
        return $this->arrayfiles($files,$this->all_dir);
    }
    
    /**
     * Méthode qui liste tous les fichier ics du dossier
     * 
     * @return array
     */
    public function getIcsFiles(){
        $files = $this->dirics->find('.*\.ics');
        return $this->arrayfiles($files,$this->ics_files_dir);
    }
    
    /**
     * Méthode qui retourne un tableau des fichier sql ou zip du dossier
     * 
     * @return array
     */
    public function getSqlFiles(){
        $filessql = $this->dirsql->findRecursive('.*\.sql',true);
        $filezip = $this->dirsql->findRecursive('.*\.zip',true); 
        $files = array_merge($filessql,$filezip);
        return $this->arrayfiles($files,$this->sql_backup_dir);
    }    
    
    /**
     * Méthode pour supprimer physiquement un fichier
     * 
     * @param string $file
     * @return boolean
     */
    public function deletefile($file){
        $filetodelete = new File($file);
        if ($filetodelete->delete()):
            return true;
        else:
            return false;
        endif;
    }
    
    /**
     * Méthode qui test l'existance d'un fichier
     * 
     * @param string $path
     * @return type
     */
    public function isfileexist($path){
        $file = new File($path);
        return $file->exists();
    }
    
    /**
     * Méthode pour lister les fichiers d'un array et retourner un tableau avec des informations particulières sur les fichiers
     * 
     * @param array $files
     * @param string $absolutepath
     * @return array
     */
    public function arrayfiles($files,$absolutepath){
        foreach ($files as $file):
            $thisfile = new File($file);
            $base = $this->urlbase;
            $url = FULL_BASE_URL.$base.DS.$absolutepath.DS.$thisfile->name;
            $this->data[]=array('name'=>$thisfile->name(),'url'=>$url,'file'=>$thisfile->pwd(),'size'=>number_format(($thisfile->size()/1024),2).' ko','created'=>date('d/m/Y H:i:s',$thisfile->lastChange()));
        endforeach;       
        return $this->data;
    }
    
    /**
     * Méthode qui test si l'OS du serveur Web est sous Windows
     * 
     * @return boolean
     */
    public function iswindows(){
        $folder = new Folder();
        $path = APP;
        return $folder->isWindowsPath($path);
    }
    
    /**
     * Méthode qui remanote les permissions du fichier
     * 
     * @param string $file
     * @return array
     */
    public function getdroits($file){
        $nfile = new File($file);
        return $nfile->perms();
    }
}

?>
