## Wallet Monitor

### Qual a proposta ?
Um código simples escrito em Laravel para monitorar carteiras bitcoins.

### Requisitos
<p>
PHP      >=   7.2.5
</p>
MySql    =    5.7
NPM      =>   6.13.4
Composer =>   1.10.1

#### Extensões PHP
BCMath PHP Extension
Ctype PHP Extension
Fileinfo PHP extension
JSON PHP Extension
Mbstring PHP Extension
OpenSSL PHP Extension
PDO PHP Extension
Tokenizer PHP Extension
XML PHP Extension


### Instalação
ssh
~~~
git@github.com:giuliomartinelli/wm.git
~~~
ou
https
~~~
https://github.com/giuliomartinelli/wm.git
~~~
Dentro da pasta do projeto na raiz executar os seguintes comandos.
~~~
composer install
~~~
~~~
npm install
~~~
~~~
configure o .env do projeto 
~~~
~~~
php artisan migrate
~~~
~~~
php artisan db:seed
~~~
~~~
php artisan currency:update
~~~
~~~
php artisan wallet:update
~~~
