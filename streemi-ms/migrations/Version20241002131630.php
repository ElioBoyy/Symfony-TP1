<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241002131630 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '1st Migration Done';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE media_categorie_media DROP FOREIGN KEY FK_E92938B8EA9FDD75');
        $this->addSql('ALTER TABLE media_categorie_media DROP FOREIGN KEY FK_E92938B8D2189C1F');
        $this->addSql('ALTER TABLE media_language DROP FOREIGN KEY FK_DBBA5F0782F1BAF4');
        $this->addSql('ALTER TABLE media_media_language DROP FOREIGN KEY FK_7A8FAB47EA9FDD75');
        $this->addSql('ALTER TABLE media_media_language DROP FOREIGN KEY FK_7A8FAB477599C867');
        $this->addSql('ALTER TABLE categorie_media DROP FOREIGN KEY FK_9F544CDCBCF5E72D');
        $this->addSql('DROP TABLE media_categorie_media');
        $this->addSql('DROP TABLE media_language');
        $this->addSql('DROP TABLE media_media_language');
        $this->addSql('DROP TABLE categorie_media');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CD622A60F');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C80F2984E');
        $this->addSql('DROP INDEX UNIQ_6A2CA10C80F2984E ON media');
        $this->addSql('DROP INDEX UNIQ_6A2CA10CD622A60F ON media');
        $this->addSql('ALTER TABLE media DROP media_movie_id, DROP media_serie_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE media_categorie_media (media_id INT NOT NULL, categorie_media_id INT NOT NULL, INDEX IDX_E92938B8EA9FDD75 (media_id), INDEX IDX_E92938B8D2189C1F (categorie_media_id), PRIMARY KEY(media_id, categorie_media_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE media_language (id INT AUTO_INCREMENT NOT NULL, language_id INT DEFAULT NULL, INDEX IDX_DBBA5F0782F1BAF4 (language_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE media_media_language (media_id INT NOT NULL, media_language_id INT NOT NULL, INDEX IDX_7A8FAB477599C867 (media_language_id), INDEX IDX_7A8FAB47EA9FDD75 (media_id), PRIMARY KEY(media_id, media_language_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE categorie_media (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, INDEX IDX_9F544CDCBCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE media_categorie_media ADD CONSTRAINT FK_E92938B8EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE media_categorie_media ADD CONSTRAINT FK_E92938B8D2189C1F FOREIGN KEY (categorie_media_id) REFERENCES categorie_media (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE media_language ADD CONSTRAINT FK_DBBA5F0782F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE media_media_language ADD CONSTRAINT FK_7A8FAB47EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE media_media_language ADD CONSTRAINT FK_7A8FAB477599C867 FOREIGN KEY (media_language_id) REFERENCES media_language (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_media ADD CONSTRAINT FK_9F544CDCBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE media ADD media_movie_id INT DEFAULT NULL, ADD media_serie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CD622A60F FOREIGN KEY (media_serie_id) REFERENCES serie (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C80F2984E FOREIGN KEY (media_movie_id) REFERENCES movie (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6A2CA10C80F2984E ON media (media_movie_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6A2CA10CD622A60F ON media (media_serie_id)');
    }
}
