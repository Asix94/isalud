<?php

declare(strict_types=1);

namespace App\PorfolioClients\Command;

use App\PorfolioClients\Application\CustomerCsvCreator;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:generate-portfolio')]
final class GeneratePortfolio extends Command
{
    public function __construct(private readonly CustomerCsvCreator $customerCsvCreator)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Portfolio users')
            ->addArgument('filename', InputArgument::REQUIRED, 'only filename')
            ->addArgument('xml', InputArgument::OPTIONAL, '');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $this->customerCsvCreator->__invoke($input->getArgument('filename') . '.csv', $input->getArgument('xml'));
            return Command::SUCCESS;
        } catch (\Exception $e) {
            echo $e->getMessage();
            return Command::FAILURE;
        }
    }
}
