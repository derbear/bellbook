<? require_once("connect.php");
connect(false); ?>
<?
function print_header() { ?>
<!--login info-->
<div align="right">
        <?php //TODO rename this file for ambiguity or merge
        //echo '<dir> <p>j</p> </dir>';
        if(isset($_SESSION['id'])) {
            echo 'You are logged in as <b>' . $_SESSION['firstname'] . ' '
            . $_SESSION['lastname'];
            echo '</b> (<a href="util/logout.php">Log out</a>
                | <a href="myAccount.php">My account</a>
                | <a href="myBooks.php">My books</a> 
                | <a href="trackedBooks.php">Tracked books</a>)<br />';
        }
        else {
            echo 'You are not logged in. (<a href="login.php">Log in</a> | '.
                ' <a href="register.php"> Get an account</a>)<br />';
        }
        ?>
</div>
<!--//login info-->
<!--header-->
<div align='right'> <form action='search.php' method='get' name='Search' id='Search'>
	<input type='text' name="query" id='search'> <input type='submit' id='submit' value='Search Books' ></form></div>
<div> <h1> bellbook </h1> </div>
<div> <!--<b>Navigation:</b>--> <a href='index.php'>Home</a>
| <a href='about.php'>About bellbook</a>
| <a href='browse.php'>Browse books</a>
    <? if (isset($_SESSION['id'])) { ?>
| <a href='sellBook.php'>Sell a book</a>
    <? } ?>

</div>
<hr />
<? if (isset($_GET['message'])) {
    $msg=filter_var($_GET['message'], FILTER_SANITIZE_STRING);
    echo '<div class=' . '"' . 'msg' . '"' . '>' . $msg . '</div>';
}
?>
<!--//header-->
<!--page content-->
<? } ?>