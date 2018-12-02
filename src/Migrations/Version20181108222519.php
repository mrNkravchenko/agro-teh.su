<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181108222519 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE angar ADD costumer_id INT DEFAULT NULL, DROP costumer');
        $this->addSql('ALTER TABLE angar ADD CONSTRAINT FK_36FCBE8360B71152 FOREIGN KEY (costumer_id) REFERENCES costumer (id)');
        $this->addSql('CREATE INDEX IDX_36FCBE8360B71152 ON angar (costumer_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE angar DROP FOREIGN KEY FK_36FCBE8360B71152');
        $this->addSql('DROP INDEX IDX_36FCBE8360B71152 ON angar');
        $this->addSql('ALTER TABLE angar ADD costumer INT NOT NULL, DROP costumer_id');
    }
}
