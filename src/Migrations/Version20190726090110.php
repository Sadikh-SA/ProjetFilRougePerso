<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190726090110 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE compte (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, code_bank INT NOT NULL, num_comp VARCHAR(255) NOT NULL, iban VARCHAR(255) NOT NULL, bic VARCHAR(255) NOT NULL, montant DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE partenaire ADD id_compte_id INT NOT NULL, ADD reg_com VARCHAR(255) NOT NULL, ADD localisation VARCHAR(255) NOT NULL, ADD domaine VARCHAR(255) NOT NULL, DROP rc, DROP denom_social, DROP localite, DROP siege_social, DROP form_juri, DROP activite_prin, DROP annee_creation, CHANGE ninea ninea DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE partenaire ADD CONSTRAINT FK_32FFA37372F0DA07 FOREIGN KEY (id_compte_id) REFERENCES compte (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_32FFA37372F0DA07 ON partenaire (id_compte_id)');
        $this->addSql('ALTER TABLE utilisateur ADD id_parte_id INT DEFAULT NULL, ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL, ADD tel DOUBLE PRECISION NOT NULL, ADD profil VARCHAR(255) NOT NULL, ADD status VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B36B2814EB FOREIGN KEY (id_parte_id) REFERENCES partenaire (id)');
        $this->addSql('CREATE INDEX IDX_1D1C63B36B2814EB ON utilisateur (id_parte_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE partenaire DROP FOREIGN KEY FK_32FFA37372F0DA07');
        $this->addSql('DROP TABLE compte');
        $this->addSql('DROP INDEX UNIQ_32FFA37372F0DA07 ON partenaire');
        $this->addSql('ALTER TABLE partenaire ADD rc VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD denom_social VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD localite VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD siege_social VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD form_juri VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD activite_prin VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD annee_creation DATE NOT NULL, DROP id_compte_id, DROP reg_com, DROP localisation, DROP domaine, CHANGE ninea ninea INT NOT NULL');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B36B2814EB');
        $this->addSql('DROP INDEX IDX_1D1C63B36B2814EB ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP id_parte_id, DROP nom, DROP prenom, DROP email, DROP tel, DROP profil, DROP status');
    }
}
