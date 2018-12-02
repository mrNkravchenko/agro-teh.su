<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181105123006 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE angar ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE angar ADD CONSTRAINT FK_36FCBE8312469DE2 FOREIGN KEY (category_id) REFERENCES angar_category (id)');
        $this->addSql('CREATE INDEX IDX_36FCBE8312469DE2 ON angar (category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE angar DROP FOREIGN KEY FK_36FCBE8312469DE2');
        $this->addSql('DROP INDEX IDX_36FCBE8312469DE2 ON angar');
        $this->addSql('ALTER TABLE angar DROP category_id');
    }
}
