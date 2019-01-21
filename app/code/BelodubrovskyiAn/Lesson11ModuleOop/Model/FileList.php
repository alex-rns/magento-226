<?php
namespace BelodubrovskyiAn\Lesson11ModuleOop\Model;

/**
 * Class FileList
 * @package BelodubrovskyiAn\Lesson11ModuleOop\Model
 */
class FileList
{
    /**
     * @var \Magento\Framework\Filesystem\DirectoryList
     */
    protected $_dir;

    /**
     * FileList constructor.
     * @param \Magento\Framework\Filesystem\DirectoryList $dir
     */
    public function __construct(\Magento\Framework\Filesystem\DirectoryList $dir)
    {
        $this->_dir = $dir;
    }

    /**
     * @return \RecursiveIteratorIterator
     */
    public function giveFileList()
    {
        $mypath = $this->_dir->getRoot() . '/app/code/';
        $ite = new \RecursiveDirectoryIterator($mypath);
        $fileList = new \RecursiveIteratorIterator($ite);
        return $fileList;
    }
}
