<section class="auth-section" style="padding-top: 120px;">
    <div class="auth-container" style="max-width: 600px;">
        <div class="auth-header">
            <h2>Checkout</h2>
            <p>Please enter your shipping address to complete the purchase.</p>
        </div>
        <form action="<?= base_url('cart/process_checkout'); ?>" method="post" class="auth-form">
            <div class="form-group" style="background: #f9f9f9; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                <h4 style="margin-bottom: 10px;">Order Summary</h4>
                <p style="margin-bottom: 5px;">Total Items: <?= $this->cart->total_items(); ?></p>
                <h3 style="color: var(--primary-color);">Total Amount: Rp <?= number_format($this->cart->total(), 0, ',', '.'); ?></h3>
            </div>
            
            <div class="form-group">
                <label for="address">Shipping Address</label>
                <textarea id="address" name="address" class="form-control" rows="5" required placeholder="Enter your full address here..." style="width: 100%; padding: 12px 15px; border: 1px solid var(--border-color); border-radius: 8px; font-family: 'Inter', sans-serif; resize: vertical;"></textarea>
            </div>

            <button type="submit" class="btn-primary btn-block">Place Order</button>
            <a href="<?= base_url('cart'); ?>" class="btn-secondary btn-block" style="text-align: center; margin-top: 10px; display: block;">Back to Cart</a>
        </form>
    </div>
</section>
