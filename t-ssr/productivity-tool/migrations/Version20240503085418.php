<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240503085418 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE spent_time_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE todo_item_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE todo_item_category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE spent_time (id INT NOT NULL, todo_item_id INT NOT NULL, duration VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_29F55CCBC766982F ON spent_time (todo_item_id)');
        $this->addSql('COMMENT ON COLUMN spent_time.duration IS \'(DC2Type:dateinterval)\'');
        $this->addSql('COMMENT ON COLUMN spent_time.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE todo_item (id INT NOT NULL, category_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, deadline TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, important BOOLEAN NOT NULL, status VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_40CA430112469DE2 ON todo_item (category_id)');
        $this->addSql('COMMENT ON COLUMN todo_item.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE todo_item_category (id INT NOT NULL, name VARCHAR(255) NOT NULL, color VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN todo_item_category.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE spent_time ADD CONSTRAINT FK_29F55CCBC766982F FOREIGN KEY (todo_item_id) REFERENCES todo_item (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE todo_item ADD CONSTRAINT FK_40CA430112469DE2 FOREIGN KEY (category_id) REFERENCES todo_item_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE spent_time_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE todo_item_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE todo_item_category_id_seq CASCADE');
        $this->addSql('ALTER TABLE spent_time DROP CONSTRAINT FK_29F55CCBC766982F');
        $this->addSql('ALTER TABLE todo_item DROP CONSTRAINT FK_40CA430112469DE2');
        $this->addSql('DROP TABLE spent_time');
        $this->addSql('DROP TABLE todo_item');
        $this->addSql('DROP TABLE todo_item_category');
    }
}
