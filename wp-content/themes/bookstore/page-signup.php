<?php
/**
 * Signup
 * 
 * @package Bookstore
 */

get_header();
?>
<div class="authn main-content">
    <h1>Sign Up</h1>
    <form id="authn">
        <div class="form">
            <!-- Prefix -->
            <label for="prefix">Title</label>
            <div class="radio">
                <input type="radio" name="prefix" value="mr" checked>
                <label for="mr">Mr.</label>
            </div>
            <div class="radio">
                <input type="radio" name="prefix" value="ms">
                <label for="ms">Ms.</label>
            </div>
            <div class="radio">
                <input type="radio" name="prefix" value="mrs">
                <label for="mrs">Mrs.</label>
            </div>

            <!-- First Name -->
            <label for="fname">First Name</label><br>
            <input type="text" name="fname">

            <!-- Last Name -->
            <label for="lname">Last Name</label><br>
            <input type="text" name="lname">

            <!-- Email -->
            <label for="email">Email</label><br>
            <input type="text" name="email"><br>
    
            <!-- Password -->
            <div class="password">
                <label for="password">Password</label><br>
                <input type="password" name="password">
                <i class="icon bi bi-eye-slash eye"></i>
            </div>

            <!-- Confirm Password -->
            <div class="password">
                <label for="confirm-password">Confirm Password</label><br>
                <input type="password" name="confirm-password">
                <i class="icon bi bi-eye-slash eye"></i>
            </div>
        </div>
        <div class="terms">
            <!-- Terms -->
            <div class="checkbox">
                <input type="checkbox" name="terms">
                <span class="term">I agree to the <a class="text-link" href="<?php echo get_site_url() . '/terms-of-use'; ?>">terms</a> and the <a class="text-link" href="<?php echo get_site_url() . '/privacy-policy'; ?>">privacy policy</a>.</span>
            </div>

            <p>Already have had an account? <a class="text-link" href="<?php echo get_site_url() . '/login'; ?>">Login</a>.</p>
        </div>
        <div class="submit">
            <button type="submit">Register</button>
        </div>
    </form>
</div>
<div id="response"></div>
<?php
get_footer();


