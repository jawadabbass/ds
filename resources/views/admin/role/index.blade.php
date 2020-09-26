@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper" style="min-height: 1200.88px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>DataTables</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">DataTables</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">DataTable with minimal features & hover style</h3>
                      </div>
                      <!-- /.card-header -->
                        <div class="card-body">
                                            <form method="post" role="form" id="role-search-form">
                                                <table class="table table-bordered table-hover"  id="roleDatatableAjax">
                                                    <thead>
                                                        <tr>
                                                            <td><input type="text" class="form-control" name="role_title" id="role_title" autocomplete="off" placeholder="Role Title"></td>
                                                            <td>Role Group</td>
                                                            <td></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </form>
                        </div>

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@push('scripts')
    <script>
        $(function() {
            var oTable = $('#roleDatatableAjax').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                searching: false,
                /*
                 "order": [[1, "asc"]],
                 paging: true,
                 info: true,
                 */
                ajax: {
                    url: "{!!  route('admin.fetch.roles') !!}",
                    data: function(d) {
                        d.role_title = $('input[name=role_title]').val();
                    }
                },
                columns: [
                    {
                        data: 'role_title',
                        name: 'role_title'
                    },
                    {
                        data: 'role_group',
                        name: 'role_group'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
            $('#role-search-form').on('submit', function(e) {
                oTable.draw();
                e.preventDefault();
            });
            $('#role_title').on('keyup', function(e) {
                oTable.draw();
                e.preventDefault();
            });
        });

        function deleteRole(id) {
            var msg = 'Are you sure?';
            if (confirm(msg)) {
                $.post("{{ route('admin.delete.role') }}", {
                        id: id,
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}'
                    })
                    .done(function(response) {
                        if (response == 'ok') {
                            var table = $('#roleDatatableAjax').DataTable();
                            table.row('roleDtRow' + id).remove().draw(false);
                        } else {
                            alert('Request Failed!');
                        }
                    });
            }
        }

    </script>
@endpush
