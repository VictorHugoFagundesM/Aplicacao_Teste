<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Product Controller
 *
 * @author Thiago Alves <thiago@sysout.com.br>
 * @since 30/06/2021 
 * @version 1.0.0
 */
class ProductControllerCopy extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $products = Product::all();

        $data = [
            "products" => $products,
            "title" => "Lista de produtos"
        ];

        return view("products.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /* public function create() {

        $product = new Product();
        $categories = Category::all();

        $data = [
            'product' => $product,
            'category_id' => $product->category_id,
            'title' => 'Crie um novo produto',
            'categories' => $categories
        ];

        return view('products.form', $data);
    } */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $validator = $this->validation($request);

        if ($validator->errors()) {
            return back()->withErrors($validator->errors()->all()[0])->withInput();
        
        } else {

            try {

                $product = new Product();
    
                // Salvar informações
                $this->save($product, $request);

                // Retornar para tela index
                return redirect("/products")->with('success', 'Novo produto criado');

            } catch (\Exception $e) {
                return back()->withErrors($e->getMessage())->withInput();
            }
        }
    }

    /**
     * Realizar validação do formulário
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function validation(Request $request) {

        $rules = [
            'name' => 'required|string|max:50',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'amount' => 'required|integer',
            'description' => 'required|string|max:50|min:30',
            'teste' => 'required'
        ];
        
        $messages = [];

        $customAttributes = [
            'name' => 'nome', // Atributo de name para nome na view
            'category_id' => 'categoria',
            'price' => 'preço',
            'amount' => 'quantidade',
            'description' => 'descrição',
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $customAttributes);

        return $validator;
    }

    /**
     * Persistir informações no banco de dados (criar ou atualizar)
     *
     * @param Product $product
     * @param Request $request
     * @return void
     */
    private function save(Product $product, Request $request) {

        // Atualizar atributos no produto
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->amount = $request->amount;
        $product->description = $request->description;

        // Salvar no banco de dados
        $product->save();
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

        $data = [
            'product' => $product,
            'category_id' => $product->category_id,
            'title' => 'Edite esse produto',
            'categories' => $categories
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

        $request->validate([
            'name'=>'required',
            'category_id' => 'required|exists:categories,id',
            'price'=>'required',
            'amount'=>'required',
            'description'=>'required',
        ]);

        $product = Product::find($id);

        

        

        $product->save();

        return redirect('/products')->with('success', 'Produto Atualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect('/products')->with('success', 'Produto deletado!');

    }
}
