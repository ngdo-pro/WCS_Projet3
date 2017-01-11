<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170109195048 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840D832BB05');
        $this->addSql('DROP INDEX IDX_6D28840D832BB05 ON payment');
        $this->addSql('ALTER TABLE payment CHANGE baptism_id baptism_has_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840DAC20AB13 FOREIGN KEY (baptism_has_user_id) REFERENCES baptism_has_user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6D28840DAC20AB13 ON payment (baptism_has_user_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840DAC20AB13');
        $this->addSql('DROP INDEX UNIQ_6D28840DAC20AB13 ON payment');
        $this->addSql('ALTER TABLE payment CHANGE baptism_has_user_id baptism_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D832BB05 FOREIGN KEY (baptism_id) REFERENCES baptism (id)');
        $this->addSql('CREATE INDEX IDX_6D28840D832BB05 ON payment (baptism_id)');
    }
}
