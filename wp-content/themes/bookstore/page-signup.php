<?php
/**
 * Signup
 * 
 * @package Bookstore
 */
if (!isset($_SESSION['AuthnUser'])):
get_header();
?>
<div class="authn main-content">
    <h1>Sign Up</h1>
    <div id="response"></div>
    <form id="authn">
        <div id="signup" class="form">
            <!-- Prefix -->            
            <label for="prefix">Title</label>
            <div class="prefix-fields">
                <div class="radio">
                    <input type="radio" name="prefix" value="mr" checked>
                    <label for="mr">Mr.</label>
                </div>
                <div class="radio">
                    <input type="radio" name="prefix" value="ms">
                    <label for="ms">Ms.</label>
                </div>
                <div class="radio"><input type="radio" name="prefix" value="mrs">
                    <label for="mrs">Mrs.</label>
                </div>
            </div>
            <div class="error prefix"></div>

            <div class="name-fields">
                <!-- First Name -->
                <div>
                    <label for="fname">First Name</label>
                    <input type="text" name="fname">
                    <div class="error fname"></div>
                </div>

                <!-- Last Name -->
                <div>
                    <label for="lname">Last Name</label><br>
                    <input type="text" name="lname">
                    <div class="error lname"></div>
                </div>
            </div>

            <!-- Email -->            
            <label for="email">Email</label><br>
            <input type="text" name="email"><br>
            <div class="error email"></div>
            
    
            <!-- Password -->
            <div class="password">
                <label for="password">Password</label><br>
                <input type="password" name="password">
                <i class="icon bi bi-eye-slash eye"></i>
                <div class="error password"></div>
            </div>

            <!-- Confirm Password -->
            <div class="password">
                <label for="confirm-password">Confirm Password</label><br>
                <input type="password" name="confirm-password">
                <i class="icon bi bi-eye-slash eye"></i>
                <div class="error confirm-password"></div>
            </div>
        </div>

        <!-- Terms -->
        <div class="terms">
            <div class="checkbox">
                <input type="checkbox" name="terms">
                <span class="term">I agree to the <a class="text-link" href="<?php echo get_site_url() . '/terms-of-use'; ?>">terms</a> and the <a class="text-link" href="<?php echo get_site_url() . '/privacy-policy'; ?>">privacy policy</a>.</span>
            </div>

            <p>Already have had an account? <a class="text-link" href="<?php echo get_site_url() . '/login'; ?>">Login</a>.</p>
            <div class="error terms"></div>
        </div>
        <div class="submit">
            <button type="submit">Register</button>
        </div>
    </form>
</div>
<?php
get_footer();
else:   
    // Redirect to 404 page
    include('404.php');

    // Do nothing when redirect to 404 page
    exit;
endif;


