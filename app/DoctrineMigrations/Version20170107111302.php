<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170107111302 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE baptem_has_user DROP FOREIGN KEY FK_AC9DB6A7F5984994');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840DF5984994');
        $this->addSql('CREATE TABLE baptism (id INT AUTO_INCREMENT NOT NULL, service_id INT DEFAULT NULL, status TINYINT(1) NOT NULL, date DATE NOT NULL, places INT NOT NULL, INDEX IDX_2F754E36ED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE baptism_has_user (id INT AUTO_INCREMENT NOT NULL, baptism_id INT DEFAULT NULL, user_id INT DEFAULT NULL, role TINYINT(1) NOT NULL, INDEX IDX_D799699E832BB05 (baptism_id), INDEX IDX_D799699EA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE baptism ADD CONSTRAINT FK_2F754E36ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE baptism_has_user ADD CONSTRAINT FK_D799699E832BB05 FOREIGN KEY (baptism_id) REFERENCES baptism (id)');
        $this->addSql('ALTER TABLE baptism_has_user ADD CONSTRAINT FK_D799699EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('DROP TABLE baptem');
        $this->addSql('DROP TABLE baptem_has_user');
        $this->addSql('DROP INDEX IDX_6D28840DF5984994 ON payment');
        $this->addSql('ALTER TABLE payment ADD user_id INT DEFAULT NULL, CHANGE baptem_id baptism_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D832BB05 FOREIGN KEY (baptism_id) REFERENCES baptism (id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_6D28840D832BB05 ON payment (baptism_id)');
        $this->addSql('CREATE INDEX IDX_6D28840DA76ED395 ON payment (user_id)');
        $this->addSql('ALTER TABLE service_opening_exception ADD service_id INT DEFAULT NULL, ADD restaurant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE service_opening_exception ADD CONSTRAINT FK_1F33C976ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE service_opening_exception ADD CONSTRAINT FK_1F33C976B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('CREATE INDEX IDX_1F33C976ED5CA9E6 ON service_opening_exception (service_id)');
        $this->addSql('CREATE INDEX IDX_1F33C976B1E7706E ON service_opening_exception (restaurant_id)');
        $this->addSql('ALTER TABLE service_opening ADD service_id INT DEFAULT NULL, ADD restaurant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE service_opening ADD CONSTRAINT FK_C1B1865FED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE service_opening ADD CONSTRAINT FK_C1B1865FB1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('CREATE INDEX IDX_C1B1865FED5CA9E6 ON service_opening (service_id)');
        $this->addSql('CREATE INDEX IDX_C1B1865FB1E7706E ON service_opening (restaurant_id)');
        $this->addSql('ALTER TABLE media ADD user_id INT DEFAULT NULL, ADD restaurant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CB1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('CREATE INDEX IDX_6A2CA10CA76ED395 ON media (user_id)');
        $this->addSql('CREATE INDEX IDX_6A2CA10CB1E7706E ON media (restaurant_id)');
        $this->addSql('ALTER TABLE restaurant ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE restaurant ADD CONSTRAINT FK_EB95123FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_EB95123FA76ED395 ON restaurant (user_id)');
        $this->addSql('ALTER TABLE price ADD product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE price ADD CONSTRAINT FK_CAC822D94584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_CAC822D94584665A ON price (product_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840D832BB05');
        $this->addSql('ALTER TABLE baptism_has_user DROP FOREIGN KEY FK_D799699E832BB05');
        $this->addSql('CREATE TABLE baptem (id INT AUTO_INCREMENT NOT NULL, service_id INT DEFAULT NULL, status TINYINT(1) NOT NULL, date DATE NOT NULL, places INT NOT NULL, INDEX IDX_43E2B318ED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE baptem_has_user (id INT AUTO_INCREMENT NOT NULL, baptem_id INT DEFAULT NULL, role TINYINT(1) NOT NULL, INDEX IDX_AC9DB6A7F5984994 (baptem_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE baptem ADD CONSTRAINT FK_43E2B318ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE baptem_has_user ADD CONSTRAINT FK_AC9DB6A7F5984994 FOREIGN KEY (baptem_id) REFERENCES baptem (id)');
        $this->addSql('DROP TABLE baptism');
        $this->addSql('DROP TABLE baptism_has_user');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CA76ED395');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CB1E7706E');
        $this->addSql('DROP INDEX IDX_6A2CA10CA76ED395 ON media');
        $this->addSql('DROP INDEX IDX_6A2CA10CB1E7706E ON media');
        $this->addSql('ALTER TABLE media DROP user_id, DROP restaurant_id');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840DA76ED395');
        $this->addSql('DROP INDEX IDX_6D28840D832BB05 ON payment');
        $this->addSql('DROP INDEX IDX_6D28840DA76ED395 ON payment');
        $this->addSql('ALTER TABLE payment ADD baptem_id INT DEFAULT NULL, DROP baptism_id, DROP user_id');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840DF5984994 FOREIGN KEY (baptem_id) REFERENCES baptem (id)');
        $this->addSql('CREATE INDEX IDX_6D28840DF5984994 ON payment (baptem_id)');
        $this->addSql('ALTER TABLE price DROP FOREIGN KEY FK_CAC822D94584665A');
        $this->addSql('DROP INDEX IDX_CAC822D94584665A ON price');
        $this->addSql('ALTER TABLE price DROP product_id');
        $this->addSql('ALTER TABLE restaurant DROP FOREIGN KEY FK_EB95123FA76ED395');
        $this->addSql('DROP INDEX IDX_EB95123FA76ED395 ON restaurant');
        $this->addSql('ALTER TABLE restaurant DROP user_id');
        $this->addSql('ALTER TABLE service_opening DROP FOREIGN KEY FK_C1B1865FED5CA9E6');
        $this->addSql('ALTER TABLE service_opening DROP FOREIGN KEY FK_C1B1865FB1E7706E');
        $this->addSql('DROP INDEX IDX_C1B1865FED5CA9E6 ON service_opening');
        $this->addSql('DROP INDEX IDX_C1B1865FB1E7706E ON service_opening');
        $this->addSql('ALTER TABLE service_opening DROP service_id, DROP restaurant_id');
        $this->addSql('ALTER TABLE service_opening_exception DROP FOREIGN KEY FK_1F33C976ED5CA9E6');
        $this->addSql('ALTER TABLE service_opening_exception DROP FOREIGN KEY FK_1F33C976B1E7706E');
        $this->addSql('DROP INDEX IDX_1F33C976ED5CA9E6 ON service_opening_exception');
        $this->addSql('DROP INDEX IDX_1F33C976B1E7706E ON service_opening_exception');
        $this->addSql('ALTER TABLE service_opening_exception DROP service_id, DROP restaurant_id');
    }
}
