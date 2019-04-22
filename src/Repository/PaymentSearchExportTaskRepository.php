<?php

namespace App\Repository;

use App\Entity\PaymentSearchExportTask;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PaymentSearchExportTask|null find($id, $lockMode = null, $lockVersion = null)
 * @method PaymentSearchExportTask|null findOneBy(array $criteria, array $orderBy = null)
 * @method PaymentSearchExportTask[]    findAll()
 * @method PaymentSearchExportTask[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaymentSearchExportTaskRepository extends ServiceEntityRepository
{
  /**
   * PaymentSearchExportTaskRepository constructor.
   *
   * @param RegistryInterface $registry
   */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PaymentSearchExportTask::class);
    }

  /**
   * @param PaymentSearchExportTask $paymentSearchExportTask
   *
   * @return PaymentSearchExportTask
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
    public function savePaymentSearchExportTask(PaymentSearchExportTask $paymentSearchExportTask)
    {
      $this->_em->persist($paymentSearchExportTask);
      $this->_em->flush();
      return $paymentSearchExportTask;
    }
}
