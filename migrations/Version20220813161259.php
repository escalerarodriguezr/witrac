<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220813161259 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE block (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', canvas_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', position_x INT NOT NULL, position_y INT NOT NULL, INDEX IDX_831B9722DD8C9D23 (canvas_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE block ADD CONSTRAINT FK_831B9722DD8C9D23 FOREIGN KEY (canvas_id) REFERENCES canvas (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE block DROP FOREIGN KEY FK_831B9722DD8C9D23');
        $this->addSql('DROP TABLE block');
    }
}
