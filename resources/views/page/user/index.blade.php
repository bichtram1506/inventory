@extends('page.layouts.page')

@section('title', 'Cuộc đời là những chuyến du lịch | VietScape Journeys')

@section('style')
    <!-- Định nghĩa các kiểu CSS nếu cần -->
@stop

@section('content')
    <div>
    
        {!! $menuHtml !!}
  @if (session('success'))
    <div id="successAlert" class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

        {{-- Thêm button để tải tệp tin --}}
        <a href="{{ route('download.file') }}" class="btn-download">Tải tệp tin</a>
        
        <a href="{{ route('users.create') }}" class="btn btn-primary">Thêm người dùng</a>
   

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach ($user->roles as $role)
                                    <li><a href="{{ route('roles.show', $role->id) }}">{{ $role->name }}</a></li>
                                @endforeach
                            </td>
                        <td>
                        @if (isset($user->address['address_line_one']) && isset($user->address['address_line_two']))
                        <p>District: {{ $user->address['address_line_one'] }}</p>
                        <p>Province: {{ $user->address['address_line_two'] }}</p>
                    @else
                        <p>No Address Available</p>
                    @endif
                  
                        </td>

                            <td>
                                <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">Delete</button>
                                </form>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn-edit">Edit</a>
                            
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if($users->hasPages())
                <div class="pagination float-right margin-20">
                    {{ $users->appends($query = '')->links() }}
                </div>
            @endif
        </div>
    
    </div>
@stop

@section('script')
    <!-- Place this script at the end of your HTML body -->
    @push('scripts')
    <script>
        setTimeout(function() {
            document.getElementById('successAlert').style.display = 'none';
        }, 5000); // 5 giây
    </script>
    @endpush
@stop
