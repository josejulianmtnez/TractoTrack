<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-success">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Agregar usuario <small> &nbsp;(*) Campos requeridos</small></h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header py-2 bg-secondary">
                                <h3 class="card-title">Datos del usuario</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-8 offset-lg-2">
                                        <div class="form-group text-center">
                                            <div class="image-preview-container" style="display: flex; justify-content: center; margin-top: 10px;">
                                                <img id="photo-preview" src="#" alt="Vista previa de la foto" style="display: none; width: 120px; height: 120px; border-radius: 50%; margin-bottom: 5px;">
                                            </div>
                                            <input type="file" accept="image/*" class="form-control" name="photo" id="photo" aria-describedby="photoHelp" onchange="previewImage(event)" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="name" class="form-label">Nombre(*)</label>
                                            <input type="text" class="form-control" name="name" placeholder="Ingresa nombre (s)" value="{{ old('name') }}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="last_name" class="form-label">Apellido(*)</label>
                                            <input type="text" class="form-control" name="last_name" placeholder="Ingresa apellido(s)" value="{{ old('last_name') }}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="email" class="form-label">Email(*)</label>
                                            <input type="email" class="form-control" name="email" placeholder="Ingresa email" value="{{ old('email') }}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="phone" class="form-label">Teléfono(*)</label>
                                            <input type="tel" pattern="^\d{10}$" class="form-control" name="phone" placeholder="Ingresa número de teléfono" title="Debe contener exactamente 10 dígitos" value="{{ old('phone') }}"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="password" class="form-label">Contraseña(*)</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa contraseña" required>
                                                <div class="input-group-append"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="role" class="form-label">Rol(*)</label>
                                            <select id="role_id" class="form-control select2" name="roles[]" required onchange="toggleTruckSelect()" required>
                                                <option value="" data-select-truck="false">Selecciona el Rol</option>
                                                @foreach($roles as $role)
                                                <option value="{{ $role->id }}" data-select-truck="{{ $role->hasPermissionTo('selectTruck') ? 'true' : 'false' }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                                    {{$role->name}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6" id="truckContainer">
                                        <div class="form-group">
                                            <label for="truck" class="form-label">Trailer(*)</label>
                                            <select id="truck_id" class="form-control select2" name="truck_id" required>
                                                <option value="">Selecciona un Trailer</option>
                                                @foreach($trucks as $truck)
                                                    <option value="{{ $truck->id }}" {{ old('truck_id') == $truck->id ? 'selected' : '' }}>
                                                        {{ $truck->license_plate }} - {{ $truck->brand }} - {{ $truck->model }} - {{ $truck->year }}
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
    function previewImage(event) {
        var input = event.target;
        var file = input.files[0];
        var reader = new FileReader();

        if (!file.type.startsWith('image/')) {
            Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Por favor, sube un archivo de imagen',
            confirmButtonText: 'Aceptar'
            });
            input.value = '';
            return;
        }

        reader.onload = function() {
            var dataURL = reader.result;
            var output = document.getElementById('photo-preview');
            output.src = dataURL;
            output.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }

    function toggleTruckSelect() {
        const roleSelect = document.getElementById('role_id');
        const truckSelect = document.getElementById('truck_id');
        const selectedOption = roleSelect.options[roleSelect.selectedIndex];
        const canSelectTruck = selectedOption.getAttribute('data-select-truck') === 'true';

        truckSelect.disabled = !canSelectTruck;
        if (!canSelectTruck) {
            truckSelect.value = '';
        }
    }

    document.getElementById('role_id').onchange = toggleTruckSelect;
    document.addEventListener('DOMContentLoaded', toggleTruckSelect);
</script>
