-- TABLE : admin
CREATE TABLE admin (
  id_admin SERIAL PRIMARY KEY,
  mail VARCHAR(100) NOT NULL,
  mdp VARCHAR(100) NOT NULL
);

INSERT INTO admin (mail, mdp) VALUES
('demo@banque.com', '$2y$10$JKsLfTfn.lD5Hb6uUHSe9OjRWnKf09fr9XxAWRVRTPifnf12UTzbK');

-- TABLE : clients
CREATE TABLE clients (
  id_client SERIAL PRIMARY KEY,
  nom VARCHAR(100) NOT NULL,
  prenom VARCHAR(100) NOT NULL,
  mail VARCHAR(100) NOT NULL,
  telephone VARCHAR(20) NOT NULL,
  adresse VARCHAR(100)
);

INSERT INTO clients (id_client, nom, prenom, mail, telephone, adresse) VALUES
(1, 'Aubré', 'Martine', 'martine.aubre@yahoo.com', '0605381820', '105 rue de Saint-Denis, 75001 Paris'),
(2, 'Dupont', 'Jean', 'jean.dupont@email.com', '0612345678', '12 rue de Paris, 75001 Paris'),
(3, 'Martin', 'Sophie', 'sophie.martin@email.com', '0623456789', '34 avenue des Champs, 69002 Lyon'),
(4, 'Bernard', 'Pierre', 'pierre.bernard@email.com', '0634567891', '56 boulevard Maritime, 13008 Marseille'),
(5, 'Petit', 'Alice', 'alice.petit@email.com', '0645678901', '78 rue Principale, 31000 Toulouse'),
(11, 'Leroy', 'Thomas', 'thomas.leroy@email.com', '0756789012', '90 chemin Vert, 59000 Lille'),
(17, 'Jean', 'Lola', 'lola.jean@gmail.com', '+33606111213', '11 rue du Ragondin, 66000 Le Ragondin');

-- TABLE : comptes
CREATE TABLE comptes (
  id_compte SERIAL PRIMARY KEY,
  rib VARCHAR(100) NOT NULL,
  type_compte VARCHAR(255),
  solde NUMERIC(15,2) NOT NULL CHECK (solde >= 0),
  client_id INTEGER REFERENCES clients(id_client) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO comptes (id_compte, rib, type_compte, solde, client_id) VALUES
(204, 'FR7610011000201234567890181', 'Courant', 1560.00, 1),
(205, 'FR7610011000201234567890182', 'Courant', 2300.50, 2),
(206, 'FR7610011000201234567890183', 'Courant', 500.75, 3),
(207, 'FR7610011000201234567890184', 'Courant', 4200.00, 4),
(208, 'FR7610011000201234567890185', 'Courant', 1800.30, 5),
(209, 'FR7610012000201234567890181', 'Épargne', 7500.00, 1),
(210, 'FR7610012000201234567890182', 'Épargne', 12000.00, 2),
(211, 'FR7610012000201234567890183', 'Épargne', 3500.50, 3),
(212, 'FR7610011000201234567890202', 'Courant', 200.00, 11);

-- TABLE : contrats
CREATE TABLE contrats (
  id_contrat SERIAL PRIMARY KEY,
  type_contrat VARCHAR(255),
  montant NUMERIC(15,2) NOT NULL,
  duree INTEGER NOT NULL,
  client_id INTEGER REFERENCES clients(id_client) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO contrats (id_contrat, type_contrat, montant, duree, client_id) VALUES
(1005, 'Assurance vie', 150000.00, 12, 1),
(1006, 'Assurance credit immobilier', 250000.00, 20, 2),
(1007, 'Credit consommation', 15000.00, 5, 3),
(1008, 'CEL', 50000.00, 10, 5);
