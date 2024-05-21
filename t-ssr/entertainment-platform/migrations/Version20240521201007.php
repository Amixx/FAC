<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240521201007 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "user" DROP biography');
        $this->addSql('ALTER TABLE "user" DROP phone_number');
        $this->addSql('ALTER TABLE "user" DROP physical_address');
        $this->addSql('ALTER TABLE "user" DROP workplace');
        $this->addSql('ALTER TABLE "user" DROP website');
        $this->addSql('ALTER TABLE "user" DROP avatar');
        $this->addSql('ALTER TABLE video RENAME COLUMN name TO title');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "user" ADD biography VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD phone_number VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD physical_address VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD workplace VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD website VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD avatar VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE video RENAME COLUMN title TO name');
    }
}
