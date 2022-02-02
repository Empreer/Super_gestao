<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\LoginController;   //chama a classe controller
use \App\Http\Controllers\ProdutoController;
use \App\Http\Controllers\ProdutoDetalheController;
use \App\Http\Controllers\ClienteController;
use \App\Http\Controllers\PedidoController;
use \App\Http\Controllers\PedidoProdutoController;

//use \App\Http\Middleware\LogAcessoMiddleware; //Rota do Middleware


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return 'Olá seja bem vindo ao curso';
}); */

// Rotas do Index
// Route::middleware(LogAcessoMiddleware::class)->get('/', [\App\Http\Controllers\PrincipalController::class,'principal'])->name('site.index'); // declaracao da middleware no routes
//         apelido caminho             nome do controller  nome da function dentro do controller
Route::get('/', [\App\Http\Controllers\PrincipalController::class, 'principal'])->name('site.index'); //o name serve para apelidar a rota dentro do codigo para se for preciso mudar o caminho não ter que mudar na app toda

// Rotas de Login   -- O erro ? é o parametro que veio lá do Controller o ? deixa ele como opcional.
Route::get('/login/{erro?}', [LoginController::class, 'index'])->name('site.login');
Route::post('/login', [LoginController::class, 'autenticar'])->name('site.login');

//Middleware
Route::get('/sobrenos', [\App\Http\Controllers\SobreNosController::class, 'sobreNos'])->name('site.sobrenos');

// Metodos da rota /contato
Route::get('/contato', [\App\Http\Controllers\ContatoController::class, 'contato'])->name('site.contato');
Route::post('/contato', [\App\Http\Controllers\ContatoController::class, 'salvar'])->name('site.contato');
// prefixo app - são as rotas que irão ficar dentro da pasta app


// Rotas do Módulo APP
Route::prefix('/app')->group(function () {    //prefix agrupa pela pasta /app
    Route::middleware('autenticacao')->get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('app.home');
    Route::middleware('autenticacao')->get('/sair', [\App\Http\Controllers\LoginController::class, 'sair'])->name('app.sair');
    // Fornecedor
    Route::middleware('autenticacao')->get('/fornecedor', [\App\Http\Controllers\FornecedorController::class, 'index'])->name('app.fornecedor');
    Route::middleware('autenticacao')->post('/fornecedor/listar', [\App\Http\Controllers\FornecedorController::class, 'listar'])->name('app.fornecedor.listar');
    Route::middleware('autenticacao')->get('/fornecedor/listar', [\App\Http\Controllers\FornecedorController::class, 'listar'])->name('app.fornecedor.listar');
    Route::middleware('autenticacao')->get('/fornecedor/adicionar', [\App\Http\Controllers\FornecedorController::class, 'adicionar'])->name('app.fornecedor.adicionar');
    Route::middleware('autenticacao')->post('/fornecedor/adicionar', [\App\Http\Controllers\FornecedorController::class, 'adicionar'])->name('app.fornecedor.adicionar');
    Route::middleware('autenticacao')->get('/fornecedor/editar/{id}/{msg?}', [\App\Http\Controllers\FornecedorController::class, 'editar'])->name('app.fornecedor.editar');
    Route::middleware('autenticacao')->get('/fornecedor/excluir/{id}', [\App\Http\Controllers\FornecedorController::class, 'excluir'])->name('app.fornecedor.excluir');
    // Produto
    Route::middleware('autenticacao')->resource('produto', ProdutoController::class); //Rotas com resource gera todos os metodos automaticamente das rotas para o controller

    // Produto Detalhes
    Route::middleware('autenticacao')->resource('produto-detalhe', ProdutoDetalheController::class);

    //CLiente                                 //apelido     //controller que vai apontar
    Route::middleware('autenticacao')->resource('cliente', CLienteController::class);
    //Pedido
    Route::middleware('autenticacao')->resource('pedido', PedidoController::class);
    //Pedido Produto
   // Route::middleware('autenticacao')->resource('pedido-produto', PedidoProdutoController::class);
    Route::middleware('autenticacao')->get('/pedido-produto/create/{pedido}', [\App\Http\Controllers\PedidoProdutoController::class, 'create'])->name('pedido.produto.create');
    Route::middleware('autenticacao')->post('/pedido-produto/store/{pedido}', [\App\Http\Controllers\PedidoProdutoController::class, 'store'])->name('pedido.produto.store');
    Route::middleware('autenticacao')->delete('/pedido-produto/store/{pedido}/{produto}', [\App\Http\Controllers\PedidoProdutoController::class, 'destroy'])->name('pedido.produto.destroy');
});




// o Fallback ele cria uma mensagem para quando as rotas não forem encontradas.
Route::fallback(function () {
    echo 'A rota acessada não existe. <a href="' . route('site.index') . '">clique aqui</a> para ir para página inicial';
});
