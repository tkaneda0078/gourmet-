<!-- main -->

<main role="main-inner-wrapper" class="container">

    <?php foreach (array_chunk($gnavi_data, 3) as $key => $store): ?>

    <div class="row">

    <!-- thumbnails -->

    	<div class="thumbnails-pan member-img">
    	    
    	    <?php foreach ($store as $val): ?>
    	    
    	    <?php echo Form::open(array('action' => 'gnavi/complete', 'name' => 'gform')); ?>

        	<section class="col-xs-12 col-sm-4 col-md-4 col-lg-4 ">

            	<figure class="gnavi-image-size">

                    <img src="<?php echo $val['image']; ?>">
                    

                	<figcaption>

                    	<h3><?php echo $val['name']; ?></h3>

                        <h5><?php echo $val['address']; ?></h5>
                        
                        <h6><?php echo Form::submit('submit', 'register', array('class' => 'gnavi-button')); ?></h6>
                        
                    </figcaption>

                </figure>
                
                <p>提供：ぐるなび</p>
                
            </section>
            
            <?php
    
                echo Form::hidden('id', $val['id']);
        
                echo Form::hidden('name', $val['name']);
                
                echo Form::hidden('address', $val['address']);
                
                echo Form::hidden('url', $val['url']);
                
                echo Form::hidden('image', $val['image']);

                echo Form::close();
                
                endforeach;
            ?>

        </div>

    <!-- thumbnails -->

    </div>

    <?php endforeach; ?>

</main>

<!-- main -->