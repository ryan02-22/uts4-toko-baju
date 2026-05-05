<section class="hero">
    <div class="hero-content">
        <h1 class="fade-in-up">Redefining Elegance for the Modern Era</h1>
        <p class="fade-in-up delay-1">Discover our exclusive collection of timeless pieces, crafted with precision and passion for the minimalists at heart.</p>
        <a href="#collection" class="btn-primary fade-in-up delay-2">Shop Collection</a>
    </div>
</section>

<section class="features">
    <div class="feature fade-in">
        <i class="fas fa-shipping-fast"></i>
        <h3>Express Delivery</h3>
        <p>Free shipping on all orders over Rp 1.000.000</p>
    </div>
    <div class="feature fade-in delay-1">
        <i class="fas fa-undo"></i>
        <h3>Easy Returns</h3>
        <p>30-day hassle-free return policy</p>
    </div>
    <div class="feature fade-in delay-2">
        <i class="fas fa-lock"></i>
        <h3>Secure Checkout</h3>
        <p>Your payment information is handled securely</p>
    </div>
</section>

<section id="collection" class="products-section">
    <div class="section-header">
        <h2>Latest Arrivals</h2>
        <p>Curated selections for your everyday luxury</p>
    </div>

    <div class="product-grid">
        <?php foreach($products as $product): ?>
        <div class="product-card">
            <div class="product-image-container">
                <img src="<?= base_url('assets/images/' . $product['image']); ?>" alt="<?= $product['name']; ?>" class="product-img">
                <div class="product-overlay">
                    <button class="btn-icon" title="Add to Wishlist"><i class="far fa-heart"></i></button>
                    <button class="btn-quickview">Quick View</button>
                    <a href="<?= base_url('cart/add/'.$product['id']); ?>" class="btn-icon" title="Add to Cart"><i class="fas fa-shopping-cart"></i></a>
                </div>
            </div>
            <div class="product-info">
                <span class="product-category"><?= $product['category']; ?></span>
                <h3 class="product-title"><?= $product['name']; ?></h3>
                <p class="product-price"><?= $product['price']; ?></p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="text-center mt-5">
        <a href="#" class="btn-secondary">View All Products</a>
    </div>
</section>
