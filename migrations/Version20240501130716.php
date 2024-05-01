<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240501130716 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE post_post_tag (post_id INT NOT NULL, post_tag_id INT NOT NULL, INDEX IDX_E523B3514B89032C (post_id), INDEX IDX_E523B3518AF08774 (post_tag_id), PRIMARY KEY(post_id, post_tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE post_post_tag ADD CONSTRAINT FK_E523B3514B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_post_tag ADD CONSTRAINT FK_E523B3518AF08774 FOREIGN KEY (post_tag_id) REFERENCES post_tag (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post_post_tag DROP FOREIGN KEY FK_E523B3514B89032C');
        $this->addSql('ALTER TABLE post_post_tag DROP FOREIGN KEY FK_E523B3518AF08774');
        $this->addSql('DROP TABLE post_post_tag');
    }
}
