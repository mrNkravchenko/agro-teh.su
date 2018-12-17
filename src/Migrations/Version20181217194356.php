<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181217194356 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tech_feedback (id INT AUTO_INCREMENT NOT NULL, tech_id INT DEFAULT NULL, feedback LONGTEXT NOT NULL, created DATETIME NOT NULL, liked INT DEFAULT NULL, not_liked INT DEFAULT NULL, INDEX IDX_D42EEAA364727BFC (tech_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tech_feedback ADD CONSTRAINT FK_D42EEAA364727BFC FOREIGN KEY (tech_id) REFERENCES tech (id)');
        $this->addSql('DROP TABLE category_id');
        $this->addSql('DROP TABLE clients');
        $this->addSql('DROP TABLE goods');
        $this->addSql('ALTER TABLE performance CHANGE performance performance JSON NOT NULL COMMENT \'(DC2Type:json_array)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category_id (id INT AUTO_INCREMENT NOT NULL, title TEXT DEFAULT NULL COLLATE utf8_general_ci, UNIQUE INDEX category_id_id_uindex (id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clients (id INT AUTO_INCREMENT NOT NULL, phone VARCHAR(55) NOT NULL COLLATE utf8_general_ci, ip_address VARCHAR(55) NOT NULL COLLATE utf8_general_ci, UNIQUE INDEX clients_id_uindex (id), UNIQUE INDEX clients_phone_uindex (phone), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE goods (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL COLLATE utf8_general_ci, price VARCHAR(55) DEFAULT NULL COLLATE utf8_general_ci, width VARCHAR(55) DEFAULT NULL COLLATE utf8_general_ci, height VARCHAR(55) DEFAULT NULL COLLATE utf8_general_ci, length VARCHAR(55) DEFAULT NULL COLLATE utf8_general_ci, weight VARCHAR(55) DEFAULT NULL COLLATE utf8_general_ci, category_id INT NOT NULL, volume VARCHAR(55) DEFAULT NULL COLLATE utf8_general_ci, UNIQUE INDEX goods_id_uindex (id), INDEX category_id (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE tech_feedback');
        $this->addSql('ALTER TABLE performance CHANGE performance performance VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
