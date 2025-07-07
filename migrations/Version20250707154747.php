<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250707154747 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE invoice (id SERIAL NOT NULL, customer_id INT NOT NULL, quote_id INT DEFAULT NULL, reference VARCHAR(10) DEFAULT NULL, customer_name VARCHAR(200) NOT NULL, customer_address VARCHAR(100) DEFAULT NULL, customer_address2 VARCHAR(100) DEFAULT NULL, customer_zip_code VARCHAR(10) DEFAULT NULL, customer_city VARCHAR(100) DEFAULT NULL, customer_country VARCHAR(2) DEFAULT NULL, customer_type VARCHAR(20) NOT NULL, total_with_tax NUMERIC(10, 2) NOT NULL, total_exclude_tax NUMERIC(10, 2) DEFAULT NULL, total_tax NUMERIC(10, 2) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, status VARCHAR(30) NOT NULL, due_date DATE DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_906517449395C3F3 ON invoice (customer_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_90651744DB805178 ON invoice (quote_id)
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN invoice.created_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN invoice.updated_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN invoice.due_date IS '(DC2Type:date_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE quote (id SERIAL NOT NULL, customer_id INT NOT NULL, reference VARCHAR(10) DEFAULT NULL, customer_name VARCHAR(200) NOT NULL, customer_address VARCHAR(100) DEFAULT NULL, customer_address2 VARCHAR(100) DEFAULT NULL, customer_zip_code VARCHAR(10) DEFAULT NULL, customer_city VARCHAR(100) DEFAULT NULL, customer_country VARCHAR(2) DEFAULT NULL, customer_type VARCHAR(20) NOT NULL, total_with_tax NUMERIC(10, 2) NOT NULL, total_exclude_tax NUMERIC(10, 2) DEFAULT NULL, total_tax NUMERIC(10, 2) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, status VARCHAR(30) NOT NULL, expiration_date DATE DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_6B71CBF49395C3F3 ON quote (customer_id)
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN quote.created_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN quote.updated_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN quote.expiration_date IS '(DC2Type:date_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE invoice ADD CONSTRAINT FK_906517449395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE invoice ADD CONSTRAINT FK_90651744DB805178 FOREIGN KEY (quote_id) REFERENCES quote (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE quote ADD CONSTRAINT FK_6B71CBF49395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE invoice DROP CONSTRAINT FK_906517449395C3F3
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE invoice DROP CONSTRAINT FK_90651744DB805178
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE quote DROP CONSTRAINT FK_6B71CBF49395C3F3
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE invoice
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE quote
        SQL);
    }
}
