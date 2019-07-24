<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190724213125 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE compte (id INT AUTO_INCREMENT NOT NULL, super_admin_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, code_banque INT NOT NULL, num_compte VARCHAR(255) NOT NULL, iban VARCHAR(255) NOT NULL, bic VARCHAR(255) NOT NULL, montant DOUBLE PRECISION NOT NULL, INDEX IDX_CFF65260BBF91D3B (super_admin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partenaire (id INT AUTO_INCREMENT NOT NULL, id_compte_id INT DEFAULT NULL, super_admin_id INT DEFAULT NULL, id_profil_id INT NOT NULL, reg_com VARCHAR(255) NOT NULL, ninea DOUBLE PRECISION NOT NULL, localisation VARCHAR(255) NOT NULL, domaine VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_32FFA37372F0DA07 (id_compte_id), INDEX IDX_32FFA373BBF91D3B (super_admin_id), INDEX IDX_32FFA373A76B6C5F (id_profil_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE caissier (id INT AUTO_INCREMENT NOT NULL, id_profil_id INT NOT NULL, id_admin_part_id INT NOT NULL, compte_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, INDEX IDX_1F038BC2A76B6C5F (id_profil_id), INDEX IDX_1F038BC236F71800 (id_admin_part_id), INDEX IDX_1F038BC2F2C56620 (compte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE admin_partenaire (id INT AUTO_INCREMENT NOT NULL, super_admin_id INT DEFAULT NULL, id_profil_id INT NOT NULL, id_part_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, INDEX IDX_FAC105F6BBF91D3B (super_admin_id), INDEX IDX_FAC105F6A76B6C5F (id_profil_id), INDEX IDX_FAC105F6927EE29C (id_part_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profil (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE super_admin (id INT AUTO_INCREMENT NOT NULL, id_profil_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, INDEX IDX_BC8C2783A76B6C5F (id_profil_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF65260BBF91D3B FOREIGN KEY (super_admin_id) REFERENCES super_admin (id)');
        $this->addSql('ALTER TABLE partenaire ADD CONSTRAINT FK_32FFA37372F0DA07 FOREIGN KEY (id_compte_id) REFERENCES compte (id)');
        $this->addSql('ALTER TABLE partenaire ADD CONSTRAINT FK_32FFA373BBF91D3B FOREIGN KEY (super_admin_id) REFERENCES super_admin (id)');
        $this->addSql('ALTER TABLE partenaire ADD CONSTRAINT FK_32FFA373A76B6C5F FOREIGN KEY (id_profil_id) REFERENCES profil (id)');
        $this->addSql('ALTER TABLE caissier ADD CONSTRAINT FK_1F038BC2A76B6C5F FOREIGN KEY (id_profil_id) REFERENCES profil (id)');
        $this->addSql('ALTER TABLE caissier ADD CONSTRAINT FK_1F038BC236F71800 FOREIGN KEY (id_admin_part_id) REFERENCES admin_partenaire (id)');
        $this->addSql('ALTER TABLE caissier ADD CONSTRAINT FK_1F038BC2F2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id)');
        $this->addSql('ALTER TABLE admin_partenaire ADD CONSTRAINT FK_FAC105F6BBF91D3B FOREIGN KEY (super_admin_id) REFERENCES super_admin (id)');
        $this->addSql('ALTER TABLE admin_partenaire ADD CONSTRAINT FK_FAC105F6A76B6C5F FOREIGN KEY (id_profil_id) REFERENCES profil (id)');
        $this->addSql('ALTER TABLE admin_partenaire ADD CONSTRAINT FK_FAC105F6927EE29C FOREIGN KEY (id_part_id) REFERENCES partenaire (id)');
        $this->addSql('ALTER TABLE super_admin ADD CONSTRAINT FK_BC8C2783A76B6C5F FOREIGN KEY (id_profil_id) REFERENCES profil (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE partenaire DROP FOREIGN KEY FK_32FFA37372F0DA07');
        $this->addSql('ALTER TABLE caissier DROP FOREIGN KEY FK_1F038BC2F2C56620');
        $this->addSql('ALTER TABLE admin_partenaire DROP FOREIGN KEY FK_FAC105F6927EE29C');
        $this->addSql('ALTER TABLE caissier DROP FOREIGN KEY FK_1F038BC236F71800');
        $this->addSql('ALTER TABLE partenaire DROP FOREIGN KEY FK_32FFA373A76B6C5F');
        $this->addSql('ALTER TABLE caissier DROP FOREIGN KEY FK_1F038BC2A76B6C5F');
        $this->addSql('ALTER TABLE admin_partenaire DROP FOREIGN KEY FK_FAC105F6A76B6C5F');
        $this->addSql('ALTER TABLE super_admin DROP FOREIGN KEY FK_BC8C2783A76B6C5F');
        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF65260BBF91D3B');
        $this->addSql('ALTER TABLE partenaire DROP FOREIGN KEY FK_32FFA373BBF91D3B');
        $this->addSql('ALTER TABLE admin_partenaire DROP FOREIGN KEY FK_FAC105F6BBF91D3B');
        $this->addSql('DROP TABLE compte');
        $this->addSql('DROP TABLE partenaire');
        $this->addSql('DROP TABLE caissier');
        $this->addSql('DROP TABLE admin_partenaire');
        $this->addSql('DROP TABLE profil');
        $this->addSql('DROP TABLE super_admin');
    }
}
