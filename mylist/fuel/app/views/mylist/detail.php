<div class="work-details">

    <div class="row">

    	<div class="col-xs-12 col-sm-12 col-md-4">

        	<header role="work-title">

            	<h2><?php echo $shop_data['name']; ?></h2>
            	
                <!--<a href="#">Visit online <i class="fa fa-external-link" aria-hidden="true"></i></a>-->
                <p><?php echo $shop_data['address']; ?></p>

            </header>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-8">

        	<section>
    
                    <p><strong>コメント</strong><br/>
                    
                    <p><?php echo $shop_data['comments']; ?></p>
                    
                    <p><strong>営業時間</strong><br/>
                    
                    <p><?php echo isset($gnavi_data['opentime']) ? $gnavi_data['opentime'] : '-----------'; ?></p>
                    
                    <p><strong>店舗リンク</strong><br/>
                    
    				<?php echo isset($gnavi_data['url']) ? Html::anchor($gnavi_data['url'], $shop_data['name'], array('target' => '_blank')) : '-----------'; ?></p>
    
                </section>

        </div>

    </div>

    <div class="clearfix"></div>

    

    <div class="work-images grid">

        <ul class="grid-lod effect-2" id="grid">

            <?php foreach ($img_paths as $path): ?>

            <li><?php echo Asset::img($path, array('class' => 'img-responsive img-size', 'style' => 'height: 525.781px;')); ?></li>
            
            <?php endforeach; ?>
            
        </ul>

    </div>
    
    <div class="contat-from-wrapper">
    
    <!-- 編集は保留 -->
    <?php //echo Form::open('modify'); ?>
    
        <?php //echo Form::hidden('shop_id', $shop_id); ?>
        <?php //echo Form::submit('submit', 'modify'); ?>
    
    <?php //echo Form::close(); ?>
    <!-- 編集は保留 -->
    
    </<div>

</div>