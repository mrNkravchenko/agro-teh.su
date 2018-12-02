<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181030200943 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE gallery_image (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, name_md5 VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, path_thumbnail VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE angar (id INT AUTO_INCREMENT NOT NULL, width DOUBLE PRECISION NOT NULL, length DOUBLE PRECISION NOT NULL, square DOUBLE PRECISION NOT NULL, costumer INT NOT NULL, address_id INT NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE costumer (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, inn INT NOT NULL, contacts VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, address_id INT NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, region VARCHAR(255) NOT NULL, region_index VARCHAR(255) NOT NULL, city VARCHAR(255) DEFAULT NULL, district VARCHAR(255) DEFAULT NULL, street VARCHAR(255) NOT NULL, building VARCHAR(255) DEFAULT NULL, zip VARCHAR(255) DEFAULT NULL, coordinate VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE angar_image (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, name_md5 VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, path_thumbnail VARCHAR(255) NOT NULL, angar_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE angar_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE gallery_image');
        $this->addSql('DROP TABLE angar');
        $this->addSql('DROP TABLE costumer');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE angar_image');
        $this->addSql('DROP TABLE angar_category');
    }
}
