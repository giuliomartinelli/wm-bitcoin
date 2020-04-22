## Wallet Monitor

### Qual a proposta ?
Um código simples escrito em Laravel para monitorar carteiras bitcoins.

### Requisitos
PHP      >=   7.2.5
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
ˋˋˋ
git@github.com:giuliomartinelli/wm.git
ˋˋˋ
ou
https
ˋˋˋ
https://github.com/giuliomartinelli/wm.git
ˋˋˋ
Dentro da pasta do projeto na raiz executar os seguintes comandos.
ˋˋˋ
composer install
ˋˋˋ
ˋˋˋ
npm install
ˋˋˋ
ˋˋˋ
configure o .env do projeto 
ˋˋˋ
ˋˋˋ
php artisan migrate
ˋˋˋ
ˋˋˋ
php artisan db:seed
ˋˋˋ
ˋˋˋ
php artisan currency:update
ˋˋˋ
ˋˋˋ
php artisan wallet:update
ˋˋˋ
