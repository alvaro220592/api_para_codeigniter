criação do projeto

definição no .env do banco de dados que a aplicação irá apontar

criação da model: 
    *definição do nome da tabela em protected $table

criação do controller de parcelas: 
    *php artisan make:controller Api\\ParcelasController

criação da rota resource em api.php

instalar o pacote spatie/laravel-cors: github.com/spatie/laravel-cors#laravel (não foi necessário na versão 8 do laravel); 
    *composer require spatie/laravel-cors; 
    *em kernel.php, no array 'api', adicione \Spatie\Cors\Cors::class; 
    *pra gerar oo arquivo de configuração config/cors.php, rode no terminal: php artisan vendor:publish --provider="Spatie\Cors\CorsServiceProvider" --tag="config"; 

inserir a key no .env:
    *API_KEY='1234'; 

criar o middleware pra verificar a key
    *php artisan make:middleware ApiHeaders
    *inserir dentro do handle:
        + if($request->header('token') != env('API_KEY')){
            + return response()->json('key errada');
        + }
        + return response()->json($next($request)->original);

adicionar no Kernel.php:
    *'apiHeaders' => \App\Http\Middleware\ApiHeaders::class

inserir na rota o middleware
    *->middleware('apiHeaders');
