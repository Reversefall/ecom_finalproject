@extends('user.layouts.master')
@section('page-title', 'Trang sản phẩm')

@section('content')
<section id="page-header">
    <h2>Sản phẩm</h2>
    <p>Mua chung để có cơ hội giảm 10%!</p>
</section>
<section id="search-filter" class="section-p1">
    <div class="search-box">
        <input type="text" id="searchName" placeholder="Tìm theo tên sản phẩm...">
    </div>

    <div class="category-filter">
        <select id="searchCategory">
            <option value="">Tất cả danh mục</option>
            @foreach($categories as $cate)
            <option value="{{ $cate->category_name }}">{{ $cate->category_name }}</option>
            @endforeach
        </select>
    </div>
</section>

<section id="product1" class="section-p1">
    <div class="pro-container">
        @foreach($products as $product)
        <div class="pro"
            data-name="{{ strtolower($product->product_name) }}"
            data-category="{{ strtolower($product->category->category_name ?? '') }}">


            <img src="{{ asset($product->images->first()->image_url ?? 'assets/images/no-image.png') }}" alt="">

            <div class="des">
                <span>{{ $product->category->category_name ?? 'Không phân loại' }}</span>

                <h5>{{ $product->product_name }}</h5>

                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>

                <h4>{{ number_format($product->price) }} đ</h4>
            </div>

            <a href="#">
                <i class="fas fa-shopping-cart cart"></i>
            </a>
        </div>
        @endforeach
    </div>
</section>

<section id="pagination" class="section-p1">
    <a href="#">1</a>
    <a href="#">2</a>
    <a href="#"><i class="fas fa-long-arrow-alt-right"></i></a>
</section>

<section id="newsletter" class="section-p1 section-m1">
    <div class="newstext">
        <h4>Sign Up For Newsletter</h4>
        <p>Get E-mail updates about our latest shop and <span>special offers.</span></p>
    </div>
    <div class="form">
        <input type="text" placeholder="Your email address">
        <button class="normal">Sign Up</button>
    </div>
</section>


@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById("searchName");
        const categorySelect = document.getElementById("searchCategory");
        const products = document.querySelectorAll(".pro");

        function filterProducts() {
            let searchText = searchInput.value.toLowerCase();
            let selectedCategory = categorySelect.value.toLowerCase();

            products.forEach(p => {
                let name = p.dataset.name;
                let category = p.dataset.category;

                let matchName = name.includes(searchText);
                let matchCategory = selectedCategory === "" || category === selectedCategory;

                if (matchName && matchCategory) {
                    p.style.display = "block";
                } else {
                    p.style.display = "none";
                }
            });
        }

        searchInput.addEventListener("keyup", filterProducts);
        categorySelect.addEventListener("change", filterProducts);
    });

    document.addEventListener("DOMContentLoaded", function() {
        const items = document.querySelectorAll(".pro");
        const itemsPerPage = 12;
        let currentPage = 1;

        function showPage(page) {
            let start = (page - 1) * itemsPerPage;
            let end = start + itemsPerPage;

            items.forEach((item, index) => {
                item.style.display = (index >= start && index < end) ? "block" : "none";
            });
        }

        showPage(currentPage);
    });
</script>
@endsection