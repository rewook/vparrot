<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240213204433 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE equipement (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE vehicule_equipement (vehicule_id INT NOT NULL, equipement_id INT NOT NULL, INDEX IDX_E4AB5C5C4A4A3511 (vehicule_id), INDEX IDX_E4AB5C5C806F0F5C (equipement_id), PRIMARY KEY(vehicule_id, equipement_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE vehicule_equipement ADD CONSTRAINT FK_E4AB5C5C4A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vehicule_equipement ADD CONSTRAINT FK_E4AB5C5C806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCB981C689 FOREIGN KEY (utilisateur_id_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE gallerie ADD CONSTRAINT FK_63539AC14F9D6605 FOREIGN KEY (vehicule_id_id) REFERENCES vehicule (id)');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1D1704EEB7 FOREIGN KEY (caracteristique_id) REFERENCES caracteristique (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehicule_equipement DROP FOREIGN KEY FK_E4AB5C5C4A4A3511');
        $this->addSql('ALTER TABLE vehicule_equipement DROP FOREIGN KEY FK_E4AB5C5C806F0F5C');
        $this->addSql('DROP TABLE equipement');
        $this->addSql('DROP TABLE vehicule_equipement');
        $this->addSql('ALTER TABLE gallerie DROP FOREIGN KEY FK_63539AC14F9D6605');
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1D1704EEB7');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCB981C689');
    }
}
