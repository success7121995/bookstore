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
    <form id="authn">
        <div id="login" class="form">
            <!-- Email -->
            <div>
                <label for="email">Email</label><br>
                <input type="text" name="email"><br>
                <div class="error email"></div>
            </div>
    
            <!-- Password -->
            <div class="password">
                <label for="password">Password</label><br>
                <input type="password" name="password">
                <i class="icon bi bi-eye-slash eye"></i>
                <div class="error password"></div>
            </div>
    
            <!-- Terms -->
            <div class="terms">
                <div class="checkbox">
                    <input type="checkbox" name="terms">
                    <span class="term">I agree to the <a class="text-link" href="<?php echo get_site_url() . '/terms-of-use'; ?>">terms</a> and the <a class="text-link" href="<?php echo get_site_url() . '/privacy-policy'; ?>">privacy policy</a>.</span>
                </div>
    
                <p>Haven't register yet? <a class="text-link" href="<?php echo get_site_url() . '/signup'; ?>">Create an account</a>.</p>
                <p><a class="text-link" href="#">Forgot Password</a></p>
                <div class="error terms"></div>
            </div>
            <input type="hidden" name="csrftoken" value="tokenvalue"/>
            <div class="submit">
                <button type="submit">Login</button>
            </div>
        </div>
    </form>
</div>
<?php
get_footer();


