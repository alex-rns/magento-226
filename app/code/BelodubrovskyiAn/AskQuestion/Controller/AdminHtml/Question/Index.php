<?php
namespace BelodubrovskyiAn\AskQuestion\Controller\Adminhtml\Question;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Action;

/**
 * Class Index
 * @package BelodubrovskyiAn\AskQuestion\Controller\Adminhtml\Question
 */
class Index extends Action
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__('Questions'));
        return $resultPage;
    }
}
