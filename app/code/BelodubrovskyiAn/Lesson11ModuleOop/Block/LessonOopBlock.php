<?php
namespace BelodubrovskyiAn\Lesson11ModuleOop\Block;

use BelodubrovskyiAn\Lesson11ModuleOop\Model\FileList;
use BelodubrovskyiAn\Lesson11ModuleOop\Model\ConstantsMethods;

class LessonOopBlock extends \Magento\Framework\View\Element\Template
{
    public $fileListGet;
    public $constantsAndMethodsGet;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        ConstantsMethods $constantsAndMethods,
        FileList $fileList
    ) {
        parent::__construct($context);
        $this->fileListGet = $fileList;
        $this->constantsAndMethodsGet = $constantsAndMethods;
    }

    public function getFileListObject(): FileList
    {
        return $this->fileListGet;
    }

    public function getConstantsAndMethods(): ConstantsMethods
    {
        return $this->constantsAndMethodsGet;
    }
}
