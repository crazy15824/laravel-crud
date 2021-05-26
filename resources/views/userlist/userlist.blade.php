@extends('layouts.app')

@section('satisfy')

    @section('css_before')
        <!-- Page JS Plugins CSS -->
        <link rel="stylesheet" href="{{ asset('/assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    @endsection

    @section('js_after')
        <!-- Page JS Plugins -->
        <script src="{{ asset('/assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('/assets/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

        <!-- Page JS Code -->
        <script src="{{ asset('/assets/js/pages/tables_datatables.js') }}"></script>
    @endsection
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table  id="pTable" class="display table table-bordered table-responsive-lg" style="width:100%">
        <thead>
            <tr>
                <th class="th-sm">Template Name</th>
                <th class="th-sm">Subscription</th>
                <th class="th-sm">Fields</th>
                <th class="th-sm" width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($templates as $template)
        
            <tr>
                <td>{{ $template->name }}</td>
                <td>{{ $template->description }}</td>
                <td>{{ $template->fields }}</td>
                <td>
                    <form action="{{ route('templates.destroy', $template->id) }}" method="POST">

                        <a href="{{ route('templates.show', $template->id) }}" title="show">
                            <i class="fas fa-eye text-success  fa-lg"></i>
                        </a>

                        <a href="{{ route('templates.edit', $template->id) }}">
                            <i class="fas fa-edit  fa-lg"></i>

                        </a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" title="delete" style="border: none; background-color:transparent;">
                            <i class="fas fa-trash fa-lg text-danger"></i>

                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    

    {!! $templates->links() !!}

@endsection