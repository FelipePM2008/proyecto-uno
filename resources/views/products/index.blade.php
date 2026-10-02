@extends('layout.layout')
@section('title', 'Lista de Productos')
@section('content')
    <br>

    <div class="container mt-4">
        <a href="{{ route('productos.create') }}"><button type="button" class="btn btn-secondary">Agregar <i
                    class="icon-save"></i> </button></a>
        <br>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    {{-- <th scope="col">ID</th> --}}
                    <th scope="col">Codigo</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Cantidad</th>
                    {{-- <th scope="col">Unidad Medida</th> --}}
                    {{-- <th scope="col">Precio</th> --}}
                    <th scope="col">Proveedor</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        {{-- <td>{{ $product->id }}</td> --}}
                        <td>{{ $product->code }}</td>
                        <td>{{ $product->name }}</td>
                        <td>
                            {!! $product->amount <= 100
                                ? '<i class="fa-solid fa-bell" style="color: #e10909;"></i> ' . $product->amount
                                : '<i class="fa-solid fa-thumbs-up" style="color: #5af109;"></i> ' . $product->amount !!}
                        </td>
                        {{-- <td>{{ $product->unit }}</td> --}}
                        {{-- <td>{{ $product->price }}</td> --}}
                        {{-- <td>{{ $product->provider->name }}</td> --}}
                        <td>{{ $product->provider?->name ?? 'Sin proveedor' }}</td>
                        <td class="d-flex justify-content-start">
                            <a href="{{ route('productos.edit', ['producto' => $product->id]) }}"><button
                                    class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i></button></a>&nbsp;

                            <form action="{{ route('productos.destroy', $product) }}" method="POST"
                                onsubmit="return confirm('Esta seguro de eliminar el producto {{ $product->name }}')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger"><i class="fa-solid fa-eraser"></i></button>&nbsp;
                            </form>

                            <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle = "modal"
                                data-bs-target = "#infoModal" data-id = "{{ $product->id }}"
                                data-code = "{{ $product->code }}" data-name = "{{ $product->name }}"
                                data-amount = "{{ $product->amount }}" data-unit = "{{ $product->unit }}"
                                data-price = "{{ $product->price }}"
                                data-provider_id = "{{ $product->provider?->name ?? ' Sin Proveedor' }}"
                                title="Ver detalle">
                                <i class="fa-solid fa-eye"></i></button>


                            <a href="{{ route('pdf', $product->id) }}" target="_blank" class="btn btn-light btn-sm border"
                                title="Generar PDF"><i class="fa-duotone fa-solid fa-file-pdf"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-3">
            {{ $products->links() }}
        </div>

        <div class="modal fade" tabindex="-1" id="infoModal" aria-labelledby="infoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="infoModalLabel">Detalle del Producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss = "modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p id="id" class="mb-2"></p>
                        <p id="code" class="mb-2"></p>
                        <p id="name" class="mb-2"></p>
                        <p id="amount" class="mb-2"></p>
                        <p id="unit" class="mb-2"></p>
                        <p id="price" class="mb-2"></p>
                        <p id="provider_id" class="mb-0"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const infoModal = document.getElementById('infoModal');
            if (infoModal) {
                infoModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    if (!button) return;

                    const id = button.getAttribute('data-id') || '';
                    const code = button.getAttribute('data-code') || '';
                    const name = button.getAttribute('data-name') || '';
                    const amount = button.getAttribute('data-amount') || '';
                    const unit = button.getAttribute('data-unit') || '';
                    const price = button.getAttribute('data-price') || '';
                    const provider_id = button.getAttribute('data-provider_id') || '';

                    document.getElementById('id').innerHTML = '<strong>Id </strong>' + id;
                    document.getElementById('code').innerHTML = '<strong>Codigo </strong>' + code;
                    document.getElementById('name').innerHTML = '<strong>Nombre </strong>' + name;
                    document.getElementById('amount').innerHTML = '<strong>Cantidad </strong>' + amount;
                    document.getElementById('unit').innerHTML = '<strong>Unidad </strong>' + unit;
                    document.getElementById('price').innerHTML = '<strong>Precio </strong>' + price;
                    document.getElementById('provider_id').innerHTML = '<strong>Proveedor </strong>' +
                        provider_id;

                    const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('infoModal'));
                    modal.show();
                });
            }
        })
    </script>

@endsection
