 <h1 align="center">
  <br>
  <img src="https://github.com/axelriv62/recettes-de-mamy-lens/blob/main/resources/images/icon.png" width="200">
  <br>
  <b>Les Recettes de Mamy Lens</b>
  <br>
  <a href="https://github.com/axelriv62/recettes-de-mamy-lens/blob/main/README.md">
    <img src="https://img.shields.io/badge/README-FR-blue">
  </a>
  <a href="https://github.com/axelriv62/recettes-de-mamy-lens/blob/main/README-EN.md">
    <img src="https://img.shields.io/badge/README-EN-blue">
  </a>
</h1>

<br>

<p align="center">
  <img src="https://github.com/axelriv62/recettes-de-mamy-lens/blob/main/resources/images/screenshot.png" alt="screenshot" width="800">
</p>

<br>

## Présentation

Ce projet a été réalisé dans le cadre d'un projet de travaux dirigés (TD) de troisème semestre de BUT Informatique à l'IUT de Lens.

<br>

L'objectif général était d'apprendre à utiliser le framework Laravel en concevant une application de gestion de recettes de cuisine.

<br>

## Objectifs

Dans le cadre de ce projet, les différents objectifs étaient les suivants :

+ Découvrir la structure d’un projet Laravel.
+ Gérer une base de données SQLite via des requêtes.
+ Utiliser Blade comme moteur de vue.
+ Mettre en place un mécanisme de routage.
+ Développer une application CRUD.
+ Gérer les ressources statiques avec Vite.
+ Implémenter l’authentification et la gestion des droits d’accès.
+ Exploiter Eloquent pour interagir avec la base de données.

<br>

## Récupérer le projet

```shell
git clone https://github.com/axelriv62/recettes-de-mamy-lens.git

cd recettes-de-mamy-lens
composer install
npm install
cp .env.example .env

php artisan key:generate
php artisan storage:link
php artisan migrate
php artisan db:seed
cp -r resources/images storage/app/public/images
npm run build

php artisan serve
```

<br>

## Pistes d’Amélioration

Bien que le projet soit abouti dans le cadre du TD, il reste perfectible. Voici quelques pistes d'amélioration :

+ __Style__ : Améliorer le style global de l'application, qui n'était pas une priorité.

<br>

## Langages, Outils et Logiciels Utilisés

![My Skills](https://go-skill-icons.vercel.app/api/icons?i=laravel,html,css,git,gitlab&theme=dark)
