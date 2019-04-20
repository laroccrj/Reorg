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
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
    public function updateOrInsertPayment(Payment $payment)
    {
      /** @var Payment $existing */
      $existing = $this->findOneBy(['record_id' => $payment->getRecordId()]);

      if (!is_null($existing)) {
        $existing = EntityUtils::copyEntity($existing, $payment);
      }

      $this->_em->persist($existing);
      $this->_em->flush($existing);

      return $payment;
    }
}
