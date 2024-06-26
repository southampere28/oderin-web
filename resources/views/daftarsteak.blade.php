<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Steak</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{asset('asset/css/styles.css')}}" rel="stylesheet">
    <!-- Jika path ke gambar tidak benar, ganti sesuai dengan struktur folder proyekmu -->
    <style>
        /* Tambahan CSS untuk highlight-bar */
        highlight-bar {
            background-color: #e5af10;
            margin: 7px 0;
            width: 152px;
            height: 3px;
        }

        .menu {
            border-radius: 9px;
            background-color: #FFFFFF;
            border: 1px solid #A1A1A1;
            display: flex;
            align-items: center;
            justify-content: space-around;
            gap: 19px;
            padding: 4px 8px;
        }

        .item {
            font-family: 'Inter', sans-serif;
            color: #FFFFFF;
            padding: 6px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: space-around;
        }

        .food-item {
            background-color: transparent;
            border-radius: 5px;
            color: #0d0d0d;
        }

        .drink-item  {
            flex-grow: 0;
            color: #0d0d0d;
            background-color: transparent;
        }

        .steak-item {
            color: #0d0d0d;
            background-color: #E5AF10;
            border-radius: 5px;
        }

        .snack-item  {
            flex-grow: 0;
            color: #0d0d0d;
            border-radius: 5px;
            background-color: transparent;
        }

        .container-makanan {
            display: flex;
            margin-top: 19px;
            justify-content: space-between;
            gap: 20px;
        }

        .price {
            font-family: Inter, sans-serif;
            font-size: 20px; /* Ubah ukuran font sesuai kebutuhan */
        }

        .image {
            width: 40px;
            height: 40px;
            object-fit: cover;
            object-position: center;
        }

        .visually-hidden {
            position: absolute;
            width: 1px;
            height: 1px;
            margin: -1px;
            padding: 0;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            border: 0;
        }

        .image-button, .image-button-minus {
            border: none;
            padding: 0;
            background: none;
            cursor: pointer;
            display: inline-block;
        }

        .menu button {
            border-width: 0px; /* Atur ketebalan border sesuai keinginan */
        }

        /* Shopping Cart Button CSS */
        .shopping-cart-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #000000; /* Ubah warna latar belakang menjadi hitam */
            color: #ffffff;
            border: none;
            border-radius: 80%;
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            cursor: pointer;
            z-index: 999; /* Pastikan tombol shopping cart muncul di atas konten lain */
        }

        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: #ffc107;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>
    <header class="bg-dark1 py-5" style="background-color: white;">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder" style="color: black;">Daftar Steak</h1>
                <nav class="menu">
                    <a href="{{ route('frontend.daftarmanakan') }}" class="item food-item text-decoration-none">Makanan</a>
                    <a href="{{ route('frontend.daftarsnack') }}" class="item snack-item text-decoration-none">Snack</a>
                    <a href="{{ route('frontend.daftarminuman') }}" class="item drink-item text-decoration-none">Minuman</a>
                    <a href="{{ route('frontend.daftarsteak') }}" class="item steak-item text-decoration-none">Steak</a>
                </nav>
                <input type="text" id="searchInput" placeholder="Cari steak berdasarkan nama atau harga..." class="form-control mt-4">
            </div>
        </div>
    </header>

    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <!-- Loop untuk menampilkan produk -->
                @foreach($foods as $food)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <img class="card-img-top" src="{{ asset('asset/img/'.$food->gambar_product) }}" alt="{{ $food->gambar_product }}">
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <h5 class="fw-bolder">{{ $food->nama_product }}</h5>
                                    <p class="text-muted">{{ $food->deskripsi }}</p>
                                </div>
                            </div>
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <section class="container-makanan">
                                    <div class="price">Rp. {{ $food->harga_product }}</div>
                                    @if($food->stock_product == 'habis')
                                    <div class="out-of-stock text-danger bg-light p-2 rounded">Stok Habis</div>
                                    @endif
                                </section>
                                <td class="cart-product-quantity" width="120px">
                                    @if($food->stock_product == 'tersedia')
                                    <div class="input-group quantity">
                                        <div class="input-group-prepend decrement-btn" style="cursor: pointer">
                                            <button class="image-button-minus" data-id="{{ $food->kode_product }}" data-name="{{ $food->nama_product }}" data-price="{{ $food->harga_product }}">
                                                <img loading="lazy" src="{{asset('asset/img/minusbutton.png')}}" alt="Product Image" class="image" />
                                            </button>
                                        </div>
                                        <input type="text" class="qty-input form-control" maxlength="2" max="10" id="qty_{{ $food->kode_product }}" disabled>
                                        <div class="input-group-append increment-btn" style="cursor: pointer">
                                            <button class="image-button" data-id="{{ $food->kode_product }}" data-name="{{ $food->nama_product }}" data-price="{{ $food->harga_product }}">
                                                <img loading="lazy" src="{{asset('asset/img/plusbutton.png')}}" alt="Product Image" class="image" />
                                            </button>
                                        </div>
                                    </div>
                                    @endif
                                </td>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Shopping Cart Button -->
    <button class="shopping-cart-btn" onclick="redirectToCart()">
        <i class="bi bi-cart-fill"></i>
        <span class="cart-count visually-hidden">0</span>
    </button>

    <footer class="py-5 bg-dark1" style="background-color: white;">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 
            <!-- Ganti dengan tahun aktual -->
            {{ date('Y') }}</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript di sini
        // Deklarasi variabel untuk menyimpan data keranjang
        let cart = [];

        // Fungsi untuk menyimpan isi keranjang dalam local storage
        function saveCartToLocalStorage() {
            localStorage.setItem('cart', JSON.stringify(cart));
        }

        // Fungsi untuk memuat isi keranjang dari local storage
        function loadCartFromLocalStorage() {
            const storedCart = localStorage.getItem('cart');
            if (storedCart) {
                cart = JSON.parse(storedCart); // Mengubah string JSON menjadi objek JavaScript
                updateCartCount(cart.length); // Memperbarui tampilan jumlah produk dalam keranjang
            }
        }

        // Fungsi untuk memuat data keranjang dari local storage saat halaman dimuat
        function initializeCart() {
            loadCartFromLocalStorage(); // Memuat isi keranjang dari local storage
        }

        // Fungsi untuk memperbarui tampilan jumlah produk dalam keranjang
        function updateCartCount(count) {
            const cartCountElement = document.querySelector('.cart-count');
            cartCountElement.textContent = count;
            if (count > 0) {
                cartCountElement.classList.remove('visually-hidden');
            } else {
                cartCountElement.classList.add('visually-hidden');
            }
        }

        // Fungsi untuk menambahkan produk ke keranjang
        function addProductToCart(id, name, price) {
            const product = { id, name, price }; // Membuat objek produk
            cart.push(product); // Menambahkan produk ke dalam keranjang
            updateCartCount(cart.length); // Memperbarui tampilan jumlah produk dalam keranjang
            saveCartToLocalStorage(); // Menyimpan keranjang dalam local storage
        }

        function popProductFromCart(id) {
            // Assuming 'cart' is an array of objects where each object represents a product
            const index = cart.findIndex(item => item.id === id);
            if (index !== -1) {
                // Remove the item from the cart array
                cart.splice(index, 1);
                updateCartCount(cart.length);
                saveCartToLocalStorage();
            } else {
                console.log("Product not found in the cart");
            }
        }

        // Fungsi untuk mengarahkan pengguna ke halaman keranjang
        function redirectToCart() {
            window.location.href = "{{ route('cart.index', ['id' => 1]) }}";
        }

        // Event listener untuk memanggil fungsi initializeCart saat halaman dimuat
        window.addEventListener('load', initializeCart);

        // Event listener untuk menambahkan produk ke keranjang saat tombol produk diklik
        const productButtons = document.querySelectorAll('.image-button');
        productButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault(); // Mencegah perilaku default tombol (jika ada)
                const productId = button.getAttribute('data-id');
                const productName = button.getAttribute('data-name');
                const productPrice = button.getAttribute('data-price');
                const qtyInput = document.querySelector(`#qty_${productId}`);

                if (qtyInput) {
                    // Increment the value of the quantity input field
                    let currentValue = parseInt(qtyInput.value) || 0; // Get the current value or default to 0 if NaN
                    let incrementedValue = currentValue + 1; // Increment the value
                    qtyInput.value = incrementedValue; // Update the input field with the new value

                }

                addProductToCart(productId, productName, productPrice); // Memanggil fungsi addProductToCart
            });
        });

        const productButtonMins = document.querySelectorAll('.image-button-minus');
