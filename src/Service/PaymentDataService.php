<?php
/**
 * This service handles interactions with the payments API and DB
 */

namespace App\Service;


use App\Entity\Payment;
use App\Repository\PaymentRepository;
use Doctrine\ORM\EntityManagerInterface;

class PaymentDataService
{
  /** @var PaymentDataApiService */
  private $api;

  /** @var PaymentRepository */
  private $paymentRepository;

  /** @var EntityManagerInterface */
  private $entityManager;

  /** @var PaymentDataIndexService */
  private $paymentDataIndexService;

  /**
   * PaymentDataService constructor.
   *
   * @param PaymentDataApiService $api
   * @param EntityManagerInterface $entityManager
   * @param PaymentRepository $paymentRepository
   * @param PaymentDataIndexService $paymentDataIndexService
   */
  public function __construct(
    PaymentDataApiService $api,
    EntityManagerInterface $entityManager,
    PaymentRepository $paymentRepository,
    PaymentDataIndexService $paymentDataIndexService
  )
  {
    $this->api = $api;
    $this->entityManager = $entityManager;
    $this->paymentRepository = $paymentRepository;
    $this->paymentDataIndexService = $paymentDataIndexService;
  }

  /**
   * @param int $limit
   * @param int $offset
   *
   * @return Payment[]
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
  public function importAndSavePayments(int $limit = 10, int $offset = 0): array
  {
    $payments = $this->api->getDataSet(PaymentDataApiService::DATA_SET_2015, $limit, $offset);
    $updatedPayments = [];

    foreach ($payments as $payment) {
      $updatedPayments[] = $this->paymentRepository->updateOrInsertPayment($payment);
    }

    return $updatedPayments;
  }

  /**
   * @param int $limit
   * @param int $offset
   *
   * @return Payment[]
   */
  public function getPayments(int $limit = 100, int $offset = 0, &$count = 0): array
  {
    $count = $this->paymentRepository->getCountOfPayments();
    return $this->paymentRepository->findBy([], null, $limit, $offset);
  }

  /**
   * @param array $query
   * @param int   $limit
   * @param int   $offset
   * @param int   $count
   *
   * @return Payment[]
   */
  public function searchPayments($query = [], $limit = 50, $offset = 0, &$count = 0)
  {
    $paymentIds = $this->paymentDataIndexService->search($query, $limit, $offset, $count);
    return $this->paymentRepository->findBy(['id' => $paymentIds]);
  }
}
