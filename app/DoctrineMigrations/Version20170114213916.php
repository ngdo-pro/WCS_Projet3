<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170114213916 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user CHANGE birth_date birth_date DATE NOT NULL, CHANGE mobile_phone mobile_phone VARCHAR(40) NOT NULL, CHANGE address address VARCHAR(255) NOT NULL, CHANGE zip_code zip_code VARCHAR(5) NOT NULL, CHANGE city city VARCHAR(255) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user CHANGE birth_date birth_date DATE DEFAULT NULL, CHANGE address address VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE zip_code zip_code VARCHAR(5) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE city city VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE mobile_phone mobile_phone VARCHAR(40) DEFAULT NULL COLLATE utf8_unicode_ci');
    }
}
