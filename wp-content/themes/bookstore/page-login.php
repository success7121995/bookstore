<?php
/**
 * Login
 * 
 * @package Bookstore
 */

get_header();
?>
<div class="authn main-content">
    <h1>Login</h1>
    <form action="#">
        <div class="form">
            <!-- Email -->
            <label for="email">Email</label><br>
            <input type="text" name="email"><br>
    
            <!-- Password -->
            <div class="password">
                <label for="password">Password</label><br>
                <input type="password" name="password">
                <i class="icon bi bi-eye-slash eye"></i>
            </div>
        </div>
        <div class="terms">
            <!-- Terms -->
            <div class="checkbox">
                <input type="checkbox" name="terms">
                <span class="term">I agree to the <a class="text-link" href="<?php echo get_site_url() . '/terms-of-use'; ?>">terms</a> and the <a class="text-link" href="<?php echo get_site_url() . '/privacy-policy'; ?>">privacy policy</a>.</span>
            </div>

            <p>Haven't register yet? <a class="text-link" href="<?php echo get_site_url() . '/signup'; ?>">Create an account</a>.</p>
            <p><a class="text-link" href="#">Forgot Password</a></p>
        </div>
        <div class="submit">
            <button type="submit">Login</button>
        </div>
    </form>
</div>
<?php
get_footer();


