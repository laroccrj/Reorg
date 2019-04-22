<?php
/**
 * Service to handle exporting to xls files
 */

namespace App\Service;


use App\Entity\PaymentSearchExportTask;
use App\Repository\PaymentSearchExportTaskRepository;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Process\Process;

class PaymentSearchExportService
{
  const EXPORTS_DIR = '/tmp/reorg_exports/';

  /**
   * @var PaymentDataService
   */
  public $paymentDataService;

  /**
   * @var PaymentSearchExportTaskRepository
   */
  public $paymentSearchExportTaskRepository;

  /**
   * PaymentSearchExportService constructor.
   *
   * @param PaymentDataService $paymentDataService
   * @param PaymentSearchExportTaskRepository $paymentSearchExportTaskRepository
   */
  public function __construct(
    PaymentDataService $paymentDataService,
    PaymentSearchExportTaskRepository $paymentSearchExportTaskRepository
  )
  {
    $this->paymentDataService = $paymentDataService;
    $this->paymentSearchExportTaskRepository = $paymentSearchExportTaskRepository;
  }

  /**
   * @param null|string $searchField
   * @param null|string $searchValue
   *
   * @return PaymentSearchExportTask
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
  public function createExportTask(?string $searchField, ?string $searchValue)
  {
    $exportTask = new PaymentSearchExportTask();
    $exportTask->setSearchField($searchField)
      ->setSearchValue($searchValue)
      ->setComplete(false)
      ->setStarted(false);

    return $this->paymentSearchExportTaskRepository->savePaymentSearchExportTask($exportTask);
  }

  /**
   * @param PaymentSearchExportTask $task
   */
  public function startExportTask(PaymentSearchExportTask $task) {
    $process = new Process(['php', '../bin/console', 'app:generate-xls',  $task->getId()]);
    $process->start();
    while ($process->isRunning()) {}
  }

  /**
   * @param int $taskId
   *
   * @return PaymentSearchExportTask|null
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
  public function getAndStartExportByTaskId(int $taskId)
  {
    $task = $this->paymentSearchExportTaskRepository->findOneBy(['id' => $taskId]);

    if (!is_null($task)) {
      $task->setStarted(true);
      $this->paymentSearchExportTaskRepository->savePaymentSearchExportTask($task);
    }

    return $task;
  }

  /**
   * Creates exports dir if it does not exist
   */
  public function getExportsDir()
  {
    $filesystem = new Filesystem();

    if (!$filesystem->exists(self::EXPORTS_DIR)) {
      $filesystem->mkdir(self::EXPORTS_DIR);
    }

    return self::EXPORTS_DIR;
  }

  /**
   * @param PaymentSearchExportTask $paymentSearchExportTask
   *
   * @return string
   */
  public function generateFileName(PaymentSearchExportTask $paymentSearchExportTask)
  {
    $dateTime = new \DateTime();
    return 'export_' . $paymentSearchExportTask->getSearchField()
      . '_' . $paymentSearchExportTask->getSearchValue()
      . '_' . $dateTime->getTimestamp()
      . '.xls';
  }

  /**
   * @param PaymentSearchExportTask $task
   * @param string                  $filename
   *
   * @return PaymentSearchExportTask
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
  public function markTaskComplete(PaymentSearchExportTask $task, string $filename)
  {
    $task->setComplete(true)
      ->setFilepath($filename);

    return $this->paymentSearchExportTaskRepository->savePaymentSearchExportTask($task);
  }

  /**
   * @param PaymentSearchExportTask $task
   *
   * @return mixed
   */
  public function getTaskFile(PaymentSearchExportTask $task)
  {
    $finder = new Finder();
    $finder->files()->in(self::EXPORTS_DIR)->name($task->getFilepath());
    $iterator = $finder->getIterator();
    $iterator->rewind();
    $file = $iterator->current();
    return $file->getContents();
  }
}