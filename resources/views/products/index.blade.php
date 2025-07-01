@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>商品一覧</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">新規商品登録</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>型式</th>
                    <th>商品名</th>
                    <th>説明</th>
                    <th>在庫</th>
                    <th class="text-end">単価</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->category }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->stock }}</td>
                        <td class="text-end">¥{{ number_format($product->price) }}</td>
                        <td class="text-center">
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-info">詳細</a>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-success">編集</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">商品が登録されていません。</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection 