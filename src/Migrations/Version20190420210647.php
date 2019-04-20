<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190420210647 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('
          CREATE TABLE payment (
            id INT AUTO_INCREMENT NOT NULL, 
            change_type VARCHAR(63) DEFAULT NULL, 
            covered_recipient_type VARCHAR(255) DEFAULT NULL, 
            teaching_hospital_ccn VARCHAR(255) DEFAULT NULL, 
            teaching_hospital_id INT DEFAULT NULL, 
            teaching_hospital_name VARCHAR(255) DEFAULT NULL, 
            physician_profile_id INT DEFAULT NULL, 
            physician_first_name VARCHAR(255) DEFAULT NULL, 
            physician_middle_name VARCHAR(255) DEFAULT NULL, 
            physician_last_name VARCHAR(255) DEFAULT NULL, 
            physician_name_suffix VARCHAR(255) DEFAULT NULL, 
            recipient_primary_business_street_address_line1 VARCHAR(255) DEFAULT NULL, 
            recipient_primary_business_street_address_line2 VARCHAR(255) DEFAULT NULL, 
            recipient_city VARCHAR(255) DEFAULT NULL, 
            recipient_state VARCHAR(255) DEFAULT NULL, 
            recipient_zip_code VARCHAR(255) DEFAULT NULL, 
            recipient_country VARCHAR(255) DEFAULT NULL, 
            recipient_province VARCHAR(255) DEFAULT NULL, 
            recipient_postal_code VARCHAR(255) DEFAULT NULL, 
            physician_primary_type VARCHAR(255) DEFAULT NULL, 
            physician_specialty VARCHAR(255) DEFAULT NULL, 
            physician_license_state_code1 VARCHAR(255) DEFAULT NULL, 
            physician_license_state_code2 VARCHAR(255) DEFAULT NULL, 
            physician_license_state_code3 VARCHAR(255) DEFAULT NULL, 
            physician_license_state_code4 VARCHAR(255) DEFAULT NULL, 
            physician_license_state_code5 VARCHAR(255) DEFAULT NULL, 
            submitting_applicable_manufacturer_or_applicable_gpo_name VARCHAR(255) DEFAULT NULL, 
            applicable_manufacturer_or_applicable_gpo_making_payment_id DOUBLE DEFAULT NULL, 
            applicable_manufacturer_or_applicable_gpo_making_payment_name VARCHAR(255) DEFAULT NULL, 
            applicable_manufacturer_or_applicable_gpo_making_payment_state VARCHAR(255) DEFAULT NULL, 
            applicable_manufacturer_or_applicable_gpo_making_payment_country VARCHAR(255) DEFAULT NULL, 
            total_amount_of_payment_usdollars DOUBLE PRECISION DEFAULT NULL, 
            date_of_payment VARCHAR(255) DEFAULT NULL, 
            number_of_payments_included_in_total_amount INT DEFAULT NULL, 
            form_of_payment_or_transfer_of_value VARCHAR(255) DEFAULT NULL, 
            nature_of_payment_or_transfer_of_value VARCHAR(255) DEFAULT NULL, 
            city_of_travel VARCHAR(255) DEFAULT NULL, 
            state_of_travel VARCHAR(255) DEFAULT NULL, 
            country_of_travel VARCHAR(255) DEFAULT NULL, 
            physician_ownership_indicator VARCHAR(255) DEFAULT NULL, 
            third_party_payment_recipient_indicator VARCHAR(255) DEFAULT NULL, 
            name_of_third_party_entity_receiving_payment_or_transfer_of_val VARCHAR(255) DEFAULT NULL, 
            charity_indicator VARCHAR(255) DEFAULT NULL, 
            third_party_equals_covered_recipient_indicator VARCHAR(255) DEFAULT NULL, 
            contextual_information VARCHAR(255) DEFAULT NULL, 
            delay_in_publication_indicator VARCHAR(255) DEFAULT NULL, 
            record_id INT NOT NULL, 
            dispute_status_for_publication VARCHAR(255) DEFAULT NULL, 
            product_indicator VARCHAR(255) DEFAULT NULL, 
            name_of_associated_covered_drug_or_biological1 VARCHAR(255) DEFAULT NULL, 
            name_of_associated_covered_drug_or_biological2 VARCHAR(255) DEFAULT NULL, 
            name_of_associated_covered_drug_or_biological3 VARCHAR(255) DEFAULT NULL, 
            name_of_associated_covered_drug_or_biological4 VARCHAR(255) DEFAULT NULL, 
            name_of_associated_covered_drug_or_biological5 VARCHAR(255) DEFAULT NULL, 
            ndc_of_associated_covered_drug_or_biological1 VARCHAR(255) DEFAULT NULL, 
            ndc_of_associated_covered_drug_or_biological2 VARCHAR(255) DEFAULT NULL, 
            ndc_of_associated_covered_drug_or_biological3 VARCHAR(255) DEFAULT NULL, 
            ndc_of_associated_covered_drug_or_biological4 VARCHAR(255) DEFAULT NULL, 
            ndc_of_associated_covered_drug_or_biological5 VARCHAR(255) DEFAULT NULL, 
            name_of_associated_covered_device_or_medical_supply1 VARCHAR(255) DEFAULT NULL, 
            name_of_associated_covered_device_or_medical_supply2 VARCHAR(255) DEFAULT NULL, 
            name_of_associated_covered_device_or_medical_supply3 VARCHAR(255) DEFAULT NULL, 
            name_of_associated_covered_device_or_medical_supply4 VARCHAR(255) DEFAULT NULL, 
            name_of_associated_covered_device_or_medical_supply5 VARCHAR(255) DEFAULT NULL, 
            program_year INT DEFAULT NULL, 
            payment_publication_date VARCHAR(255) DEFAULT NULL, 
            UNIQUE INDEX UNIQ_6D28840D4DFD750C (record_id), 
            PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE payment');
    }
}
