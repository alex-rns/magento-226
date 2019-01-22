<?php

namespace BelodubrovskyiAn\Lesson10Module\Controller\Adminhtml\AskQuestion;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Action;

/**
 * Class Index
 * @package BelodubrovskyiAn\Lesson10Module\Controller\Adminhtml\AskQuestion
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
        $resultPage->getConfig()->getTitle()->prepend(__('Ask Question'));
        return $resultPage;
    }
}
