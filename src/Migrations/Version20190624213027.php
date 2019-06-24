<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190624213027 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F8160B71152');
        $this->addSql('DROP INDEX UNIQ_D4E6F8160B71152 ON address');
        $this->addSql('ALTER TABLE address DROP costumer_id');
        $this->addSql('ALTER TABLE costumer ADD address_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE costumer ADD CONSTRAINT FK_7D33FA72F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7D33FA72F5B7AF75 ON costumer (address_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE address ADD costumer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F8160B71152 FOREIGN KEY (costumer_id) REFERENCES costumer (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D4E6F8160B71152 ON address (costumer_id)');
        $this->addSql('ALTER TABLE costumer DROP FOREIGN KEY FK_7D33FA72F5B7AF75');
        $this->addSql('DROP INDEX UNIQ_7D33FA72F5B7AF75 ON costumer');
        $this->addSql('ALTER TABLE costumer DROP address_id');
    }
}
