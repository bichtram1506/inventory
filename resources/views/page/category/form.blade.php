<div class="container-fluid">
    <form role="form" action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($category))
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
                                    <input type="text" maxlength="100" class="form-control" id="name" name="name" value="{{ old('name', isset($category) ? $category->name : '') }}">
                                    <span class="text-danger "><p class="mg-t-5">{{ $errors->first('name') }}</p></span>
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
