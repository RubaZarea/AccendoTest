<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


### About Online Homework Management system

Online Homework Management system helps teachers manage their homework online and
put marks for homework submitted by students.

It gives the students ability to view list of courses homework uploaded by teachers, download a homework requirements file, and then submit the homework by uploading the homework solution file.
Also it gives teachers ability to  view list of courses homework and  students’ submitted homework those are belong to their courses(every teacher can see only his course submitted homework), create a new homework by uploading an assignment file, delete a homework, download a particular submitted homework and put a mark for it.

### Project architecture

The project is written in `php` on `Laravel` framework version 8.81  based on `MVC` architecture. `Passport` have been used as an authentication system, `MySQL` as database service and `RESTful APIs`    as a source of data to communicate with backend . 

### Project Entity Relationship Diagram

 Please refer to this link https://ibb.co/vqRncPR   for a visual view of the  diagram.


 ### Project Setup 

1) Make sure you have Docker installed on your machine (if you need help you can follow Steps 1 and 2 of How To Install and Use Docker on Ubuntu 20.04. link https://www.digitalocean.com/)

2) Make sure you have Docker Compose installed on your machine (if you need help you can follow Step 1 of How To Install and Use Docker Compose on Ubuntu 20.04. link https://www.digitalocean.com/)

3) After cloning the project change the branch to master `git checkout master`

4) Copy .env.example to new file .env

5) Run `docker-compose build`

6) Run `docker-compose up -d`

7) Run `docker ps` you should see 3 container runing (accendo,mysql:5.7,nginx:

8) Run `docker-compose exec app composer install`

9) Run `docker-compose exec app php artisan key:generate`

10) Run `docker-compose exec app php artisan migrate`

11) Run  `docker-compose exec app php artisan db:seed  --class=UsersSeeder

12) Run  `docker-compose exec app php artisan db:seed --class=TeachersSeeder

13) Run  `docker-compose exec app php artisan db:seed --class=StudentsSeeder

Now when you try to run any API in the postman by using http://localhost:8000/ it should work fine 



