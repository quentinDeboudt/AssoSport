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
![image](https://github.com/user-attachments/assets/8d7d4a3e-17a2-4a7c-b21a-f0d318f890b6)
![image](https://github.com/user-attachments/assets/7c96d2fa-9a61-43a0-a4b4-e043866cfd35)
![image](https://github.com/user-attachments/assets/ad662e51-01a8-4474-9d65-c11b99058e9f)


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






