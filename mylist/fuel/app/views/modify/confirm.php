<div class="contat-from-wrapper work-details">
    
    <?php echo Form::open('modify/complete'); ?>
        
    <div class="row">

    	<div class="col-xs-12 col-sm-12 col-md-4">

        	<header role="work-title">

            	<h2><?php echo $shop_data['name']; ?></h2>
            	
            	<p><strong>Address</strong>
            	
                <p><?php echo empty($shop_data['address']) ? '--------' : $shop_data['address']; ?></p>

            </header>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-8">

        	<section>

                <p><strong>Your comments</strong><br/>
                
                <p><?php echo empty($shop_data['comments']) ? '--------' : $shop_data['address']; ?></p>

            </section>

        </div>

    </div>
    
    <div class="clearfix"></div>
    
    <div class="work-images grid">

        <ul class="grid-lod effect-2" id="grid">

            <?php foreach ($img_paths as $path): ?>
            
            <li><?php echo Asset::img($path, array('class' => 'img-responsive img-size')); ?></li>
            
            <?php endforeach; ?>

        </ul>

    </div>
            
    <?php

        echo Form::hidden('name', $shop_data['name']);
        
        echo Form::hidden('address', $shop_data['address']);
        
        echo Form::hidden('comments', $shop_data['comments']);

        echo Form::submit('submit', 'complete');

    ?>

    <?php echo Form::close(); ?>
    
</div>
