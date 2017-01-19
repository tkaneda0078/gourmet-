<!DOCTYPE html>

<html>
    
    <head>
    
    	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    
        <meta charset="utf-8">
    
        <meta name="description" content="">
    
        <meta name="author" content="">
    
        
    
        <title>gourmet</title>
    
    	<?php echo html_tag('link', array('rel' => 'shortcut icon', 'type' => 'image/x-icon', 'href' => Asset::get_file('assets/img/favicon.ico', 'img'))); ?>
    
        <!-- css -->
        <?php echo Asset::render('add_css'); ?>

    </head>
    
    <body>
        
        <header role="header">
            <!-- header.phpファイルを読み込む-->
            <?php echo $header; ?>
            
        </header>
        
        <main role="main-home-wrapper" class="container">
            <!-- 各アクションの内容を読み込む-->
            <?php echo $content; ?>
            
        </main>
        
        <footer role="footer">
            <!-- footer.phpファイルを読み込む-->
            <?php echo $footer; ?>
            
        </footer>
        
        <!-- js -->
        <?php echo Asset::render('add_js'); ?>
        
    </body>
    
</html>