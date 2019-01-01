<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181224183927 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE dimensions (id INT AUTO_INCREMENT NOT NULL, tech_id INT DEFAULT NULL, width VARCHAR(55) NOT NULL, height VARCHAR(55) NOT NULL, length VARCHAR(55) NOT NULL, volume VARCHAR(55) NOT NULL, UNIQUE INDEX UNIQ_E27D8BA564727BFC (tech_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dimensions ADD CONSTRAINT FK_E27D8BA564727BFC FOREIGN KEY (tech_id) REFERENCES tech (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE dimensions');
    }
}
