<?php
namespace BelodubrovskyiAn\AskQuestion\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Store\Model\Store;
use BelodubrovskyiAn\AskQuestion\Model\AskQuestion;

class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var \BelodubrovskyiAn\AskQuestion\Model\AskQuestionFactory
     */
    private $askQuestionFactory;

    /**
     * UpgradeData constructor.
     * @param \BelodubrovskyiAn\AskQuestion\Model\AskQuestionFactory $askQuestionFactory
     */
    public function __construct(\BelodubrovskyiAn\AskQuestion\Model\AskQuestionFactory $askQuestionFactory)
    {
        $this->askQuestionFactory = $askQuestionFactory;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Exception
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.0.3', '<')) {
            $statuses = [AskQuestion::STATUS_PENDING, AskQuestion::STATUS_PROCESSED];
            for ($i = 1; $i <= 5; $i++) {
                /** @var AskQuestion $askQuestion */
                $askQuestion = $this->askQuestionFactory->create();
                $askQuestion->setName("Customer #$i")
                    ->setEmail("test-mail-$i@gmail.com")
                    ->setPhone("+38093-$i$i$i-$i$i-$i$i")
                    ->setProductName("Product #$i")
                    ->setSku("product_sku_$i")
                    ->setQuestion('Just a test question')
                    ->setStatus($statuses[array_rand($statuses)])
                    ->setStoreId(Store::DISTRO_STORE_ID);
                $askQuestion->save();
            }
        }
    }
}
