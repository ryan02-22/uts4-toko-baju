<section style="padding: 120px 5% 50px;">
    <div style="max-width: 1000px; margin: 0 auto;">
        <h2 style="margin-bottom: 20px; font-family: 'Playfair Display', serif;">Your Shopping Cart</h2>
        
        <?php if($this->cart->total_items() > 0): ?>
            <form action="<?= base_url('cart/update'); ?>" method="post">
                <table style="width: 100%; border-collapse: collapse; text-align: left;">
                    <tr style="border-bottom: 1px solid #ddd;">
                        <th style="padding: 15px 0;">Product</th>
                        <th style="padding: 15px 0;">Price</th>
                        <th style="padding: 15px 0;">Qty</th>
                        <th style="padding: 15px 0;">Total</th>
                        <th style="padding: 15px 0;">Action</th>
                    </tr>
                    
                    <?php $i = 1; ?>
                    <?php foreach ($this->cart->contents() as $items): ?>
                        <tr style="border-bottom: 1px solid #ddd;">
                            <td style="padding: 15px 0; display: flex; align-items: center; gap: 15px;">
                                <img src="<?= base_url('assets/images/' . $items['image']); ?>" alt="<?= $items['name']; ?>" style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                                <span><?= $items['name']; ?></span>
                            </td>
                            <td style="padding: 15px 0;">Rp <?= number_format($items['price'], 0, ',', '.'); ?></td>
                            <td style="padding: 15px 0;">
                                <input type="number" name="<?= $i.'[qty]'; ?>" value="<?= $items['qty']; ?>" style="width: 60px; padding: 5px; border: 1px solid #ddd; border-radius: 4px;" min="1">
                            </td>
                            <td style="padding: 15px 0;">Rp <?= number_format($items['subtotal'], 0, ',', '.'); ?></td>
                            <td style="padding: 15px 0;">
                                <a href="<?= base_url('cart/remove/'.$items['rowid']); ?>" style="color: #e74c3c; text-decoration: none;"><i class="fas fa-trash"></i> Remove</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                    
                    <tr>
                        <td colspan="3" style="text-align: right; padding: 20px 15px; font-weight: bold; font-size: 1.2rem;">Total:</td>
                        <td colspan="2" style="padding: 20px 0; font-weight: bold; font-size: 1.2rem;">Rp <?= number_format($this->cart->total(), 0, ',', '.'); ?></td>
                    </tr>
                </table>
                
                <div style="display: flex; justify-content: space-between; margin-top: 30px;">
                    <div>
                        <button type="submit" class="btn-primary-outline" style="border-color: #333; color: #333;">Update Cart</button>
                    </div>
                    <div>
                        <a href="<?= base_url('cart/checkout'); ?>" class="btn-primary">Proceed to Checkout</a>
                    </div>
                </div>
            </form>
        <?php else: ?>
            <div style="text-align: center; padding: 50px 0;">
                <i class="fas fa-shopping-cart" style="font-size: 4rem; color: #ddd; margin-bottom: 20px;"></i>
                <h3>Your cart is empty</h3>
                <p style="color: #666; margin-bottom: 20px;">Looks like you haven't added anything to your cart yet.</p>
                <a href="<?= base_url(); ?>" class="btn-primary">Start Shopping</a>
            </div>
        <?php endif; ?>
    </div>
</section>
