<?php

namespace App\Command;

use App\Repository\PaymentRepository;
use App\Service\PaymentDataIndexService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class IndexPaymentsCommand extends Command
{
  protected static $defaultName = 'app:index-payments';

  /**
   * @var PaymentRepository
   */
  private $paymentRepository;

  /** @var PaymentDataIndexService  */
  private $paymentDataIndexService;

  public function __construct(
    PaymentRepository $paymentRepository,
    PaymentDataIndexService $paymentDataIndexService
  )
  {
    $this->paymentRepository = $paymentRepository;
    $this->paymentDataIndexService = $paymentDataIndexService;

    parent::__construct();
  }

  protected function configure()
  {
    $this->setDescription('Index payments into elastic search');
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
    $output->writeln('Starting the Index');

    while (count($paymentIds = $this->paymentRepository->findPaymentsThatNeedToBeIndexed(1)) > 0) {
      $payments = $this->paymentRepository->findBy(['id' => $paymentIds]);
      foreach ($payments as $payment) {
        $this->paymentDataIndexService->indexPayment($payment);
        $output->writeln('Payment ' . $payment->getId() . ' has been indexed');
      }
    }

    $output->writeln('Payments have been indexed');
  }
}
