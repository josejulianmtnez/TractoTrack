@extends('adminlte::page')

@section('title', config('adminlte.title') . ' | Plataformas')

@section('content')
<section class="content">
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Plataformas</h2>
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <button class="btn btn-success" data-toggle='modal' data-target="#create">
                                <i class="fa fa-plus"></i> Registrar Plataforma
                            </button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="flatbeds" class="table table-striped display responsive nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>PLACA</th>
                                            <th>MARCA</th>
                                            <th>MODELO</th>
                                            <th>OPCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($flatbeds) <= 0)
                                            <tr>
                                                <td colspan="8">No hay resultados</td>
                                            </tr>
                                        @else
                                            @foreach($flatbeds as $flatbed)
                                                <tr>
                                                    <td scope="row">{{ $flatbed->id }}</td>
                                                    <td>{{ $flatbed->license_plate }}</td>
                                                    <td>{{ $flatbed->brand }}</td>
                                                    <td>{{ $flatbed->model }}</td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Opciones">
                                                            <button type="button" class="btn btn-info mr-2" data-toggle="modal" title="Ver Detalles" data-target="#view{{ $flatbed->id }}">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-warning mr-2" data-toggle="modal" title="Editar Datos" data-target="#edit{{ $flatbed->id }}">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-danger mr-2" data-toggle="modal" title="Eliminar Registro" data-target="#delete{{ $flatbed->id }}">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @include('flatbeds.edit')
                                                @include('flatbeds.delete')
                                                @include('flatbeds.show')
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                @include('flatbeds.create')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#flatbeds').DataTable({
            responsive: true,
            buttons: ['excel', 'pdf', 'print'],
            dom: 'Bfrtip',
        });

        var successMessage = "{{ session('success') }}";
        var errorMessage = "{{ session('error') }}";

        if (successMessage) {
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: successMessage,
                confirmButtonText: 'Aceptar'
            });
        }

        if (errorMessage) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: errorMessage,
                confirmButtonText: 'Aceptar'
            });
        }
    });

    $('#create').on('shown.bs.modal', function() {
        $('.select2').select2({
                dropdownParent: $('#create')
        });
    });

    $('[id^="edit"]').on('shown.bs.modal', function() {
        $(this).find('.select2').select2({
            dropdownParent: $(this)
        });
    });
</script>
@endsection
