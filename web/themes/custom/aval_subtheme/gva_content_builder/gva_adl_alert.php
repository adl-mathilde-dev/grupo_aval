<?php 

if(!class_exists('element_gva_adl_alert')):
   class element_gva_adl_alert{
      
      public function render_form(){
         $fields =array(
            //'type' => 'gsc_image',
            'title' => ('Alert'), 
            'size' => 3,
            'fields' => array(
               array(
                  'id'     => 'alert_title',
                  'type'      => 'text',
                  'title'  => t('Alert title'),
               ),
               array(
                'id'        => 'color',
                'type'      => 'select',
                'title'     => t('Alert Color'),
                'options'   => array( 
                   'alert-primary'  => 'alert-primary', 
                   'alert-secondary'  => 'alert-secondary', 
                   'alert-success'  => 'alert-success', 
                   'alert-danger'  => 'alert-danger', 
                   'alert-warning'  => 'alert-warning', 
                   'alert-info'  => 'alert-info', 
                   'alert-light'  => 'alert-light', 
                   'alert-dark'  => 'alert-dark',  
                ),
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
            'alert_title'   => '',
            'color'        => 'alert-primary',
            'el_class'        => ''
         ), $attr));

         $class_array = array();
         $class_array[] = $el_class;

         ob_start();
         ?>
            <div class="gsc-adl-alert <?php print implode(' ', $class_array) ?>">
                <div class="alert <?php print $color ?>" role="alert">
                    <?php print $alert_title ?>
                </div>
            </div>    
         <?php return ob_get_clean() ?>  
         <?php       
      }

   }
endif; 
