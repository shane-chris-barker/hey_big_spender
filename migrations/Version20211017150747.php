<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211017150747 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE purchases ADD person_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE purchases ADD CONSTRAINT FK_AA6431FE217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
        $this->addSql('CREATE INDEX IDX_AA6431FE217BBB47 ON purchases (person_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE purchases DROP FOREIGN KEY FK_AA6431FE217BBB47');
        $this->addSql('DROP INDEX IDX_AA6431FE217BBB47 ON purchases');
        $this->addSql('ALTER TABLE purchases DROP person_id');
    }
}
