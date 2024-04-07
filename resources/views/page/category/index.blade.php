@extends('page.layouts.page')

@section('title', 'Danh sách danh mục | VietScape Journeys')

@section('style')
 
@stop

@section('content')
<section class="container">
    <h2>Danh sách danh mục</h2>
 <a href="{{ route('categories.create') }}" class="btn btn-primary">Thêm Danh mục</a>
    <div class="table-container">
        @if(count($categories) > 0)
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên danh mục</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td class="btn-group">
                                <form method="POST" action="{{ route('categories.destroy', $category->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Xóa</button>
                                </form>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary">Sửa</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
                  @if($categories->hasPages())
                      <div class="pagination float-right margin-20">
                         {{ $categories->appends($query = '')->links() }}
                     </div>
                 @endif        
        @else
            <div class="alert alert-info">Không có danh mục nào.</div>
        @endif
    </div>
     
</section>
  <!-- Phân trang -->
 <!-- Phân trang -->


@stop
