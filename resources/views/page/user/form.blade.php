<div class="container-fluid">
    <form role="form" action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($user))
            @method('PUT')
        @endif
        <div class="row">
            <div class="col-md-9">
                <div class="card card-primary">
                    <!-- form start -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->first('name') ? 'has-error' : '' }}">
                                    <label for="name" class="control-label">Name <sup class="text-danger">*</sup></label>
                                    <input type="text" maxlength="100" class="form-control" id="name" name="name" value="{{ old('name', isset($user) ? $user->name : '') }}">
                                    <span class="text-danger "><p class="mg-t-5">{{ $errors->first('name') }}</p></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->first('email') ? 'has-error' : '' }}">
                                    <label for="email" class="control-label">Email <sup class="text-danger">*</sup></label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', isset($user) ? $user->email : '') }}">
                                    <span class="text-danger "><p class="mg-t-5">{{ $errors->first('email') }}</p></span>
                                </div>
                            </div>
                        </div>
                        @if(!isset($user))
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->first('password') ? 'has-error' : '' }}">
                                    <label for="password" class="control-label">Password <sup class="text-danger">*</sup></label>
                                    <input type="password" class="form-control" id="password" name="password">
                                    <span class="text-danger "><p class="mg-t-5">{{ $errors->first('password') }}</p></span>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->first('phone') ? 'has-error' : '' }}">
                                    <label for="phone" class="control-label">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', isset($user) ? $user->phone : '') }}">
                                    <span class="text-danger "><p class="mg-t-5">{{ $errors->first('phone') }}</p></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->first('avatar') ? 'has-error' : '' }}">
                                    <label for="avatar" class="control-label">Avatar</label>
                                    <input type="file" class="form-control" id="avatar" name="avatar">
                                    <span class="text-danger "><p class="mg-t-5">{{ $errors->first('avatar') }}</p></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="btn-set">
                            <button type="submit" name="submit" class="btn btn-info">
                                <i class="fa fa-save"></i> Save Data
                            </button>
                            <button type="reset" name="reset" value="reset" class="btn btn-danger">
                                <i class="fa fa-undo"></i> Reset
                            </button>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </form>
</div>
