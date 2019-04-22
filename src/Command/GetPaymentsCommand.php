<?php

namespace App\Command;

use App\Repository\PaymentRepository;
use App\Service\PaymentDataIndexService;
use App\Service\PaymentDataService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetPaymentsCommand extends Command
{
  protected static $defaultName = 'app:get-payments';


  /** @var PaymentDataService  */
  private $paymentDataService;

  public function __construct(
    PaymentDataService $paymentDataService
  )
  {
    $this->paymentDataService = $paymentDataService;

    parent::__construct();
  }

  protected function configure()
  {
    $this->setDescription('Index payments into elastic search')
      ->addArgument('limit', InputArgument::OPTIONAL, 'How many records do you want to pull', 10000)
      ->addArgument('batch-size', InputArgument::OPTIONAL, 'How many records do you want to pull at once', 1000);
  }

  /**
   * @param InputInterface  $input
   * @param OutputInterface $output
   *
   * @return int|null|void
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
  protected function execute(
    InputInterface $input,
    OutputInterface $output
  )
  {
    $output->writeln('Starting to get payments');
    $limit = $input->getArgument('limit');
    $batch = $input->getArgument('batch-size');
    $count = 0;

    while ($count < $limit) {
      $output->writeln('Getting: ' . $batch . ' payments');
      $this->paymentDataService->importAndSavePayments($batch, $count);
      $output->writeln('Synced ' . $batch . ' payments');
      $count += $batch;
    }
    $output->writeln($count . ' Payments have been saved');
  }
}
