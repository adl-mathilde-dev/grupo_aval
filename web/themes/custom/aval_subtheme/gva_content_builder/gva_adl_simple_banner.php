<?php 

if(!class_exists('element_gva_adl_simple_banner')):
   class element_gva_adl_simple_banner{
      
      public function render_form(){
         $fields =array(
            'title' => ('Simple banner'), 
            'size' => 3,
            'fields' => array(
               array(
                  'id'     => 'title',
                  'type'      => 'text',
                  'title'  => t('Banner title'),
                  'class'     => 'width-1-2'
               ),
               array(
                'id'        => 'image',
                'type'      => 'upload',
                'title'     => t('Image'),
                'class'     => 'width-1-2'
               ),
               array(
                  'id'        => 'type_button',
                  'type'      => 'select',
                  'options'   => array(
                      'button'  => 'button',
                      'arrow'  => 'arrow'
                  ),
                  'title'  => t('Target Link'),
                  'class'     => 'width-1-2'
                ),
               array(
                'id'        => 'text_button',
                'type'      => 'text',
                'title'     => t('Text Button'),
                'class'     => 'width-1-2'
               ),
               array(
                  'id'        => 'link',
                  'type'      => 'text',
                  'title'     => t('Link Button'),
                  'class'     => 'width-1-2'
               ),
               array(
                  'id'        => 'target',
                  'type'      => 'select',
                  'options'   => array(
                      '_self'  => '_self',
                      '_blank'  => '_blank',  
                      '_parent'  => '_parent', 
                      '_top'  => '_top'
                  ),
                  'title'  => t('Target Link'),
                  'class'     => 'width-1-2'
                ),
                array(
                  'id'        => 'el_class',
                  'type'      => 'text',
                  'title'     => t('Extra class name'),
                  'desc'      => t('Style particular content element differently - add a class name and refer to it in custom CSS.'),
                  'class'     => 'width-1-2'
                ),
            ),                                       
         );
         return $fields;
      }

      public static function render_content( $attr, $content = null ){
         global $base_url;
         extract(gavias_merge_atts(array(
            'title'   => '',
            'image'   => '',
            'type_button'   => 'button',
            'text_button'   => '',
            'link'   => '',
            'target'   => '_self',
            'el_class'  => ''
         ), $attr));

         $class_array = array();
         $class_array[] = $el_class;

         ob_start();
         ?>
            <div class="adl-simple-banner <?php print implode(' ', $class_array) ?>">
                <div class="adl-simple-gradient"></div>
                <img class="adl-simple-banner-image " src="<?php echo ($base_url . $image) ?>" alt="<?php print $title ?>"/>
                <div class="adl-simple-banner-title">
                    <div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                <?php if($title){ ?>
                    <h2><span><?php print($title) ?></span></h2>
                <?php } ?>    
                <?php if($type_button == 'button'){ ?>
                    <div class="adl-simple-banner-button">
                        <a href="<?php print $link ?>" target="<?php print $target ?>" class="btn btn-primary" role="button"><?php print $text_button ?></a>
                    </div>
                <?php } ?>
                </div>
                <?php if($type_button == 'arrow'){ ?>
                <div class="adl-simple-banner-arrow">
                    <a href="<?php print $link ?>" target="<?php print $target ?>" class="btn-arrow" role="button">></a>
                </div>
                <?php } ?>
            </div>
        
         <?php return ob_get_clean() ?>  
         <?php       
      }

   }
endif; 
