<div class="row">

	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

    	<article role="pge-title-content">

        	<header>

            	<h2><span>gourmet</span> Your favorite store. </h2>

            </header>
            
            <p>Let's find your favorite store.</p>

        </article>

    </div>
    
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

    	<article role="pge-title-content" class="contact-header">

        	<header>

            	<?php echo Asset::img('work/works-image-3.jpg', array('class' => 'img-responsive')); ?>

            </header>

        </article>

    </div>

    <!-- contat-from-wrapper -->

    <div class="contat-from-wrapper">
       
        <div class="clearfix">
        
        </div>

        <div id="message"></div>

            <?php echo Form::open(array('action' => 'gnavi', 'name' => 'cform', 'id' => 'cform')); ?>
                
                <section>
            
                    <div>
                        
                        <ul class="error_msg">
                            
                            <?php if (isset($gnavi_data)): ?>
                                    
                                <div class="alert alert-warning" role="alert">
                                    
                                    The store you searched could not be found.
                                
                                </div>
                                    
                            <?php endif; ?>
                            
                        </ul>
                        
                    </div>
                    
                </section>
                
                <!-- alert-messege-area start-->
                
                <section>
            
                    <div>
                        
                        <ul class="error_msg">
                            
                            <?php if (isset($error_msg)): ?>
                            
                                <?php foreach ($error_msg as $message): ?>
                                
                                <li>
                                    
                                    <div class="alert alert-danger" role="alert">
                                        
                                        <?php echo $message; ?>
                                    
                                    </div>
                                    
                                </li>
                                
                                <?php endforeach; ?>
                                
                            <?php endif; ?>
                            
                        </ul>
                        
                    </div>
                    
                </section>
                
                <!-- alert-messege-area end-->

                <div class="row">

                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">

                        <?php echo Form::input('name', Session::get_flash('name'), array('type' => 'text', 'id' => 'name', 'placeholder' => 'Whats store name?')); ?>

                    </div>

                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">

                        <?php echo Form::input('area', Session::get_flash('area'), array('type' => 'text', 'id' => 'area', 'placeholder' => 'Where is the area?')); ?>

                    </div>

                </div>

                <?php echo Form::submit('submit', 'confirm'); ?>

                <div id="simple-msg"></div>

            <?php echo Form::close(); ?>

   </div>

   <!-- contat-from-wrapper -->

</div>