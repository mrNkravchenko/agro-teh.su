<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181104204929 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE angar_image ADD angar_id_id INT DEFAULT NULL, DROP angar_id');
        $this->addSql('ALTER TABLE angar_image ADD CONSTRAINT FK_948008FD2EF992F5 FOREIGN KEY (angar_id_id) REFERENCES angar (id)');
        $this->addSql('CREATE INDEX IDX_948008FD2EF992F5 ON angar_image (angar_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE angar_image DROP FOREIGN KEY FK_948008FD2EF992F5');
        $this->addSql('DROP INDEX IDX_948008FD2EF992F5 ON angar_image');
        $this->addSql('ALTER TABLE angar_image ADD angar_id INT NOT NULL, DROP angar_id_id');
    }
}
