Yii 2 Test Project
============================

Сделать на Yii2 возможность только зарегистрированным
пользователям просматривать, удалять, редактировать записи в таблице
`books`

**NOTE:** В 6 часов не уложился :( 
Вчера около часа потратил на подготовку, сегодня начал примерно в 10:00, закончил в 17:30.
Итого 8.5 часов.

* Наверное много жру и курю :(

REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.


INSTALLATION
------------

### Fork/clone project from GIT

I.e. just clone:

~~~
cd /var/www
git clone https://github.com/IuriiP/test160107.git gittest
~~~


### Install dependencies via Composer

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install this project dependencies using the following command:

~~~
composer update
~~~

CONFIGURATION
-------------

### Apache

Create the virtual host to `/var/www/gittest/web`:

```
	DocumentRoot /var/www/gittest/web
	<Directory /var/www/gittest/web>
		 Options Indexes FollowSymLinks MultiViews
		 AllowOverride All
		 Order allow,deny
		 allow from all
	</Directory>
```

Restart apache2 service:

~~~
sudo service apache2 restart
~~~

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2test',
    'username' => 'yii2test',
    'password' => 'yii2test',
    'charset' => 'utf8',
];
```

**NOTE:** This has to be done manually before you can run application.

### Init database

Run the database migrations:

~~~
php yii migrate
~~~

Generate your startup fixtures:

```
# generate fixtures
php yii fixture/generate authors --count=10

# or generate fixtures in russian language
php yii fixture/generate authors --count=10 --language='ru_RU'
```

Load the fixtures to database:

~~~
php yii fixture/load authors
~~~