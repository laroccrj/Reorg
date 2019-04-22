<?php
/**
 * Created by PhpStorm.
 * User: rob
 * Date: 4/20/19
 * Time: 2:17 PM
 */

namespace App\Controller;

use App\Entity\Payment;
use App\Service\PaymentDataService;
use Elasticsearch\ClientBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecordSearchController extends AbstractController
{
  private $elastic;

  public function __construct()
  {
    $this->elastic = ClientBuilder::create()->build();
  }

  /**
   * @Route("/")
   */
  public function index(Request $request, PaymentDataService $paymentDataService)
  {
    $page = $request->get('page', 1);
    $searchField = $request->get('searchField', null);
    $searchValue = $request->get('searchValue', null);
    $limit = 50;
    $offset = $limit * $page;
    $pageCount = 1;

    $fields = Payment::getPublicAttributes();

    if (empty($searchField) || empty($searchValue)) {
      $payments = $paymentDataService->getPayments($limit, $offset, $pageCount);
    } else {
      $payments = $paymentDataService->searchPayments(
        [$searchField => $searchValue],
        $limit,
        $offset,
        $pageCount
      );
    }

    return $this->render('search.html.twig',
      [
        'payments' => $payments,
        'fields' => $fields,
        'searchField' => $searchField,
        'searchValue' => $searchValue,
        'totalPages' => floor($pageCount / $limit),
        'page' => $page
      ]
    );
  }

  /**
   * @Route("/typeahead")
   */
  public function typeahead(Request $request, PaymentDataService $paymentDataService)
  {
    $searchField = $request->get('searchField', null);
    $searchValue = $request->get('searchValue', null);
    $results = [];

    if (!is_null($searchField) && !is_null($searchValue)) {
      $payments = $paymentDataService->searchPayments(
        [$searchField => $searchValue],
        100
      );

      foreach ($payments as $payment) {
        $results[] = $payment->$searchField;
      }
    }

    $results = array_unique($results);
    $results = array_slice($results, 0, 5);

    $response = new Response(json_encode(['results' => $results]));
    $response->headers->set('Content-Type', 'application/json');

    return $response;
  }
}
