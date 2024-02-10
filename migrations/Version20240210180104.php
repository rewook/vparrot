<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240210180104 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gallerie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, vehicule_id_id INT DEFAULT NULL, INDEX IDX_63539AC14F9D6605 (vehicule_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE gallerie ADD CONSTRAINT FK_63539AC14F9D6605 FOREIGN KEY (vehicule_id_id) REFERENCES vehicule (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCB981C689 FOREIGN KEY (utilisateur_id_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE horaire_jour_ouvert ADD CONSTRAINT FK_7DBC7B9A58C54515 FOREIGN KEY (horaire_id) REFERENCES horaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE horaire_jour_ouvert ADD CONSTRAINT FK_7DBC7B9ABACED132 FOREIGN KEY (jour_ouvert_id) REFERENCES jour_ouvert (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gallerie DROP FOREIGN KEY FK_63539AC14F9D6605');
        $this->addSql('DROP TABLE gallerie');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCB981C689');
        $this->addSql('ALTER TABLE horaire_jour_ouvert DROP FOREIGN KEY FK_7DBC7B9A58C54515');
        $this->addSql('ALTER TABLE horaire_jour_ouvert DROP FOREIGN KEY FK_7DBC7B9ABACED132');
    }
}
