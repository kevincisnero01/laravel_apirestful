<?php


use App\User;
use App\Product;
use App\Category;
use App\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        User::truncate();
        Category::truncate();
        Product::truncate();
        Transaction::truncate();
        DB::table('category_product')->truncate();

        $cantidadUsuarios = 20;
        $cantidadCategorias = 10;
        $cantidadProductos = 30;
        $cantidadTransacciones = 100;

        factory(User::class, $cantidadUsuarios)->create();
        factory(Category::class, $cantidadCategorias)->create();

        factory(Product::class, $cantidadProductos)->create()->each(
        	function($producto){
        		$categorias = Category::all()->random(mt_rand(1,5))->pluck('id');

        		$producto->categories()->attach($categorias);
        	}
        );

        factory(Transaction::class, $cantidadTransacciones)->create();
    }
}
