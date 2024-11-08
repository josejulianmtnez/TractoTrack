<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-success">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Agregar Trailer <small> &nbsp;(*) Campos requeridos</small></h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <form action="{{ route('trucks.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header py-2 bg-secondary">
                                <h3 class="card-title">Datos del Trailer</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="license_plate" class="form-label">Placa(*)</label>
                                            <input type="text" class="form-control" name="license_plate" placeholder="Ingresa número de placa" value="{{ old('license_plate') }}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="brand" class="form-label">Marca(*)</label>
                                            <input type="text" class="form-control" name="brand" placeholder="Ingresa marca" value="{{ old('brand') }}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="model" class="form-label">Modelo(*)</label>
                                            <input type="text" class="form-control" name="model" placeholder="Ingresa modelo" value="{{ old('model') }}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="year" class="form-label">Año(*)</label>
                                            <input type="text" class="form-control" name="year" placeholder="Ingresa año" value="{{ old('year') }}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="color" class="form-label">Color(*)</label>
                                            <input type="text" class="form-control" name="color" placeholder="Ingresa color" value="{{ old('color') }}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="flatbed" class="form-label">Plataforma</label>
                                            <select class="form-control" name="flatbed_id" id="flatbed">
                                                <option value="">Selecciona una Plataforma</option>
                                                @foreach ($flatbeds as $flatbed)
                                                    <option value="{{ $flatbed->id }}" {{ old('flatbed_id') == $flatbed->id ? 'selected' : '' }}>
                                                        {{ $flatbed->license_plate }} - {{ $flatbed->brand }} - {{ $flatbed->model }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" id="save" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .select2-container .select2-selection--single {
        height: 40px;
        display: flex;
        align-items: center;
    }
</style>

<script>
</script>
