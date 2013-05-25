<?php
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

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
    
    public function __construct($base=null) {
        $this->diradmin = new Folder($this->dir.$this->admin_dir,true,0777);
        $this->diraall = new Folder($this->dir.$this->all_dir,true,0777);
        $this->dirics = new Folder($this->dir.$this->ics_files_dir,true,0777);
        $this->dirsql = new Folder($this->dir.$this->sql_backup_dir,true,0777);
        $this->urlbase = $base;
    }
    
    public function getAdmFiles(){
        $files = $this->diradmin->findRecursive('.*\.*');
        return $this->arrayfiles($files,$this->admin_dir);
    }
    
    public function getAllFiles(){
        $files = $this->dirall->find('.*\.*');
        return $this->arrayfiles($files,$this->all_dir);
    }
    
    public function getIcsFiles(){
        $files = $this->dirics->find('.*\.ics');
        return $this->arrayfiles($files,$this->ics_files_dir);
    }
    
    public function getSqlFiles(){
        $files = $this->dirsql->findRecursive('.*\.sql',true);
        return $this->arrayfiles($files,$this->sql_backup_dir);
    }    
    
    public function deletefile($file){
        $filetodelete = new File($file);
        if ($filetodelete->delete()):
            return true;
        else:
            return false;
        endif;
    }
    
    public function isfileexist($path){
        $file = new File($path);
        return $file->exists();
    }
    
    public function arrayfiles($files,$absolutepath){
        foreach ($files as $file):
            $thisfile = new File($file);
            $base = $this->urlbase;
            $url = FULL_BASE_URL.$base.DS.$absolutepath.DS.$thisfile->name;
            $this->data[]=array('name'=>$thisfile->name(),'url'=>$url,'file'=>$thisfile->pwd(),'size'=>number_format(($thisfile->size()/1024),2).' ko','created'=>date('d/m/Y H:i:s',$thisfile->lastChange()));
        endforeach;
        return $this->data;
    }
}

?>
