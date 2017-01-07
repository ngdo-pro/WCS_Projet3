<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170107113711 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE baptism (id INT AUTO_INCREMENT NOT NULL, service_id INT DEFAULT NULL, status TINYINT(1) NOT NULL, date DATE NOT NULL, places INT NOT NULL, INDEX IDX_2F754E36ED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment (id INT AUTO_INCREMENT NOT NULL, baptism_id INT DEFAULT NULL, user_id INT DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, product_name VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, confirmation_sent TINYINT(1) NOT NULL, INDEX IDX_6D28840D832BB05 (baptism_id), INDEX IDX_6D28840DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service_opening_exception (id INT AUTO_INCREMENT NOT NULL, service_id INT DEFAULT NULL, restaurant_id INT DEFAULT NULL, date DATE NOT NULL, status INT NOT NULL, INDEX IDX_1F33C976ED5CA9E6 (service_id), INDEX IDX_1F33C976B1E7706E (restaurant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service_opening (id INT AUTO_INCREMENT NOT NULL, service_id INT DEFAULT NULL, restaurant_id INT DEFAULT NULL, monday INT NOT NULL, tuesday INT NOT NULL, wednesday INT NOT NULL, thursday INT NOT NULL, friday INT NOT NULL, saturday INT NOT NULL, sunday INT NOT NULL, INDEX IDX_C1B1865FED5CA9E6 (service_id), INDEX IDX_C1B1865FB1E7706E (restaurant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, restaurant_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, last_updated_at DATETIME NOT NULL, context VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_6A2CA10CA76ED395 (user_id), INDEX IDX_6A2CA10CB1E7706E (restaurant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurant (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, opening_date DATE NOT NULL, address VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, web_url VARCHAR(255) NOT NULL, trip_advisor_url VARCHAR(255) NOT NULL, facebook_url VARCHAR(255) NOT NULL, phone VARCHAR(40) NOT NULL, phone2 VARCHAR(40) DEFAULT NULL, email VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, postal_code VARCHAR(20) NOT NULL, city VARCHAR(255) NOT NULL, food_type VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_EB95123F989D9B62 (slug), INDEX IDX_EB95123FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE baptism_has_user (id INT AUTO_INCREMENT NOT NULL, baptism_id INT DEFAULT NULL, user_id INT DEFAULT NULL, role TINYINT(1) NOT NULL, INDEX IDX_D799699E832BB05 (baptism_id), INDEX IDX_D799699EA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE food_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE price (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, value DOUBLE PRECISION NOT NULL, INDEX IDX_CAC822D94584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, postal_code VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, birth_date DATE DEFAULT NULL, biography LONGTEXT NOT NULL, signature_dish VARCHAR(255) NOT NULL, rating DOUBLE PRECISION NOT NULL, phone VARCHAR(40) NOT NULL, level INT NOT NULL, participation INT NOT NULL, profession VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D64992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_8D93D649A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_8D93D649C05FB297 (confirmation_token), UNIQUE INDEX UNIQ_8D93D649989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_64C19C15E237E06 (name), UNIQUE INDEX UNIQ_64C19C1989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, keywords VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, views INT NOT NULL, visibility VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, last_updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_5A8A6C8D2B36786B (title), INDEX IDX_5A8A6C8D12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post_has_tag (post_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_AA15D4A4B89032C (post_id), INDEX IDX_AA15D4ABAD26311 (tag_id), PRIMARY KEY(post_id, tag_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_389B7832B36786B (title), UNIQUE INDEX UNIQ_389B783989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE baptism ADD CONSTRAINT FK_2F754E36ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D832BB05 FOREIGN KEY (baptism_id) REFERENCES baptism (id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE service_opening_exception ADD CONSTRAINT FK_1F33C976ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE service_opening_exception ADD CONSTRAINT FK_1F33C976B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('ALTER TABLE service_opening ADD CONSTRAINT FK_C1B1865FED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE service_opening ADD CONSTRAINT FK_C1B1865FB1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CB1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('ALTER TABLE restaurant ADD CONSTRAINT FK_EB95123FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE baptism_has_user ADD CONSTRAINT FK_D799699E832BB05 FOREIGN KEY (baptism_id) REFERENCES baptism (id)');
        $this->addSql('ALTER TABLE baptism_has_user ADD CONSTRAINT FK_D799699EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE price ADD CONSTRAINT FK_CAC822D94584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE post_has_tag ADD CONSTRAINT FK_AA15D4A4B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE post_has_tag ADD CONSTRAINT FK_AA15D4ABAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE baptism DROP FOREIGN KEY FK_2F754E36ED5CA9E6');
        $this->addSql('ALTER TABLE service_opening_exception DROP FOREIGN KEY FK_1F33C976ED5CA9E6');
        $this->addSql('ALTER TABLE service_opening DROP FOREIGN KEY FK_C1B1865FED5CA9E6');
        $this->addSql('ALTER TABLE price DROP FOREIGN KEY FK_CAC822D94584665A');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840D832BB05');
        $this->addSql('ALTER TABLE baptism_has_user DROP FOREIGN KEY FK_D799699E832BB05');
        $this->addSql('ALTER TABLE service_opening_exception DROP FOREIGN KEY FK_1F33C976B1E7706E');
        $this->addSql('ALTER TABLE service_opening DROP FOREIGN KEY FK_C1B1865FB1E7706E');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CB1E7706E');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840DA76ED395');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CA76ED395');
        $this->addSql('ALTER TABLE restaurant DROP FOREIGN KEY FK_EB95123FA76ED395');
        $this->addSql('ALTER TABLE baptism_has_user DROP FOREIGN KEY FK_D799699EA76ED395');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D12469DE2');
        $this->addSql('ALTER TABLE post_has_tag DROP FOREIGN KEY FK_AA15D4A4B89032C');
        $this->addSql('ALTER TABLE post_has_tag DROP FOREIGN KEY FK_AA15D4ABAD26311');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE baptism');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE service_opening_exception');
        $this->addSql('DROP TABLE service_opening');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE restaurant');
        $this->addSql('DROP TABLE baptism_has_user');
        $this->addSql('DROP TABLE food_type');
        $this->addSql('DROP TABLE price');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE post_has_tag');
        $this->addSql('DROP TABLE tag');
    }
}
