<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170110160612 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user CHANGE slug slug VARCHAR(255) NOT NULL, CHANGE biography biography LONGTEXT DEFAULT NULL, CHANGE signature_dish signature_dish VARCHAR(255) DEFAULT NULL, CHANGE rating rating DOUBLE PRECISION DEFAULT NULL, CHANGE phone phone VARCHAR(40) DEFAULT NULL, CHANGE level level INT DEFAULT NULL, CHANGE participation participation INT DEFAULT NULL, CHANGE profession profession VARCHAR(255) DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user CHANGE slug slug VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE biography biography LONGTEXT NOT NULL COLLATE utf8_unicode_ci, CHANGE signature_dish signature_dish VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE rating rating DOUBLE PRECISION NOT NULL, CHANGE phone phone VARCHAR(40) NOT NULL COLLATE utf8_unicode_ci, CHANGE level level INT NOT NULL, CHANGE participation participation INT NOT NULL, CHANGE profession profession VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
    }
}
