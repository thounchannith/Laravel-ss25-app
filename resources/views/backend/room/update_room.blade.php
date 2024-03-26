@extends('backend.master')
@section('title','CreateRoom')
@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Update Room</h1>

        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" id="alert" role="alert">
                <strong>Updating Success !</strong> {{session('success')}}
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" id="alert" role="alert">
                <ul>
                    @foreach($errors->all() as $error )
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{url('room/update')}}" method="POST" autocomplete="off" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="room_id" value="{{$room->room_id}}">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Overflow Hidden -->
                    <a href="{{url('/room')}}" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-arrow-left"></i>
                        </span>
                        <span class="text">
                            Back
                        </span>
                    </a>
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Fill room info</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="room_name" class="col-sm-2 col-form-label">RoomName <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="room_name" id="room_name"
                                           value="{{$room->room_name}}"
                                           autofocus>
                                    @error('room_name')
                                    <div class="text-sm text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="room_desc" class="col-sm-2 col-form-label">RoomDesc</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="room_desc" id="room_desc">
                                        {{$room->room_name}}
                                    </textarea>
                                    @error('room_desc')
                                    <div class="text-sm text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="room_status" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select class="form-select form-control" id="room_status" name="room_status">
                                        <option value="1" {{$room->room_status==1?'selected':''}}>Available</option>
                                        <option value="0" {{$room->room_status==0?'selected':''}}>Unavailable</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="room_type_id" class="col-sm-2 col-form-label">RoomType</label>
                                <div class="col-sm-10">
                                    <select class="form-select form-control" id="room_type_id" name="room_type_id">
                                        @foreach($room_type as $rt)
                                            <option
                                                value="{{$rt->room_type_id}}" {{$room->room_type_id == $rt->room_type_id ? 'selected':''}}>{{$rt->room_type_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('room_type_id')
                                    <div class="text-sm text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Rotation Utilities -->
                    <div class="card" style="min-height: 335px;height: auto;">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Attachment</h6>
                        </div>
                        <div class="card-body text-center">
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <div>
                                        <input class="form-control form-control-lg" name="room_photo" id="room_photo"
                                               type="file" accept="image/*">
                                    </div>
                                </div>
                            </div>
                            <img src="{{asset($room->room_photo)}}" alt="" width="300px">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10">
                    <div class="col-sm-2">
                        <button class="btn btn-success btn-icon-split" type="submit">
                            <span class="icon text-white-50">
                              <i class="fas fa-check"></i>
                            </span>
                            <span class="text">update</span>
                        </button>
                    </div>
                </div>
            </div>
        </form> <!-- Closing form tag -->
    </div>
    <!-- /.container-fluid -->
@endsection

@section('myjs')
    <script type="text/javascript">
        $("document").ready(function () {
            setTimeout(() => {
                $('div.alert').remove()
            }, 3000)
        })
    </script>
@endsection










