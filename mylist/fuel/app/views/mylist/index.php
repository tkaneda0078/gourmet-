<!-- main -->

<main role="main-inner-wrapper" class="container">

    <div class="row">
    
    	<section class="col-xs-12 col-sm-6 col-md-6 col-lg-6 ">
    
        	<article role="pge-title-content">
    
            	<header>
    
                	<h2><span>gourmet</span> Your favorite store. </h2>
    
                </header>
    
                <p>You can also get 'Gastronomy' with this.</p>
    
            </article>

        </section>
        
        <!-- 未登録 start-->
        <?php if (empty($gourmet_list)): ?>
        
        <section class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
    
        	<article class="about-content">
    
            	<p>Gurmet is a web service that you go and register shop information you like.You can share your registered shops with friends and use them as your own memorandum.</p>
    
                <p>Registered shops will be used for dates and dining.Let's register it immediately!</p>
    
            </article>
    
        </section>
        
        <div class="clearfix"></div>
        
        <?php endif; ?>
        <!-- 未登録 end-->
        
        <?php if ( ! empty($gourmet_list)): ?>
        
        <?php $flag = 0; ?>
    
        <?php foreach ($gourmet_list as $data): ?>
        
        <?php if ($flag == 0): ?>
        
        <!-- 最新の記事 start-->
        
        <section class="col-xs-12 col-sm-6 col-md-6 col-lg-6 grid">
            
        	<figure class="effect-oscar">
                
                <?php if (empty($data['saved_to'])): ?>

                <?php echo Asset::img($data['image'], array('class' => 'img-responsive top-img-size')); ?>
                
                <?php else: ?>
                
            	<?php echo Asset::img($data['saved_to'], array('class' => 'img-responsive top-img-size')); ?>
                
                <?php endif; ?>
                
                <figcaption>
    
                	<h2><?php echo $data['name']; ?></h2>
    
    				<p><?php echo $data['address']; ?></p>
    
    				<a href="<?php echo Uri::create('detail', array(), array('id' => $data['id'])); ?>">View more</a>
    
                </figcaption>
    
            </figure>
    
        </section>
        
        <div class="clearfix"></div>
        
        <!-- 最新の記事 end-->
    
        <?php else: ?>
    
        <!-- 過去の記事 start-->
        
        <section class="col-xs-12 col-sm-6 col-md-6 col-lg-6 grid">
    
        	<ul class="grid-lod effect-2" id="grid">
    
            	<li>
    
                	<figure class="effect-oscar">
    
                        <?php if (empty($data['saved_to'])): ?>
                    
                        <?php echo Asset::img($data['image'], array('class' => 'img-responsive top-img-size')); ?>
                        
                        <?php else: ?>
                        
                    	<?php echo Asset::img($data['saved_to'], array('class' => 'img-responsive top-img-size')); ?>
                        
                        <?php endif; ?>
    
                        <figcaption>
        
                            <h2><?php echo $data['name']; ?></h2>
            
            				<p><?php echo $data['address']; ?></p>
            
            				<a href="<?php echo Uri::create('detail', array(), array('id' => $data['id'])); ?>">View more</a>
        
                        </figcaption>
    
                    </figure>
    
                </li>
    
            </ul>
    
        </section>
        
        <!-- 過去の記事 end-->
        
        <?php endif; ?>
        
        <?php $flag++; ?>
        
        <?php endforeach; ?>
        
        <?php endif; ?>
        
        <div class="clearfix"></div>
    
    </div>
    
    <?php if (empty($gourmet_list)): ?>
    
    <?php echo Html::anchor('register', 'Register', array('class' => 'fast-register')); ?>
    
    <?php endif; ?>

</main>

<!-- main -->