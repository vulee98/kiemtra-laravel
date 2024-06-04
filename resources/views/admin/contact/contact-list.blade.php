@extends('admin.master')
@section('content')


<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Comment
                    <small>List</small>
                </h1>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Rep Cmt</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $key => $contact )
                    <tr class="odd gradeX" align="center">
                        <td>{{ $contact->id }}</td>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->message }}</td>
                        <td>
                            @if($contact->is_replied)
                                <div class="alert alert-success">
                                    Đã phản hồi
                                </div>
                            @else
                                <div class="alert alert-danger">
                                    Chưa phản hồi
                                </div>
                            @endif
                        </td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{ route('admin.contact-reply', $contact->id) }}">Rep Cmt</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>

@endsection