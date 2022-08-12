<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220812092437 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE canvas (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', spaceship_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(100) NOT NULL, width INT NOT NULL, height INT NOT NULL, UNIQUE INDEX UNIQ_A59F6C184AD9556B (spaceship_id), INDEX IDX_name (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE spaceship (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', position_x INT NOT NULL, position_y INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE canvas ADD CONSTRAINT FK_A59F6C184AD9556B FOREIGN KEY (spaceship_id) REFERENCES spaceship (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE canvas DROP FOREIGN KEY FK_A59F6C184AD9556B');
        $this->addSql('DROP TABLE canvas');
        $this->addSql('DROP TABLE spaceship');
    }
}
