<div class="contat-from-wrapper">
    
    <?php echo Form::open('register/complete'); ?>
        
    <div class="row">

    	<div class="col-xs-12 col-sm-12 col-md-4">

        	<header role="work-title">

            	<h2><?php echo $name; ?></h2>
            	
                <p><?php echo $address; ?></p>

            </header>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-8">

        	<section>

                <p><strong>Your comments</strong><br/>
                
                <p><?php echo $comments; ?></p>
                
                <p><strong>Opening hour</strong><br/>
                
                <p><?php echo empty($opentime) ? 'not found' : $opentime; ?></p>
                
                <p><strong>Store link</strong><br/>
                
				<?php echo empty($url) ? 'not found' : Html::anchor($url, $name, array('target' => '_blank')); ?></p>

            </section>

        </div>

    </div>
    
    <div class="clearfix"></div>
    
    <div class="work-images grid">

        <ul class="grid-lod effect-2" id="grid">

            <li><?php echo Asset::img($img_path, array('class' => 'img-responsive img-size', 'style' => 'height: 525.781px;')); ?></li>

        </ul>

    </div>
            
    <?php

        echo Form::hidden('name', $name);
        
        echo Form::hidden('address', $address);
        
        echo Form::hidden('comments', $comments);
        
        // echo Form::hidden('img_path', $img_path);
        
        echo Form::submit('submit', 'complete');

    ?>

    <?php echo Form::close(); ?>
    
</div>
