Asso Sport

## Contexte
site web pour
une Association Sportive. Les adhérents peuvent s’inscrire à différents cours de la semaine
(musculation, Dance, Vélo…), et les Coachs peuvent gérer et créer les leçons avec leurs
différents sports respectifs.
Pour la partie administrateur, il peut créer, modifier et supprimer différents coachs, sport et
leçons.

## Spécifications Techniques
Les principales spécifications à respecter :
- [Ex : Gestion des réservations]
- [Ex : Interface intuitive pour les utilisateurs]
- [Ex : Sécurité contre les attaques courantes (XSS, CSRF, SQLi)]

---

## Cas d’Utilisation
![image](https://github.com/user-attachments/assets/013368c1-1d5b-4027-b027-77102464c317)

---

## Maquettage
![image](https://github.com/user-attachments/assets/cba204ba-3f3e-4bf3-9fa1-f018ad038501)
![image](https://github.com/user-attachments/assets/ceb1c2da-c545-4726-b6b8-a9652be6d666)



## Schéma de base de données

![image](https://github.com/user-attachments/assets/2eab8b5f-dd76-43a3-9310-cd2f845ed256)


## Technologies utilisées : Symfony & Twig

Dans le cadre de ce projet, j’ai choisi d’utiliser Symfony, un framework PHP open source reposant sur le paradigme MVC (Modèle–Vue–Contrôleur). Reconnue pour sa robustesse et sa flexibilité, cette solution est l’une des plus répandues au sein de la communauté PHP. Elle est particulièrement adaptée au développement d’applications web complexes, évolutives et performantes.

Pour la gestion de l’affichage côté front-end, le moteur de templates Twig a été utilisé. Il s’agit du moteur de rendu natif de Symfony, conçu pour faciliter la séparation des couches métier et présentation.

Les principaux avantages de Twig sont les suivants :

Performance : le code généré est compilé en PHP optimisé, assurant une exécution rapide.

Sécurité : Twig intègre un système de sandboxing et une gestion automatique de l’échappement des variables, réduisant fortement les risques liés aux failles XSS.

Flexibilité : grâce à un parseur puissant, Twig permet la création de structures de templates modulables et réutilisables, facilitant la maintenance et l’évolutivité de l’interface utilisateur.

### Réalisation de la Base de Données

L’utilisation du framework **Symfony** permet de générer automatiquement le schéma de la base de données via la commande suivante :
```bash
php bin/console doctrine:schema:update --force
```
Cette commande crée et met à jour les différentes tables, en configurant les relations et les clés étrangères conformément aux entités définies dans le code. Cette génération repose sur l’ORM Doctrine, qui assure la gestion des objets métiers et leur correspondance avec la base de données relationnelle.

Par ailleurs, la commande suivante :
```bash
php bin/console doctrine:fixtures:load
```
permet de purger la base de données (suppression intégrale des données présentes dans chaque table) et de charger un jeu de données initial (fixtures), facilitant ainsi les phases de développement et de tests.


## Réalisation des Composants d’Accès aux Données
Le framework Symfony met à disposition l’ensemble des outils nécessaires à l’interaction avec la base de données via Doctrine, son ORM (Object-Relational Mapper) natif.
Doctrine fait office d’intermédiaire entre l’application et la base de données, permettant de manipuler les données à l’aide d’un langage objet tout en générant et exécutant automatiquement les requêtes SQL sous-jacentes.

## Réalisation des Interfaces Homme-Machine (IHM)
Pour le développement des interfaces utilisateur, j’ai utilisé HTML, CSS ainsi que Twig, moteur de templates open source natif de Symfony.
Twig facilite la maintenance et le développement de l’application en assurant une séparation claire entre la logique PHP et la présentation HTML, tout en renforçant la sécurité grâce à son système d’échappement automatique.


### Sécurité

## Protection contre les Injections SQL
L’injection SQL est une attaque visant à insérer des commandes SQL malveillantes dans les entrées utilisateur (ex. formulaires), pouvant entraîner la divulgation, la modification ou la suppression non autorisée de données sensibles.

## Mise en œuvre :
- Validation stricte du type et du format des données reçues via les formulaires.
- Utilisation systématique de requêtes paramétrées avec espaces réservés (placeholders) pour éviter toute interpolation directe des données utilisateur dans les requêtes SQL.

  

## Protection contre les Attaques CSRF (Cross-Site Request Forgery)
Les attaques CSRF exploitent la session d’un utilisateur authentifié pour exécuter des actions non désirées à son insu.

Mise en œuvre :
- Intégration du mécanisme de token CSRF via le filtre CsrfFilter de Spring Security.
- Chaque formulaire inclut un token aléatoire unique, stocké simultanément dans la session utilisateur et transmis avec la requête, ce qui permet une validation sécurisée lors de la soumission.

## Protection contre les Attaques XSS (Cross-Site Scripting)
Les attaques XSS consistent à injecter du code malveillant (JavaScript, HTML) dans les pages web, pouvant notamment voler des cookies, rediriger vers des sites frauduleux ou exécuter des actions malveillantes.

Mise en œuvre :
- Application des règles de sécurité de Spring Security, qui bloque automatiquement les contenus jugés malveillants.
- Usage de la fonction d’échappement automatique de Twig pour neutraliser le contenu potentiellement dangereux.

## Autres Mécanismes de Sécurité
- Contrôle d’authentification : vérification systématique que l’utilisateur est connecté avant l’accès aux pages protégées (outil : Authenticated Fully) — voir Annexe #5.
- Gestion des rôles : contrôle des droits d’accès selon le rôle utilisateur attribué — voir Annexe #6.
- Protection des mots de passe : stockage sécurisé des mots de passe sous forme hachée dans la base de données — voir Annexe #7.
- Politique de mot de passe fort : obligation d’utiliser des mots de passe complexes respectant des critères de robustesse — voir Annexe #8.




