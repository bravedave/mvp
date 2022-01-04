# MVP - Minimum Viable Product

> _For PHP using composer initiated AutoLoad (PSR-4)_

In deployment PHP is easily maintained using Composer. Composer handles distribution and updating.

This simple agnostic example is extended using a _Markdown Parser_.

## What can I do with this ?

> _Easily extend the environment - and to publish the extension for use in this and any PSR-4 enviroment - See example at <https://github.com/bravedave/pages>_

1.Setup a new project

```bash
composer create-project bravedave/mvp <my-project> @dev
```

2.Install dependencies &amp; run

```bash
cd <my-project>
composer update

# to run locally ..
./run.sh
```

> ... the result is visible at <http://localhost/>

### Extend with _Slim_

* Install Extension &amp; run

```bash
composer require slim/slim slim/psr7 slim/php-view twbs/bootstrap twbs/bootstrap-icons

# if you are installing on CentOS running under apache or similar, it will need a data folder
mkdir src/data
chmod 777 src/data

# to run locally ..
./run.sh
```

* Remove Extension &amp; run

```bash
composer rem slim/slim slim/psr7 slim/php-view twbs/bootstrap twbs/bootstrap-icons
```

### Extend with _erusev/parsedown_

* Install Extension &amp; run

```bash
composer require erusev/parsedown

# to run locally ..
./run.sh
```

* remove Extension

```bash
composer remove erusev/parsedown
```

### more

> Look at _src/app/launcher.php_ ...
