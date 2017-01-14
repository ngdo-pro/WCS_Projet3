<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170110152035 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transaction CHANGE authorisation_id authorisation_id VARCHAR(255) DEFAULT NULL, CHANGE bank_response_code bank_response_code VARCHAR(255) DEFAULT NULL, CHANGE caddie caddie VARCHAR(255) DEFAULT NULL, CHANGE capture_day capture_day VARCHAR(255) DEFAULT NULL, CHANGE capture_mode capture_mode VARCHAR(255) DEFAULT NULL, CHANGE card_number card_number VARCHAR(255) DEFAULT NULL, CHANGE card_validity card_validity VARCHAR(255) DEFAULT NULL, CHANGE code code VARCHAR(255) DEFAULT NULL, CHANGE complementary_code complementary_code VARCHAR(255) DEFAULT NULL, CHANGE complementary_info complementary_info VARCHAR(255) DEFAULT NULL, CHANGE customer_ip_address customer_ip_address VARCHAR(255) DEFAULT NULL, CHANGE cvv_flag cvv_flag VARCHAR(255) DEFAULT NULL, CHANGE cvv_response_code cvv_response_code VARCHAR(255) DEFAULT NULL, CHANGE data data VARCHAR(255) DEFAULT NULL, CHANGE error error VARCHAR(255) DEFAULT NULL, CHANGE language language VARCHAR(255) DEFAULT NULL, CHANGE merchant_country merchant_country VARCHAR(255) DEFAULT NULL, CHANGE merchant_id merchant_id VARCHAR(255) DEFAULT NULL, CHANGE merchant_language merchant_language VARCHAR(255) DEFAULT NULL, CHANGE order_id order_id VARCHAR(255) DEFAULT NULL, CHANGE order_validity order_validity VARCHAR(255) DEFAULT NULL, CHANGE payment_certificate payment_certificate VARCHAR(255) DEFAULT NULL, CHANGE payment_date payment_date DATETIME DEFAULT NULL, CHANGE payment_means payment_means VARCHAR(255) DEFAULT NULL, CHANGE receipt_complement receipt_complement VARCHAR(255) DEFAULT NULL, CHANGE response_code response_code VARCHAR(255) DEFAULT NULL, CHANGE return_context return_context VARCHAR(255) DEFAULT NULL, CHANGE score_color score_color VARCHAR(255) DEFAULT NULL, CHANGE score_info score_info VARCHAR(255) DEFAULT NULL, CHANGE score_profile score_profile VARCHAR(255) DEFAULT NULL, CHANGE score_threshold score_threshold VARCHAR(255) DEFAULT NULL, CHANGE score_value score_value VARCHAR(255) DEFAULT NULL, CHANGE statement_reference statement_reference VARCHAR(255) DEFAULT NULL, CHANGE transaction_condition transaction_condition VARCHAR(255) DEFAULT NULL, CHANGE transmission_date transmission_date DATETIME DEFAULT NULL, CHANGE updated updated DATETIME DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transaction CHANGE authorisation_id authorisation_id VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE bank_response_code bank_response_code VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE caddie caddie VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE capture_day capture_day VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE capture_mode capture_mode VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE card_number card_number VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE card_validity card_validity VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE code code VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE complementary_code complementary_code VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE complementary_info complementary_info VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE customer_ip_address customer_ip_address VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE cvv_flag cvv_flag VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE cvv_response_code cvv_response_code VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE data data VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE error error VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE language language VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE merchant_country merchant_country VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE merchant_id merchant_id VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE merchant_language merchant_language VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE order_id order_id VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE order_validity order_validity VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE payment_certificate payment_certificate VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE payment_date payment_date DATETIME NOT NULL, CHANGE payment_means payment_means VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE receipt_complement receipt_complement VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE response_code response_code VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE return_context return_context VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE score_color score_color VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE score_info score_info VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE score_profile score_profile VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE score_threshold score_threshold VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE score_value score_value VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE statement_reference statement_reference VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE transaction_condition transaction_condition VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE transmission_date transmission_date DATETIME NOT NULL, CHANGE updated updated DATETIME NOT NULL');
    }
}