productButtonMins.forEach(button => {
    button.addEventListener('click', function (event){
        event.preventDefault();
        const productId = button.getAttribute('data-id');
        popProductFromCart(productId);
        const qtyInput = document.querySelector(`#qty_${productId}`);

        if (qtyInput) {
            // Decrement the value of the quantity input field only if it's greater than 0
            let currentValue = parseInt(qtyInput.value) || 0; // Get the current value or default to 0 if NaN
            if (currentValue > 0) { // Check if the current value is greater than 0
                let decrementedValue = currentValue - 1; // Decrement the value
                qtyInput.value = decrementedValue; // Update the input field with the new value
            }
        }
    });
});


        // Load cart data from local storage
        const cart2 = JSON.parse(localStorage.getItem('cart')) || [];

        // Count occurrences of each product code in the cart
        const productCounts = {};
        cart2.forEach(item => {
            productCounts[item.id] = (productCounts[item.id] || 0) + 1;
        });

        // Set initial quantity values for each product
        document.addEventListener("DOMContentLoaded", function() {
            const qtyInputs = document.querySelectorAll('.qty-input');
            qtyInputs.forEach(input => {
                const productId = input.id.split('_')[1];
                input.value = productCounts[productId] || 0;
            });
        });


        // Fungsi untuk memfilter produk berdasarkan input pencarian
        function filterProducts() {
            const searchInput = document.getElementById('searchInput').value.toLowerCase();
            const productCards = document.querySelectorAll('.col.mb-5');

            productCards.forEach(card => {
                const productName = card.querySelector('.fw-bolder').textContent.toLowerCase();
                const productPrice = card.querySelector('.price').textContent.toLowerCase();

                if (productName.includes(searchInput) || productPrice.includes(searchInput)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Event listener untuk input pencarian
        const searchInput = document.getElementById('searchInput');
        searchInput.addEventListener('input', filterProducts);
        </script>
    </script>
</body>
</html>
