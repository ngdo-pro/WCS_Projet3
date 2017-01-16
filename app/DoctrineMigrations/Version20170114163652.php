<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170114163652 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD civility TINYINT(1) DEFAULT NULL, ADD address VARCHAR(255) DEFAULT NULL, ADD postal_code INT DEFAULT NULL, ADD city VARCHAR(255) DEFAULT NULL, DROP biography, DROP signature_dish, DROP profession, CHANGE phone mobile_phone VARCHAR(40) DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD biography LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, ADD signature_dish VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, ADD profession VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, DROP civility, DROP address, DROP postal_code, DROP city, CHANGE mobile_phone phone VARCHAR(40) DEFAULT NULL COLLATE utf8_unicode_ci');
    }
}
