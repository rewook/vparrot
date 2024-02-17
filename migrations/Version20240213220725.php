<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240213220725 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE caracteristique');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCB981C689 FOREIGN KEY (utilisateur_id_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE gallerie ADD CONSTRAINT FK_63539AC14F9D6605 FOREIGN KEY (vehicule_id_id) REFERENCES vehicule (id)');
        $this->addSql('DROP INDEX UNIQ_292FFF1D1704EEB7 ON vehicule');
        $this->addSql('ALTER TABLE vehicule ADD marque VARCHAR(255) NOT NULL, ADD modele VARCHAR(255) NOT NULL, ADD annee VARCHAR(255) NOT NULL, ADD kilometrage VARCHAR(255) NOT NULL, ADD energie VARCHAR(255) NOT NULL, ADD boite VARCHAR(255) NOT NULL, ADD couleur VARCHAR(255) NOT NULL, ADD nbplace INT NOT NULL, ADD puissance INT NOT NULL, ADD puissance_din INT NOT NULL, CHANGE caracteristique_id nbporte INT NOT NULL');
        $this->addSql('ALTER TABLE vehicule_equipement ADD CONSTRAINT FK_E4AB5C5C4A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vehicule_equipement ADD CONSTRAINT FK_E4AB5C5C806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE caracteristique (id INT AUTO_INCREMENT NOT NULL, marque VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, modele VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, annee VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, kilometrage VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, energie VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, boite VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, couleur VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`, nbporte INT NOT NULL, nbplace INT NOT NULL, puissance INT NOT NULL, puissance_din INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCB981C689');
        $this->addSql('ALTER TABLE gallerie DROP FOREIGN KEY FK_63539AC14F9D6605');
        $this->addSql('ALTER TABLE vehicule ADD caracteristique_id INT NOT NULL, DROP marque, DROP modele, DROP annee, DROP kilometrage, DROP energie, DROP boite, DROP couleur, DROP nbporte, DROP nbplace, DROP puissance, DROP puissance_din');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_292FFF1D1704EEB7 ON vehicule (caracteristique_id)');
        $this->addSql('ALTER TABLE vehicule_equipement DROP FOREIGN KEY FK_E4AB5C5C4A4A3511');
        $this->addSql('ALTER TABLE vehicule_equipement DROP FOREIGN KEY FK_E4AB5C5C806F0F5C');
    }
}
