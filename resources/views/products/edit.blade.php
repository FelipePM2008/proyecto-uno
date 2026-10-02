@extends('layout.layout')
@section('title','Editar Producto')
@section('content')

<div class="container">

    <div class="text-center" mt="5px">
        <h4>Crear Producto</h4>
    </div>

   <form action="{{ route('productos.update', ['producto' => $producto->id]) }}" method="post">
        @csrf
        @method('PUT')
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="code">Codigo</label>
            <input type="text" name="code" id="code" class="form-control" value="{{ old('code', $producto->code) }}">
        </div>
        <div class="col-md-6 mb-3">
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $producto->name) }}">
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="amount">Cantidad</label>
            <input type="number" name="amount" id="amount" class="form-control" value="{{ old('amount', $producto->amount) }}">
        </div>

        <div class="col-md-6 mb-3">
            <label for="unit">Unidad de  Medida</label>
            <select class="form-select" name="unit" id="unit">
                <option value="Und" {{ old('unit', $producto->unit) == 'Und' ? 'selected' : ''  }}>Und</option>
                <option value="Kg" {{ old('unit', $producto->unit) == 'Kg' ? 'selected' : '' }}>Kg</option>
                <option value="Gr" {{ old('unit', $producto->unit) == 'Gr' ? 'selected' : '' }}>Gr</option>
                <option value="Pack" {{ old('unit', $producto->unit) == 'Pack' ? 'selected' : '' }}>Pack</option>
                <option value="Lb" {{ old('unit', $producto->unit) == 'Lb' ? 'selected' : '' }}>Lb</option>
            </select>
        </div>
    </div>

     <div class="row">
        <div class="col-md-6 mb-3">
            <label for="price">Precio</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $producto->price) }}">
        </div>

         <div class="col-md-6 mb-3">
            <label for="provider_id">Proveedor</label>
            <select name="provider_id" id="provider_id" class="form-control">
               <option value=""disabled {{ !$producto->provider_id ? 'selected' : '' }}>Seleccione un proveedor</option>
                @foreach ($providers as $provider)
                 <option value="{{ $provider->id }}" {{ $producto->provider_id == $provider->id ? 'selected' : '' }}>{{ $provider->name }}</option>
                @endforeach
            </select>
        </div>


       <div class="text-center mt4">
            <button class="btn btn-outline-primary">Actualizar</button>
            <a href="{{ route('productos.index') }}"><button type="button" class="btn btn-secondary">Volver</button></a>
       </div>
    </div>

   </form>

</div>

@endsection

