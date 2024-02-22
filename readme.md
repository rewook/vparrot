# Installation en local du site Vincent Parrot sous Symfony 6.4

Ce guide décrit les étapes nécessaires pour installer et configurer l'application de Vincent Parrot sous Symfony 6.4 depuis un dépôt GitHub. L'application inclut une base de données et des migrations à réaliser.

## Prérequis

Avant de commencer, assurez-vous d'avoir installé les éléments suivants sur votre système :

- PHP >= 8.2
- Composer
- MySQL (ou un autre système de gestion de base de données supporté par Symfony)
- Git

## Étapes d'Installation

1. **Cloner le dépôt GitHub :**

    ```bash
    git clone https://github.com/rewook/vparrot.git
    ```

2. **Installation des dépendances :**

   Accédez au répertoire de l'application (vparrot par défaut) et installez les dépendances en utilisant Composer :

    ```bash
    cd vparrot
    composer install
    ```

3. **Configurer la base de données :**

   Copiez le fichier `.env` en `.env.local` et configurez les paramètres de connexion à votre base de données dans ce fichier :

    ```
    DATABASE_URL=mysql://votre_utilisateur:votre_mot_de_passe@127.0.0.1:3306/nom_de_la_base
    ```

4. **Créer la base de données :**

   Utilisez la commande Symfony pour créer la base de données :

    ```bash
    php bin/console doctrine:database:create
    ```

5. **Appliquer les migrations :**

   Exécutez les migrations pour mettre à jour la structure de la base de données :

    ```bash
    php bin/console doctrine:migrations:migrate
    ```

6. **Charger les données initiales :**

   Le site nécessite des données initiales, chargez les avec la commande suivante :

    ```bash
    php bin/console doctrine:fixtures:load
    ```

7. **Lancer le serveur de développement :**

   Pour tester l'application localement, lancez le serveur de développement Symfony :

    ```bash
    php bin/console server:run
    ```
   ou 
    ```bash
    php bin/console serve -d
    ```

8. **Accès à l'application :**

   Ouvrez votre navigateur web et accédez à l'URL suivante : [http://localhost:8000](http://localhost:8000)
    
    Un utilisateur administrateur est créé avec le jeu de fixtures.
    
    Son login est : admin@test.com
    son mot de passe : 12$Stl54
    
## Documentation supplémentaire

Pour plus d'informations sur le développement avec Symfony, consultez la [documentation officielle](https://symfony.com/doc/current/index.html).

