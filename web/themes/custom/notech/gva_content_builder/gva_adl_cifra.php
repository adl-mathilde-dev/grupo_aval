<?php 

if(!class_exists('element_gva_adl_cifra')):
   class element_gva_adl_cifra{
      
      public function render_form(){
         $fields =array(
            'title' => ('Cifra'), 
            'size' => 3,
            'fields' => array(
               array(
                  'id'     => 'title',
                  'type'      => 'text',
                  'title'  => t('Title'),
                  'class'     => 'width-1-2'
               ),
               array(
                  'id'        => 'type_cifra',
                  'type'      => 'select',
                  'options'   => array(
                      'icon'  => 'icon',
                      'image'  => 'image'
                  ),
                  'title'  => t('Type'),
                  'class'     => 'width-1-2'
                ),
               array(
                'id'        => 'image',
                'type'      => 'upload',
                'title'     => t('Image'),
                'class'     => 'width-1-2'
               ),
               array(
                  'id'        => 'icon',
                  'title'     => t('Icon'),
                  'type'      => 'text',
                  'std'       => '',
                  'desc'     => t('Use class icon font <a target="_blank" href="http://fontawesome.io/icons/">Icon Awesome</a> or <a target="_blank" href="http://gaviasthemes.com/icons/icons-2/">Custom icon</a>'),
                  'class'     => 'width-1-2'
               ),
               array(
                'id'        => 'number',
                'type'      => 'text',
                'title'     => t('Number'),
                'class'     => 'width-1-2'
               ),
               array(
                  'id'        => 'symbol',
                  'title'     => t('Symbol'),
                  'type'      => 'text',
                  'class'     => 'width-1-2'
               ),
               array(
                  'id'        => 'symbol_position',
                  'type'      => 'select',
                  'options'   => array(
                      'after'  => 'after',
                      'before'  => 'before'
                  ),
                  'title'  => t('Symbol position'),
                  'class'     => 'width-1-2'
                ),
               array(
                'id'        => 'text_cifra',
                'type'      => 'text',
                'title'     => t('Text'),
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
            'type_cifra' => 'icon',
            'image'   => '',
            'icon'   => '',
            'number'   => '',
            'symbol'   => '+',
            'symbol_position' => 'after',
            'text_cifra'   => '',
            'link'   => '',
            'target'   => '_self',
            'el_class'  => ''
         ), $attr));

         $class_array = array();
         $class_array[] = $el_class;

         ob_start();
         ?>
            <div class="adl-cifra <?php print implode(' ', $class_array) ?>">
                <?php if($type_cifra == 'image'){ ?>
                <div class="adl-cifra-image">
                    <img src="<?php echo ($base_url . $image) ?>" alt="<?php print $title ?>"/>
                </div>
                <?php } else { ?>
                <div class="adl-cifra-icon">
                    <i class="<?php print $icon ?>"></i>
                </div>
                <?php } ?>
                <?php if($number){ ?>
                <div class="adl-cifra-number">
                    <?php if($symbol_position == 'before') { ?><span><?php print $symbol ?></span> <?php } ?><span><?php print $number ?></span><?php if($symbol_position == 'after') { ?> <span><?php print $symbol ?></span><?php } ?>
                </div>
                <?php } ?>  
                <?php if($link){ ?>
                <div class="adl-cifra-text">
                    <a href="<?php print $link ?>" target="<?php print $target ?>">
                        <span><?php print $text_cifra ?></span>
                    </a>
                </div>
                <?php } else { ?>
                <div class="adl-cifra-text">
                    <span><?php print $text_cifra ?></span>
                </div>
                <?php } ?>
            </div>
        
         <?php return ob_get_clean() ?>  
         <?php       
      }

   }
endif; 
