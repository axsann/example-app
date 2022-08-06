<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Collection;
use App\ViewModels\WelcomeViewModel;

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

Route::get('/', function () {
    hoge(10000);
    $foo = fuga(collect([1, 2, 3, 4]));
    print($foo);
    $foo->each(function ($item) {
        print($item);
    });
    hoge(3);
    $vm = new WelcomeViewModel(1, $foo);
    $hoge = $vm->list->map(function ($item) {
        return $item;
    });
    print($hoge);
    return view('welcome')
        ->with('vm', $vm);
});

function hoge(int $x): int
{
    print($x);
    return $x;
}

/**
 * @param Collection<int, int> $list
 * @return Collection<int, string>
 */
function fuga(Collection $list): Collection
{
    return $list->map(function ($item) {
        return strval($item);
    });
}
