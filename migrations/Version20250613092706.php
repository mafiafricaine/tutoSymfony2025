<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250613092706 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ajout de la relation entre User et Recipe';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE recipes ADD user_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE recipes ADD CONSTRAINT FK_A369E2B5A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_A369E2B5A76ED395 ON recipes (user_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE recipes DROP FOREIGN KEY FK_A369E2B5A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_A369E2B5A76ED395 ON recipes
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE recipes DROP user_id
        SQL);
    }
}
