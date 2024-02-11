<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240211145633 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE horaire');
        $this->addSql('DROP TABLE jour_ouvert');
        $this->addSql('DROP TABLE horaire_jour_ouvert');
        $this->addSql('ALTER TABLE caracteristique_vehicule ADD CONSTRAINT FK_4BB22A601704EEB7 FOREIGN KEY (caracteristique_id) REFERENCES caracteristique (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE caracteristique_vehicule ADD CONSTRAINT FK_4BB22A604A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCB981C689 FOREIGN KEY (utilisateur_id_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE equipement_vehicule ADD CONSTRAINT FK_36FEF139806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipement_vehicule ADD CONSTRAINT FK_36FEF1394A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gallerie ADD CONSTRAINT FK_63539AC14F9D6605 FOREIGN KEY (vehicule_id_id) REFERENCES vehicule (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE horaire (id INT AUTO_INCREMENT NOT NULL, hdmatin DATETIME DEFAULT NULL, hfmatin DATETIME DEFAULT NULL, hdapresmidi DATETIME DEFAULT NULL, hfapresmidi DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE jour_ouvert (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE horaire_jour_ouvert (horaire_id INT NOT NULL, jour_ouvert_id INT NOT NULL, INDEX IDX_7DBC7B9A58C54515 (horaire_id), INDEX IDX_7DBC7B9ABACED132 (jour_ouvert_id), PRIMARY KEY(horaire_id, jour_ouvert_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('ALTER TABLE caracteristique_vehicule DROP FOREIGN KEY FK_4BB22A601704EEB7');
        $this->addSql('ALTER TABLE caracteristique_vehicule DROP FOREIGN KEY FK_4BB22A604A4A3511');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCB981C689');
        $this->addSql('ALTER TABLE equipement_vehicule DROP FOREIGN KEY FK_36FEF139806F0F5C');
        $this->addSql('ALTER TABLE equipement_vehicule DROP FOREIGN KEY FK_36FEF1394A4A3511');
        $this->addSql('ALTER TABLE gallerie DROP FOREIGN KEY FK_63539AC14F9D6605');
    }
}
