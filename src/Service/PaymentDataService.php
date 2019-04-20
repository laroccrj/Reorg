<?php
/**
 * Created by PhpStorm.
 * User: rob
 * Date: 4/20/19
 * Time: 4:05 PM
 */

namespace App\Service;


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

  public function getAndSavePayments(int $limit = 10, int $offset = 0)
  {
    $payments = $this->api->getDataSet(PaymentDataApiService::DATA_SET_2015, $limit, $offset);

    foreach ($payments as $payment) {
      $this->entityManager->persist($payment);
    }

    $this->entityManager->flush();
  }
}
