<?php

namespace App\Command;

use App\Entity\Payment;
use App\Repository\PaymentRepository;
use App\Service\PaymentDataIndexService;
use App\Service\PaymentDataService;
use App\Service\PaymentSearchExportService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

class GenerateSpreadsheetCommand extends Command
{
  protected static $defaultName = 'app:generate-xls';


  /** @var PaymentSearchExportService  */
  private $paymentSearchExportService;

  /** @var PaymentDataService  */
  private $paymentDataService;

  public function __construct(
    PaymentSearchExportService $paymentSearchExportService,
    PaymentDataService $paymentDataService
  )
  {
    $this->paymentSearchExportService = $paymentSearchExportService;
    $this->paymentDataService = $paymentDataService;

    parent::__construct();
  }

  protected function configure()
  {
    $this->setDescription('Generate an excel spreadsheet')
      ->addArgument('task_id', InputArgument::REQUIRED, 'Id of Payment Search Export Task')
      ->addArgument('batch-size', InputArgument::OPTIONAL, 'How many payments will be retrieved at once', 100);
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
    $taskId = (int) $input->getArgument('task_id');
    $batchSize = (int) $input->getArgument('batch-size');
    $exportsDir = $this->paymentSearchExportService->getExportsDir();
    $output->writeln('Starting task: ' . $taskId);
    $task = $this->paymentSearchExportService->getAndStartExportByTaskId($taskId);

    if (!$task) {
      $output->writeln('Task not found, exiting');
      return;
    }

    $output->writeln('Starting export');

    $fileSystem = new Filesystem();
    $fileName = $this->paymentSearchExportService->generateFileName($task);
    $fullPath = $exportsDir . $fileName;

    $fileSystem->touch($fullPath);
    $fields = array_keys(Payment::getPublicAttributes());
    $headers = implode("\t", $fields) . "\r\n";
    $fileSystem->appendToFile($fullPath, $headers);

    $offset = 0;
    $payments = $this->paymentDataService->searchPayments(
      [$task->getSearchField() => $task->getSearchValue()],
      $batchSize,
      $offset,
      $totalPayments
    );

    do {
      $rows = '';

      foreach ($payments as $payment) {
        $output->writeln('Export Payment: ' . $payment->getId());
        $row = '';

        foreach ($fields as $field) {
          $row .= $payment->$field . "\t";
        }

        $row .= "\r\n";
        $rows .= $row;
      }

      $offset += $batchSize;
      $payments = $this->paymentDataService->searchPayments(
        [$task->getSearchField() => $task->getSearchValue()],
        $batchSize,
        $offset
      );

      $fileSystem->appendToFile($fullPath, $rows);
    } while (count($payments) > 0);


    $task->setComplete(true);
    $this->paymentSearchExportService->markTaskComplete($task, $fileName);
    $output->writeln('Export complete');
  }
}
