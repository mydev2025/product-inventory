@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>商品詳細</h1>
        <div>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">一覧に戻る</a>
            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-success">編集</a>
            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">ID</div>
                <div class="col-md-9">{{ $product->id }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">型式</div>
                <div class="col-md-9">{{ $product->category }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">商品名</div>
                <div class="col-md-9">{{ $product->name }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">説明</div>
                <div class="col-md-9">{{ $product->description }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">在庫</div>
                <div class="col-md-9">{{ $product->stock }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">単価</div>
                <div class="col-md-9">¥{{ number_format($product->price) }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">登録日時</div>
                <div class="col-md-9">{{ $product->created_at->format('Y/m/d H:i') }}</div>
            </div>
            <div class="row">
                <div class="col-md-3 fw-bold">更新日時</div>
                <div class="col-md-9">{{ $product->updated_at->format('Y/m/d H:i') }}</div>
            </div>
        </div>
    </div>
@endsection 