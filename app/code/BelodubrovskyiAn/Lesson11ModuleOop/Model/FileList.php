<?php
namespace BelodubrovskyiAn\Lesson11ModuleOop\Model;

/**
 * Class FileList
 * @package BelodubrovskyiAn\Lesson11ModuleOop\Model
 */
class FileList
{
    /**
     * @return \RecursiveIteratorIterator
     */
    public function giveFileList()
    {
        $ite = new \RecursiveDirectoryIterator('/misc/apps/magento-226/app/code/BelodubrovskyiAn/Lesson11ModuleOop/');
        $fileList = new \RecursiveIteratorIterator($ite);
        return $fileList;
    }
}
