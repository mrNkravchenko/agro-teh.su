<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190612224338 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE partner_tech (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, content LONGTEXT DEFAULT NULL, image VARCHAR(255) NOT NULL, small_image VARCHAR(255) NOT NULL, price VARCHAR(255) DEFAULT NULL, short_name VARCHAR(255) NOT NULL, short_description LONGTEXT DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partner_tech_image (id INT AUTO_INCREMENT NOT NULL, tech_id INT DEFAULT NULL, path VARCHAR(255) NOT NULL, is_slider TINYINT(1) DEFAULT NULL, created DATETIME NOT NULL, INDEX IDX_8D7662364727BFC (tech_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE partner_tech_image ADD CONSTRAINT FK_8D7662364727BFC FOREIGN KEY (tech_id) REFERENCES partner_tech (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE partner_tech_image DROP FOREIGN KEY FK_8D7662364727BFC');
        $this->addSql('DROP TABLE partner_tech');
        $this->addSql('DROP TABLE partner_tech_image');
    }
}
