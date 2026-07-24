@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-4">Editar Servicio</h2>

            <form method="POST" action="{{ route('servicios.update', $servicio) }}">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre del Servicio</label>
                        <input type="text"
                               id="nombre"
                               name="nombre"
                               class="form-control @error('nombre') is-invalid @enderror"
                               value="{{ old('nombre', $servicio->nombre) }}"
                               maxlength="100"
                               required>
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label for="precio" class="form-label">Precio (S/)</label>
                        <input type="number"
                               id="precio"
                               name="precio"
                               class="form-control @error('precio') is-invalid @enderror"
                               value="{{ old('precio', $servicio->precio) }}"
                               step="0.01"
                               min="0"
                               required>
                        @error('precio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label for="duracion_estimada" class="form-label">Duración (minutos)</label>
                        <input type="number"
                               id="duracion_estimada"
                               name="duracion_estimada"
                               class="form-control @error('duracion_estimada') is-invalid @enderror"
                               value="{{ old('duracion_estimada', $servicio->duracion_estimada) }}"
                               min="1"
                               required>
                        @error('duracion_estimada')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea id="descripcion"
                              name="descripcion"
                              class="form-control @error('descripcion') is-invalid @enderror"
                              rows="3">{{ old('descripcion', $servicio->descripcion) }}</textarea>
                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="estado" class="form-label">Estado</label>
                    <select id="estado"
                            name="estado"
                            class="form-select @error('estado') is-invalid @enderror"
                            required>
                        <option value="">Seleccione...</option>
                        <option value="Pendiente" {{ old('estado', $servicio->estado) == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="En proceso" {{ old('estado', $servicio->estado) == 'En proceso' ? 'selected' : '' }}>En proceso</option>
                        <option value="Completado" {{ old('estado', $servicio->estado) == 'Completado' ? 'selected' : '' }}>Completado</option>
                    </select>
                    @error('estado')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('servicios.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar Servicio</button>
                </div>
            </form>
        </div>
    </div>
@endsection
