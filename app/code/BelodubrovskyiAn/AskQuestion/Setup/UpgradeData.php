<?php
namespace BelodubrovskyiAn\AskQuestion\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Store\Model\Store;
use BelodubrovskyiAn\AskQuestion\Model\AskQuestion;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Customer\Model\Customer;
use Magento\Eav\Model\Entity\Attribute\Source\Boolean;
use Magento\Customer\Model\GroupFactory;
use Magento\Customer\Model\ResourceModel\GroupRepository;

class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var \BelodubrovskyiAn\AskQuestion\Model\AskQuestionFactory
     */
    private $askQuestionFactory;

    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * @var \Magento\Customer\Model\Attribute
     */
    private $customerAttribute;

    /**
     * @var GroupFactory
     */
    private $groupFactory;

    /**
     * @var GroupRepository
     */
    private $groupRepository;

    /**
     * UpgradeData constructor.
     * @param \BelodubrovskyiAn\AskQuestion\Model\AskQuestionFactory $askQuestionFactory
     * @param EavSetupFactory $eavSetupFactory
     * @param \Magento\Customer\Model\Attribute $customerAttribute
     * @param GroupFactory $groupFactory
     * @param GroupRepository $groupRepository
     */
    public function __construct(
        \BelodubrovskyiAn\AskQuestion\Model\AskQuestionFactory $askQuestionFactory,
        EavSetupFactory $eavSetupFactory,
        \Magento\Customer\Model\Attribute $customerAttribute,
        GroupFactory $groupFactory,
        GroupRepository $groupRepository
    ) {
        $this->askQuestionFactory = $askQuestionFactory;
        $this->eavSetupFactory = $eavSetupFactory;
        $this->customerAttribute = $customerAttribute;
        $this->groupFactory = $groupFactory;
        $this->groupRepository = $groupRepository;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        if (version_compare($context->getVersion(), '1.0.4', '<')) {
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

        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'allow_to_ask_questions',
            [
                'type' => 'int',
                'backend' => '',
                'frontend' => '',
                'label' => 'Allow to ask questions',
                'input' => 'boolean',
                'class' => '',
                'source' => \Magento\Eav\Model\Entity\Attribute\Source\Boolean::class,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => true,
                'required' => true,
                'user_defined' => false,
                'default' => 1,
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'unique' => false,
                'apply_to' => '',
                'sort_order' => 15,
                'group' => 'General'
            ]
        );

        if (version_compare($context->getVersion(), '1.0.5') < 0) {
            $this->createDisallowAslQuestionCustomerAttribute($setup);
        }
        $setup->endSetup();

        if (version_compare($context->getVersion(), '1.0.6') < 0) {
            $this->createDisallowAskQuestionCustomerGroup();
        }

        if (version_compare($context->getVersion(), '1.0.7') < 0) {
            $this->createCorpusAddressCustomerAttribute($setup);
        }
    }

    /**
     * @param $setup
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function createDisallowAslQuestionCustomerAttribute($setup)
    {
        $code = 'disallow_ask_question';
        /** @var \Magento\Eav\Setup\EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(
            Customer::ENTITY,
            'disallow_ask_question',
            [
                'type'         => 'int',
                'label'        => 'Disallow Ask Question',
                'input'        => 'select',
                'source'       => Boolean::class,
                'required'     => false,
                'visible'      => false,
                'user_defined' => true,
                'position'     => 999,
                'system'       => 0,
                'default'      => 0,
                'used_in_forms' => ['adminhtml_customer', 'customer_account_edit'],
            ]
        );
        $attribute = $this->customerAttribute->loadByCode(Customer::ENTITY, $code);
        $attribute->addData([
            'attribute_set_id' => 1,
            'attribute_group_id' => 1,
            'used_in_forms' => ['adminhtml_customer', 'customer_account_edit'],
        ])->save();
    }

    /**
     * @param $setup
     * @throws \Exception
     */
    public function createDisallowAskQuestionCustomerGroup()
    {
        /** @var \Magento\Customer\Model\Group $group */
        $group = $this->groupFactory->create();
        $group->setCode('Forbidden for Ask Question')->save();
    }

    /**
     * @param $setup
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function createCorpusAddressCustomerAttribute($setup)
    {
        $code = 'corpus';
        /** @var \Magento\Eav\Setup\EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(
            'customer_address',
            $code,
            [
                'label'        => 'Corpus',
                'input'        => 'text',
                'required'     => false,
                'visible'      => true,
                'position'     => 888,
                'system'       => 0
            ]
        );
        $attribute = $this->customerAttribute->loadByCode('customer_address', $code);
        $attribute->addData([
            'used_in_forms' => ['adminhtml_customer_address', 'customer_address_edit', 'customer_register_address'],
        ])->save();
    }
}
