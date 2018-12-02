<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181025204455 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tech ADD performance INT NOT NULL, DROP content, DROP `table`, DROP after_slider, DROP video');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tech ADD content LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD `table` LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD after_slider LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD video VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, DROP performance');
    }
}
