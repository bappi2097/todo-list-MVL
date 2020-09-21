# Todo-List-MVL(MongoDB, Vue, Laravel) 😃

**For MongoDB setup on Laravel Project I will use `jenssegars/mongodb` package and command is:**

### Install On Laravel

`composer require jenssegers/mongodb`

**If its not work try this.**

`composer require jenssegers/mongodb:dev-develop`

### Add service provider to `config\app.php` if not loaded autometically

`Jenssegers\Mongodb\MongodbServiceProvider::class,`
paste it on `providers` array

### Edit `config/database.php` file

    'mongodb' => [
        'driver' => 'mongodb',
        'host' => env('DB_HOST', '127.0.0.1'),
        'port' => env('DB_PORT', 27017),
        'database' => env('DB_DATABASE', 'homestead'),
        'username' => env('DB_USERNAME', 'homestead'),
        'password' => env('DB_PASSWORD', 'secret'),
        'options' => [
            // here you can pass more settings to the Mongo Driver Manager
            // see https://www.php.net/manual/en/mongodb-driver-manager.construct.php under "Uri Options" for a list of complete parameters that you can use

            'database' => env('DB_AUTHENTICATION_DATABASE', 'admin'), // required with Mongo 3+
        ],
    ],

**Now Add db info on `.env` file**

    DB_CONNECTION=mongodb
    DB_HOST=127.0.0.1
    DB_PORT=27017
    DB_DATABASE=homestead
    DB_USERNAME=homestead
    DB_PASSWORD=secret

**If You aant to connect with mongodb cloud host add this code**

    'mongodb' => [
        .......
        'dsn' => env('DB_DSN'),
        .......
    ],

**And add `DB_DSN=host.url` in `.env` file like this:**

    DB_CONNECTION=mongodb
    DB_DSN=mongodb+srv://cluster.dummy.mongodb.net
    DB_HOST=cluster.dummy.mongodb.net
    DB_PORT=27017
    DB_DATABASE=homestead
    DB_USERNAME=homestead
    DB_PASSWORD=secret

**And you have to change normal model to jessenger model**

    use Illuminate\Database\Eloquent\Model => use Jenssegers\Mongodb\Eloquent\Model

<div align="center">
<b>Thats all Thank You ❤️</b>
</div>
