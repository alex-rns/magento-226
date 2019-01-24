<?php
namespace BelodubrovskyiAn\Lesson11ModuleOop\Block;

use BelodubrovskyiAn\Lesson11ModuleOop\Model\FileList;
use BelodubrovskyiAn\Lesson11ModuleOop\Model\ConstantsMethods;
use BelodubrovskyiAn\Lesson11ModuleOop\Model\Parameters;

/**
 * Class LessonOopBlock
 * @package BelodubrovskyiAn\Lesson11ModuleOop\Block
 */
class LessonOopBlock extends \Magento\Framework\View\Element\Template
{
    /**
     * @var FileList
     */
    public $fileListGet;
    /**
     * @var ConstantsMethods
     */
    public $constantsAndMethodsGet;
    /**
     * @var Parameters
     */
    public $parametersGet;

    /**
     * LessonOopBlock constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param ConstantsMethods $constantsAndMethods
     * @param FileList $fileList
     * @param Parameters $parameters
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        ConstantsMethods $constantsAndMethods,
        FileList $fileList,
        Parameters $parameters
    ) {
        parent::__construct($context);
        $this->fileListGet = $fileList;
        $this->constantsAndMethodsGet = $constantsAndMethods;
        $this->parametersGet = $parameters;
    }

    /**
     * @return \RecursiveIteratorIterator
     */
    public function giveFileList(): \RecursiveIteratorIterator
    {
        return $this->fileListGet->giveFileList();
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public function getMethods(): array
    {
        return $this->constantsAndMethodsGet->getMethods();
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public function getConstants(): array
    {
        return $this->constantsAndMethodsGet->getConstants();
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parametersGet->getParameters();
    }
}
