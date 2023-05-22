<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230522135106 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande ADD transporter_name VARCHAR(255) NOT NULL, ADD transporter_price DOUBLE PRECISION NOT NULL, ADD delivery LONGTEXT NOT NULL, ADD is_paid TINYINT(1) NOT NULL, ADD method VARCHAR(255) NOT NULL, ADD reference VARCHAR(255) NOT NULL, ADD stripe_session_id VARCHAR(255) NOT NULL, ADD paypal_order_id VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP transporter_name, DROP transporter_price, DROP delivery, DROP is_paid, DROP method, DROP reference, DROP stripe_session_id, DROP paypal_order_id');
    }
}
