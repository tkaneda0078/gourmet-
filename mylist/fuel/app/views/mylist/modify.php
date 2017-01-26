<div class="row">

    <div class="clearfix">
        
        <!-- alert-messege-area -->
        
        <section>
            
            <div>
                
                <ul class="error_msg">
                    
                    <?php if (isset($error_msg)): ?>
                    
                        <?php foreach ($error_msg as $message): ?>
                        
                        <li>
                            
                            <?php echo $message; ?>
                            
                        </li>
                        
                        <?php endforeach; ?>
                        
                    <?php endif; ?>
                    
                </ul>
                
            </div>
            
        </section>
    
        <!-- alert-messege-area -->
        
    </div>
    
    <!-- contat-from-wrapper -->

   <div class="contat-from-wrapper">

        <div id="message"></div>

            <?php echo Form::open(array('action' => 'register')); ?>

                <div class="row">

                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">

                        <?php echo Form::input('name', $shop_data['name'], array('type' => 'text', 'id' => 'name', 'placeholder' => 'Whats store name?')); ?>

                    </div>

                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">

                        <?php echo Form::input('address', $shop_data['address'], array('type' => 'text', 'id' => 'address', 'placeholder' => 'Where is the address?')); ?>

                    </div>

                </div>

                <div class="clearfix">
                    
                    <?php echo Form::textarea('comments', $shop_data['comments'], array('id' => 'comments', 'placeholder' => 'What is your comments?')); ?>
                    
                </div>
                
                <div class="work-images grid">

                    <ul class="grid-lod effect-2" id="grid">
            
                        <?php foreach ($img_paths as $path): ?>
            
                        <li><?php echo Asset::img($path, array('class' => 'img-responsive img-size')); ?></li>
                        
                        <?php endforeach; ?>
                        
                    </ul>
            
                </div>

                    <?php echo Form::submit('submit', 'confirm'); ?>

                <div id="simple-msg"></div>

            <?php echo Form::close(); ?>

   </div>

   <!-- contat-from-wrapper -->

</div>
