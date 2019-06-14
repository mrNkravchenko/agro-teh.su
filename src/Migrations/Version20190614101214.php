<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190614101214 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE partner_service_image DROP FOREIGN KEY FK_20B7D4F964727BFC');
        $this->addSql('DROP INDEX IDX_20B7D4F964727BFC ON partner_service_image');
        $this->addSql('ALTER TABLE partner_service_image CHANGE tech_id service_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE partner_service_image ADD CONSTRAINT FK_20B7D4F9ED5CA9E6 FOREIGN KEY (service_id) REFERENCES partner_service (id)');
        $this->addSql('CREATE INDEX IDX_20B7D4F9ED5CA9E6 ON partner_service_image (service_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE partner_service_image DROP FOREIGN KEY FK_20B7D4F9ED5CA9E6');
        $this->addSql('DROP INDEX IDX_20B7D4F9ED5CA9E6 ON partner_service_image');
        $this->addSql('ALTER TABLE partner_service_image CHANGE service_id tech_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE partner_service_image ADD CONSTRAINT FK_20B7D4F964727BFC FOREIGN KEY (tech_id) REFERENCES partner_tech (id)');
        $this->addSql('CREATE INDEX IDX_20B7D4F964727BFC ON partner_service_image (tech_id)');
    }
}
