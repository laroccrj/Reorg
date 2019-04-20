<?php
/**
 * Created by PhpStorm.
 * User: rob
 * Date: 4/20/19
 * Time: 2:17 PM
 */

namespace App\Controller;

use App\Service\PaymentDataApiService;
use App\Service\PaymentDataService;
use Symfony\Component\Routing\Annotation\Route;

class RecordSearchController
{
  /**
   * @Route("/")
   */
  public function index(PaymentDataService $paymentDataService)
  {
    $paymentDataService->getAndSavePayments(10);
    die;
  }
}
