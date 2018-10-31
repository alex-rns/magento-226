<?php
namespace BelodubrovskyiAn\MyCustomModule\Controller\ShowPerson;
use Magento\Framework\Controller\ResultFactory;
class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        $name = "Aleksandr";
        $lastName = "Belodubrovskyi";
        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getLayout()->getBlock('homework.custom.block')->setName($name)->setLastName($lastName);
        return $resultPage;
    }
}