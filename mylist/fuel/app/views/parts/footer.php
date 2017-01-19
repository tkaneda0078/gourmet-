<!-- logo -->

<!--<h1>-->

<!--    <a href="<?php //echo Uri::create('mylist'); ?>" title="gourmet">-->
        
<!--        <?php //echo Asset::img('gourmet.png', array('title' => 'gourmet', 'alt' => 'gourmet')); ?>-->
        
<!--    </a>-->

<!--</h1>-->

<!-- logo -->

<!-- nav -->

<nav role="footer-nav">

	<ul>

        <li class="nav-active"><?php echo Html::anchor('register', 'Register'); ?></li>

        <li><?php echo Html::anchor('about', 'About'); ?></li>

        <!--<li><a href="contact.html" title="Contact">Contact</a></li>-->

    </ul>

</nav>

<!-- nav -->

<ul role="social-icons" class="share-buttons">
    <li>
        <a href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fgourmet-tkaneda.c9users.io%2Fmylist" title="Share on Facebook" target="_blank">
            <?php echo Asset::img('web_icon/Facebook.png', array('alt' => 'Share on Facebook')); ?>
        </a>
    </li>
    <li>
        <a href="https://twitter.com/intent/tweet?source=https%3A%2F%2Fgourmet-tkaneda.c9users.io%2Fmylist&text=:%20https%3A%2F%2Fgourmet-tkaneda.c9users.io%2Fmylist" target="_blank" title="Tweet">
            <?php echo Asset::img('web_icon/Twitter.png', array('alt' => 'Tweet')); ?>
        </a>
    </li>
    <li>
        <a href="https://plus.google.com/share?url=https%3A%2F%2Fgourmet-tkaneda.c9users.io%2Fmylist" target="_blank" title="Share on Google+">
            <?php echo Asset::img('web_icon/Google+.png', array('alt' => 'Share on Google+')); ?>
        </a>
    </li>
    <li>
        <a href="https://getpocket.com/save?url=https%3A%2F%2Fgourmet-tkaneda.c9users.io%2Fmylist" target="_blank" title="Add to Pocket">
            <?php echo Asset::img('web_icon/Pocket.png', array('alt' => 'Add to Pocket')); ?>
        </a>
    </li>
</ul>

<p class="copy-right">&copy; 2016  gourmet</p>
