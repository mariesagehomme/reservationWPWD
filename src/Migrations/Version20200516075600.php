<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200516075600 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE artist_type DROP FOREIGN KEY FK_3060D1B6B7970CF8');
        $this->addSql('ALTER TABLE artist_type DROP FOREIGN KEY FK_3060D1B6C54C8C93');
        $this->addSql('ALTER TABLE artist_type ADD id INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE artist_type ADD CONSTRAINT FK_3060D1B6B7970CF8 FOREIGN KEY (artist_id) REFERENCES artists (id)');
        $this->addSql('ALTER TABLE artist_type ADD CONSTRAINT FK_3060D1B6C54C8C93 FOREIGN KEY (type_id) REFERENCES types (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE artist_type MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE artist_type DROP FOREIGN KEY FK_3060D1B6B7970CF8');
        $this->addSql('ALTER TABLE artist_type DROP FOREIGN KEY FK_3060D1B6C54C8C93');
        $this->addSql('ALTER TABLE artist_type DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE artist_type DROP id');
        $this->addSql('ALTER TABLE artist_type ADD CONSTRAINT FK_3060D1B6B7970CF8 FOREIGN KEY (artist_id) REFERENCES artists (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_type ADD CONSTRAINT FK_3060D1B6C54C8C93 FOREIGN KEY (type_id) REFERENCES types (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_type ADD PRIMARY KEY (artist_id, type_id)');
    }
}
