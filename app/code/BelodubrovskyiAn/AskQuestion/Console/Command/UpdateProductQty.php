<?php
namespace BelodubrovskyiAn\AskQuestion\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class UpdateProductQty extends \Symfony\Component\Console\Command\Command
{
    const DEFAULT_COUNT = 20;

    protected function configure()
    {
        $this->setName('update_product:set_qty')
            ->setDescription('Update product Qty')
            ->setDefinition([
                new InputArgument(
                    'count',
                    InputArgument::OPTIONAL,
                    'Count'
                )
            ]);
        parent::configure();
    }
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $count = $input->getArgument('count') ?: self::DEFAULT_COUNT;
        $i = 0;
        while ($i < $count) {
            ++$i;
            $output->writeln("<info>Generated item #$i...<info>");
        }
        $output->writeln("<info>Completed!<info>");
    }
}
