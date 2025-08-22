<?php 

if(!class_exists('element_gva_adl_simple_card')):
   class element_gva_adl_simple_card{
      
      public function render_form(){
         $fields =array(
            'title' => ('Simple Card'), 
            'size' => 3,
            'fields' => array(
               array(
                  'id'     => 'title',
                  'type'      => 'text',
                  'title'  => t('Card title'),
                  'class'     => 'width-1-2'
               ),
               array(
                'id'     => 'subtitle',
                'type'      => 'text',
                'title'  => t('Card subtitle'),
                'class'     => 'width-1-2'
               ),
               array(
                'id'        => 'image',
                'type'      => 'upload',
                'title'     => t('Image'),
                'class'     => 'width-1-2'
               ),
               array(
                'id'        => 'position',
                'type'      => 'select',
                'options'   => array(
                    'left'  => 'Left',
                    'right'  => 'Right'
                ),
                'title'  => t('Image position'),
                'class'     => 'width-1-2'
               ),
               array(
                'id'        => 'overflow',
                'type'      => 'select',
                'options'   => array(
                    'true'  => 'Yes',
                    'false'  => 'No'
                ),
                'title'  => t('Overflow image 80px'),
                'class'     => 'width-1-2'
               ),
               array(
                'id'     => 'content',
                'type'      => 'textarea',
                'title'  => t('Card content')
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
            'subtitle'   => '',
            'image'   => '',
            'position'   => 'left',
            'overflow'  => 'true',
            'content'   => '',
            'text_button'   => '',
            'link'   => '',
            'target'   => '_self',
            'el_class'  => ''
         ), $attr));

         $class_array = array();
         $class_array[] = $el_class;

         ob_start();
         ?>
            <div class="adl-simple-card <?php print implode(' ', $class_array) ?>">
                <div style="<?php echo ($overflow != 'true') ? "margin: 0;": ""; ?>" class="adl-simple-card-body <?php echo ($position == 'left') ? "adl-simple-card-body-left": "adl-simple-card-body-right"; ?>">
                    <div class="row <?php if($position != 'left'){ echo "flex-row-reverse"; } ?>">
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                            <img style="<?php echo ($overflow != 'true') ? "margin: 0;": ""; ?>" class="adl-simple-card-image  <?php echo ($position == 'left') ? "adl-simple-card-image-left": "adl-simple-card-image-right"; ?>" src="<?php echo ($base_url . $image) ?>" alt="<?php print $title ?>"/>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 adl-simple-card-content  <?php echo ($position == 'left') ? "adl-simple-card-content-left": "adl-simple-card-content-right"; ?>">
                            <div class="adl-simple-card-title">
                                <?php if($title){ ?>
                                        <h2><span><?php print($title) ?></span></h2>
                                <?php } ?>
                                <?php if($subtitle){ ?>
                                        <h3><span><?php print($subtitle) ?></span></h3>
                                <?php } ?>
                            </div>
                            <?php if($content){ ?>
                                <div class="adl-simple-card-html">
                                    <?php print $content ?>
                                </div>
                            <?php } ?>
                            <?php if($text_button && $link){ ?>
                                <div class="adl-simple-card-button">
                                    <a href="<?php print $link ?>" target="<?php print $target ?>" class="btn btn-primary" role="button"><?php print $text_button ?></a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>    
         <?php return ob_get_clean() ?>  
         <?php       
      }

   }
endif; 
