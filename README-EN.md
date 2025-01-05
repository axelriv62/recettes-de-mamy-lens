 <h1 align="center">
  <br>
  <img src="https://github.com/axelriv62/recettes-de-mamy-lens/blob/main/resources/images/icon.png" width="200">
  <br>
  <b>The Recipes of Mamy Lens</b>
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

## Presentation

This project was realized out as part of a project of the third semester of the BUT in Computer Science at the IUT of Lens

<br>

The main objective was learning to use the framework Laravel by designing a recipe management application.

<br>

## Objectifs

In the context of this project, the different objectives were as follows:

+ Discover the structure of a Laravel project.
+ Manage a SQLite database via requests.
+ Use Blade as a view engine.
+ Set up a routing mechanism.
+ Develop a CRUD application.
+ Manage static resources with Vite.
+ Implement authentication and access rights management.
+ Use Eloquent to interact with the database.

<br>

## Get the project

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

## Areas for Improvement

The project is complete in the context of the course, but there are still areas for improvement. Here are some possible improvements:

+ __Style__ : Improve the global style of the application, which was not a priority.

<br>

## Languages, Tools and Software Used

![My Skills](https://go-skill-icons.vercel.app/api/icons?i=laravel,html,css,git,gitlab&theme=dark)
