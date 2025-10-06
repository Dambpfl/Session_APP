# Session APP 🎓

Application web de gestion de sessions de formation développée avec Symfony 7.2.

## 📋 Description

Session APP est une application de gestion complète pour organiser et administrer des sessions de formation. Elle permet de gérer les formateurs, les stagiaires, les modules de formation et les sessions avec leurs programmes associés.

## ✨ Fonctionnalités

- **Gestion des Sessions** : Création et administration des sessions de formation avec dates, places disponibles
- **Gestion des Formateurs** : Base de données des formateurs avec leurs spécialités
- **Gestion des Stagiaires** : Inscription et suivi des participants
- **Modules de Formation** : Organisation des contenus pédagogiques par modules
- **Programmes** : Attribution des modules aux sessions
- **Catégories** : Classification des formations par domaines
- **Authentification** : Système de connexion sécurisé avec vérification email
- **Interface responsive** : Design adaptatif pour tous les appareils

## 🛠️ Technologies utilisées

- **Backend** : Symfony 7.2 (PHP 8.2+)
- **Base de données** : MySQL avec Doctrine ORM
- **Frontend** : Twig, Stimulus, Turbo
- **Styling** : CSS personnalisé, Bootstrap
- **Tests** : PHPUnit
- **Email** : Symfony Mailer avec vérification d'email

## 📦 Structure du projet

```
src/
├── Controller/         # Contrôleurs de l'application
├── Entity/            # Entités Doctrine (modèles)
├── Form/              # Formulaires Symfony
├── Repository/        # Repositories Doctrine
└── Security/          # Composants de sécurité

templates/             # Templates Twig
├── base.html.twig
├── home/
├── session/
├── module/
├── registration/
└── security/

assets/               # Assets frontend
├── app.js
├── styles/
└── controllers/      # Contrôleurs Stimulus
```

## 🏗️ Modèle de données

Le projet utilise les entités suivantes :

- **Session** : Sessions de formation avec dates, places, formateur
- **Formation** : Formations disponibles liées aux catégories
- **Formateur** : Informations des formateurs
- **Stagiaire** : Données des participants
- **Module** : Modules pédagogiques avec durée
- **Programme** : Liaison entre sessions et modules
- **Categorie** : Classification des formations
- **Utilisateur** : Gestion des comptes utilisateurs

## 🚀 Installation

### Prérequis

- PHP 8.2 ou supérieur
- Composer
- MySQL/MariaDB
- Node.js (optionnel pour les assets)

### Étapes d'installation

1. **Cloner le projet**
```bash
git clone https://github.com/Dambpfl/Session_APP.git
cd Session_APP
```

2. **Installer les dépendances**
```bash
composer install
```

3. **Configuration de l'environnement**
```bash
# Copier le fichier d'environnement
cp .env .env.local

# Configurer la base de données dans .env.local
DATABASE_URL="mysql://username:password@127.0.0.1:3306/session"
```

4. **Créer la base de données**
```bash
# Créer la base de données
php bin/console doctrine:database:create

# Exécuter les migrations
php bin/console doctrine:migrations:migrate

# (Optionnel) Charger les données de test
mysql -u username -p session < script_session.sql
```

5. **Installer les assets**
```bash
php bin/console importmap:install
```

6. **Démarrer le serveur de développement**
```bash
symfony server:start
# ou
php -S localhost:8000 -t public/
```

## 📚 Utilisation

1. **Accéder à l'application** : `http://localhost:8000`
2. **S'inscrire** : Créer un compte utilisateur
3. **Se connecter** : Utiliser ses identifiants
4. **Gérer les sessions** : Créer et administrer les sessions de formation
5. **Inscrire des stagiaires** : Ajouter des participants aux sessions

## 🧪 Tests

```bash
# Exécuter tous les tests
php bin/phpunit

# Tests avec couverture
php bin/phpunit --coverage-html coverage/
```

## 📁 Base de données

Le fichier `script_session.sql` contient :
- La structure complète de la base de données
- Des données d'exemple pour tester l'application
- Les catégories de formation prédéfinies
