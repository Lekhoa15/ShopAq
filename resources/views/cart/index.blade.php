<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="../../images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">

    <title>
        Giftos
    </title>

    <!-- slider stylesheet -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css" />

    <!-- Custom styles for this template -->
    <link href="../../css/style.css" rel="stylesheet">
    <!-- responsive style -->
    <link href="../../css/responsive.css" rel="stylesheet" />
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        <div class="hero_area">
            <header class="header_section">
                <nav class="navbar navbar-expand-lg custom_nav-container ">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <span>
                            Giftos
                        </span>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class=""></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav  ">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">Home
                                </a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('shop') }}">
                                    Shop <span class="sr-only">(current)</span>

                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('why') }}">
                                    Why Us
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('testimonial') }}">
                                    Testimonial
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('contact') }}">
                                    Contact Us

                                </a>
                            </li>
                        </ul>
                        <div class="user_option">
                            @if (auth()->check())
                                <!-- Avatar hiển thị khi người dùng đã đăng nhập -->
                                <div class="user-avatar" style="position: relative;">
                                    <img src="{{ asset('images/avatar.jpg') }}" alt="Avatar" class="avatar-icon"
                                        id="avatarIcon" style="border-radius: 50%; width: 30px; height: 30px;">
                                    <div class="user-dropdown"
                                        style="display: none; position: absolute; top: 40px; right: 0; background: white; border: 1px solid #ddd; padding: 10px; border-radius: 5px;">
                                        <p>{{ auth()->user()->name }}</p>
                                        <p>{{ auth()->user()->email }}</p>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Đăng xuất</button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <!-- Nút đăng nhập khi chưa đăng nhập -->
                                <a href="{{ route('login') }}">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <span>Login</span>
                                </a>
                            @endif
                            <a href="{{ route('cart.index') }}" id="cart-icon">
                                <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                <span id="cart-count">{{ session('cart') ? count(session('cart')) : 0 }}</span>
                            </a>

                            <form class="form-inline ">
                                <button class="btn nav_search-btn" type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </nav>
            </header>
            <div class="cart-container">
                <div class="cart-header">Giỏ hàng của bạn</div>
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Hình ảnh</th>
                            <th>Thành tiền</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody id="cart-items">
                        @php $total = 0; @endphp
                        @foreach ($cart as $id => $item)
                            @php $subtotal = $item['price'] * $item['quantity']; @endphp
                            @php $total += $subtotal; @endphp
                            <tr data-id="{{ $id }}">
                                <td>{{ $item['name'] }}</td>
                                <td>${{ number_format($item['price'], 2) }}</td>
                                <td>
                                    <div class="quantity-buttons">
                                        <button class="decrease">-</button>
                                        <span class="quantity">{{ $item['quantity'] }}</span>
                                        <button class="increase">+</button>
                                    </div>
                                </td>
                                <td><img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" />
                                </td>
                                <td class="subtotal">${{ number_format($subtotal, 2) }}</td>
                                <td><button class="remove-item btn btn-danger"
                                        data-id="{{ $id }}">Xóa</button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="total-container">Tổng tiền: <span id="total">${{ number_format($total, 2) }}</span>
                </div>

                <a href="javascript:void(0);" id="checkout-button" class="btn-checkout">Thanh toán</a>
            </div>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://js.stripe.com/v3/"></script>

            <script src="https://js.stripe.com/v3/"></script>

            <script>
                $(document).ready(function() {
                    // Tăng hoặc giảm số lượng sản phẩm
                    $(document).on('click', '.increase, .decrease', function() {
                        var quantityElement = $(this).siblings('.quantity');
                        var currentQuantity = parseInt(quantityElement.text());
                        var newQuantity = $(this).hasClass('increase') ? currentQuantity + 1 : Math.max(
                            currentQuantity - 1, 1); // Không cho phép số lượng < 1
                        quantityElement.text(newQuantity);

                        var productId = $(this).closest('tr').data('id');
                        var row = $(this).closest('tr');

                        updateCart(productId, newQuantity, row);
                    });

                    // Cập nhật giỏ hàng trên server và cập nhật subtotal, total, giỏ hàng
                    function updateCart(productId, quantity, row) {
                        $.ajax({
                            url: '{{ route('cart.update') }}',
                            method: 'POST',
                            data: {
                                id: productId,
                                quantity: quantity,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.success) {
                                    alert(response.success);
                                    updateSubtotal(row, quantity);
                                    updateTotal();
                                    updateCartIcon();
                                } else {
                                    alert('Có lỗi xảy ra, vui lòng thử lại.');
                                }
                            }
                        });
                    }

                    // Cập nhật subtotal cho sản phẩm
                    function updateSubtotal(row, quantity) {
                        var price = parseFloat(row.find('td:nth-child(2)').text().replace('$', ''));
                        var subtotal = price * quantity;
                        row.find('.subtotal').text('$' + subtotal.toFixed(2));
                    }

                    // Cập nhật tổng giá
                    function updateTotal() {
                        var total = 0;
                        $('.subtotal').each(function() {
                            total += parseFloat($(this).text().replace('$', ''));
                        });
                        $('#total').text('$' + total.toFixed(2));
                    }

                    // Xóa sản phẩm khỏi giỏ hàng
                    $(document).on('click', '.remove-item', function() {
                        var productId = $(this).data('id');
                        var row = $(this).closest('tr');

                        $.ajax({
                            url: '{{ route('cart.remove') }}',
                            method: 'POST',
                            data: {
                                id: productId,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                alert(response.success);
                                row.remove(); // Xóa hàng của sản phẩm đã xóa
                                updateTotal(); // Cập nhật tổng giá sau khi xóa
                                updateCartIcon(); // Cập nhật số lượng icon giỏ hàng
                            }
                        });
                    });

                    // Cập nhật số lượng sản phẩm trong icon giỏ hàng
                    function updateCartIcon() {
                        var totalItems = 0;
                        $('.quantity').each(function() {
                            totalItems += parseInt($(this).text());
                        });
                        $('#cart-icon-quantity').text(totalItems).css({
                            'font-size': '0.75em',
                            'padding': '4px 8px',
                            'background-color': '#FF6347', // Thay đổi màu nền cho nổi bật
                            'border-radius': '50%', // Tạo viền tròn cho số lượng
                            'color': 'white'
                        });
                    }

                    var stripe = Stripe(
                        'pk_test_51PGBfuDutMMW2UrrlhaOvZGBcrCCOSMVmY3SKZwXj10NEpLimKafsC3UxRDrhpjw16jnVN6BN3MAdSAOxzJl33F200hseS1M56'
                        );
                    var checkoutButton = document.getElementById('checkout-button');

                    checkoutButton.addEventListener('click', function() {
                        // Gửi yêu cầu tới backend để tạo checkout session
                        fetch('{{ route('checkout') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    cart: @json(session('cart')) // Truyền giỏ hàng sang backend
                                })
                            })
                            .then(function(response) {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(function(data) {
                                if (data.id) {
                                    stripe.redirectToCheckout({
                                        sessionId: data.id
                                    }).then(function(result) {
                                        if (result.error) {
                                            console.error('Stripe Error:', result.error.message);
                                            alert(result.error.message);
                                        }
                                    });
                                } else {
                                    console.error('Stripe Session ID Error:', data);
                                    alert('Không thể tạo session Stripe.');
                                }
                            })
                            .catch(function(error) {
                                console.error('Error:', error);
                                alert('Có lỗi xảy ra khi tạo phiên thanh toán.');
                            });
                    });





                });
            </script>




</body>

</html>
