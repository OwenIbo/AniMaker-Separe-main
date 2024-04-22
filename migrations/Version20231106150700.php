<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231106150700 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE studio_danimation (id INT AUTO_INCREMENT NOT NULL, nom_studio VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE studio_danimation_anime (studio_danimation_id INT NOT NULL, anime_id INT NOT NULL, INDEX IDX_539A563CDDB3CC50 (studio_danimation_id), INDEX IDX_539A563C794BBE89 (anime_id), PRIMARY KEY(studio_danimation_id, anime_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE studio_danimation_anime ADD CONSTRAINT FK_539A563CDDB3CC50 FOREIGN KEY (studio_danimation_id) REFERENCES studio_danimation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE studio_danimation_anime ADD CONSTRAINT FK_539A563C794BBE89 FOREIGN KEY (anime_id) REFERENCES anime (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE studio_danimation_anime DROP FOREIGN KEY FK_539A563CDDB3CC50');
        $this->addSql('ALTER TABLE studio_danimation_anime DROP FOREIGN KEY FK_539A563C794BBE89');
        $this->addSql('DROP TABLE studio_danimation');
        $this->addSql('DROP TABLE studio_danimation_anime');
    }
}
