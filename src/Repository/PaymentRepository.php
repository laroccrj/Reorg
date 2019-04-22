<?php

namespace App\Repository;

use App\Entity\Payment;
use App\Utils\EntityUtils;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Payment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Payment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Payment[]    findAll()
 * @method Payment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaymentRepository extends ServiceEntityRepository
{
  public function __construct(RegistryInterface $registry)
  {
    parent::__construct($registry, Payment::class);
  }

  /**
   * @param Payment $payment
   *
   * @return Payment|mixed
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
  public function updateOrInsertPayment(Payment $payment)
  {
    /** @var Payment $existing */
    $existing = $this->findOneBy(['record_id' => $payment->getRecordId()]);

    if (!is_null($existing)) {
      $existing = EntityUtils::copyEntity($existing, $payment);
      $payment = $existing;
    }

    $date = new \DateTime();
    $payment->setLastUpdateTime($date->getTimestamp());
    $this->_em->persist($payment);
    $this->_em->flush($payment);

    return $payment;
  }

  /**
   * @param int $limit
   * @param int $offset
   *
   * @return array
   */
  public function findPaymentsThatNeedToBeIndexed(int $limit = 100, int $offset = 0)
  {
    $result = $this->createQueryBuilder('p')
      ->select('p.id')
      ->where('p.last_index_time IS NULL')
      ->orWhere('p.last_index_time < p.last_update_time')
      ->setMaxResults($limit)
      ->setFirstResult($offset)
      ->getQuery()
      ->getResult();

    return array_column($result, "id");
  }

  /**
   * @param Payment $payment
   *
   * @return Payment
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
  public function markPaymentIndexed(Payment $payment)
  {
    $date = new \DateTime();
    $payment->setLastIndexTime($date->getTimestamp());
    $this->_em->persist($payment);
    $this->_em->flush($payment);
    return $payment;
  }

  /**
   * @return mixed
   * @throws \Doctrine\ORM\NonUniqueResultException
   */
  public function getCountOfPayments()
  {
    return $this->createQueryBuilder('p')
      ->select('count(p.id)')
      ->getQuery()
      ->getSingleScalarResult();
  }
}
