<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240211170121 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE caracteristique_vehicule ADD CONSTRAINT FK_4BB22A601704EEB7 FOREIGN KEY (caracteristique_id) REFERENCES caracteristique (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE caracteristique_vehicule ADD CONSTRAINT FK_4BB22A604A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCB981C689 FOREIGN KEY (utilisateur_id_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE contact ADD est_humain TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE equipement_vehicule ADD CONSTRAINT FK_36FEF139806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipement_vehicule ADD CONSTRAINT FK_36FEF1394A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gallerie ADD CONSTRAINT FK_63539AC14F9D6605 FOREIGN KEY (vehicule_id_id) REFERENCES vehicule (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipement_vehicule DROP FOREIGN KEY FK_36FEF139806F0F5C');
        $this->addSql('ALTER TABLE equipement_vehicule DROP FOREIGN KEY FK_36FEF1394A4A3511');
        $this->addSql('ALTER TABLE caracteristique_vehicule DROP FOREIGN KEY FK_4BB22A601704EEB7');
        $this->addSql('ALTER TABLE caracteristique_vehicule DROP FOREIGN KEY FK_4BB22A604A4A3511');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCB981C689');
        $this->addSql('ALTER TABLE contact DROP est_humain');
        $this->addSql('ALTER TABLE gallerie DROP FOREIGN KEY FK_63539AC14F9D6605');
    }
}
