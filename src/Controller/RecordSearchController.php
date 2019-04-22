<?php
/**
 * Created by PhpStorm.
 * User: rob
 * Date: 4/20/19
 * Time: 2:17 PM
 */

namespace App\Controller;

use App\Entity\Payment;
use App\Entity\PaymentSearchExportTask;
use App\Repository\PaymentSearchExportTaskRepository;
use App\Service\PaymentDataService;
use App\Service\PaymentSearchExportService;
use Elasticsearch\ClientBuilder;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
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

  /**
   * @Route("/export")
   * @param Request                    $request
   * @param PaymentSearchExportService $paymentSearchExportService
   *
   * @return Response
   * @throws \Doctrine\ORM\ORMException
   * @throws \Doctrine\ORM\OptimisticLockException
   */
  public function startExport(Request $request, PaymentSearchExportService $paymentSearchExportService)
  {
    $searchField = $request->get('searchField', null);
    $searchValue = $request->get('searchValue', null);

    $exportTask = $paymentSearchExportService->createExportTask($searchField, $searchValue);
    $paymentSearchExportService->startExportTask($exportTask);

    $response = new Response(json_encode(['taskId' => $exportTask->getId()]));
    $response->headers->set('Content-Type', 'application/json');

    return $response;
  }

  /**
   * @Route("/export/status/{taskId}")
   * @param Request                           $request
   * @param PaymentSearchExportTaskRepository $paymentSearchExportTaskRepository
   *
   * @return Response
   */
  public function pollExportStatus(
    Request $request,
    PaymentSearchExportTaskRepository $paymentSearchExportTaskRepository
  )
  {
    $taskId = $request->get('taskId', null);

    if (is_null($taskId)) {
      $responseBody = ['result' => 'error', 'reason' => 'task not found'];
    } else {
      $task = $paymentSearchExportTaskRepository->find($taskId);

      if ($task->getComplete()) {
        $responseBody = ['result' => 'success', 'status' => 'complete', 'fileUrl' => $task->getFilepath()];
      } else {
        $responseBody = ['result' => 'success', 'status' => 'loading'];
      }
    }

    $response = new Response(json_encode($responseBody));
    $response->headers->set('Content-Type', 'application/json');

    return $response;
  }

  /**
   * @Route("/export/download/{taskId}")
   * @param Request                           $request
   * @param PaymentSearchExportTaskRepository $paymentSearchExportTaskRepository
   * @param PaymentSearchExportService $paymentSearchExportService
   *
   * @return Response
   */
  public function downloadExportFile(
    Request $request,
    PaymentSearchExportTaskRepository $paymentSearchExportTaskRepository,
    PaymentSearchExportService $paymentSearchExportService
  )
  {
    $taskId = $request->get('taskId', null);

    if (is_null($taskId)) {
      throw $this->createNotFoundException();
    }

    $task = $paymentSearchExportTaskRepository->find($taskId);

    $response = new BinaryFileResponse(PaymentSearchExportService::EXPORTS_DIR . $task->getFilepath());
    $response->setContentDisposition('attachment', $task->getFilepath());
    return $response;
  }
}
