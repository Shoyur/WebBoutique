CREATE DATABASE IF NOT EXISTS bd_boutique DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE bd_boutique;

-- Structure table membres (nom, prenom, courriel, sexe, daten)
-- Structure table connexion (courriel, mdp, role, statut)
-- Role (A-Admin, M-Membre, E-Employé)
-- Status (A-Actif, I-Inactif)

DROP TABLE IF EXISTS membres;
CREATE TABLE membres (
    nom VARCHAR(50) COLLATE utf8_unicode_ci NOT NULL,
    prenom VARCHAR(50) COLLATE utf8_unicode_ci NOT NULL,
    email VARCHAR(50) COLLATE utf8_unicode_ci NOT NULL,
    sexe CHAR(1) COLLATE utf8_unicode_ci NOT NULL,
    daten DATE NOT NULL,
    CONSTRAINT membres_email_pk PRIMARY KEY (email)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS connexion;
CREATE TABLE connexion (
    email VARCHAR(50) COLLATE utf8_unicode_ci NOT NULL,
    mdp VARCHAR(20) COLLATE utf8_unicode_ci NOT NULL,
    role_m CHAR(1) COLLATE utf8_unicode_ci NOT NULL,
    statut_m CHAR(1) COLLATE utf8_unicode_ci NOT NULL,
    CONSTRAINT connexion_email_fk FOREIGN KEY (email) REFERENCES membres (email)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO membres VALUES ("Rouleau", "Félix", "admin@nomDeVotreCompagnie.com", "M", "1990-03-13");
INSERT INTO connexion VALUES ("admin@NomDeVotreCompagnie.com", "password", "A", "A");