<?php
namespace BelodubrovskyiAn\AskQuestion\Model;

use BelodubrovskyiAn\AskQuestion\Model\ResourceModel\AskQuestion as AskQuestionResource;

/**
 * Class AskQuestion
 * @package BelodubrovskyiAn\AskQuestion\Model
 *
 * @method int|string getQuestionId()
 * @method int|string getName()
 * @method AskQuestion setName(string $name)
 * @method string getEmail()
 * @method AskQuestion setEmail(string $email)
 * @method string getPhone()
 * @method AskQuestion setPhone(string $phone)
 * @method string getProductName()
 * @method AskQuestion setProductName(string $productName)
 * @method string getSku()
 * @method AskQuestion setSku(string $sku)
 * @method string getQuestion()
 * @method AskQuestion setQuestion(string $question)
 * @method string getCreatedAt()
 * @method string getStatus()
 * @method AskQuestion setStatus(string $status)
 * @method int|string getStoreId()
 * @method AskQuestion setStoreId(int $storeId)
 */
class AskQuestion extends \Magento\Framework\Model\AbstractModel
{
    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSED = 'processed';

    protected function _construct()
    {
        $this->_init(AskQuestionResource::class);
    }
}
