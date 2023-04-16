<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230416121834 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE feeding_time (id INT AUTO_INCREMENT NOT NULL, cat_id INT NOT NULL, food_id INT NOT NULL, week_day SMALLINT NOT NULL, time TIME NOT NULL, INDEX IDX_5E3786E8E6ADA943 (cat_id), INDEX IDX_5E3786E8BA8E87C4 (food_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE food (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE log (id INT AUTO_INCREMENT NOT NULL, service_id INT DEFAULT NULL, time DATETIME NOT NULL, data LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', INDEX IDX_8F3F68C5ED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE feeding_time ADD CONSTRAINT FK_5E3786E8E6ADA943 FOREIGN KEY (cat_id) REFERENCES cat (id)');
        $this->addSql('ALTER TABLE feeding_time ADD CONSTRAINT FK_5E3786E8BA8E87C4 FOREIGN KEY (food_id) REFERENCES food (id)');
        $this->addSql('ALTER TABLE log ADD CONSTRAINT FK_8F3F68C5ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE feeding_time DROP FOREIGN KEY FK_5E3786E8E6ADA943');
        $this->addSql('ALTER TABLE feeding_time DROP FOREIGN KEY FK_5E3786E8BA8E87C4');
        $this->addSql('ALTER TABLE log DROP FOREIGN KEY FK_8F3F68C5ED5CA9E6');
        $this->addSql('DROP TABLE feeding_time');
        $this->addSql('DROP TABLE food');
        $this->addSql('DROP TABLE log');
    }
}
