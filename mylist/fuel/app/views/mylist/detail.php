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
            
            <?php echo Form::button('button', 'delete', array('type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#delete-modal')); ?>
            
        </div>
        
        <?php echo Form::hidden('shop_id', $shop_id); ?>
    
    </div>
    
    <?php echo Form::close(); ?>
    
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
    <div class="modal-dialog" role="document">
    
        <div class="modal-content">
    
            <div class="modal-header">
        
            <h4 class="modal-title" id="exampleModalLabel"><?php echo $shop_data['name']; ?></h4>
        
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        
                <span aria-hidden="true">&times;</span>
        
                </button>
        
            </div>
        
            <div class="modal-body">
        
                <h3>Are you sure you want to delete it ?</h3>
        
            </div>
            
            <?php echo Form::open(); ?>
        
            <div class="modal-footer">
        
                <?php echo Form::button('button', 'NO', array('class' => 'modal-button-no', 'data-dismiss' => 'modal')); ?>
        
                <?php echo Form::button('button', 'YES', array('class' => 'modal-button-yes', 'onClick' => 'form.action="delete"; return true')); ?>
                
                <?php echo Form::hidden('shop_id', $shop_id); ?>
        
            </div>
            
            <?php echo Form::close(); ?>
        
        </div>
    
    </div>

</div>