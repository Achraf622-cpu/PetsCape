# 🐾 PetsCape - Plateforme d'Adoption d'Animaux et Soutien aux Refuges

## 📌 Présentation du Projet
PetsCape est une plateforme web dédiée à l'adoption d'animaux de compagnie et au soutien des refuges. Le site permet aux utilisateurs de découvrir des animaux disponibles à l'adoption, de signaler des animaux perdus ou trouvés, et de soutenir la cause animale par des dons.

## ❓ Problématique
De nombreuses personnes souhaitent adopter un animal mais rencontrent des difficultés à trouver des refuges ou des animaux adaptés à leur mode de vie. Les refuges manquent souvent de visibilité, et les propriétaires d'animaux perdus n'ont pas de plateforme centralisée pour signaler leur disparition. Cette plateforme répond à ces besoins en centralisant ces services.

## 🎯 Objectifs du Projet
- Permettre aux utilisateurs de découvrir et d'adopter des animaux en ligne
- Offrir un système de rendez-vous pour rencontrer les animaux avant adoption
- Faciliter le signalement d'animaux perdus et trouvés
- Soutenir les refuges par un système de dons sécurisé
- Fournir une interface d'administration complète pour la gestion du site

## 🛠 Technologies Utilisées
- **Backend :** PHP (Framework Laravel)
- **Base de données :** MySQL
- **Frontend :** JavaScript, HTML (Blade), Tailwind CSS
- **Paiement :** Stripe API (pour les dons)

## 🚀 Fonctionnalités

### 🐶 Adoption d'Animaux
- Catalogue d'animaux disponibles à l'adoption avec fiches détaillées (photos, âge, race, description)
- Système de filtres avancés (espèce, âge, caractéristiques)
- Prise de rendez-vous pour rencontrer les animaux
- Suivi des demandes d'adoption
- Interface d'administration pour la gestion des animaux

### 🔍 Signalement d'Animaux Perdus/Trouvés
- Formulaire de signalement d'animaux perdus ou trouvés
- Système de recherche et filtres par localisation, espèce et caractéristiques
- Système de commentaires pour faciliter la communication
- Gestion du statut des signalements (en cours, résolu, annulé)

### 💰 Système de Dons
- Formulaire de don avec intégration Stripe
- Différents montants proposés
- Suivi des dons effectués
- Reçu automatique par email

### 👤 Gestion des Utilisateurs
- Inscription et authentification des utilisateurs
- Vérification d'email
- Profil utilisateur personnalisable
- Tableau de bord utilisateur pour suivre les rendez-vous et les signalements

### 🔧 Administration
- Tableau de bord administrateur complet
- Gestion des animaux (ajout, modification, suppression)
- Gestion des rendez-vous et des demandes d'adoption
- Suivi des dons
- Gestion des utilisateurs et des signalements

## 🔐 Architecture et Sécurité
- Architecture MVC avec Laravel
- Authentification sécurisée avec Laravel Sanctum
- Validation des données côté serveur
- Protection contre les attaques CSRF et XSS
- Gestion des rôles et des permissions (utilisateur standard, administrateur)

## 🎨 Design et Expérience Utilisateur
- Interface intuitive et responsive
- Design moderne avec Tailwind CSS
- Navigation fluide
- Expérience utilisateur optimisée pour mobile et desktop

## 🔄 Évolutions Futures
- Module de messagerie intégrée entre adoptants et refuges
- Système de notifications en temps réel
- Géolocalisation des animaux perdus/trouvés
- Intégration de cartes interactives
- Ajout d'un blog et de ressources éducatives sur les soins aux animaux

## 📋 Installation et Déploiement
1. Cloner le dépôt
2. Installer les dépendances avec `composer install`
3. Configurer le fichier `.env` avec les paramètres de base de données et Stripe
4. Exécuter les migrations avec `php artisan migrate --seed`
5. Lancer le serveur avec `php artisan serve`

## 🤝 Contribution
Les contributions sont les bienvenues ! N'hésitez pas à soumettre des pull requests ou à signaler des bugs.

## 📜 Licence
Ce projet est sous licence open-source.

---

🐾 **Contact :** Pour toute question, contactez hanzazachraf581@gmail.com
