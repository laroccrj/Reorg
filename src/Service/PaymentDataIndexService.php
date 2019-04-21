<?php
/**
 * Created by PhpStorm.
 * User: rob
 * Date: 4/20/19
 * Time: 8:03 PM
 */

namespace App\Service;


use App\Entity\Payment;
use App\Repository\PaymentRepository;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;

class PaymentDataIndexService
{
  const INDEX_NAME_PAYMENTS = 'payments';
  const INDEX_TYPE_PAYMENTS = 'payment';

  /** @var Client */
  private $elastic;

  /** @var PaymentRepository  */
  private $paymentRepository;

  /**
   * PaymentDataIndexService constructor.
   */
  public function __construct(PaymentRepository $paymentRepository)
  {
    $this->elastic = ClientBuilder::create()->build();
    $this->paymentRepository = $paymentRepository;
  }

  /**
   * @param array $query
   * @param int   $limit
   * @param int   $offset
   *
   * @return int[]
   */
  public function search($query = [], int $limit = 50, int $offset = 0)
  {
    $query = array_map('strtolower', $query);

    $params = [
      'index' => self::INDEX_NAME_PAYMENTS,
      'type' => self::INDEX_TYPE_PAYMENTS,
      'body' => [
        "from" => $offset,
        "size" => $limit,
        'query' => [
          'prefix' => $query
        ]
      ]
    ];

    $response = $this->elastic->search($params);
    $hits = array_column($response['hits']['hits'],'_id');
    return $hits;
  }

