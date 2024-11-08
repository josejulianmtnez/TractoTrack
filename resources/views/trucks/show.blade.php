<div class="modal fade" id="view{{ $truck->id }}" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel{{ $truck->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-info">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Información del Trailer</h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label>ID</label>
                                        <input type="text" disabled class="form-control" value="{{ $truck->id }}" />
                                    </div>
                                </div>
                                <div class="col-lg-10">
                                    <div class="form-group">
                                        <label>Placa</label>
                                        <input type="text" disabled class="form-control" value="{{ $truck->license_plate }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Plataforma</label>
                                        <input type="text" disabled class="form-control" value="{{ $truck->flatbed->license_plate }} {{ $truck->flatbed->brand }} {{ $truck->flatbed->model }} " />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Marca</label>
                                        <input type="text" disabled class="form-control" value="{{ $truck->brand }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Modelo</label>
                                        <input type="text" disabled class="form-control" value="{{ $truck->model }}" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Año</label>
                                        <input type="text" disabled class="form-control" value="{{ $truck->year }}" />
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Color</label>
                                        <input type="text" disabled class="form-control" value="{{ $truck->color }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
