<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170109172329 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE transaction (id INT AUTO_INCREMENT NOT NULL, amount INT NOT NULL, authorisation_id VARCHAR(255) NOT NULL, bank_response_code VARCHAR(255) NOT NULL, caddie VARCHAR(255) NOT NULL, capture_day VARCHAR(255) NOT NULL, capture_mode VARCHAR(255) NOT NULL, card_number VARCHAR(255) NOT NULL, card_validity VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, complementary_code VARCHAR(255) NOT NULL, complementary_info VARCHAR(255) NOT NULL, created DATETIME NOT NULL, currency_code INT NOT NULL, customer_email VARCHAR(255) NOT NULL, customer_id VARCHAR(255) NOT NULL, customer_ip_address VARCHAR(255) NOT NULL, cvv_flag VARCHAR(255) NOT NULL, cvv_response_code VARCHAR(255) NOT NULL, data VARCHAR(255) NOT NULL, error VARCHAR(255) NOT NULL, language VARCHAR(255) NOT NULL, merchant_country VARCHAR(255) NOT NULL, merchant_id VARCHAR(255) NOT NULL, merchant_language VARCHAR(255) NOT NULL, order_id VARCHAR(255) NOT NULL, order_validity VARCHAR(255) NOT NULL, payment_certificate VARCHAR(255) NOT NULL, payment_date DATETIME NOT NULL, payment_means VARCHAR(255) NOT NULL, receipt_complement VARCHAR(255) NOT NULL, response_code VARCHAR(255) NOT NULL, return_context VARCHAR(255) NOT NULL, score_color VARCHAR(255) NOT NULL, score_info VARCHAR(255) NOT NULL, score_profile VARCHAR(255) NOT NULL, score_threshold VARCHAR(255) NOT NULL, score_value VARCHAR(255) NOT NULL, statement_reference VARCHAR(255) NOT NULL, transaction_condition VARCHAR(255) NOT NULL, transmission_date DATETIME NOT NULL, updated DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE transaction');
    }
}
