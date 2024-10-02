<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241002141358 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE movie ADD title VARCHAR(255) NOT NULL, ADD short_desc LONGTEXT NOT NULL, ADD long_desc LONGTEXT NOT NULL, ADD cover_image VARCHAR(255) NOT NULL, ADD release_date DATE NOT NULL, ADD duration INT NOT NULL, ADD rating INT NOT NULL, ADD yt_trailer VARCHAR(255) DEFAULT NULL, ADD allocine_trailer VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE movie DROP title, DROP short_desc, DROP long_desc, DROP cover_image, DROP release_date, DROP duration, DROP rating, DROP yt_trailer, DROP allocine_trailer');
    }
}
