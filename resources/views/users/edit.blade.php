<div class="modal fade" id="edit{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="card-warning">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Editar usuario<small> &nbsp;(*) Campos requeridos</small></h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                </div>
                <form action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data" id="edit-user-form-{{ $user->id }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header py-2 bg-secondary">
                                <h3 class="card-title">Datos del Usuario</h3>
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
                                            <label for="photo-{{ $user->id }}" class="form-label"></label>
                                            <div class="image-preview-container" style="display: flex; justify-content: center; margin-bottom: 10px;">
                                                <img id="photo-preview-edit-{{ $user->id }}" src="{{ $user->getFirstMediaUrl('userGallery') ? $user->getFirstMediaUrl('userGallery') : asset('img/userDefault.png') }}" 
                                                    alt="Foto Actual" style="width: 120px; height: 120px; border-radius: 50%; margin-bottom: 5px;">
                                            </div>
                                            <input type="file" accept="image/*" class="form-control" name="photo" id="photo-{{ $user->id }}" onchange="previewImageEdit(event, {{ $user->id }})">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="nameUpdate" class="form-label">Nombre(*)</label>
                                            <input type="text" class="form-control" name="nameUpdate" id="nameUpdate" value="{{ $user->name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="lastNameUpdate" class="form-label">Apellido(*)</label>
                                            <input type="text" class="form-control" name="lastNameUpdate" id="lastNameUpdate" value="{{ $user->last_name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="phoneUpdate" class="form-label">Teléfono (*)</label>
                                            <input type="tel" pattern="^\d{10}$" class="form-control" name="phoneUpdate" id="phoneUpdate" title="Debe contener exactamente 10 dígitos" value="{{ $user->phone }}" >
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="emailUpdate" class="form-label">Email(*)</label>
                                            <input type="email" class="form-control" name="emailUpdate" id="emailUpdate" value="{{ $user->email }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="roleUpdate" class="form-label">Rol(*)</label>
                                            <select id="roleUpdate-{{ $user->id }}" class="form-control select2" name="roleUpdate" required onchange="toggleTruckChange({{ $user->id }})" required>
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}" {{ $user->roles->contains($role->id) ? 'selected' : '' }} data-change-truck="{{ $role->hasPermissionTo('selectTruck') ? 'true' : 'false' }}">
                                                        {{ $role->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6" id="truckContainer">
                                        <div class="form-group">
                                            <label for="truckUpdate" class="form-label">Trailer(*)</label>
                                            <select id="truckUpdate-{{ $user->id }}" class="form-control select2" name="truckUpdate" required>
                                                <option value="">No aplica</option>
                                                @foreach($trucks as $truck)
                                                    <option value="{{ $truck->id }}" {{ $user->truck_id == $truck->id ? 'selected' : '' }}>
                                                        {{ $truck->license_plate }} / {{ $truck->brand }} / {{ $truck->model }} / {{ $truck->year }}
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel-button-{{ $user->id }}">Cancelar</button>
                        <button type="submit" class="btn btn-warning">Actualizar</button>
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
    function previewImageEdit(event, id) {
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
            var output = document.getElementById('photo-preview-edit-' + id);
            output.src = dataURL;
            output.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }

    function toggleTruckChange(userId) {
        const roleSelect = document.getElementById('roleUpdate-' + userId);
        const truckSelect = document.getElementById('truckUpdate-' + userId);

        if (!roleSelect || !truckSelect) return;

        const selectedOption = roleSelect.options[roleSelect.selectedIndex];
        const canSelectTruck = selectedOption.getAttribute('data-change-truck') === 'true';
        truckSelect.disabled = !canSelectTruck;
        if (!canSelectTruck) {
            truckSelect.value = '';
        }
    }

    function assignTruckChangeEvent() {
        document.querySelectorAll('[id^=roleUpdate-]').forEach((element) => {
            const userId = element.id.split('-')[1];
            toggleTruckChange(userId);
            element.addEventListener('change', () => toggleTruckChange(userId));
        });
    }


    function resetForm(userId) {
        const form = document.getElementById('edit-user-form-' + userId);
        form.reset();
        const photoPreview = document.getElementById('photo-preview-edit-' + userId);
        const defaultPhoto = "{{ asset('img/userDefault.png') }}";
        const currentPhoto = "{{ $user->getFirstMediaUrl('userGallery') ? $user->getFirstMediaUrl('userGallery') : asset('img/userDefault.png') }}";
        photoPreview.src = currentPhoto !== defaultPhoto ? currentPhoto : defaultPhoto;
    }

    document.addEventListener('DOMContentLoaded', () => {
        assignTruckChangeEvent();
        document.querySelectorAll('[id^=cancel-button-]').forEach((button) => {
            const userId = button.id.split('-')[2];
            button.addEventListener('click', () => resetForm(userId));
        });
    });
</script>
