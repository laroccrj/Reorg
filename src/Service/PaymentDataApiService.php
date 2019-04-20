<?php
/**
 * Created by PhpStorm.
 * User: rob
 * Date: 4/20/19
 * Time: 2:33 PM
 */

namespace App\Service;

use App\Entity\Payment;
use GuzzleHttp\Client;


class PaymentDataApiService
{
  const DATA_SET_2015 = '8pru-svmk';

  /** @var Client */
  private $client;

  /** @var string */
  private $appKey;

  /**
   * PaymentDataApiService constructor.
   *
   * @param string $appKey
   */
  public function __construct(string $appKey)
  {
    $this->client = new Client();
    $this->appKey = $appKey;
  }

  public function getDataSet(string $dataSet, int $limit = 5, int $offset = 0): array
  {
    $uri = 'https://openpaymentsdata.cms.gov/resource/' . $dataSet . '.json?$limit=' . $limit . '&$offset=' . $offset;

    $response = $this->client->get(
      $uri,
      [
        'headers' => [
          'X-App-Token' => $this->appKey
        ]
      ]
    );

    $results = json_decode($response->getBody()->getContents());
    $payments = [];

    foreach ($results as $result) {

      $payment = new Payment();

      $payment->setChangeType($result->change_type ?? null)
        ->setCoveredRecipientType($result->covered_recipient_type ?? null)
        ->setTeachingHospitalCcn($result->teaching_hospital_ccn ?? null)
        ->setTeachingHospitalId($result->teaching_hospital_id ?? null)
        ->setTeachingHospitalName($result->teaching_hospital_name ?? null)
        ->setPhysicianProfileId($result->physician_profile_id ?? null)
        ->setPhysicianFirstName($result->physician_first_name ?? null)
        ->setPhysicianMiddleName($result->physician_middle_name ?? null)
        ->setPhysicianLastName($result->physician_last_name ?? null)
        ->setPhysicianNameSuffix($result->physician_name_suffix ?? null)
        ->setRecipientPrimaryBusinessStreetAddressLine1($result->recipient_primary_business_street_address_line1 ?? null)
        ->setRecipientPrimaryBusinessStreetAddressLine2($result->recipient_primary_business_street_address_line2 ?? null)
        ->setRecipientCity($result->recipient_city ?? null)
        ->setRecipientState($result->recipient_state ?? null)
        ->setRecipientZipCode($result->recipient_zip_code ?? null)
        ->setRecipientCountry($result->recipient_country ?? null)
        ->setRecipientProvince($result->recipient_province ?? null)
        ->setRecipientPostalCode($result->recipient_postal_code ?? null)
        ->setPhysicianPrimaryType($result->physician_primary_type ?? null)
        ->setPhysicianSpecialty($result->physician_specialty ?? null)
        ->setPhysicianLicenseStateCode1($result->physician_license_state_code1 ?? null)
        ->setPhysicianLicenseStateCode2($result->physician_license_state_code2 ?? null)
        ->setPhysicianLicenseStateCode3($result->physician_license_state_code3 ?? null)
        ->setPhysicianLicenseStateCode4($result->physician_license_state_code4 ?? null)
        ->setPhysicianLicenseStateCode5($result->physician_license_state_code5 ?? null)
        ->setSubmittingApplicableManufacturerOrApplicableGpoName($result->submitting_applicable_manufacturer_or_applicable_gpo_name ?? null)
        ->setApplicableManufacturerOrApplicableGpoMakingPaymentId($result->applicable_manufacturer_or_applicable_gpo_making_payment_id ?? null)
        ->setApplicableManufacturerOrApplicableGpoMakingPaymentName($result->applicable_manufacturer_or_applicable_gpo_making_payment_name ?? null)
        ->setApplicableManufacturerOrApplicableGpoMakingPaymentState($result->applicable_manufacturer_or_applicable_gpo_making_payment_state ?? null)
        ->setApplicableManufacturerOrApplicableGpoMakingPaymentCountry($result->applicable_manufacturer_or_applicable_gpo_making_payment_country ?? null)
        ->setTotalAmountOfPaymentUsdollars($result->total_amount_of_payment_usdollars ?? null)
        ->setDateOfPayment($result->date_of_payment ?? null)
        ->setNumberOfPaymentsIncludedInTotalAmount($result->number_of_payments_included_in_total_amount ?? null)
        ->setFormOfPaymentOrTransferOfValue($result->form_of_payment_or_transfer_of_value ?? null)
        ->setNatureOfPaymentOrTransferOfValue($result->nature_of_payment_or_transfer_of_value ?? null)
        ->setCityOfTravel($result->city_of_travel ?? null)
        ->setStateOfTravel($result->state_of_travel ?? null)
        ->setCountryOfTravel($result->country_of_travel ?? null)
        ->setPhysicianOwnershipIndicator($result->physician_ownership_indicator ?? null)
        ->setThirdPartyPaymentRecipientIndicator($result->third_party_payment_recipient_indicator ?? null)
        ->setNameOfThirdPartyEntityReceivingPaymentOrTransferOfVal($result->name_of_third_party_entity_receiving_payment_or_transfer_of_val ?? null)
        ->setCharityIndicator($result->charity_indicator ?? null)
        ->setThirdPartyEqualsCoveredRecipientIndicator($result->third_party_equals_covered_recipient_indicator ?? null)
        ->setContextualInformation($result->contextual_information ?? null)
        ->setDelayInPublicationIndicator($result->delay_in_publication_indicator ?? null)
        ->setRecordId($result->record_id)
        ->setDisputeStatusForPublication($result->dispute_status_for_publication ?? null)
        ->setProductIndicator($result->product_indicator ?? null)
        ->setNameOfAssociatedCoveredDrugOrBiological1($result->name_of_associated_covered_drug_or_biological1 ?? null)
        ->setNameOfAssociatedCoveredDrugOrBiological2($result->name_of_associated_covered_drug_or_biological2 ?? null)
        ->setNameOfAssociatedCoveredDrugOrBiological3($result->name_of_associated_covered_drug_or_biological3 ?? null)
        ->setNameOfAssociatedCoveredDrugOrBiological4($result->name_of_associated_covered_drug_or_biological4 ?? null)
        ->setNameOfAssociatedCoveredDrugOrBiological5($result->name_of_associated_covered_drug_or_biological5 ?? null)
        ->setNdcOfAssociatedCoveredDrugOrBiological1($result->ndc_of_associated_covered_drug_or_biological1 ?? null)
        ->setNdcOfAssociatedCoveredDrugOrBiological2($result->ndc_of_associated_covered_drug_or_biological2 ?? null)
        ->setNdcOfAssociatedCoveredDrugOrBiological3($result->ndc_of_associated_covered_drug_or_biological3 ?? null)
        ->setNdcOfAssociatedCoveredDrugOrBiological4($result->ndc_of_associated_covered_drug_or_biological4 ?? null)
        ->setNdcOfAssociatedCoveredDrugOrBiological5($result->ndc_of_associated_covered_drug_or_biological5 ?? null)
        ->setNameOfAssociatedCoveredDeviceOrMedicalSupply1($result->name_of_associated_covered_device_or_medical_supply1 ?? null)
        ->setNameOfAssociatedCoveredDeviceOrMedicalSupply2($result->name_of_associated_covered_device_or_medical_supply2 ?? null)
        ->setNameOfAssociatedCoveredDeviceOrMedicalSupply3($result->name_of_associated_covered_device_or_medical_supply3 ?? null)
        ->setNameOfAssociatedCoveredDeviceOrMedicalSupply4($result->name_of_associated_covered_device_or_medical_supply4 ?? null)
        ->setNameOfAssociatedCoveredDeviceOrMedicalSupply5($result->name_of_associated_covered_device_or_medical_supply5 ?? null)
        ->setProgramYear($result->program_year ?? null)
        ->setPaymentPublicationDate($result->payment_publication_date ?? null);

      $payments[] = $payment;
    }

    return $payments;
  }
}
