<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240210175810 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE horaire (id INT AUTO_INCREMENT NOT NULL, hdmatin DATETIME DEFAULT NULL, hfmatin DATETIME DEFAULT NULL, hdapresmidi DATETIME DEFAULT NULL, hfapresmidi DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE horaire_jour_ouvert (horaire_id INT NOT NULL, jour_ouvert_id INT NOT NULL, INDEX IDX_7DBC7B9A58C54515 (horaire_id), INDEX IDX_7DBC7B9ABACED132 (jour_ouvert_id), PRIMARY KEY(horaire_id, jour_ouvert_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE vehicule (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, image VARCHAR(255) DEFAULT NULL, annee DATETIME NOT NULL, kilometrage DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE horaire_jour_ouvert ADD CONSTRAINT FK_7DBC7B9A58C54515 FOREIGN KEY (horaire_id) REFERENCES horaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE horaire_jour_ouvert ADD CONSTRAINT FK_7DBC7B9ABACED132 FOREIGN KEY (jour_ouvert_id) REFERENCES jour_ouvert (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCB981C689 FOREIGN KEY (utilisateur_id_id) REFERENCES utilisateur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE horaire_jour_ouvert DROP FOREIGN KEY FK_7DBC7B9A58C54515');
        $this->addSql('ALTER TABLE horaire_jour_ouvert DROP FOREIGN KEY FK_7DBC7B9ABACED132');
        $this->addSql('DROP TABLE horaire');
        $this->addSql('DROP TABLE horaire_jour_ouvert');
        $this->addSql('DROP TABLE vehicule');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCB981C689');
    }
}
