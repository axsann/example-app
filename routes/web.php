<?php

declare(strict_types=1);

use App\ViewModels\WelcomeViewModel;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

final class WelcomeVM
{
    public function __construct(
        public bool $canLogin,
        public bool $canRegister,
        public string $laravelVersion,
        public string $phpVersion
    ) {
    }
}

Route::get('/', function () {
    $vm = new WelcomeVM(
        canLogin: Route::has('login'),
        canRegister: Route::has('register'),
        laravelVersion: Application::VERSION,
        phpVersion: PHP_VERSION
    );

    return Inertia::render('Welcome', json_decode(json_encode($vm), true));
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';


// ここから下はphpstanを試しに使っている

Route::get('/hoge', function () {
    hoge(10000);
    $foo = fuga(collect([1, 2, 3, 4]));
    print($foo);
    $foo->each(function (string $item) {
        print($item);
    });
    hoge(3);
    $vm = new WelcomeViewModel(1, $foo);
    $hoge = $vm->list->map(function (string $item) {
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
    return $list->map(fn (int $item) => (string) $item);
}

/**
 * @param Collection<int, WelcomeVM> $list
 * @return Collection<int, string>
 */
function fuga2(Collection $list): Collection
{
    return $list->map(fn (WelcomeVM $item) => $item->laravelVersion);
}
