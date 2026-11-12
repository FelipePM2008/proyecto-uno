<!DOCTYPE html>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

```
<title>Reporte del Movimiento #{{ $movement->id }}</title>

<style>
    body {
        background-color: #f9f9f9;
        color: #333;
        font-family: 'DejaVu Sans', sans-serif;
        line-height: 1.6;
        padding: 20px;
    }

    .container {
        background: white;
        border-radius: 8px;
        margin: 0 auto;
        max-width: 1000px;
        padding: 30px;
    }

    .header {
        text-align: center;
        margin-bottom: 30px;
        border-bottom: 2px solid #4CAF50;
        padding-bottom: 20px;
    }

    .header h1 {
        color: #2E7D32;
        font-size: 28px;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .header p {
        color: #666;
        font-size: 14px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 12px;
    }

    table thead tr {
        background-color: #4CAF50;
        color: white;
        text-align: left;
        font-weight: bold;
    }

    table th,
    table td {
        padding: 12px 10px;
        border: 1px solid #ddd;
    }

    table tbody tr {
        border-bottom: 1px solid #ddd;
    }

    table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }

    .highlight {
        background-color: #E8F5E9;
        font-weight: 500;
    }

    .footer {
        text-align: center;
        margin-top: 30px;
        font-size: 11px;
        color: #777;
        border-top: 1px solid #eee;
        padding-top: 15px;
    }

    .info-box {
        background-color: #E3F2FD;
        border-left: 4px solid #2196f3;
        padding: 15px;
        margin: 20px 0;
    }

    .info-box h3 {
        margin-top: 0;
        color: #0D47A1;
        font-size: 16px;
    }

    .badge {
        padding: 5px 8px;
        font-weight: bold;
    }

    .entrada {
        color: #2E7D32;
    }

    .salida {
        color: #C62828;
    }

    .devolucion {
        color: #1565C0;
    }
</style>
```

</head>

<body>

```
<div class="container">

    <!-- ENCABEZADO -->
    <div class="header">
        <h1>Reporte detallado del movimiento</h1>

        <p>
            Generado el: {{ date('d/m/Y H:i') }}
        </p>
    </div>

    <!-- INFORMACIÓN BÁSICA -->
    <div class="info-box">
        <h3>Información básica</h3>

        <p>
            Reporte del movimiento número:
            <strong>#{{ $movement->id }}</strong>
        </p>

        <p>
            Este documento contiene la información del movimiento
            y los datos del producto relacionado.
        </p>
    </div>

    <!-- TABLA DEL MOVIMIENTO -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo de movimiento</th>
                <th>Cantidad</th>
                <th>Caja o punto de venta</th>
                <th>Fecha de registro</th>
            </tr>
        </thead>

        <tbody>
            <tr class="highlight">
                <td>{{ $movement->id }}</td>

                <td>
                    <span class="badge
                        {{ strtolower($movement->type) == 'entrada' ? 'entrada' :
                           (strtolower($movement->type) == 'salida' ? 'salida' : 'devolucion') }}">
                        {{ ucfirst($movement->type) }}
                    </span>
                </td>

                <td>{{ $movement->amount }}</td>

                <td>
                    {{ $movement->sale_point ?? 'No especificado' }}
                </td>

                <td>
                    {{ $movement->created_at
                        ? $movement->created_at->format('d/m/Y H:i')
                        : 'No disponible' }}
                </td>
            </tr>
        </tbody>
    </table>

    <!-- INFORMACIÓN DEL PRODUCTO -->
    <div class="info-box">
        <h3>Información del producto relacionado</h3>

        <p>
            <strong>ID del producto:</strong>
            {{ $movement->product?->id ?? 'No disponible' }}
        </p>

        <p>
            <strong>Código:</strong>
            {{ $movement->product?->code ?? 'No disponible' }}
        </p>

        <p>
            <strong>Nombre:</strong>
            {{ $movement->product?->name ?? 'Sin producto relacionado' }}
        </p>

        <p>
            <strong>Existencia actual:</strong>
            {{ $movement->product?->amount ?? 'No disponible' }}
        </p>

        <p>
            <strong>Unidad de medida:</strong>
            {{ $movement->product?->unit ?? 'No disponible' }}
        </p>

        <p>
            <strong>Precio unitario:</strong>

            @if ($movement->product)
                ${{ number_format((float) $movement->product->price, 2, ',', '.') }}
            @else
                No disponible
            @endif
        </p>

        <p>
            <strong>Categoría:</strong>
            {{ $movement->product?->category ?? 'No especificada' }}
        </p>

        <p>
            <strong>Proveedor:</strong>
            {{ $movement->product?->provider?->name ?? 'Sin proveedor' }}
        </p>

        <p>
            <strong>Última actualización del producto:</strong>

            {{ $movement->product?->updated_at
                ? $movement->product->updated_at->format('d/m/Y')
                : 'No disponible' }}
        </p>
    </div>

    <!-- PIE DE PÁGINA -->
    <div class="footer">
        <p>
            &copy; {{ date('Y') }}
            Sistema de Inventario. Todos los derechos reservados.
        </p>

        <p>Documento generado automáticamente.</p>
    </div>

</div>
```

</body>
</html>
