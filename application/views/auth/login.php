<div style="padding-top: 100px; min-height: 80vh; display: flex; align-items: center; justify-content: center; background-color: var(--bg-color);">
    <div style="background: white; padding: 40px; border-radius: 8px; box-shadow: var(--shadow-md); width: 100%; max-width: 400px; text-align: center;">
        <h2 style="margin-bottom: 30px; color: var(--primary-color);">Welcome Back</h2>
        
        <form action="<?= base_url('auth/process'); ?>" method="post">
            <div style="margin-bottom: 20px; text-align: left;">
                <label for="email" style="display: block; margin-bottom: 5px; font-weight: 500; font-size: 0.9rem;">Email Address</label>
                <input type="email" id="email" name="email" required style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 4px; outline: none;">
            </div>
            
            <div style="margin-bottom: 20px; text-align: left;">
                <label for="password" style="display: block; margin-bottom: 5px; font-weight: 500; font-size: 0.9rem;">Password</label>
                <input type="password" id="password" name="password" required style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: 4px; outline: none;">
            </div>
            
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; font-size: 0.85rem;">
                <label style="display: flex; align-items: center; gap: 5px;">
                    <input type="checkbox"> Remember me
                </label>
                <a href="#" style="color: var(--secondary-color);">Forgot Password?</a>
            </div>
            
            <button type="submit" class="btn-primary" style="width: 100%;">Sign In</button>
        </form>
        
        <p style="margin-top: 20px; font-size: 0.9rem; color: var(--text-light);">
            Don't have an account? <a href="#" style="color: var(--primary-color); font-weight: 600;">Create Account</a>
        </p>
    </div>
</div>
