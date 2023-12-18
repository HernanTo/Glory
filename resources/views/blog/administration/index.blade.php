@extends('layouts.app')
@section('title', 'Publicaciones | Glory Store')

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
            <a>Publicaciones</a>
        </div>
        <h2>Publicaciones</h2>
            <div class="con-filter">
                @can('create.blog.administration')
                    <a class="btn-modal-add" href="{{ route('blog.administration.create') }}">
                        <i class="fi fi-br-plus-small"></i>
                        Nuevo post
                    </a>
                @endcan
                <div class="divider-fil"></div>
            </div>
    </div>
    <table id="table-users" class="display" style="width:100%">
        <thead>
            <tr>
                <th style="max-width: 100px">#</th>
                <th>Titulo</th>
                <th style="max-width: 150px">Fecha</th>
                <th style="max-width: 150px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($blogs as $blog)
                <tr>
                    <td> {{$blog->id}} </td>
                    <td> {{$blog->title}} </td>
                    <td> {{$blog->created_at}} </td>
                    <td class="con-actions-table">
                        @can('see.blog.administration')
                        <a href="{{ route('blog.administration.show', $blog->slug) }}" class="actions-table action__table_show"><i class="fi fi-br-eye"></i></a>
                        @endcan
                        @can('update.blog.administration')
                            <a href="{{ route('blog.administration.edit',$blog->slug) }}" class="actions-table action__table_edit"><i class="fi fi-sr-pencil"></i></a>
                        @endcan
                        @can('destroy.blog.administration')
                            <a onclick="confirmTrash({{ $blog->id }}, '{{ $blog->title }}')" class="actions-table action__table_delete"><i class="fi fi-sr-trash-xmark"></i></a>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>#</th>
                <th>Titulo</th>
                <th>Fecha</th>
                <th>Actions</th>
            </tr>
        </tfoot>
    </table>
</div>

@include('blog.administration.modal')

@endsection
@section('scripts')
    <script src="{{asset('libs/datatable/datatables.min.js')}}"></script>
        <script src="{{ asset('libs/datatable/datatablesButtons.js') }}"></script>
        <script src="{{ asset('libs/datatable/jszip.min.js') }}"></script>
        <script src="{{ asset('libs/datatable/pdfmake.min.js') }}"></script>
        <script src="{{ asset('libs/datatable/vfs_fonts.js') }}"></script>
        <script src="{{ asset('libs/datatable/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('js/products.js') }}"></script>
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
                            columns: [ 0, 1,2]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [ 0, 1,2]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [ 0, 1, 2]
                        }
                    },
                ],
            });
        });
        </script>
@endsection
