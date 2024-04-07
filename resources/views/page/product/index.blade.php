@extends('page.layouts.page')

@section('title', 'Cuộc đời là những chuyến du lịch | VietScape Journeys')

@section('style')
    <!-- Định nghĩa các kiểu CSS nếu cần -->
@stop

@section('content')

<div class="container">
 <div >
                <!-- Dùng class alert để hiển thị thông báo -->
                <div class="alert" id="alert-message"></div>
            </div>
    <div class="row">
        <div class="col-md-12">
           
            <div class="card">
                <div class="card-header">
                    <h4>Danh sách sản phẩm</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên sản phẩm</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($products->isEmpty())
                                <p>No products found.</p>
                            @else
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>
                                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary btn-sm">Xem</a>
                                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Chỉnh sửa</a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')">Xóa</button>
                                            </form>
                                            <button class="orderBtn" data-user-id="{{ auth()->user()->id }}" data-product-id="{{ $product->id }}">Đặt hàng</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Place this script at the end of your HTML body -->
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    // JavaScript to handle button click event
    var orderBtns = document.querySelectorAll('.orderBtn');
    orderBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            var productId = this.getAttribute('data-product-id');
            var userId = this.getAttribute('data-user-id');
            createOrder(userId, productId);
        });
    });

    // Function to create order via Axios
    function createOrder(userId, productId) {
        axios.post('/orders', { userId: userId, productId: productId })
            .then(function(response) {
                // Hiển thị thông báo thành công
                var alertMessage = document.getElementById('alert-message');
                alertMessage.innerText = response.data.message;
                alertMessage.classList.add('alert-success');
                alertMessage.style.display = 'block';

                // Ẩn thông báo sau 4 giây
                setTimeout(function() {
                    alertMessage.style.display = 'none';
                }, 4000);
            })
            .catch(function(error) {
                // Xử lý lỗi nếu có
                console.error('Error creating order:', error);
            });
    }
</script>
@endpush

@stop