  /**
   * @param Payment $payment
   */
  public function indexPayment(Payment $payment)
  {
    $id = $payment->getId();
    $body = [
      'change_type' => $payment->getChangeType(),
      'covered_recipient_type' => $payment->getCoveredRecipientType(),
      'teaching_hospital_ccn' => $payment->getTeachingHospitalCcn(),
      'teaching_hospital_id' => $payment->getTeachingHospitalId(),
      'teaching_hospital_name' => $payment->getTeachingHospitalName(),
      'physician_profile_id' => $payment->getPhysicianProfileId(),
      'physician_first_name' => $payment->getPhysicianFirstName(),
      'physician_middle_name' => $payment->getPhysicianMiddleName(),
      'physician_last_name' => $payment->getPhysicianLastName(),
      'physician_name_suffix' => $payment->getPhysicianNameSuffix(),
      'recipient_primary_business_street_address_line1' => $payment->getRecipientPrimaryBusinessStreetAddressLine1(),
      'recipient_primary_business_street_address_line2' => $payment->getRecipientPrimaryBusinessStreetAddressLine2(),
      'recipient_city' => $payment->getRecipientCity(),
      'recipient_state' => $payment->getRecipientState(),
      'recipient_zip_code' => $payment->getRecipientZipCode(),
      'recipient_country' => $payment->getRecipientCountry(),
      'recipient_province' => $payment->getRecipientProvince(),
      'recipient_postal_code' => $payment->getRecipientPostalCode(),
      'physician_primary_type' => $payment->getPhysicianPrimaryType(),
      'physician_specialty' => $payment->getPhysicianSpecialty(),
      'physician_license_state_code1' => $payment->getPhysicianLicenseStateCode1(),
      'physician_license_state_code2' => $payment->getPhysicianLicenseStateCode2(),
      'physician_license_state_code3' => $payment->getPhysicianLicenseStateCode3(),
      'physician_license_state_code4' => $payment->getPhysicianLicenseStateCode4(),
      'physician_license_state_code5' => $payment->getPhysicianLicenseStateCode5(),
      'submitting_applicable_manufacturer_or_applicable_gpo_name' => $payment->getSubmittingApplicableManufacturerOrApplicableGpoName(),
      'applicable_manufacturer_or_applicable_gpo_making_payment_id' => $payment->getApplicableManufacturerOrApplicableGpoMakingPaymentId(),
      'applicable_manufacturer_or_applicable_gpo_making_payment_name' => $payment->getApplicableManufacturerOrApplicableGpoMakingPaymentName(),
      'applicable_manufacturer_or_applicable_gpo_making_payment_state' => $payment->getApplicableManufacturerOrApplicableGpoMakingPaymentState(),
      'applicable_manufacturer_or_applicable_gpo_making_payment_country' => $payment->getApplicableManufacturerOrApplicableGpoMakingPaymentCountry(),
      'total_amount_of_payment_usdollars' => $payment->getTotalAmountOfPaymentUsdollars(),
      'date_of_payment' => $payment->getDateOfPayment(),
      'number_of_payments_included_in_total_amount' => $payment->getNumberOfPaymentsIncludedInTotalAmount(),
      'form_of_payment_or_transfer_of_value' => $payment->getFormOfPaymentOrTransferOfValue(),
      'nature_of_payment_or_transfer_of_value' => $payment->getNatureOfPaymentOrTransferOfValue(),
      'city_of_travel' => $payment->getCityOfTravel(),
      'state_of_travel' => $payment->getStateOfTravel(),
      'country_of_travel' => $payment->getCountryOfTravel(),
      'physician_ownership_indicator' => $payment->getPhysicianOwnershipIndicator(),
      'third_party_payment_recipient_indicator' => $payment->getThirdPartyPaymentRecipientIndicator(),
      'name_of_third_party_entity_receiving_payment_or_transfer_of_val' => $payment->getNameOfThirdPartyEntityReceivingPaymentOrTransferOfVal(),
      'charity_indicator' => $payment->getCharityIndicator(),
      'third_party_equals_covered_recipient_indicator' => $payment->getThirdPartyEqualsCoveredRecipientIndicator(),
      'contextual_information' => $payment->getContextualInformation(),
      'delay_in_publication_indicator' => $payment->getDelayInPublicationIndicator(),
      'record_id' => $payment->getRecordId(),
      'dispute_status_for_publication' => $payment->getDisputeStatusForPublication(),
      'product_indicator' => $payment->getProductIndicator(),
      'name_of_associated_covered_drug_or_biological1' => $payment->getNameOfAssociatedCoveredDrugOrBiological1(),
      'name_of_associated_covered_drug_or_biological2' => $payment->getNameOfAssociatedCoveredDrugOrBiological2(),
      'name_of_associated_covered_drug_or_biological3' => $payment->getNameOfAssociatedCoveredDrugOrBiological3(),
      'name_of_associated_covered_drug_or_biological4' => $payment->getNameOfAssociatedCoveredDrugOrBiological4(),
      'name_of_associated_covered_drug_or_biological5' => $payment->getNameOfAssociatedCoveredDrugOrBiological5(),
      'ndc_of_associated_covered_drug_or_biological1' => $payment->getNdcOfAssociatedCoveredDrugOrBiological1(),
      'ndc_of_associated_covered_drug_or_biological2' => $payment->getNdcOfAssociatedCoveredDrugOrBiological2(),
      'ndc_of_associated_covered_drug_or_biological3' => $payment->getNdcOfAssociatedCoveredDrugOrBiological3(),
      'ndc_of_associated_covered_drug_or_biological4' => $payment->getNdcOfAssociatedCoveredDrugOrBiological4(),
      'ndc_of_associated_covered_drug_or_biological5' => $payment->getNdcOfAssociatedCoveredDrugOrBiological5(),
      'name_of_associated_covered_device_or_medical_supply1' => $payment->getNameOfAssociatedCoveredDeviceOrMedicalSupply1(),
      'name_of_associated_covered_device_or_medical_supply2' => $payment->getNameOfAssociatedCoveredDeviceOrMedicalSupply1(),
      'name_of_associated_covered_device_or_medical_supply3' => $payment->getNameOfAssociatedCoveredDeviceOrMedicalSupply1(),
      'name_of_associated_covered_device_or_medical_supply4' => $payment->getNameOfAssociatedCoveredDeviceOrMedicalSupply1(),
      'name_of_associated_covered_device_or_medical_supply5' => $payment->getNameOfAssociatedCoveredDeviceOrMedicalSupply1(),
      'program_year' => $payment->getProgramYear(),
      'payment_publication_date' => $payment->getPaymentPublicationDate()
    ];

    $params = [
      'index' => self::INDEX_NAME_PAYMENTS,
      'type' => self::INDEX_TYPE_PAYMENTS,
      'id' => $id,
      'body' => $body
    ];

    $this->elastic->index($params);
    $this->paymentRepository->markPaymentIndexed($payment);
  }
}