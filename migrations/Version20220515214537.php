<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220515214537 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annonce (id INT AUTO_INCREMENT NOT NULL, logement_id INT DEFAULT NULL, promotion_id INT DEFAULT NULL, user_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, disponible TINYINT(1) NOT NULL, description VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, date DATE NOT NULL, INDEX IDX_F65593E558ABF955 (logement_id), INDEX IDX_F65593E5139DF194 (promotion_id), INDEX IDX_F65593E5A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, date_arrivee DATE NOT NULL, date_depart DATE NOT NULL, duree_sejour INT NOT NULL, nbr_adulte INT DEFAULT NULL, nb_enfants INT DEFAULT NULL, remarques VARCHAR(255) DEFAULT NULL, prix_total DOUBLE PRECISION NOT NULL, INDEX IDX_E00CEDDEA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE calendar (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, start DATETIME NOT NULL, end DATETIME NOT NULL, description LONGTEXT NOT NULL, all_day TINYINT(1) NOT NULL, bg_color VARCHAR(7) NOT NULL, bdr_color VARCHAR(7) NOT NULL, textcolor VARCHAR(7) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, color VARCHAR(255) DEFAULT NULL, INDEX IDX_64C19C1A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, annonces_id INT NOT NULL, user_id INT DEFAULT NULL, content LONGTEXT NOT NULL, INDEX IDX_5F9E962A4C2885D7 (annonces_id), INDEX IDX_5F9E962AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipement (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, prix_equip DOUBLE PRECISION DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, prix_sejour DOUBLE PRECISION DEFAULT NULL, prix_exp DOUBLE PRECISION DEFAULT NULL, prix_final DOUBLE PRECISION DEFAULT NULL, id_res INT DEFAULT NULL, id_exp INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, programmes_id INT NOT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_C53D045FA0A1C920 (programmes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, annonces_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_E01FBE6A4C2885D7 (annonces_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE logement (id INT AUTO_INCREMENT NOT NULL, hote_id INT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, addresse LONGTEXT NOT NULL, INDEX IDX_F0FD4457453D3D6F (hote_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE logement_equipement (logement_id INT NOT NULL, equipement_id INT NOT NULL, INDEX IDX_85F9697158ABF955 (logement_id), INDEX IDX_85F96971806F0F5C (equipement_id), PRIMARY KEY(logement_id, equipement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE option_guide (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, tel INT NOT NULL, INDEX IDX_F3757A5DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE option_transport (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, matricule VARCHAR(255) NOT NULL, capacite INT NOT NULL, INDEX IDX_B73031AEA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prog (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE programme (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, guide_id INT DEFAULT NULL, transport_id INT DEFAULT NULL, region_id INT DEFAULT NULL, user_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, date DATE NOT NULL, adresse VARCHAR(255) NOT NULL, INDEX IDX_3DDCB9FF12469DE2 (category_id), INDEX IDX_3DDCB9FFD7ED1D4B (guide_id), INDEX IDX_3DDCB9FF9909C13F (transport_id), INDEX IDX_3DDCB9FF98260155 (region_id), INDEX IDX_3DDCB9FFA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promotion (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, taux INT NOT NULL, INDEX IDX_C11D7DD1A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE region (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, color VARCHAR(7) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservations (id INT AUTO_INCREMENT NOT NULL, datearrive DATE DEFAULT NULL, date_depart DATE DEFAULT NULL, dureesejour INT DEFAULT NULL, nbadulte INT DEFAULT NULL, nbenfants INT DEFAULT NULL, remarques VARCHAR(255) DEFAULT NULL, prixtotal DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, tel VARCHAR(255) DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, password VARCHAR(255) DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', banned TINYINT(1) DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, activation_token VARCHAR(50) DEFAULT NULL, reset_token VARCHAR(50) DEFAULT NULL, github_id VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E558ABF955 FOREIGN KEY (logement_id) REFERENCES logement (id)');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5139DF194 FOREIGN KEY (promotion_id) REFERENCES promotion (id)');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A4C2885D7 FOREIGN KEY (annonces_id) REFERENCES annonce (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FA0A1C920 FOREIGN KEY (programmes_id) REFERENCES programme (id)');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A4C2885D7 FOREIGN KEY (annonces_id) REFERENCES annonce (id)');
        $this->addSql('ALTER TABLE logement ADD CONSTRAINT FK_F0FD4457453D3D6F FOREIGN KEY (hote_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE logement_equipement ADD CONSTRAINT FK_85F9697158ABF955 FOREIGN KEY (logement_id) REFERENCES logement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE logement_equipement ADD CONSTRAINT FK_85F96971806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE option_guide ADD CONSTRAINT FK_F3757A5DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE option_transport ADD CONSTRAINT FK_B73031AEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE programme ADD CONSTRAINT FK_3DDCB9FF12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE programme ADD CONSTRAINT FK_3DDCB9FFD7ED1D4B FOREIGN KEY (guide_id) REFERENCES option_guide (id)');
        $this->addSql('ALTER TABLE programme ADD CONSTRAINT FK_3DDCB9FF9909C13F FOREIGN KEY (transport_id) REFERENCES option_transport (id)');
        $this->addSql('ALTER TABLE programme ADD CONSTRAINT FK_3DDCB9FF98260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE programme ADD CONSTRAINT FK_3DDCB9FFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE promotion ADD CONSTRAINT FK_C11D7DD1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A4C2885D7');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6A4C2885D7');
        $this->addSql('ALTER TABLE programme DROP FOREIGN KEY FK_3DDCB9FF12469DE2');
        $this->addSql('ALTER TABLE logement_equipement DROP FOREIGN KEY FK_85F96971806F0F5C');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E558ABF955');
        $this->addSql('ALTER TABLE logement_equipement DROP FOREIGN KEY FK_85F9697158ABF955');
        $this->addSql('ALTER TABLE programme DROP FOREIGN KEY FK_3DDCB9FFD7ED1D4B');
        $this->addSql('ALTER TABLE programme DROP FOREIGN KEY FK_3DDCB9FF9909C13F');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FA0A1C920');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5139DF194');
        $this->addSql('ALTER TABLE programme DROP FOREIGN KEY FK_3DDCB9FF98260155');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5A76ED395');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDEA76ED395');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1A76ED395');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AA76ED395');
        $this->addSql('ALTER TABLE logement DROP FOREIGN KEY FK_F0FD4457453D3D6F');
        $this->addSql('ALTER TABLE option_guide DROP FOREIGN KEY FK_F3757A5DA76ED395');
        $this->addSql('ALTER TABLE option_transport DROP FOREIGN KEY FK_B73031AEA76ED395');
        $this->addSql('ALTER TABLE programme DROP FOREIGN KEY FK_3DDCB9FFA76ED395');
        $this->addSql('ALTER TABLE promotion DROP FOREIGN KEY FK_C11D7DD1A76ED395');
        $this->addSql('DROP TABLE annonce');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE calendar');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE comments');
        $this->addSql('DROP TABLE equipement');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE images');
        $this->addSql('DROP TABLE logement');
        $this->addSql('DROP TABLE logement_equipement');
        $this->addSql('DROP TABLE option_guide');
        $this->addSql('DROP TABLE option_transport');
        $this->addSql('DROP TABLE prog');
        $this->addSql('DROP TABLE programme');
        $this->addSql('DROP TABLE promotion');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE reservations');
        $this->addSql('DROP TABLE user');
    }
}
