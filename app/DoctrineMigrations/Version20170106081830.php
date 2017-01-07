<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170106081830 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE service_opening ADD service_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE service_opening ADD CONSTRAINT FK_C1B1865FED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('CREATE INDEX IDX_C1B1865FED5CA9E6 ON service_opening (service_id)');
        $this->addSql('ALTER TABLE service_opening_exception ADD service_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE service_opening_exception ADD CONSTRAINT FK_1F33C976ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('CREATE INDEX IDX_1F33C976ED5CA9E6 ON service_opening_exception (service_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE service_opening DROP FOREIGN KEY FK_C1B1865FED5CA9E6');
        $this->addSql('DROP INDEX IDX_C1B1865FED5CA9E6 ON service_opening');
        $this->addSql('ALTER TABLE service_opening DROP service_id');
        $this->addSql('ALTER TABLE service_opening_exception DROP FOREIGN KEY FK_1F33C976ED5CA9E6');
        $this->addSql('DROP INDEX IDX_1F33C976ED5CA9E6 ON service_opening_exception');
        $this->addSql('ALTER TABLE service_opening_exception DROP service_id');
    }
}
