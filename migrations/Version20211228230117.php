<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211228230117 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE competences_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE realisation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE competences (id INT NOT NULL, name VARCHAR(255) NOT NULL, value INT DEFAULT NULL, description TEXT DEFAULT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE realisation (id INT NOT NULL, title VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, website_link VARCHAR(255) DEFAULT NULL, github_link VARCHAR(255) DEFAULT NULL, image_link VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, priory INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, date_of_birth DATE NOT NULL, age INT NOT NULL, adress VARCHAR(255) NOT NULL, nationality VARCHAR(255) NOT NULL, niveau VARCHAR(255) NOT NULL, university VARCHAR(255) NOT NULL, formation VARCHAR(255) DEFAULT NULL, title VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, resume TEXT DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE SCHEMA public');
        // $this->addSql('DROP SEQUENCE competences_id_seq CASCADE');
        // $this->addSql('DROP SEQUENCE realisation_id_seq CASCADE');
        // $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        // $this->addSql('DROP TABLE competences');
        // $this->addSql('DROP TABLE realisation');
        // $this->addSql('DROP TABLE "user"');
    }
}
