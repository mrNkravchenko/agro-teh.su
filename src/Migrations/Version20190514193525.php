<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190514193525 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE spare_parts (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE spare_parts_tech (spare_parts_id INT NOT NULL, tech_id INT NOT NULL, INDEX IDX_578AB9A9597E364F (spare_parts_id), INDEX IDX_578AB9A964727BFC (tech_id), PRIMARY KEY(spare_parts_id, tech_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE spare_parts_image (id INT AUTO_INCREMENT NOT NULL, spare_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, name_md5 VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, path_thumbnail VARCHAR(255) NOT NULL, first TINYINT(1) DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME DEFAULT NULL, INDEX IDX_995F58D27ED7ED72 (spare_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tech_spare_parts (tech_id INT NOT NULL, spare_parts_id INT NOT NULL, INDEX IDX_C32612FC64727BFC (tech_id), INDEX IDX_C32612FC597E364F (spare_parts_id), PRIMARY KEY(tech_id, spare_parts_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE spare_parts_tech ADD CONSTRAINT FK_578AB9A9597E364F FOREIGN KEY (spare_parts_id) REFERENCES spare_parts (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE spare_parts_tech ADD CONSTRAINT FK_578AB9A964727BFC FOREIGN KEY (tech_id) REFERENCES tech (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE spare_parts_image ADD CONSTRAINT FK_995F58D27ED7ED72 FOREIGN KEY (spare_id) REFERENCES spare_parts (id)');
        $this->addSql('ALTER TABLE tech_spare_parts ADD CONSTRAINT FK_C32612FC64727BFC FOREIGN KEY (tech_id) REFERENCES tech (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tech_spare_parts ADD CONSTRAINT FK_C32612FC597E364F FOREIGN KEY (spare_parts_id) REFERENCES spare_parts (id) ON DELETE CASCADE');
//        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE spare_parts_tech DROP FOREIGN KEY FK_578AB9A9597E364F');
        $this->addSql('ALTER TABLE spare_parts_image DROP FOREIGN KEY FK_995F58D27ED7ED72');
        $this->addSql('ALTER TABLE tech_spare_parts DROP FOREIGN KEY FK_C32612FC597E364F');
        $this->addSql('DROP TABLE spare_parts');
        $this->addSql('DROP TABLE spare_parts_tech');
        $this->addSql('DROP TABLE spare_parts_image');
        $this->addSql('DROP TABLE tech_spare_parts');
//        $this->addSql('ALTER TABLE user CHANGE roles roles VARCHAR(180) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
