<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181028121542 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE video ADD tech_id INT DEFAULT NULL, DROP tech');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2C64727BFC FOREIGN KEY (tech_id) REFERENCES tech (id)');
        $this->addSql('CREATE INDEX IDX_7CC7DA2C64727BFC ON video (tech_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2C64727BFC');
        $this->addSql('DROP INDEX IDX_7CC7DA2C64727BFC ON video');
        $this->addSql('ALTER TABLE video ADD tech INT NOT NULL, DROP tech_id');
    }
}
