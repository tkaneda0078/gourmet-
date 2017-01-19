<div class="row">

	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

    	<article role="pge-title-content">

        	<header>

            	<h2><span>gourmet</span> Your favorite store. </h2>

            </header>
            
            <p>Let's continue to register your favorite shops rapidly!.</p>

        </article>

    </div>
    
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

    	<article role="pge-title-content" class="contact-header">

        	<header>

            	<?php echo Asset::img('work/works-image-2.jpg', array('class' => 'img-responsive')); ?>
            	
            	<?php echo Asset::img('work/works-image-1.jpg', array('class' => 'img-responsive')); ?>

            </header>

        </article>

    </div>

    <!-- contat-from-wrapper -->

    <div class="contat-from-wrapper">
       
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

        <div id="message"></div>

            <?php echo Form::open(array('action' => 'register', 'name' => 'cform', 'id' => 'cform', 'enctype' => 'multipart/form-data')); ?>

                <div class="row">

                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">

                        <?php echo Form::input('name', Session::get_flash('name'), array('type' => 'text', 'id' => 'name', 'placeholder' => 'Whats store name?')); ?>

                    </div>

                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">

                        <?php echo Form::input('address', Session::get_flash('address'), array('type' => 'text', 'id' => 'address', 'placeholder' => 'Where is the address?')); ?>

                    </div>

                </div>

                <div class="clearfix">
                    
                    <?php echo Form::textarea('comments', Session::get_flash('comments'), array('id' => 'comments', 'placeholder' => 'What is your comments?')); ?>
                    
                </div>

                <div class="clearfix">
                    
                    <?php echo Form::label('upload a photo', 'upload'); ?>
                    
                    <label for="file_photo" id="select_photo">
                        
                        Select photo
                        
                        <?php echo Form::file('upload', array('id' => 'file_photo', 'style' => 'display: none;')); ?>
                        
                    </label>
                    
                </div>

                    <?php echo Form::submit('submit', 'confirm'); ?>

                <div id="simple-msg"></div>

            <?php echo Form::close(); ?>

   </div>

   <!-- contat-from-wrapper -->

</div>
