<?php
namespace BelodubrovskyiAn\Lesson11ModuleOop\Model;

class FileList
{
    /**
     * Display list of files and directory in /misc/apps/magento-226/app/code/BelodubrovskyiAn/
     */
    public function giveFileList()
    {
        $ite = new \RecursiveDirectoryIterator('/misc/apps/magento-226/app/code/BelodubrovskyiAn/Lesson11ModuleOop/');
        $fileList = new \RecursiveIteratorIterator($ite);
        return $fileList;
    }
}
