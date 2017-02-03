<div class="contat-from-wrapper work-details">
    
    <?php echo Form::open('register/complete'); ?>
        
    <div class="row">

    	<div class="col-xs-12 col-sm-12 col-md-4">

        	<header role="work-title">

            	<h2><?php echo $name; ?></h2>
            	
            	<p><strong>Address</strong>
            	
                <p><?php echo empty($address) ? '--------' : $address; ?></p>

            </header>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-8">

        	<section>

                <p><strong>Your comments</strong><br/>
                
                <p><?php echo $comments; ?></p>
                
                <!--<p><strong>Opening hour</strong><br/>-->

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

        echo Form::submit('submit', 'complete');

    ?>

    <?php echo Form::close(); ?>
    
</div>
