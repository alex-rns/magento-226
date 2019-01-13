<?php
namespace BelodubrovskyiAn\Lesson11ModuleOop\FileList;

class FileList
{
    /**
     * Display list of files and directory in /misc/apps/magento-226/app/code/BelodubrovskyiAn/
     */
    public function giveFileList(): array
    {
        $fileList = [];
        $ite = new \RecursiveDirectoryIterator('/misc/apps/magento-226/app/code/BelodubrovskyiAn/Lesson11ModuleOop/');

        foreach (new \RecursiveIteratorIterator($ite) as $filename) {
//            echo "$filename \n" . 'Date of creation/change: ' . date('F d Y H:i:s.', filemtime($filename)) . "\n\n";
            $fileList[$filename->getFilename()] = [
                $filename->getPathname(),
                $filename->getFilename(),
            ];
        }
        return $fileList;
    }
}