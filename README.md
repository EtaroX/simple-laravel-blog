# Simple Laravel Blog
This project was created for a job interview. It is a simple blog that allows users to create, edit and delete posts.


## Run the project
To build the project, run the following commands:
```bash
composer install
npm install
php artisan key:generate
php artisan migrate
php artisan storage:link
npm run build 
```
And put the files into a web server.

For development purposes, you can use the following command to seed the database:
```bash
php artisan db:seed
```
Also you can use the following command to run the project in a local server:
```bash
npm run dev
php artisan serve
```
