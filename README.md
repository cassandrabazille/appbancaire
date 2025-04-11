# Application Bancaire

## 1. Contexte et Objectif

Une institution bancaire souhaite moderniser la gestion de ses clients, de leurs comptes bancaires et des contrats souscrits (assurances, crédits, épargne, etc.). L’objectif est de développer une application web sécurisée permettant à un administrateur unique de gérer ces données via une interface ergonomique et fluide.

L’application devra permettre :

- Authentification de l’administrateur pour restreindre l’accès aux fonctionnalités.
- L’enregistrement et la gestion des clients.
- La création et la gestion des comptes bancaires.
- La souscription et la gestion des contrats.

Le projet suivra une méthodologie rigoureuse, incluant une phase de modélisation des données (MERISE) avant le développement en PHP avec une architecture MVC.

---

## 2. Spécifications Fonctionnelles

### 2.1. Acteurs du Système

- **Administrateur** : Utilisateur unique de l’application, chargé de la gestion des clients, comptes et contrats.

### 2.2. Fonctionnalités Détailées

#### 2.2.1. Authentification de l’Administrateur

- L’accès à l’application est restreint et nécessite une connexion.
- L’administrateur dispose d’un identifiant unique et d’un mot de passe sécurisé.

Fonctionnalités :

- Page de connexion avec un formulaire (email + mot de passe).
- Vérification des identifiants et redirection vers le tableau de bord en cas de succès.
- Déconnexion sécurisée (suppression de session).

#### 2.2.2. Tableau de bord

Affichage d’une vue synthétique du système :

- Nombre total de clients enregistrés.
- Nombre total de comptes ouverts.
- Nombre total de contrats souscrits.

Possibilité d’accéder aux différentes sections via des liens rapides.

#### 2.2.3. Gestion des Clients

**Créer un Client** :

- Un client est identifié par un Numéro Client généré automatiquement.
- Informations à saisir :
  - Nom (obligatoire)
  - Prénom (obligatoire)
  - Email (obligatoire, format valide)
  - Téléphone (obligatoire, format valide)
  - Adresse (optionnelle)

Après validation, le client est ajouté à la base de données.

**Liste des Clients** :

Tableau affichant tous les clients avec colonnes :

- Numéro client
- Nom
- Prénom
- Email
- Téléphone
- Actions : Modifier / Supprimer / Voir dossier

**Modifier un Client** :

- Possibilité de modifier toutes les informations sauf le Numéro Client.

**Supprimer un Client** :

- Un client peut être supprimé uniquement s'il ne possède aucun compte ou contrat.
- Confirmation obligatoire avant suppression.

#### 2.2.4. Gestion des Comptes Bancaires

**Créer un Compte Bancaire** :

- Un compte est caractérisé par :
  - Identifiant de compte (généré automatiquement)
  - RIB
  - Type de compte (choix obligatoire parmi les suivants) :
    - Compte courant
    - Compte épargne
  - Solde initial (montant en euros, obligatoire, minimum 0€)
  - Numéro Client associé (sélection d’un client existant)

**Liste des Comptes** :

Tableau affichant tous les comptes avec colonnes :

- Identifiant de compte
- RIB
- Type de compte
- Solde
- Nom du client associé
- Actions : Modifier / Supprimer

**Modifier un Compte** :

- Possibilité de modifier :
  - Type de compte
  - Solde

**Supprimer un Compte** :

- Confirmation obligatoire avant suppression.

#### 2.2.5. Gestion des Contrats

**Créer un Contrat** :

- Un contrat est caractérisé par :
  - Identifiant de contrat (généré automatiquement)
  - Type de contrat (choix obligatoire parmi les suivants) :
    - Assurance Vie
    - Assurance Habitation
    - Crédit Immobilier
    - Crédit à la Consommation
    - Compte Épargne Logement (CEL)
  - Montant souscrit (obligatoire, montant en euros)
  - Durée (en nombre de mois, obligatoire)
  - Numéro Client associé (sélection d’un client existant)

**Liste des Contrats** :

Tableau affichant tous les contrats avec colonnes :

- Identifiant du contrat
- Type de contrat
- Montant
- Durée
- Nom du client associé
- Actions : Modifier / Supprimer

**Modifier un Contrat** :

- Possibilité de modifier le montant souscrit et la durée.

**Supprimer un Contrat** :

- Confirmation obligatoire avant suppression.

---

## 3. Spécifications Techniques

### 3.1. Technologies utilisées

- **Back-end** : PHP avec architecture MVC.
- **Base de données** : MySQL.
- **Front-end** : HTML, CSS, JavaScript.

### 3.2. Sécurité

- Hashage du mot de passe de l’administrateur (bcrypt).
- Sessions sécurisées pour l’authentification.
- Requêtes préparées pour éviter les injections SQL.

### 3.3. Organisation du Code

L'application suivra une structure MVC avec :

- **Modèles** : Gestion des entités et interactions avec la base de données via un système de DAO.
- **DAO (Data Access Object)** : Chaque entité (Client, Compte, Contrat) aura une classe DAO dédiée pour exécuter les requêtes SQL avec PDO et des requêtes préparées.
- **Contrôleurs** : Gestion des actions utilisateur et interaction entre les modèles et les vues.
- **Vues** : Pages HTML affichant les données dynamiquement.

---

## 4. Interface Utilisateur

### 4.1. Design et ergonomie

- Page de connexion avec champ email et mot de passe.
- Disposition générale :
  - Un header affichant le nom de l’application.
  - Un menu latéral pour accéder aux différentes sections.
  - Un espace principal où s’affichent les contenus.

### 4.2. Navigation

- **Page de connexion**
- **Tableau de bord**
- **Menu latéral** :
  - Gestion des clients
  - Gestion des comptes
  - Gestion des contrats
  - Déconnexion
