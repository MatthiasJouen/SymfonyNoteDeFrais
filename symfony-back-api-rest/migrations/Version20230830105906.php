<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230830105906 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note_frais (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, note_type_id INT NOT NULL, company_id INT NOT NULL, date DATE NOT NULL, amount DOUBLE PRECISION NOT NULL, save_date DATE NOT NULL, INDEX IDX_4050EF4FA76ED395 (user_id), INDEX IDX_4050EF4F44EA4809 (note_type_id), INDEX IDX_4050EF4F979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE note_frais ADD CONSTRAINT FK_4050EF4FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE note_frais ADD CONSTRAINT FK_4050EF4F44EA4809 FOREIGN KEY (note_type_id) REFERENCES note_type (id)');
        $this->addSql('ALTER TABLE note_frais ADD CONSTRAINT FK_4050EF4F979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE note_frais DROP FOREIGN KEY FK_4050EF4FA76ED395');
        $this->addSql('ALTER TABLE note_frais DROP FOREIGN KEY FK_4050EF4F44EA4809');
        $this->addSql('ALTER TABLE note_frais DROP FOREIGN KEY FK_4050EF4F979B1AD6');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE note_frais');
        $this->addSql('DROP TABLE note_type');
    }
}
