<ul id="nav">
    <?php if(isset($_SESSION["user"])) { ?>
                <li><a href='index.php'>Domů</a></li>
                <li><a href='?link=my-tips.php'>Moje tipy</a></li>
                <li><a href='?link=ladder.php'>Žebříček</a></li>
                <li><a href='?link=my-profile.php'>Můj profil</a></li>
                <li><span id='current-time'></span></li>
    <?php if($_SESSION["user"]["admin"] == 1) { ?>
        <li><a href='?link=manage-matches.php'>Spravovat zápasy</a></li>
        <!-- <li><a href='?link=null-points.php'>Testy</a></li> -->
    <?php } ?>
                <li><a href='?link=logout.php'>Odhlásit se</a></li>
    <?php } ?>
</ul>