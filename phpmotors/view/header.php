<header>
      <img class="logo" alt=logo src="/phpmotors/images/site/logo.png">
      <div class="login">
      <?php if(isset($_SESSION['loggedin'])) {
				echo '<a href="/phpmotors/accounts/index.php">' . $_SESSION['clientData']['clientFirstname'] . '</a>';
				echo '<span> | </span>';
				echo '<a href="/phpmotors/accounts/index.php?action=Logout">Log out</a>';
			} 
                        else {
				echo '<a href="/phpmotors/accounts/index.php?action=login">My Account</a>';
			}
        ?>
      </div>
      
    <nav class="navigation" id="nav">
    <?php echo $navList; ?>
    </nav>

</header>