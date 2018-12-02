<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181108204713 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE angar ADD address_id INT DEFAULT NULL, DROP address');
        $this->addSql('ALTER TABLE angar ADD CONSTRAINT FK_36FCBE83F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_36FCBE83F5B7AF75 ON angar (address_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE angar DROP FOREIGN KEY FK_36FCBE83F5B7AF75');
        $this->addSql('DROP INDEX UNIQ_36FCBE83F5B7AF75 ON angar');
        $this->addSql('ALTER TABLE angar ADD address INT NOT NULL, DROP address_id');
    }
}
