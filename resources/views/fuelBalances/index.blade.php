@extends('adminlte::page')

@section('title', config('adminlte.title') . ' | Saldo de Diésel')

@section('content')
<section class="content">
    <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Saldo</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="fuel-balances" class="table table-striped display responsive nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>SALDO</th>
                                            <th>ESTADO</th>
                                            <th>OPCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($balances) <= 0)
                                            <tr>
                                                <td colspan="8">No hay resultados</td>
                                            </tr>
                                        @else
                                            @foreach($balances as $balance)
                                                <tr>
                                                    <td> 
                                                        @if ($balance->balance < 0)
                                                            <span style="color: red;">${{ number_format($balance->balance, 2, '.', ',') }}</span>
                                                        @else
                                                            <span style="color: green;">${{ number_format($balance->balance, 2, '.', ',') }}</span>
                                                        @endif
                                                        
                                                    </td>
                                                    <td>
                                                        @switch($balance->status)
                                                            @case('in_favor')
                                                                <span class="badge badge-success">A Favor</span>
                                                                @break
                                                            @case('overdraft')
                                                                <span class="badge badge-danger">Deudor</span>
                                                                @break
                                                            @default
                                                                <span class="badge badge-warning">Sin asignar</span>
                                                                @break
                                                        @endswitch
                                                    </td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Opciones">
                                                            <button type="button" class="btn btn-warning mr-2" data-toggle="modal" title="Editar Datos" data-target="#edit{{ $balance->id }}">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                    @include('fuelBalances.edit')
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
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
