<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190502194226 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

//        $this->addSql('DROP TABLE category_id');
//        $this->addSql('DROP TABLE clients');
//        $this->addSql('DROP TABLE goods');
        $this->addSql('ALTER TABLE angar_category ADD content LONGTEXT NOT NULL');
//        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE api_token api_token VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

//        $this->addSql('CREATE TABLE category_id (id INT AUTO_INCREMENT NOT NULL, title TEXT DEFAULT NULL COLLATE utf8_general_ci, UNIQUE INDEX category_id_id_uindex (id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
//        $this->addSql('CREATE TABLE clients (id INT AUTO_INCREMENT NOT NULL, phone VARCHAR(55) NOT NULL COLLATE utf8_general_ci, ip_address VARCHAR(55) NOT NULL COLLATE utf8_general_ci, UNIQUE INDEX clients_id_uindex (id), UNIQUE INDEX clients_phone_uindex (phone), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
//        $this->addSql('CREATE TABLE goods (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL COLLATE utf8_general_ci, price VARCHAR(55) DEFAULT NULL COLLATE utf8_general_ci, width VARCHAR(55) DEFAULT NULL COLLATE utf8_general_ci, height VARCHAR(55) DEFAULT NULL COLLATE utf8_general_ci, length VARCHAR(55) DEFAULT NULL COLLATE utf8_general_ci, weight VARCHAR(55) DEFAULT NULL COLLATE utf8_general_ci, category_id INT NOT NULL, volume VARCHAR(55) DEFAULT NULL COLLATE utf8_general_ci, UNIQUE INDEX goods_id_uindex (id), INDEX category_id (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE angar_category DROP content');
//        $this->addSql('ALTER TABLE user CHANGE roles roles VARCHAR(500) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE api_token api_token VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
