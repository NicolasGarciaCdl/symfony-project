<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220428123854 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE author DROP FOREIGN KEY FK_BDAFD8C8D8A48BBD');
        $this->addSql('DROP INDEX IDX_BDAFD8C8D8A48BBD ON author');
        $this->addSql('ALTER TABLE author CHANGE country_id_id country_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE author ADD CONSTRAINT FK_BDAFD8C8F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('CREATE INDEX IDX_BDAFD8C8F92F3E70 ON author (country_id)');
        $this->addSql('ALTER TABLE kind CHANGE name name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE author DROP FOREIGN KEY FK_BDAFD8C8F92F3E70');
        $this->addSql('DROP INDEX IDX_BDAFD8C8F92F3E70 ON author');
        $this->addSql('ALTER TABLE author CHANGE country_id country_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE author ADD CONSTRAINT FK_BDAFD8C8D8A48BBD FOREIGN KEY (country_id_id) REFERENCES country (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_BDAFD8C8D8A48BBD ON author (country_id_id)');
        $this->addSql('ALTER TABLE kind CHANGE name name VARCHAR(32) DEFAULT NULL');
    }
}
