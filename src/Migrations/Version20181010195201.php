<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181010195201 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tech ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tech ADD CONSTRAINT FK_86BC301212469DE2 FOREIGN KEY (category_id) REFERENCES tech_category (id)');
        $this->addSql('CREATE INDEX IDX_86BC301212469DE2 ON tech (category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tech DROP FOREIGN KEY FK_86BC301212469DE2');
        $this->addSql('DROP INDEX IDX_86BC301212469DE2 ON tech');
        $this->addSql('ALTER TABLE tech DROP category_id');
    }
}
