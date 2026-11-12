@extends('layout.layout')

@section('title', 'Lista de Movimientos')

@section('content')

@if (Session::has('error'))
    <div class="alert alert-danger mt-3">
        {{ Session::get('error') }}
    </div>
@endif

<div class="container mt-4">

    <a href="{{ route('movimientos.create') }}" class="btn btn-secondary">
        Agregar <i class="fa-solid fa-plus"></i>
    </a>

    <table class="table table-striped table-hover mt-4">

        <thead class="table-dark">
            <tr>
                <th>Id</th>
                <th>Tipo</th>
                <th>Cantidad</th>
                <th>Caja</th>
                <th>Producto</th>
                <th>Existencia</th>
                <th>Alarma</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($movements as $movement)

                <tr>
                    <td>{{ $movement->id }}</td>

                    <td>
                        <span class="badge
                            {{ $movement->type == 'entrada' ? 'bg-success' :
                            ($movement->type == 'salida' ? 'bg-danger' : 'bg-warning text-dark') }}">

                            {{ ucfirst($movement->type) }}

                        </span>
                    </td>

                    <td>{{ $movement->amount }}</td>

                    <td>{{ $movement->sale_point }}</td>

                    <td>
                        {{ $movement->product?->name ?? 'Sin producto' }}
                    </td>

                    <td>
                        {{ $movement->product?->amount ?? 'Sin existencia' }}
                    </td>

                    <td>
                        @if ($movement->product)
                            @if ($movement->product->amount <= 10)
                                <i class="fa-solid fa-bell text-danger"></i>
                            @else
                                <i class="fa-solid fa-thumbs-up text-success"></i>
                            @endif
                        @else
                            -
                        @endif
                    </td>

                    <td class="text-nowrap">

                        <!-- Botón para abrir la modal -->
                        <button
                            type="button"
                            class="btn btn-primary btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#modalMovimiento{{ $movement->id }}">

                            <i class="fa-solid fa-eye"></i>
                            Ver

                        </button>

                        <!-- Botón para generar PDF -->
                        <a
                            href="{{ route('movimientos.pdf', $movement->id) }}"
                            class="btn btn-danger btn-sm"
                            target="_blank">

                            <i class="fa-solid fa-file-pdf"></i>
                            PDF

                        </a>

                    </td>
                </tr>

            @endforeach

        </tbody>

    </table>

    <div>
        {{ $movements->links() }}
    </div>

</div>


<!-- MODALES DE LOS MOVIMIENTOS -->

@foreach ($movements as $movement)

<div
    class="modal fade"
    id="modalMovimiento{{ $movement->id }}"
    tabindex="-1"
    aria-labelledby="tituloMovimiento{{ $movement->id }}"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <!-- Encabezado -->
            <div class="modal-header bg-primary text-white">

                <h5
                    class="modal-title"
                    id="tituloMovimiento{{ $movement->id }}">

                    <i class="fa-solid fa-circle-info"></i>
                    Detalles del movimiento #{{ $movement->id }}

                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                    aria-label="Cerrar">
                </button>

            </div>

            <!-- Información del movimiento -->
            <div class="modal-body">

                <div class="mb-3">
                    <strong>ID del movimiento:</strong>
                    <p class="text-muted">{{ $movement->id }}</p>
                </div>

                <div class="mb-3">
                    <strong>Tipo de movimiento:</strong>
                    <p class="text-muted">
                        {{ ucfirst($movement->type) }}
                    </p>
                </div>

                <div class="mb-3">
                    <strong>Cantidad del movimiento:</strong>
                    <p class="text-muted">{{ $movement->amount }}</p>
                </div>

                <div class="mb-3">
                    <strong>Caja o punto de venta:</strong>
                    <p class="text-muted">
                        {{ $movement->sale_point ?? 'No especificado' }}
                    </p>
                </div>

                <hr>

                <h6 class="text-primary">
                    Información del producto
                </h6>

                <div class="mb-3">
                    <strong>Nombre:</strong>
                    <p class="text-muted">
                        {{ $movement->product?->name ?? 'Sin producto' }}
                    </p>
                </div>

                <div class="mb-3">
                    <strong>Código:</strong>
                    <p class="text-muted">
                        {{ $movement->product?->code ?? 'No disponible' }}
                    </p>
                </div>

                <div class="mb-3">
                    <strong>Existencia actual:</strong>
                    <p class="text-muted">
                        {{ $movement->product?->amount ?? 'No disponible' }}
                    </p>
                </div>

                <div class="mb-3">
                    <strong>Unidad de medida:</strong>
                    <p class="text-muted">
                        {{ $movement->product?->unit ?? 'No disponible' }}
                    </p>
                </div>

                <div class="mb-3">
                    <strong>Precio del producto:</strong>
                    <p class="text-muted">
                        @if ($movement->product)
                            ${{ number_format($movement->product->price, 2, ',', '.') }}
                        @else
                            No disponible
                        @endif
                    </p>
                </div>

                <hr>

                <div class="mb-3">
                    <strong>Fecha de registro:</strong>
                    <p class="text-muted">
                        {{ $movement->created_at?->format('d/m/Y H:i') ?? 'No disponible' }}
                    </p>
                </div>

            </div>

            <!-- Pie de la modal -->
            <div class="modal-footer">

                <a
                    href="{{ route('movimientos.pdf', $movement->id) }}"
                    class="btn btn-danger"
                    target="_blank">

                    <i class="fa-solid fa-file-pdf"></i>
                    Generar PDF

                </a>

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">

                    Cerrar

                </button>

            </div>

        </div>

    </div>

</div>

@endforeach

@endsection