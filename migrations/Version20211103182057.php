<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211103182057 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE purchase ADD purchased_at DATETIME NOT NULL');
        //Mise à jours de la base de donné déjà intégrer.
        $this->addSql('UPDATE purchase SET purchased_at = NOW()');
        //Mise en place de la base de donné avec le date time no null.
        $this->addSql('ALTER TABLE purchase MODIFY purchased_at DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE purchase ADD purchased_at purchased_at DATETIME DEFAULT NULL');
    }
}
