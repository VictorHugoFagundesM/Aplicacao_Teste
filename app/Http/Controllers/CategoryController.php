<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Controller de categorias
 *
 * @author Victor Hugo Fagundes <victorfagundes@sysout.com.br>
 * @since 06/07/2021 
 * @version 1.0.0
 */
class CategoryController extends Controller
{   
    /**
     * Apresenta as informaçoes em tela
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request) {
    
        $limit = 5;
    
        //Obtem todas as categorias
        $categories = Category::search($request->search)
        ->orderBy('name', 'asc')
        ->paginate($limit);
    
    return view('categories.index', [ "categories" => $categories ]);

    }
    
    
    /**
     * Apresenta o formulário para criação de categoria
     * @return void
     */
    public function create() {
        return $this->form(new Category());
    }

    /**
     * Armazena as informações da categoria
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request)
    {

        $validator = $this->validation($request);

        if(!$validator->fails()){

            //Grava os dados da categoria
            $this->save($request, new Category());

            return redirect('/categories')->with('success', 'Categoria salva!');

        } else {
            return back()->withErrors($validator)->withInput();
        }


    }

    /**
     * Carrega o formulário para inserção e alteração de categorias
     *
     * @param [type] $category
     * @return void
     */
    private function form($category) {
        return view('categories.create-edit', [ "category" => $category ]);
    }
 
    /**
     * Carrega o formulário para alteração de uma categoria
     *
     * @param [type] $id
     * @return void
     */
    public function edit($id) {

        $category = Category::find($id);

        return $this->form($category);

    }

    /**
     * Atualiza os dados da categoria
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request)
    {
        $validator = $this->validation($request);

        if(!$validator->fails()){
            
            $category = Category::find($request->id);

            //Grava os dados da categoria
            $this->save($request, $category);
    
            return redirect('/categories')->with('success', 'Categoria atualizada!');

        } else {
            //dd($validator->errors());
            return back()->withErrors($validator)->withInput();
        }

    }

    /**
     * Salva os dados da categoria
     *
     * @param [type] $request
     * @param [type] $category
     * @return void
     */
    private function save($request, $category) {

        $category->name = $request->name;
        $category->save();

    }

 
    /**
     * Remove uma categoria
     *
     * @param [type] $id
     * @return void
     */
    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect('/categories')->with('success', 'Categoria removida!');
    }

    /**
     * Valida as informações da categoria
     *
     * @param Request $request
     * @return object
     */
    private function validation(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'bail|required|string|max:30|min:2',
        ], [
            'name.min' => 'O campo nome está muito pequeno',
            'name.max' => 'O campo nome está muito grande',
        ], [
            'name' => 'nome', // Atributo de name para nome na view
        ]);

        return $validator;
    }
}

