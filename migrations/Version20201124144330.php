<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201124144330 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A76ED395');
        $this->addSql('DROP INDEX IDX_F5299398A76ED395 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP user_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649B1E7706E');
        $this->addSql('DROP INDEX UNIQ_8D93D649B1E7706E ON user');
        $this->addSql('ALTER TABLE user ADD preview VARCHAR(510) DEFAULT NULL, DROP restaurant_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_F5299398A76ED395 ON `order` (user_id)');
        $this->addSql('ALTER TABLE user ADD restaurant_id INT DEFAULT NULL, DROP preview');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649B1E7706E ON user (restaurant_id)');
    }
}
