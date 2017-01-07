<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170106084538 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE service_opening_exception ADD restaurant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE service_opening_exception ADD CONSTRAINT FK_1F33C976B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('CREATE INDEX IDX_1F33C976B1E7706E ON service_opening_exception (restaurant_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE service_opening_exception DROP FOREIGN KEY FK_1F33C976B1E7706E');
        $this->addSql('DROP INDEX IDX_1F33C976B1E7706E ON service_opening_exception');
        $this->addSql('ALTER TABLE service_opening_exception DROP restaurant_id');
    }
}
