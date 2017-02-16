<div class="work-details">

    <div class="row">

    	<div class="col-xs-12 col-sm-12 col-md-4">

        	<header role="work-title">

            	<h2><?php echo $shop_data['name']; ?></h2>
            	
            	<p><strong>Address</strong>
            	
                <p><?php echo empty($shop_data['address']) ? '-------' : $shop_data['address']; ?></p>

            </header>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-8">

        	<section>
    
                    <p><strong>Your comments</strong><br/>
                    
                    <p><?php echo empty($shop_data['comments']) ? '--------' : $shop_data['comments']; ?></p>
                    
                    <!--<p><strong>Opening hour</strong><br/>-->
                    
                    <!--<p><?php //echo empty($gnavi_data['opentime']) ? 'not found' : $gnavi_data['opentime']; ?></p>-->
                    
                    <p><strong>Store link</strong><br/>
                    
    				<?php echo empty($shop_data['url']) ? 'not found' : Html::anchor($shop_data['url'], $shop_data['name'], array('target' => '_blank')); ?></p>
    
                </section>

        </div>

    </div>

    <div class="clearfix"></div>

    <div class="work-images grid">

        <ul class="grid-lod effect-2" id="grid">

            <li><?php echo Asset::img($shop_data['image'], array('class' => 'img-responsive img-size', 'style' => 'height: 525.781px;')); ?></li>
            
        </ul>

    </div>
    
    <div class="contat-from-wrapper">
    
    <?php echo Form::open(); ?>
    
    <div class="form-inline">
        
        <div class="btn-group">
            
            <?php echo Form::submit('submit', 'modify', array('onClick' => 'form.action="modify"; return true')); ?>
            
            <?php echo Form::submit('submit', 'delete', array('onClick' => 'form.action="delete"; return true')); ?>
        
        </div>
        
        <?php echo Form::hidden('shop_id', $shop_id); ?>
    
    </<div>
    
    <?php echo Form::close(); ?>
    
    </<div>

</div>