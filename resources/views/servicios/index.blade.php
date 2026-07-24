@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Listado de Servicios</h2>
        <a href="{{ route('servicios.create') }}" class="btn btn-primary">Nuevo Servicio</a>
    </div>

    @if ($servicios->isEmpty())
        <div class="alert alert-info">
            No hay servicios registrados. <a href="{{ route('servicios.create') }}" class="alert-link">Registre el primer servicio</a>.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Servicio</th>
                        <th>Precio</th>
                        <th>Estado</th>
                        <th>Registrado por</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($servicios as $servicio)
                        <tr>
                            <td>{{ $servicio->nombre }}</td>
                            <td>S/ {{ number_format($servicio->precio, 2) }}</td>
                            <td>
                                <span class="badge bg-{{ $servicio->estado == 'Completado' ? 'success' : ($servicio->estado == 'En proceso' ? 'warning' : 'secondary') }}">
                                    {{ $servicio->estado }}
                                </span>
                            </td>
                            <td>{{ $servicio->user->name }}</td>
                            <td>
                                <a href="{{ route('servicios.edit', $servicio) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('servicios.destroy', $servicio) }}" method="POST"
                                      style="display:inline"
                                      onsubmit="return confirm('¿Eliminar este servicio?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
