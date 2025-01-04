## Projet 'Les recettes de Mamy Lens' par Axel Rivière

### Récupérer le projet:
```shell
git clone https://gitlab.univ-artois.fr/axel_riviere/projet-fil-rouge-b-24.git

cd projet-fil-rouge-b-24
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


### Tags:
* v1 - [Introduction Laravel](https://gitlab.univ-artois.fr/axel_riviere/projet-fil-rouge-b-24/-/tree/v1-introduction-laravel?ref_type=tags)
* v2 - [Routage CRUD](https://gitlab.univ-artois.fr/axel_riviere/projet-fil-rouge-b-24/-/tree/v2-routage-crud?ref_type=tags)
* v3 - [Authentification](https://gitlab.univ-artois.fr/axel_riviere/projet-fil-rouge-b-24/-/tree/v3-authentification?ref_type=tags)