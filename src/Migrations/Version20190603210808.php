<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190603210808 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE tech_spare_parts');
        $this->addSql('ALTER TABLE tech_feedback ADD name LONGTEXT NOT NULL, ADD title LONGTEXT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tech_spare_parts (tech_id INT NOT NULL, spare_parts_id INT NOT NULL, INDEX IDX_C32612FC64727BFC (tech_id), INDEX IDX_C32612FC597E364F (spare_parts_id), PRIMARY KEY(tech_id, spare_parts_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tech_spare_parts ADD CONSTRAINT FK_C32612FC597E364F FOREIGN KEY (spare_parts_id) REFERENCES spare_parts (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tech_spare_parts ADD CONSTRAINT FK_C32612FC64727BFC FOREIGN KEY (tech_id) REFERENCES tech (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tech_feedback DROP name, DROP title');
    }
}
