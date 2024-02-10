<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240210180543 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE equipement (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, possede TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE equipement_vehicule (equipement_id INT NOT NULL, vehicule_id INT NOT NULL, INDEX IDX_36FEF139806F0F5C (equipement_id), INDEX IDX_36FEF1394A4A3511 (vehicule_id), PRIMARY KEY(equipement_id, vehicule_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE equipement_vehicule ADD CONSTRAINT FK_36FEF139806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipement_vehicule ADD CONSTRAINT FK_36FEF1394A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE caracteristique_vehicule ADD CONSTRAINT FK_4BB22A601704EEB7 FOREIGN KEY (caracteristique_id) REFERENCES caracteristique (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE caracteristique_vehicule ADD CONSTRAINT FK_4BB22A604A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCB981C689 FOREIGN KEY (utilisateur_id_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE gallerie ADD CONSTRAINT FK_63539AC14F9D6605 FOREIGN KEY (vehicule_id_id) REFERENCES vehicule (id)');
        $this->addSql('ALTER TABLE horaire_jour_ouvert ADD CONSTRAINT FK_7DBC7B9A58C54515 FOREIGN KEY (horaire_id) REFERENCES horaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE horaire_jour_ouvert ADD CONSTRAINT FK_7DBC7B9ABACED132 FOREIGN KEY (jour_ouvert_id) REFERENCES jour_ouvert (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipement_vehicule DROP FOREIGN KEY FK_36FEF139806F0F5C');
        $this->addSql('ALTER TABLE equipement_vehicule DROP FOREIGN KEY FK_36FEF1394A4A3511');
        $this->addSql('DROP TABLE equipement');
        $this->addSql('DROP TABLE equipement_vehicule');
        $this->addSql('ALTER TABLE caracteristique_vehicule DROP FOREIGN KEY FK_4BB22A601704EEB7');
        $this->addSql('ALTER TABLE caracteristique_vehicule DROP FOREIGN KEY FK_4BB22A604A4A3511');
        $this->addSql('ALTER TABLE gallerie DROP FOREIGN KEY FK_63539AC14F9D6605');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCB981C689');
        $this->addSql('ALTER TABLE horaire_jour_ouvert DROP FOREIGN KEY FK_7DBC7B9A58C54515');
        $this->addSql('ALTER TABLE horaire_jour_ouvert DROP FOREIGN KEY FK_7DBC7B9ABACED132');
    }
}
