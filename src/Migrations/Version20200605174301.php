<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200605174301 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE agent (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(60) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artists ADD agent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE artists ADD CONSTRAINT FK_68D3801E3414710B FOREIGN KEY (agent_id) REFERENCES agent (id)');
        $this->addSql('CREATE INDEX IDX_68D3801E3414710B ON artists (agent_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE artists DROP FOREIGN KEY FK_68D3801E3414710B');
        $this->addSql('DROP TABLE agent');
        $this->addSql('DROP INDEX IDX_68D3801E3414710B ON artists');
        $this->addSql('ALTER TABLE artists DROP agent_id');
    }
}
