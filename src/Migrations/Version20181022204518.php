<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181022204518 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX tech_url_uindex ON tech');
        $this->addSql('DROP INDEX tech_category_url_uindex ON tech_category');
        $this->addSql('ALTER TABLE tech_image ADD tech_id_id INT DEFAULT NULL, DROP tech_id');
        $this->addSql('ALTER TABLE tech_image ADD CONSTRAINT FK_122665C5A85FFFCD FOREIGN KEY (tech_id_id) REFERENCES tech (id)');
        $this->addSql('CREATE INDEX IDX_122665C5A85FFFCD ON tech_image (tech_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE UNIQUE INDEX tech_url_uindex ON tech (url)');
        $this->addSql('CREATE UNIQUE INDEX tech_category_url_uindex ON tech_category (url)');
        $this->addSql('ALTER TABLE tech_image DROP FOREIGN KEY FK_122665C5A85FFFCD');
        $this->addSql('DROP INDEX IDX_122665C5A85FFFCD ON tech_image');
        $this->addSql('ALTER TABLE tech_image ADD tech_id INT NOT NULL, DROP tech_id_id');
    }
}
