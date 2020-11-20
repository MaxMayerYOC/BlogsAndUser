<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201120090248 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blog DROP user_id_new_id');
        $this->addSql('ALTER TABLE blog RENAME INDEX fk_c0155143b2ee79c8 TO IDX_C0155143B2EE79C8');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blog ADD user_id_new_id INT NOT NULL');
        $this->addSql('ALTER TABLE blog RENAME INDEX idx_c0155143b2ee79c8 TO FK_C0155143B2EE79C8');
    }
}
