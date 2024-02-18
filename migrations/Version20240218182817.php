<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240218182817 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCB981C689 FOREIGN KEY (utilisateur_id_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE gallerie ADD CONSTRAINT FK_63539AC14F9D6605 FOREIGN KEY (vehicule_id_id) REFERENCES vehicule (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE vehicule_equipement ADD CONSTRAINT FK_E4AB5C5C4A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vehicule_equipement ADD CONSTRAINT FK_E4AB5C5C806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCB981C689');
        $this->addSql('ALTER TABLE vehicule_equipement DROP FOREIGN KEY FK_E4AB5C5C4A4A3511');
        $this->addSql('ALTER TABLE vehicule_equipement DROP FOREIGN KEY FK_E4AB5C5C806F0F5C');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE gallerie DROP FOREIGN KEY FK_63539AC14F9D6605');
    }
}
