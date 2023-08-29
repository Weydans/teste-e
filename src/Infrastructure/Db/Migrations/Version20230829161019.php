<?php

declare(strict_types=1);

namespace App\Infrastructure\Db\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230829161019 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Process (id INT AUTO_INCREMENT NOT NULL, person_id INT DEFAULT NULL, unit_id INT DEFAULT NULL, type INT NOT NULL, status INT NOT NULL, line_position INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_49A0210A217BBB47 (person_id), INDEX IDX_49A0210AF8BD700D (unit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Process ADD CONSTRAINT FK_49A0210A217BBB47 FOREIGN KEY (person_id) REFERENCES Person (id)');
        $this->addSql('ALTER TABLE Process ADD CONSTRAINT FK_49A0210AF8BD700D FOREIGN KEY (unit_id) REFERENCES Unit (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Process DROP FOREIGN KEY FK_49A0210A217BBB47');
        $this->addSql('ALTER TABLE Process DROP FOREIGN KEY FK_49A0210AF8BD700D');
        $this->addSql('DROP TABLE Process');
    }
}
