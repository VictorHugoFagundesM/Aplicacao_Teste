<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Void_;

class ProductController extends Controller
{
    
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('products.product', [
            'product' => Product::findOrFail($id)]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = 5;

        $query = Product::search($request);
        $products = $query->paginate($limit);
        
        $title = "Lista de produtos";
        $data = [
            "products" => $products,
            "title" => $title,
        ];

        return view("products.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        $product = new Product();
        $categories = Category::all();
        $size = Size::all();
        $color = Color::all();

        $data = [
            'product' => $product,
            'category_id' => $product->category_id,
            'size_id' => $product->size_id,
            'color_id' => $product->color_id,
            'title' => 'Crie um novo produto',
            'categories' => $categories,
            'size' => $size,
            'color' => $color,
        ];


        return view('products.create-edit', $data);
    }

    /**
     * Armazena as informações da categoria
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Insert(Request $request)
    {
        $validator = $this->validation($request);

        if (!$validator->fails()) {

            //dd($request->all());

            $product = new Product([
                'name' => $request->get('name'),
                'category_id' => $request->get('category_id'),
                'size_id' => $request->get('size_id'),
                'color_id' => $request->get('color_id'),
                'price' => number_format($request->get('price'), 2, '', ','),
                'amount' => $request->get('amount'),
                'description' => $request->get('description'),
                

            ]);

            // Salvar no banco de dados
            $product->save();

            return redirect("/products")->with('success', 'Novo produto criado');

        } else {
            
            //return back()->withErrors($validator);
            return back()->withErrors($validator, 'form');
        }
        
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $size = Size::all();
        $color = Color::all();

        $data = [
            'product' => $product,
            'category_id' => $product->category_id,
            'size_id' => $product->size_id,
            'color_id' => $product->color_id,
            'title' => 'Edite esse produto',
            'categories' => $categories,
            'size' => $size,
            'color' => $color,
        ];

        return view('products.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = $this->validation($request);

        if(!$validator->fails()){

            $product = Product::find($id);
    
            $product->name = $request->get('name');
            $product->category_id = $request->get('category_id');
            $product->size_id = $request->get('size_id');
            $product->color_id = $request->get('color_id');
            $product->price = $request->get('price');
            $product->amount = $request->get('amount');
            $product->description = $request->get('description');

            $product->save();
    
            return redirect('/products')->with('success', 'Produto Atualizado!');
        } else {
            // return back()->withErrors($validator);
            return back()->withErrors($validator, 'form');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect('/products')->with('success', 'Produto deletado!');

    }

     /**
     * Realizar validação do formulário
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function validation(Request $request){

        $data = $request->all();

        //verificar a validacao no front
        $rules = [
            'name' => 'bail|required|string|max:20|min:6',
            'category_id' => 'bail|required|numeric|integer', 
            'size_id' => 'bail|required|numeric|integer',
            'color_id' => 'bail|required|numeric|integer',
            'price' => 'bail|required|numeric',
            'amount' => 'bail|required|numeric|integer',
            'description' => 'bail|required|string|max:35|min:10'
        ];

        $messages = [
            // 'name.min' => 'O campo nome está muito pequeno',
            'name.max' => 'O campo nome está muito grande',
            'price.numeric' => 'O campo preço deve ser um número e usar ponto ao invés de vírgula. Exemplo: 3.0',
            'description.max' => "O campo descrição está muito grande",
            'description.min' => 'O campo descrição está muito pequeno',
        ];

        $customAttributes = [
            'name' => 'nome', // Atributo de name para nome na view
            'category_id' => 'categoria',
            'size_id' => 'tamanho',
            'color_id' => 'color',
            'price' => 'preço',
            'amount' => 'quantidade',
            'description' => 'Descrição',
        ];

        $validator = Validator::make($data, $rules, $messages, $customAttributes);

        return $validator;
    }
}
