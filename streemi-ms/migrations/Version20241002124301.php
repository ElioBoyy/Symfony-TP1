<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241002124301 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, label VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_media (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, INDEX IDX_9F544CDCBCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, media_id INT DEFAULT NULL, comment_comments_id INT DEFAULT NULL, content LONGTEXT NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_5F9E962AA76ED395 (user_id), INDEX IDX_5F9E962AEA9FDD75 (media_id), INDEX IDX_5F9E962A58DB54C4 (comment_comments_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE episode (id INT AUTO_INCREMENT NOT NULL, season_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, duration TIME NOT NULL, release_date DATE NOT NULL, INDEX IDX_DDAA1CDA4EC001D1 (season_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, code VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, media_movie_id INT DEFAULT NULL, media_serie_id INT DEFAULT NULL, media_type VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, short_description VARCHAR(255) NOT NULL, long_description LONGTEXT NOT NULL, release_date DATETIME NOT NULL, cover_image VARCHAR(255) NOT NULL, staff JSON NOT NULL, cast JSON NOT NULL, UNIQUE INDEX UNIQ_6A2CA10C80F2984E (media_movie_id), UNIQUE INDEX UNIQ_6A2CA10CD622A60F (media_serie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media_categorie_media (media_id INT NOT NULL, categorie_media_id INT NOT NULL, INDEX IDX_E92938B8EA9FDD75 (media_id), INDEX IDX_E92938B8D2189C1F (categorie_media_id), PRIMARY KEY(media_id, categorie_media_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media_media_language (media_id INT NOT NULL, media_language_id INT NOT NULL, INDEX IDX_7A8FAB47EA9FDD75 (media_id), INDEX IDX_7A8FAB477599C867 (media_language_id), PRIMARY KEY(media_id, media_language_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media_language (id INT AUTO_INCREMENT NOT NULL, language_id INT DEFAULT NULL, INDEX IDX_DBBA5F0782F1BAF4 (language_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movie (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playlist (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL, INDEX IDX_D782112DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playlist_media (id INT AUTO_INCREMENT NOT NULL, playlist_id INT DEFAULT NULL, media_id INT DEFAULT NULL, added_at DATETIME NOT NULL, INDEX IDX_C930B84F6BBD148 (playlist_id), INDEX IDX_C930B84FEA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playlist_subscription (id INT AUTO_INCREMENT NOT NULL, playlist_id INT DEFAULT NULL, user_playlist_id INT DEFAULT NULL, subscribed_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_832940C6BBD148 (playlist_id), INDEX IDX_832940CAFA018DD (user_playlist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE season (id INT AUTO_INCREMENT NOT NULL, serie_id INT DEFAULT NULL, season_number INT NOT NULL, INDEX IDX_F0E45BA9D94388BD (serie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE serie (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subscription_user (subscription_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_BAAFC6579A1887DC (subscription_id), INDEX IDX_BAAFC657A76ED395 (user_id), PRIMARY KEY(subscription_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE watch_histoty (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, media_id INT DEFAULT NULL, last_watched DATETIME NOT NULL, number_of_views INT NOT NULL, INDEX IDX_881E485EA76ED395 (user_id), INDEX IDX_881E485EEA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE categorie_media ADD CONSTRAINT FK_9F544CDCBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AEA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A58DB54C4 FOREIGN KEY (comment_comments_id) REFERENCES comments (id)');
        $this->addSql('ALTER TABLE episode ADD CONSTRAINT FK_DDAA1CDA4EC001D1 FOREIGN KEY (season_id) REFERENCES season (id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C80F2984E FOREIGN KEY (media_movie_id) REFERENCES movie (id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CD622A60F FOREIGN KEY (media_serie_id) REFERENCES serie (id)');
        $this->addSql('ALTER TABLE media_categorie_media ADD CONSTRAINT FK_E92938B8EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE media_categorie_media ADD CONSTRAINT FK_E92938B8D2189C1F FOREIGN KEY (categorie_media_id) REFERENCES categorie_media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE media_media_language ADD CONSTRAINT FK_7A8FAB47EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE media_media_language ADD CONSTRAINT FK_7A8FAB477599C867 FOREIGN KEY (media_language_id) REFERENCES media_language (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE media_language ADD CONSTRAINT FK_DBBA5F0782F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE playlist ADD CONSTRAINT FK_D782112DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE playlist_media ADD CONSTRAINT FK_C930B84F6BBD148 FOREIGN KEY (playlist_id) REFERENCES playlist (id)');
        $this->addSql('ALTER TABLE playlist_media ADD CONSTRAINT FK_C930B84FEA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE playlist_subscription ADD CONSTRAINT FK_832940C6BBD148 FOREIGN KEY (playlist_id) REFERENCES playlist (id)');
        $this->addSql('ALTER TABLE playlist_subscription ADD CONSTRAINT FK_832940CAFA018DD FOREIGN KEY (user_playlist_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE season ADD CONSTRAINT FK_F0E45BA9D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id)');
        $this->addSql('ALTER TABLE subscription_user ADD CONSTRAINT FK_BAAFC6579A1887DC FOREIGN KEY (subscription_id) REFERENCES subscription (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subscription_user ADD CONSTRAINT FK_BAAFC657A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE watch_histoty ADD CONSTRAINT FK_881E485EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE watch_histoty ADD CONSTRAINT FK_881E485EEA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE user_user DROP FOREIGN KEY FK_F7129A80233D34C1');
        $this->addSql('ALTER TABLE user_user DROP FOREIGN KEY FK_F7129A803AD8644E');
        $this->addSql('DROP TABLE user_user');
        $this->addSql('ALTER TABLE subscription_history ADD user_id_id INT NOT NULL, ADD subscription_id_id INT NOT NULL, ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE subscription_history ADD CONSTRAINT FK_54AF90D09D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE subscription_history ADD CONSTRAINT FK_54AF90D0857C9F24 FOREIGN KEY (subscription_id_id) REFERENCES subscription (id)');
        $this->addSql('ALTER TABLE subscription_history ADD CONSTRAINT FK_54AF90D0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_54AF90D09D86650F ON subscription_history (user_id_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_54AF90D0857C9F24 ON subscription_history (subscription_id_id)');
        $this->addSql('CREATE INDEX IDX_54AF90D0A76ED395 ON subscription_history (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_user (user_source INT NOT NULL, user_target INT NOT NULL, INDEX IDX_F7129A80233D34C1 (user_target), INDEX IDX_F7129A803AD8644E (user_source), PRIMARY KEY(user_source, user_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE user_user ADD CONSTRAINT FK_F7129A80233D34C1 FOREIGN KEY (user_target) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_user ADD CONSTRAINT FK_F7129A803AD8644E FOREIGN KEY (user_source) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_media DROP FOREIGN KEY FK_9F544CDCBCF5E72D');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AA76ED395');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AEA9FDD75');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A58DB54C4');
        $this->addSql('ALTER TABLE episode DROP FOREIGN KEY FK_DDAA1CDA4EC001D1');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C80F2984E');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CD622A60F');
        $this->addSql('ALTER TABLE media_categorie_media DROP FOREIGN KEY FK_E92938B8EA9FDD75');
        $this->addSql('ALTER TABLE media_categorie_media DROP FOREIGN KEY FK_E92938B8D2189C1F');
        $this->addSql('ALTER TABLE media_media_language DROP FOREIGN KEY FK_7A8FAB47EA9FDD75');
        $this->addSql('ALTER TABLE media_media_language DROP FOREIGN KEY FK_7A8FAB477599C867');
        $this->addSql('ALTER TABLE media_language DROP FOREIGN KEY FK_DBBA5F0782F1BAF4');
        $this->addSql('ALTER TABLE playlist DROP FOREIGN KEY FK_D782112DA76ED395');
        $this->addSql('ALTER TABLE playlist_media DROP FOREIGN KEY FK_C930B84F6BBD148');
        $this->addSql('ALTER TABLE playlist_media DROP FOREIGN KEY FK_C930B84FEA9FDD75');
        $this->addSql('ALTER TABLE playlist_subscription DROP FOREIGN KEY FK_832940C6BBD148');
        $this->addSql('ALTER TABLE playlist_subscription DROP FOREIGN KEY FK_832940CAFA018DD');
        $this->addSql('ALTER TABLE season DROP FOREIGN KEY FK_F0E45BA9D94388BD');
        $this->addSql('ALTER TABLE subscription_user DROP FOREIGN KEY FK_BAAFC6579A1887DC');
        $this->addSql('ALTER TABLE subscription_user DROP FOREIGN KEY FK_BAAFC657A76ED395');
        $this->addSql('ALTER TABLE watch_histoty DROP FOREIGN KEY FK_881E485EA76ED395');
        $this->addSql('ALTER TABLE watch_histoty DROP FOREIGN KEY FK_881E485EEA9FDD75');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE categorie_media');
        $this->addSql('DROP TABLE comments');
        $this->addSql('DROP TABLE episode');
        $this->addSql('DROP TABLE language');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE media_categorie_media');
        $this->addSql('DROP TABLE media_media_language');
        $this->addSql('DROP TABLE media_language');
        $this->addSql('DROP TABLE movie');
        $this->addSql('DROP TABLE playlist');
        $this->addSql('DROP TABLE playlist_media');
        $this->addSql('DROP TABLE playlist_subscription');
        $this->addSql('DROP TABLE season');
        $this->addSql('DROP TABLE serie');
        $this->addSql('DROP TABLE subscription_user');
        $this->addSql('DROP TABLE watch_histoty');
        $this->addSql('ALTER TABLE subscription_history DROP FOREIGN KEY FK_54AF90D09D86650F');
        $this->addSql('ALTER TABLE subscription_history DROP FOREIGN KEY FK_54AF90D0857C9F24');
        $this->addSql('ALTER TABLE subscription_history DROP FOREIGN KEY FK_54AF90D0A76ED395');
        $this->addSql('DROP INDEX UNIQ_54AF90D09D86650F ON subscription_history');
        $this->addSql('DROP INDEX UNIQ_54AF90D0857C9F24 ON subscription_history');
        $this->addSql('DROP INDEX IDX_54AF90D0A76ED395 ON subscription_history');
        $this->addSql('ALTER TABLE subscription_history DROP user_id_id, DROP subscription_id_id, DROP user_id');
    }
}
