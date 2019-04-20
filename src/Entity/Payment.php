<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PaymentRepository")
 */
class Payment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=63, nullable=true)
     */
    private $change_type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $covered_recipient_type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $teaching_hospital_ccn;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $teaching_hospital_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $teaching_hospital_name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $physician_profile_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $physician_first_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $physician_middle_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $physician_last_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $physician_name_suffix;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $recipient_primary_business_street_address_line1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $recipient_primary_business_street_address_line2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $recipient_city;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $recipient_state;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $recipient_zip_code;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $recipient_country;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $recipient_province;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $recipient_postal_code;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $physician_primary_type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $physician_specialty;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $physician_license_state_code1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $physician_license_state_code2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $physician_license_state_code3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $physician_license_state_code4;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $physician_license_state_code5;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $submitting_applicable_manufacturer_or_applicable_gpo_name;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $applicable_manufacturer_or_applicable_gpo_making_payment_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $applicable_manufacturer_or_applicable_gpo_making_payment_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $applicable_manufacturer_or_applicable_gpo_making_payment_state;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $applicable_manufacturer_or_applicable_gpo_making_payment_country;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $total_amount_of_payment_usdollars;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $date_of_payment;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $number_of_payments_included_in_total_amount;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $form_of_payment_or_transfer_of_value;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nature_of_payment_or_transfer_of_value;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city_of_travel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $state_of_travel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $country_of_travel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $physician_ownership_indicator;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $third_party_payment_recipient_indicator;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name_of_third_party_entity_receiving_payment_or_transfer_of_val;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $charity_indicator;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $third_party_equals_covered_recipient_indicator;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contextual_information;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $delay_in_publication_indicator;

    /**
     * @ORM\Column(type="integer", unique=true)
     */
    private $record_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dispute_status_for_publication;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $product_indicator;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name_of_associated_covered_drug_or_biological1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name_of_associated_covered_drug_or_biological2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name_of_associated_covered_drug_or_biological3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name_of_associated_covered_drug_or_biological4;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name_of_associated_covered_drug_or_biological5;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ndc_of_associated_covered_drug_or_biological1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ndc_of_associated_covered_drug_or_biological2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ndc_of_associated_covered_drug_or_biological3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ndc_of_associated_covered_drug_or_biological4;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ndc_of_associated_covered_drug_or_biological5;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name_of_associated_covered_device_or_medical_supply1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name_of_associated_covered_device_or_medical_supply2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name_of_associated_covered_device_or_medical_supply3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name_of_associated_covered_device_or_medical_supply4;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name_of_associated_covered_device_or_medical_supply5;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $program_year;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $payment_publication_date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChangeType(): ?string
    {
        return $this->change_type;
    }

    public function setChangeType(?string $change_type): self
    {
        $this->change_type = $change_type;

        return $this;
    }

    public function getCoveredRecipientType(): ?string
    {
        return $this->covered_recipient_type;
    }

    public function setCoveredRecipientType(?string $covered_recipient_type): self
    {
        $this->covered_recipient_type = $covered_recipient_type;

        return $this;
    }

    public function getTeachingHospitalCcn(): ?string
    {
        return $this->teaching_hospital_ccn;
    }

    public function setTeachingHospitalCcn(?string $teaching_hospital_ccn): self
    {
        $this->teaching_hospital_ccn = $teaching_hospital_ccn;

        return $this;
    }

    public function getTeachingHospitalId(): ?int
    {
        return $this->teaching_hospital_id;
    }

    public function setTeachingHospitalId(?int $teaching_hospital_id): self
    {
        $this->teaching_hospital_id = $teaching_hospital_id;

        return $this;
    }

    public function getTeachingHospitalName(): ?string
    {
        return $this->teaching_hospital_name;
    }

    public function setTeachingHospitalName(?string $teaching_hospital_name): self
    {
        $this->teaching_hospital_name = $teaching_hospital_name;

        return $this;
    }

    public function getPhysicianProfileId(): ?int
    {
        return $this->physician_profile_id;
    }

    public function setPhysicianProfileId(?int $physician_profile_id): self
    {
        $this->physician_profile_id = $physician_profile_id;

        return $this;
    }

    public function getPhysicianFirstName(): ?string
    {
        return $this->physician_first_name;
    }

    public function setPhysicianFirstName(?string $physician_first_name): self
    {
        $this->physician_first_name = $physician_first_name;

        return $this;
    }

    public function getPhysicianMiddleName(): ?string
    {
        return $this->physician_middle_name;
    }

    public function setPhysicianMiddleName(?string $physician_middle_name): self
    {
        $this->physician_middle_name = $physician_middle_name;

        return $this;
    }

    public function getPhysicianLastName(): ?string
    {
        return $this->physician_last_name;
    }

    public function setPhysicianLastName(?string $physician_last_name): self
    {
        $this->physician_last_name = $physician_last_name;

        return $this;
    }

    public function getPhysicianNameSuffix(): ?string
    {
        return $this->physician_name_suffix;
    }

    public function setPhysicianNameSuffix(?string $physician_name_suffix): self
    {
        $this->physician_name_suffix = $physician_name_suffix;

        return $this;
    }

    public function getRecipientPrimaryBusinessStreetAddressLine1(): ?string
    {
        return $this->recipient_primary_business_street_address_line1;
    }

    public function setRecipientPrimaryBusinessStreetAddressLine1(?string $recipient_primary_business_street_address_line1): self
    {
        $this->recipient_primary_business_street_address_line1 = $recipient_primary_business_street_address_line1;

        return $this;
    }

    public function getRecipientPrimaryBusinessStreetAddressLine2(): ?string
    {
        return $this->recipient_primary_business_street_address_line2;
    }

    public function setRecipientPrimaryBusinessStreetAddressLine2(?string $recipient_primary_business_street_address_line2): self
    {
        $this->recipient_primary_business_street_address_line2 = $recipient_primary_business_street_address_line2;

        return $this;
    }

    public function getRecipientCity(): ?string
    {
        return $this->recipient_city;
    }

    public function setRecipientCity(?string $recipient_city): self
    {
        $this->recipient_city = $recipient_city;

        return $this;
    }

    public function getRecipientState(): ?string
    {
        return $this->recipient_state;
    }

    public function setRecipientState(?string $recipient_state): self
    {
        $this->recipient_state = $recipient_state;

        return $this;
    }

    public function getRecipientZipCode(): ?string
    {
        return $this->recipient_zip_code;
    }

    public function setRecipientZipCode(?string $recipient_zip_code): self
    {
        $this->recipient_zip_code = $recipient_zip_code;

        return $this;
    }

    public function getRecipientCountry(): ?string
    {
        return $this->recipient_country;
    }

    public function setRecipientCountry(?string $recipient_country): self
    {
        $this->recipient_country = $recipient_country;

        return $this;
    }

    public function getRecipientProvince(): ?string
    {
        return $this->recipient_province;
    }

    public function setRecipientProvince(?string $recipient_province): self
    {
        $this->recipient_province = $recipient_province;

        return $this;
    }

    public function getRecipientPostalCode(): ?string
    {
        return $this->recipient_postal_code;
    }

    public function setRecipientPostalCode(?string $recipient_postal_code): self
    {
        $this->recipient_postal_code = $recipient_postal_code;

        return $this;
    }

    public function getPhysicianPrimaryType(): ?string
    {
        return $this->physician_primary_type;
    }

    public function setPhysicianPrimaryType(?string $physician_primary_type): self
    {
        $this->physician_primary_type = $physician_primary_type;

        return $this;
    }

    public function getPhysicianSpecialty(): ?string
    {
        return $this->physician_specialty;
    }

    public function setPhysicianSpecialty(?string $physician_specialty): self
    {
        $this->physician_specialty = $physician_specialty;

        return $this;
    }

    public function getPhysicianLicenseStateCode1(): ?string
    {
        return $this->physician_license_state_code1;
    }

    public function setPhysicianLicenseStateCode1(?string $physician_license_state_code1): self
    {
        $this->physician_license_state_code1 = $physician_license_state_code1;

        return $this;
    }

    public function getPhysicianLicenseStateCode2(): ?string
    {
        return $this->physician_license_state_code2;
    }

    public function setPhysicianLicenseStateCode2(?string $physician_license_state_code2): self
    {
        $this->physician_license_state_code2 = $physician_license_state_code2;

        return $this;
    }

    public function getPhysicianLicenseStateCode3(): ?string
    {
        return $this->physician_license_state_code3;
    }

    public function setPhysicianLicenseStateCode3(?string $physician_license_state_code3): self
    {
        $this->physician_license_state_code3 = $physician_license_state_code3;

        return $this;
    }

    public function getPhysicianLicenseStateCode4(): ?string
    {
        return $this->physician_license_state_code4;
    }

    public function setPhysicianLicenseStateCode4(?string $physician_license_state_code4): self
    {
        $this->physician_license_state_code4 = $physician_license_state_code4;

        return $this;
    }

    public function getPhysicianLicenseStateCode5(): ?string
    {
        return $this->physician_license_state_code5;
    }

    public function setPhysicianLicenseStateCode5(?string $physician_license_state_code5): self
    {
        $this->physician_license_state_code5 = $physician_license_state_code5;

        return $this;
    }

    public function getSubmittingApplicableManufacturerOrApplicableGpoName(): ?string
    {
        return $this->submitting_applicable_manufacturer_or_applicable_gpo_name;
    }

    public function setSubmittingApplicableManufacturerOrApplicableGpoName(?string $submitting_applicable_manufacturer_or_applicable_gpo_name): self
    {
        $this->submitting_applicable_manufacturer_or_applicable_gpo_name = $submitting_applicable_manufacturer_or_applicable_gpo_name;

        return $this;
    }

    public function getApplicableManufacturerOrApplicableGpoMakingPaymentId(): ?int
    {
        return $this->applicable_manufacturer_or_applicable_gpo_making_payment_id;
    }

    public function setApplicableManufacturerOrApplicableGpoMakingPaymentId(?int $applicable_manufacturer_or_applicable_gpo_making_payment_id): self
    {
        $this->applicable_manufacturer_or_applicable_gpo_making_payment_id = $applicable_manufacturer_or_applicable_gpo_making_payment_id;

        return $this;
    }

    public function getApplicableManufacturerOrApplicableGpoMakingPaymentName(): ?string
    {
        return $this->applicable_manufacturer_or_applicable_gpo_making_payment_name;
    }

    public function setApplicableManufacturerOrApplicableGpoMakingPaymentName(?string $applicable_manufacturer_or_applicable_gpo_making_payment_name): self
    {
        $this->applicable_manufacturer_or_applicable_gpo_making_payment_name = $applicable_manufacturer_or_applicable_gpo_making_payment_name;

        return $this;
    }

    public function getApplicableManufacturerOrApplicableGpoMakingPaymentState(): ?string
    {
        return $this->applicable_manufacturer_or_applicable_gpo_making_payment_state;
    }

    public function setApplicableManufacturerOrApplicableGpoMakingPaymentState(?string $applicable_manufacturer_or_applicable_gpo_making_payment_state): self
    {
        $this->applicable_manufacturer_or_applicable_gpo_making_payment_state = $applicable_manufacturer_or_applicable_gpo_making_payment_state;

        return $this;
    }

    public function getApplicableManufacturerOrApplicableGpoMakingPaymentCountry(): ?string
    {
        return $this->applicable_manufacturer_or_applicable_gpo_making_payment_country;
    }

    public function setApplicableManufacturerOrApplicableGpoMakingPaymentCountry(?string $applicable_manufacturer_or_applicable_gpo_making_payment_country): self
    {
        $this->applicable_manufacturer_or_applicable_gpo_making_payment_country = $applicable_manufacturer_or_applicable_gpo_making_payment_country;

        return $this;
    }

    public function getTotalAmountOfPaymentUsdollars(): ?float
    {
        return $this->total_amount_of_payment_usdollars;
    }

    public function setTotalAmountOfPaymentUsdollars(?float $total_amount_of_payment_usdollars): self
    {
        $this->total_amount_of_payment_usdollars = $total_amount_of_payment_usdollars;

        return $this;
    }

    public function getDateOfPayment(): ?string
    {
        return $this->date_of_payment;
    }

    public function setDateOfPayment(?string $date_of_payment): self
    {
        $this->date_of_payment = $date_of_payment;

        return $this;
    }

    public function getNumberOfPaymentsIncludedInTotalAmount(): ?int
    {
        return $this->number_of_payments_included_in_total_amount;
    }

    public function setNumberOfPaymentsIncludedInTotalAmount(?int $number_of_payments_included_in_total_amount): self
    {
        $this->number_of_payments_included_in_total_amount = $number_of_payments_included_in_total_amount;

        return $this;
    }

    public function getFormOfPaymentOrTransferOfValue(): ?string
    {
        return $this->form_of_payment_or_transfer_of_value;
    }

    public function setFormOfPaymentOrTransferOfValue(?string $form_of_payment_or_transfer_of_value): self
    {
        $this->form_of_payment_or_transfer_of_value = $form_of_payment_or_transfer_of_value;

        return $this;
    }

    public function getNatureOfPaymentOrTransferOfValue(): ?string
    {
        return $this->nature_of_payment_or_transfer_of_value;
    }

    public function setNatureOfPaymentOrTransferOfValue(?string $nature_of_payment_or_transfer_of_value): self
    {
        $this->nature_of_payment_or_transfer_of_value = $nature_of_payment_or_transfer_of_value;

        return $this;
    }

    public function getCityOfTravel(): ?string
    {
        return $this->city_of_travel;
    }

    public function setCityOfTravel(?string $city_of_travel): self
    {
        $this->city_of_travel = $city_of_travel;

        return $this;
    }

    public function getStateOfTravel(): ?string
    {
        return $this->state_of_travel;
    }

    public function setStateOfTravel(?string $state_of_travel): self
    {
        $this->state_of_travel = $state_of_travel;

        return $this;
    }

    public function getCountryOfTravel(): ?string
    {
        return $this->country_of_travel;
    }

    public function setCountryOfTravel(?string $country_of_travel): self
    {
        $this->country_of_travel = $country_of_travel;

        return $this;
    }

    public function getPhysicianOwnershipIndicator(): ?string
    {
        return $this->physician_ownership_indicator;
    }

    public function setPhysicianOwnershipIndicator(?string $physician_ownership_indicator): self
    {
        $this->physician_ownership_indicator = $physician_ownership_indicator;

        return $this;
    }

    public function getThirdPartyPaymentRecipientIndicator(): ?string
    {
        return $this->third_party_payment_recipient_indicator;
    }

    public function setThirdPartyPaymentRecipientIndicator(?string $third_party_payment_recipient_indicator): self
    {
        $this->third_party_payment_recipient_indicator = $third_party_payment_recipient_indicator;

        return $this;
    }

    public function getNameOfThirdPartyEntityReceivingPaymentOrTransferOfVal(): ?string
    {
        return $this->name_of_third_party_entity_receiving_payment_or_transfer_of_val;
    }

    public function setNameOfThirdPartyEntityReceivingPaymentOrTransferOfVal(?string $name_of_third_party_entity_receiving_payment_or_transfer_of_val): self
    {
        $this->name_of_third_party_entity_receiving_payment_or_transfer_of_val = $name_of_third_party_entity_receiving_payment_or_transfer_of_val;

        return $this;
    }

    public function getCharityIndicator(): ?string
    {
        return $this->charity_indicator;
    }

    public function setCharityIndicator(?string $charity_indicator): self
    {
        $this->charity_indicator = $charity_indicator;

        return $this;
    }

    public function getThirdPartyEqualsCoveredRecipientIndicator(): ?string
    {
        return $this->third_party_equals_covered_recipient_indicator;
    }

    public function setThirdPartyEqualsCoveredRecipientIndicator(?string $third_party_equals_covered_recipient_indicator): self
    {
        $this->third_party_equals_covered_recipient_indicator = $third_party_equals_covered_recipient_indicator;

        return $this;
    }

    public function getContextualInformation(): ?string
    {
        return $this->contextual_information;
    }

    public function setContextualInformation(?string $contextual_information): self
    {
        $this->contextual_information = $contextual_information;

        return $this;
    }

    public function getDelayInPublicationIndicator(): ?string
    {
        return $this->delay_in_publication_indicator;
    }

    public function setDelayInPublicationIndicator(?string $delay_in_publication_indicator): self
    {
        $this->delay_in_publication_indicator = $delay_in_publication_indicator;

        return $this;
    }

    public function getRecordId(): ?int
    {
        return $this->record_id;
    }

    public function setRecordId(int $record_id): self
    {
        $this->record_id = $record_id;

        return $this;
    }

    public function getDisputeStatusForPublication(): ?string
    {
        return $this->dispute_status_for_publication;
    }

    public function setDisputeStatusForPublication(?string $dispute_status_for_publication): self
    {
        $this->dispute_status_for_publication = $dispute_status_for_publication;

        return $this;
    }

    public function getProductIndicator(): ?string
    {
        return $this->product_indicator;
    }

    public function setProductIndicator(?string $product_indicator): self
    {
        $this->product_indicator = $product_indicator;

        return $this;
    }

    public function getNameOfAssociatedCoveredDrugOrBiological1(): ?string
    {
        return $this->name_of_associated_covered_drug_or_biological1;
    }

    public function setNameOfAssociatedCoveredDrugOrBiological1(?string $name_of_associated_covered_drug_or_biological1): self
    {
        $this->name_of_associated_covered_drug_or_biological1 = $name_of_associated_covered_drug_or_biological1;

        return $this;
    }

    public function getNameOfAssociatedCoveredDrugOrBiological2(): ?string
    {
        return $this->name_of_associated_covered_drug_or_biological2;
    }

    public function setNameOfAssociatedCoveredDrugOrBiological2(?string $name_of_associated_covered_drug_or_biological2): self
    {
        $this->name_of_associated_covered_drug_or_biological2 = $name_of_associated_covered_drug_or_biological2;

        return $this;
    }

    public function getNameOfAssociatedCoveredDrugOrBiological3(): ?string
    {
        return $this->name_of_associated_covered_drug_or_biological3;
    }

    public function setNameOfAssociatedCoveredDrugOrBiological3(?string $name_of_associated_covered_drug_or_biological3): self
    {
        $this->name_of_associated_covered_drug_or_biological3 = $name_of_associated_covered_drug_or_biological3;

        return $this;
    }

    public function getNameOfAssociatedCoveredDrugOrBiological4(): ?string
    {
        return $this->name_of_associated_covered_drug_or_biological4;
    }

    public function setNameOfAssociatedCoveredDrugOrBiological4(?string $name_of_associated_covered_drug_or_biological4): self
    {
        $this->name_of_associated_covered_drug_or_biological4 = $name_of_associated_covered_drug_or_biological4;

        return $this;
    }

    public function getNameOfAssociatedCoveredDrugOrBiological5(): ?string
    {
        return $this->name_of_associated_covered_drug_or_biological5;
    }

    public function setNameOfAssociatedCoveredDrugOrBiological5(?string $name_of_associated_covered_drug_or_biological5): self
    {
        $this->name_of_associated_covered_drug_or_biological5 = $name_of_associated_covered_drug_or_biological5;

        return $this;
    }

    public function getNdcOfAssociatedCoveredDrugOrBiological1(): ?string
    {
        return $this->ndc_of_associated_covered_drug_or_biological1;
    }

    public function setNdcOfAssociatedCoveredDrugOrBiological1(?string $ndc_of_associated_covered_drug_or_biological1): self
    {
        $this->ndc_of_associated_covered_drug_or_biological1 = $ndc_of_associated_covered_drug_or_biological1;

        return $this;
    }

    public function getNdcOfAssociatedCoveredDrugOrBiological2(): ?string
    {
        return $this->ndc_of_associated_covered_drug_or_biological2;
    }

    public function setNdcOfAssociatedCoveredDrugOrBiological2(?string $ndc_of_associated_covered_drug_or_biological2): self
    {
        $this->ndc_of_associated_covered_drug_or_biological2 = $ndc_of_associated_covered_drug_or_biological2;

        return $this;
    }

    public function getNdcOfAssociatedCoveredDrugOrBiological3(): ?string
    {
        return $this->ndc_of_associated_covered_drug_or_biological3;
    }

    public function setNdcOfAssociatedCoveredDrugOrBiological3(?string $ndc_of_associated_covered_drug_or_biological3): self
    {
        $this->ndc_of_associated_covered_drug_or_biological3 = $ndc_of_associated_covered_drug_or_biological3;

        return $this;
    }

    public function getNdcOfAssociatedCoveredDrugOrBiological4(): ?string
    {
        return $this->ndc_of_associated_covered_drug_or_biological4;
    }

    public function setNdcOfAssociatedCoveredDrugOrBiological4(?string $ndc_of_associated_covered_drug_or_biological4): self
    {
        $this->ndc_of_associated_covered_drug_or_biological4 = $ndc_of_associated_covered_drug_or_biological4;

        return $this;
    }

    public function getNdcOfAssociatedCoveredDrugOrBiological5(): ?string
    {
        return $this->ndc_of_associated_covered_drug_or_biological5;
    }

    public function setNdcOfAssociatedCoveredDrugOrBiological5(?string $ndc_of_associated_covered_drug_or_biological5): self
    {
        $this->ndc_of_associated_covered_drug_or_biological5 = $ndc_of_associated_covered_drug_or_biological5;

        return $this;
    }

    public function getNameOfAssociatedCoveredDeviceOrMedicalSupply1(): ?string
    {
        return $this->name_of_associated_covered_device_or_medical_supply1;
    }

    public function setNameOfAssociatedCoveredDeviceOrMedicalSupply1(?string $name_of_associated_covered_device_or_medical_supply1): self
    {
        $this->name_of_associated_covered_device_or_medical_supply1 = $name_of_associated_covered_device_or_medical_supply1;

        return $this;
    }

    public function getNameOfAssociatedCoveredDeviceOrMedicalSupply2(): ?string
    {
        return $this->name_of_associated_covered_device_or_medical_supply2;
    }

    public function setNameOfAssociatedCoveredDeviceOrMedicalSupply2(?string $name_of_associated_covered_device_or_medical_supply2): self
    {
        $this->name_of_associated_covered_device_or_medical_supply2 = $name_of_associated_covered_device_or_medical_supply2;

        return $this;
    }

    public function getNameOfAssociatedCoveredDeviceOrMedicalSupply3(): ?string
    {
        return $this->name_of_associated_covered_device_or_medical_supply3;
    }

    public function setNameOfAssociatedCoveredDeviceOrMedicalSupply3(?string $name_of_associated_covered_device_or_medical_supply3): self
    {
        $this->name_of_associated_covered_device_or_medical_supply3 = $name_of_associated_covered_device_or_medical_supply3;

        return $this;
    }

    public function getNameOfAssociatedCoveredDeviceOrMedicalSupply4(): ?string
    {
        return $this->name_of_associated_covered_device_or_medical_supply4;
    }

    public function setNameOfAssociatedCoveredDeviceOrMedicalSupply4(?string $name_of_associated_covered_device_or_medical_supply4): self
    {
        $this->name_of_associated_covered_device_or_medical_supply4 = $name_of_associated_covered_device_or_medical_supply4;

        return $this;
    }

    public function getNameOfAssociatedCoveredDeviceOrMedicalSupply5(): ?string
    {
        return $this->name_of_associated_covered_device_or_medical_supply5;
    }

    public function setNameOfAssociatedCoveredDeviceOrMedicalSupply5(?string $name_of_associated_covered_device_or_medical_supply5): self
    {
        $this->name_of_associated_covered_device_or_medical_supply5 = $name_of_associated_covered_device_or_medical_supply5;

        return $this;
    }

    public function getProgramYear(): ?int
    {
        return $this->program_year;
    }

    public function setProgramYear(?int $program_year): self
    {
        $this->program_year = $program_year;

        return $this;
    }

    public function getPaymentPublicationDate(): ?string
    {
        return $this->payment_publication_date;
    }

    public function setPaymentPublicationDate(?string $payment_publication_date): self
    {
        $this->payment_publication_date = $payment_publication_date;

        return $this;
    }
}
