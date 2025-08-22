<?php 

if(!class_exists('element_gva_adl_simple_card_text')):
   class element_gva_adl_simple_card_text {
      
      public function render_form(){
         $fields =array(
            'title' => ('Simple Card Text'), 
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
            <div class="adl-simple-card-text <?php print implode(' ', $class_array) ?>">
                <div class="adl-simple-card-text-body">
                    <div class="adl-simple-card-text-content">
                        <div class="adl-simple-card-text-title">
                            <?php if($title){ ?>
                                <h2><span><?php print($title) ?></span></h2>
                            <?php } ?>
                            <?php if($subtitle){ ?>
                                <h3><span><?php print($subtitle) ?></span></h3>
                            <?php } ?>
                        </div>
                        <?php if($content){ ?>
                            <div class="adl-simple-card-text-html">
                                <?php print $content ?>
                            </div>
                        <?php } ?>
                        <?php if($text_button && $link){ ?>
                            <div class="adl-simple-card-text-button">
                                <a href="<?php print $link ?>" target="<?php print $target ?>" class="btn btn-primary" role="button"><?php print $text_button ?></a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>    
         <?php return ob_get_clean() ?>  
         <?php       
      }
   }
endif; 
