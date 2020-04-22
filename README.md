## Wallet Monitor

### Qual a proposta ?

<p>
Um código simples escrito em Laravel para monitorar carteiras bitcoins.
</p>

### Requisitos

<p>
PHP      >=   7.2.5
</p>
<p>
MySql    =    5.7
</p>
<p>
NPM      =>   6.13.4
</p>
<p>
Composer =>   1.10.1
</p>

#### Extensões PHP

<p>
BCMath PHP Extension
</p>
<p>
Ctype PHP Extension
</p>
<p>
Fileinfo PHP extension
</p>
<p>
JSON PHP Extension
</p>
<p>
Mbstring PHP Extension
</p>
<p>
OpenSSL PHP Extension
</p>
<p>
PDO PHP Extension
</p>
<p>
Tokenizer PHP Extension
</p>
<p>
XML PHP Extension
</p>

### Instalação

<p>ssh
</p>

~~~
git@github.com:giuliomartinelli/wm.git
~~~

<p>
ou
</p>
<p>
https
</p>

~~~
https://github.com/giuliomartinelli/wm.git
~~~

<p>
Dentro da pasta do projeto na raiz executar os seguintes comandos.
</p>

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
