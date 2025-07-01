<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * 商品一覧を表示
     */
    public function index()
    {
        $products = Product::orderBy('id', 'asc')->get();
        return view('products.index', compact('products'));
    }

    /**
     * 商品登録フォームを表示
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * 新規商品を保存
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'description' => 'nullable|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|max:100',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')
            ->with('success', '商品が正常に登録されました。');
    }

    /**
     * 商品詳細を表示
     */
    public function show(string $id)
    {
        try {
            $product = Product::findOrFail($id);
            return view('products.show', compact('product'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('products.index')
                ->with('error', '指定された商品が見つかりませんでした。');
        } catch (\Exception $e) {
            return redirect()->route('products.index')
                ->with('error', 'エラーが発生しました。もう一度お試しください。');
        }
    }

    /**
     * 商品編集フォームを表示
     */
    public function edit(string $id)
    {
        try {
            $product = Product::findOrFail($id);
            return view('products.edit', compact('product'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('products.index')
                ->with('error', '指定された商品が見つかりませんでした。');
        } catch (\Exception $e) {
            return redirect()->route('products.index')
                ->with('error', 'エラーが発生しました。もう一度お試しください。');
        }
    }

    /**
     * 商品情報を更新
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'name' => 'required|max:100',
                'description' => 'nullable|max:255',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'category' => 'required|max:100',
            ]);

        $product = Product::findOrFail($id);
        $product->update($request->all());

            return redirect()->route('products.index')
                ->with('success', '商品が正常に更新されました。');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('products.index')
                ->with('error', '指定された商品が見つかりませんでした。');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->route('products.index')
                ->with('error', 'エラーが発生しました。もう一度お試しください。');
        }
    }

    /**
     * 商品を削除
     */
    public function destroy(string $id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();

            return redirect()->route('products.index')
                ->with('success', '商品が正常に削除されました。');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('products.index')
                ->with('error', '指定された商品が見つかりませんでした。');
        } catch (\Exception $e) {
            return redirect()->route('products.index')
                ->with('error', 'エラーが発生しました。もう一度お試しください。');
        }
    }
}
