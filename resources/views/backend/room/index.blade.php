@extends('backend.master')

@section('title', 'Room')
@section('roomList', 'show')
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Rooms Info</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <form action="{{ url('room/search') }}" method="POST"
                      class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="q_search" value="{{$q_search}}"
                               class="form-control bg-light border-primary small"
                               placeholder="Search for...">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-search fa-sm"></i></button>
                        </div>
                    </div>
                </form>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Photo</th>
                            <th>Room Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Room Type</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($get_room) > 0)
                                <?php
                                $page = @$_GET['page'];
                                if (!$page) {
                                    $page = 1;
                                }
                                $i = config('app.row') * ($page - 1) + 1;
                                ?>
                            @foreach($get_room as $room)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td><img src="{{asset($room->room_photo)}}" alt=""
                                             style="width: 50px; height: 50px"></td>
                                    <td>{{ $room->room_name }}</td>
                                    <td>{{ $room->room_desc }}</td>
                                    <td>
                                        {!! $room->room_status == 1 ? '
                                         <button type="button" class="btn btn-success">Available </button>'
                                         :
                                         '<button type="button" class="btn btn-danger">Unavailable </button>' !!}
                                    </td>

                                    <td>{{ $room->room_type_name }}</td>
                                    <td>
                                        <a href="{{url('room/edit/'.$room->room_id)}}" type="button"
                                           class="btn btn-primary"><i
                                                class="far fa-edit"></i>
                                        </a>
                                        <a href="{{url('/room/deactivate/'.$room->room_id)}}" type="button"
                                           onclick="confirm('Do you want to deactivate this room?')"
                                           class="btn btn-danger">
                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6">Data Not Found</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    <div class="pagination">
                        {{ $get_room->appends(['q_search' => request()->input('q_search')])->links('vendor/pagination/custom_pagination') }}
                    </div>

                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection

