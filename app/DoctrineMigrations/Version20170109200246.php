<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170109200246 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE baptism ADD restaurant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE baptism ADD CONSTRAINT FK_2F754E36B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('CREATE INDEX IDX_2F754E36B1E7706E ON baptism (restaurant_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE baptism DROP FOREIGN KEY FK_2F754E36B1E7706E');
        $this->addSql('DROP INDEX IDX_2F754E36B1E7706E ON baptism');
        $this->addSql('ALTER TABLE baptism DROP restaurant_id');
    }
}
