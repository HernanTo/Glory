@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('libs/datatable/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('libs/datatable/datatablesButtons.css') }}">
@endsection

@section('content')
<div class="container-index-user conrtainer-table-d">
    <div class="header-table">
        <div class="bread-cump">
            <a href="{{ route('dashboard') }}">Home</a>
            /
            <a>Usuarios</a>
        </div>
        <h2>Usuarios</h2>
            <div class="con-filter">
                <a class="btn-modal-add" href="{{ route('usuarios.create') }}">
                    <i class="fi fi-br-plus-small"></i>
                    Nuevos usuarios
                </a>
                <p>Filtrar por rol: </p>
                <div class="con-filter-da"></div>
                <div class="divider-fil"></div>
            </div>
    </div>
    <table id="table-users" class="display" style="width:100%">
        <thead>
            <tr>
                <th style="max-width: 200px">NIT / CC</th>
                <th>Nombres</th>
                <th style="max-width: 150px">Rol</th>
                <th>Email</th>
                <th style="max-width: 150px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{$user->cc}}</td>
                    <td>{{$user->full_name}}</td>
                    <td>{{$user->getRoleNames()->first()}}</td>
                    <td> {{$user->emailV}} </td>
                    <td class="con-actions-table">
                        <a href="{{ route('usuarios.usuario', $user->cc) }}" class="actions-table action__table_show"><i class="fi fi-br-eye"></i></a>
                        <a href="{{ route('usuarios.edit', $user->cc) }}" class="actions-table action__table_edit"><i class="fi fi-sr-pencil"></i></a>
                        <a onclick="confirmTrash({{ $user->id }}, '{{ $user->full_name }}', 1)" class="actions-table action__table_delete"><i class="fi fi-sr-trash-xmark"></i></a>
                    </td>

                </tr>
            @endforeach

            @foreach ($customers as $user)
            <tr>
                <td>{{$user->cc}}</td>
                <td>{{$user->full_name}}</td>
                <td>Cliente</td>
                <td>
                    @if ($user->email == '')
                        No tiene
                    @else
                        {{$user->email}}
                    @endif
                </td>
                <td class="con-actions-table">
                    <a href="{{ route('clientes.cliente', $user->cc) }}" class="actions-table action__table_show"><i class="fi fi-br-eye"></i></a>
                    <a href="{{ route('clientes.edit', $user->cc) }}" class="actions-table action__table_edit"><i class="fi fi-sr-pencil"></i></a>
                    <a onclick='confirmTrash({{ $user->id }}, "{{$user->full_name}}", 2)' class="actions-table action__table_delete"><i class="fi fi-sr-trash-xmark"></i></a>
                </td>

            </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Documento</th>
                <th>Nombres</th>
                <th>Rol</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </tfoot>
    </table>
</div>

@include('usuarios.modal')

@endsection
@section('scripts')
    <script src="{{asset('libs/datatable/datatables.min.js')}}"></script>
        <script src="{{ asset('libs/datatable/datatablesButtons.js') }}"></script>
        <script src="{{ asset('libs/datatable/jszip.min.js') }}"></script>
        <script src="{{ asset('libs/datatable/pdfmake.min.js') }}"></script>
        <script src="{{ asset('libs/datatable/vfs_fonts.js') }}"></script>
        <script src="{{ asset('libs/datatable/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('js/user.js') }}"></script>
        <script>
            $(document).ready(function () {
            $('#table-users').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                lengthMenu: [
                    [ 25, 50, 100, -1 ],
                    [ '25', '50', '100', 'Mostrar todo' ]
                ],
                buttons: [
                    'pageLength',
                    {
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [ 0, 1,2,3]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [ 0, 1,2,3]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3 ]
                        }
                    },
                ],
                initComplete: function () {
                    this.api().columns([ 2 ]).every( function () {
                        var column = this;
                        var select = $('<select class="form-select form-select-sm selecttable-lotus"> <option value="">Todos</option> </select>')
                        .appendTo( $('.con-filter-da'))
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column
                                .search( val ? '^'+val+'$' : '', true, false )
                                .draw();
                        } );

                        column.data().unique().sort().each( function ( d, j ) {
                            if(column.search() === '^'+d+'$'){
                                select.append(
                                    '<option value="'+d+'" selected="selected">'
                                    +d+
                                    '</option>'
                                )
                            } else {
                                select.append('<option value="'+d+'">'+d+'</option>')
                            }
                        });
                    });
                },
            });
        });
        </script>
        {{-- Toggle --}}
            @isset($newUser)
            <script>
                // Alerta Usuario
            </script>
            @endisset
        {{-- Toggle --}}
@endsection
