<div class="container">

	<!-- logo -->

	<h1>

    	<a href="<?php echo Uri::create('mylist'); ?>" title="gourmet"><?php echo Asset::img('gourmet.png', array('title' => 'gourmet', 'alt' => 'gourmet')); ?></a>

    </h1>

    <!-- logo -->

    <!-- nav -->

    <nav role="header-nav" class="navy">

        <ul>

            <li class="nav-active"><?php echo Html::anchor('register', 'Register'); ?></li>
            
            <li><?php echo Html::anchor('gnavi', 'Gnavi Seach'); ?></li>

            <li><?php echo Html::anchor('about', 'About'); ?></li>

        </ul>

    </nav>

    <!-- nav -->

</div>