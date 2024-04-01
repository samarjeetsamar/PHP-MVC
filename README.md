# PHP-MVC

#### Clone project 

``` git clone https://github.com/samarjeetsamar/PHP-MVC.git ```

#### Run composer install command

``` composer install ```

#### Run composer dump-autoload

``` composer dump-autoload ```

#### Run below command to start the 

``` php -S localhost:8000 public/index.php ```

#### Edit .env file as per your requirment

If you are running developer server using ``` php -S localhost:8000 public/index.php ``` command. Please change the BASE_URL to BASE_URL=http://localhost:8000

If you are not using command ``` php -S localhost:8000 public/index.php ``` then you change BASE_URL as per below.

``` BASE_URL=http://localhost/php/MVC ```

<p> public/index.php: This specifies the entry point file for your PHP application. The web server will use this file to handle incoming requests </p>

#### How to create a new route 

<p> Open `app/route.php` file   </p>
<p> Add a route as below and you can make changes as per your requirements </p>

``` $router->get('/test', 'App\Controllers\TestingController@index')->name('test'); ```
<p> Create a controller class in app\Controllers directory and define a method index() which is used in router (@index) and return to view file using `View::render('test.php');` . Create a view file named test.php in views directory. Now you can see the output in your view file. </p>









