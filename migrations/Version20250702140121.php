<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250702140121 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE customer (id SERIAL NOT NULL, email VARCHAR(100) DEFAULT NULL, is_company BOOLEAN NOT NULL, company_name VARCHAR(100) DEFAULT NULL, legal_status VARCHAR(255) NOT NULL, lastname VARCHAR(100) DEFAULT NULL, firstname VARCHAR(100) DEFAULT NULL, gender VARCHAR(20) DEFAULT NULL, address VARCHAR(100) DEFAULT NULL, address2 VARCHAR(100) DEFAULT NULL, vat_number VARCHAR(50) DEFAULT NULL, zip_code VARCHAR(10) DEFAULT NULL, city VARCHAR(100) DEFAULT NULL, country VARCHAR(100) DEFAULT NULL, phone VARCHAR(20) DEFAULT NULL, company_number VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id))
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE customer
        SQL);
    }
}
