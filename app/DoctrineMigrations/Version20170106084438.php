<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170106084438 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE service_opening ADD restaurant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE service_opening ADD CONSTRAINT FK_C1B1865FB1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('CREATE INDEX IDX_C1B1865FB1E7706E ON service_opening (restaurant_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE service_opening DROP FOREIGN KEY FK_C1B1865FB1E7706E');
        $this->addSql('DROP INDEX IDX_C1B1865FB1E7706E ON service_opening');
        $this->addSql('ALTER TABLE service_opening DROP restaurant_id');
    }
}
