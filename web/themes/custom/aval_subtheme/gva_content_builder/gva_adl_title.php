<?php 

if(!class_exists('element_gva_adl_title')):
   class element_gva_adl_title{
      
      public function render_form(){
         $fields =array(
            //'type' => 'gsc_image',
            'title' => ('Simple Title'), 
            'size' => 3,
            'fields' => array(
               array(
                  'id'     => 'title',
                  'type'      => 'text',
                  'title'  => t('Title'),
               ),
               array(
                'id'        => 'title_type',
                'type'      => 'select',
                'title'     => t('Title type'),
                'options'   => array( 
                   'h2'  => 'h2',
                   'h3'  => 'h3',
                   'h4'  => 'h4',
                   'h5'  => 'h5',
                   'h6'  => 'h6',
                ),
                'class'     => 'width-1-2'
               ),
               array(
                'id'        => 'font_color',
                'type'      => 'select',
                'title'     => t('Title font color'),
                'options'   => array( 
                   '#ebeb31' => 'amarillo', 
                   '#080994' => 'azul', 
                   '#fff' => 'blanco', 
                   '#F1441D' => 'naranja', 
                   '#000' => 'negro', 
                   '#6debab' => 'agua marina',  
                ),
                'class'     => 'width-1-2'
               ),
               array(
                'id'        => 'background_color',
                'type'      => 'select',
                'title'     => t('Title background color'),
                'options'   => array( 
                   '#ebeb31' => 'amarillo', 
                   '#080994' => 'azul', 
                   '#fff' => 'blanco', 
                   '#F1441D' => 'naranja', 
                   '#000' => 'negro', 
                   '#6debab' => 'agua marina', 
                   'transparent' => 'transparent', 
                ),
                'class'     => 'width-1-2'
               ),
               array(
                  'id'        => 'text_alignment',
                  'type'      => 'select',
                  'title'     => t('Text alignment'),
                  'options'   => array( 
                     'text-start' => 'start', 
                     'text-center' => 'center', 
                     'text-end' => 'end',   
                  ),
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
            )                                     
         );
         return $fields;
      }

      public static function render_content( $attr, $content = null ){
         global $base_url;
         extract(gavias_merge_atts(array(
            'title'   => '',
            'title_type' => 'h2',
            'font_color'        => '#000',
            'background_color'        => '#000',
            'text_alignment' => 'text-start',
            'link' => '',
            'target' => '_self',
            'el_class'        => ''
         ), $attr));

         $class_array = array();
         $class_array[] = $el_class;

         ob_start();
         ?>
            <div class="gsc-adl-title <?php print implode(' ', $class_array) ?>">
                <<?php print $title_type ?> class="adl-h-title <?php print $text_alignment ?>">
                    <?php if($link){ ?>
                        <a href="<?php print $link ?>" target="<?php print $target ?>">
                    <?php } ?>
                        <span style="background-color: <?php print $background_color ?>; color: <?php print $font_color ?>; ">
                            <?php print $title ?>
                        </span>
                    <?php if($link){ ?>
                        </a>
                    <?php } ?>
                </<?php print $title_type ?>>
            </div>    
         <?php return ob_get_clean() ?>  
         <?php       
      }

   }
endif; 
