<?php
/**
 * Created by PhpStorm.
 * User: rob
 * Date: 4/20/19
 * Time: 4:05 PM
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

  /**
   * PaymentDataService constructor.
   *
   * @param PaymentDataApiService $api
   * @param EntityManagerInterface $entityManager
   * @param PaymentRepository $paymentRepository
   */
  public function __construct(
    PaymentDataApiService $api,
    EntityManagerInterface $entityManager,
    PaymentRepository $paymentRepository)
  {
    $this->api = $api;
    $this->entityManager = $entityManager;
    $this->paymentRepository = $paymentRepository;
  }

  /**
   * @param int $limit
   * @param int $offset
   *
   * @return Payment[]
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
  public function getAndSavePayments(int $limit = 10, int $offset = 0): array
  {
    $payments = $this->api->getDataSet(PaymentDataApiService::DATA_SET_2015, $limit, $offset);
    $updatedPayments = [];

    foreach ($payments as $payment) {
      $updatedPayments[] = $this->paymentRepository->updateOrInsertPayment($payment);
    }

    return $updatedPayments;
  }
}
