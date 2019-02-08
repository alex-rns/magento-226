<?php
namespace BelodubrovskyiAn\AskQuestion\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class UpdateProductQty
 * @package BelodubrovskyiAn\AskQuestion\Console\Command
 */
class UpdateProductQty extends \Symfony\Component\Console\Command\Command
{
    /**
     * @var \Magento\Framework\App\State
     */
    protected $state;

    /**
     * @var \Magento\CatalogInventory\Api\StockRegistryInterface
     */
    protected $stockRegistry;

    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * UpdateProductQty constructor.
     * @param \Magento\Framework\App\State $state
     * @param \Magento\CatalogInventory\Api\StockRegistryInterface $stockRegistry
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
     */
    public function __construct(
        \Magento\Framework\App\State $state,
        \Magento\CatalogInventory\Api\StockRegistryInterface $stockRegistry,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
    ) {
        $this->state = $state;
        $this->stockRegistry = $stockRegistry;
        $this->productRepository = $productRepository;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('update_product:set_qty')
            ->setDescription('Update product Qty')
            ->setDefinition([
                new InputArgument(
                    'product_id',
                    InputArgument::OPTIONAL,
                    'Product ID'
                ),
                new InputArgument(
                    'qty',
                    InputArgument::OPTIONAL,
                    'Qty'
                )
            ]);
        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $this->state->setAreaCode(\Magento\Framework\App\Area::AREA_ADMINHTML);

            $productId = (int) $input->getArgument('product_id');

            $product = $this->productRepository->getById($productId);

            $stockItem = $this->stockRegistry->getStockItem($productId);

            $stockItem->setQty((int) $input->getArgument('qty'));

            $stockItem->setIsInStock((int) $input->getArgument('qty'));

            $newQty = (int) $input->getArgument('qty');

            $this->stockRegistry->updateStockItemBySku($product->getSku(), $stockItem);

            $productName = $product->getName();

            $output->writeln('<info>Updated!<info>' . " New quantity of $productName is $newQty");
        } catch (\Exception $e) {
            $output->writeln("<error>{$e->getMessage()}<error>");
        }
    }
}
