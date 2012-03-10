<? require_once("connect.php");
connect(false); ?>
<!--login form--> 
<div align="right">
        <?php 
        //echo '<dir> <p>j</p> </dir>';
        if(isset($_SESSION['id'])) {
            echo 'You are logged in as <b>' . $_SESSION['firstname'] . ' '
            . $_SESSION['lastname'];
            echo '</b> (<a href="util/logout.php">Log out</a>)<br />';
        }
        else {
            echo 'You are not logged in. (<a href="login.php">Log in</a> | '. 
                ' <a href="register.php"> Get an account</a>)<br />';
        }
        ?>
</div>
<!--//login form-->
