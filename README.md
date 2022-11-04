## 🚧 ColdNotes Em construção...  🚧

Plataforma desenvolvida com [Laravel 8](https://laravel.com/docs/8.x). Para instalação, certifique-se de atender os seguintes requisitos:

- Mínimo PHP 7.3.0 e um pacote de servidores como [XAMPP](https://www.apachefriends.org/pt_br/index.html), por exemplo.
- [Composer instalado globalmente](https://medium.com/@marcos.paegle/php-moderno-instalando-o-composer-windows-d45c29ba1fe1).


## Instalação

1. Clonar o repositório:

```sh
git clone https://github.com/felipeceltic/coldnotes.git
cd coldnotes
```

2. Instalar as dependências PHP:

```sh
composer install
```

3. Renomear o arquivo .env.example para .env:

```sh
rename .env.example .env
```

4. Gerar chave da aplicação:

```sh
php artisan key:generate
```

5. Abra o arquivo .env e substitua as informações do banco de dados.

6. Realize as migrations no banco de dados

```sh
php artisan migrate
```

7. Criar link simbólico dos arquivos

```sh
php artisan storage:link
```

Pronto! O sistema está pronto para rodar

## Rodando o sistema

O comando abaixo criará um servidor interno do laravel para rodar o sistema na porta 8000, então ficará acessível pela URL localhost:8000

```sh
php artisan serve
```

## Desenvolvedores

- [Luiz Felipe](https://github.com/felipeceltic)
