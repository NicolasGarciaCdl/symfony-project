<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220428074339 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE author CHANGE birthdate birthdate DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE country ADD country_name VARCHAR(255) NOT NULL, DROP countryName, CHANGE code_country code_country VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE author CHANGE birthdate birthdate DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE country ADD countryName VARCHAR(50) DEFAULT \'\' NOT NULL, DROP country_name, CHANGE code_country code_country CHAR(2) DEFAULT \'\' NOT NULL');
    }
}
