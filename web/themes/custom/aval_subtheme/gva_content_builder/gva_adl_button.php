<?php 
if(!class_exists('element_gva_adl_button')):
   class element_gva_adl_button{
      
      public static function gsc_button_id($length=12){
         $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
         $randomString = '';
         for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
         }
         return $randomString;
      }

      public function render_form(){
         $fields =array(
            'type' => 'gsc_button',
            'title' => ('Simple Button'), 
            'size' => 3,
            'fields' => array(
               array(
                  'id'        => 'title',
                  'type'      => 'text',
                  'title'     => t('Title'),
                  'admin'     => true
               ),
               array(
                  'id'        => 'link',
                  'type'      => 'text',
                  'title'     => t('Link'),
               ),
               array(
                  'id'        => 'target',
                  'type'      => 'select',
                  'title'     => t('Open in new window'),
                  'desc'      => t('Adds a target="_blank" attribute to the link'),
                  'options'   => array( 'off' => 'Off', 'on' => 'On' ),
               ),
               array(
                  'id'        => 'el_class',
                  'type'      => 'text',
                  'title'     => t('Extra class name'),
                  'desc'      => t('Style particular content element differently - add a class name and refer to it in custom CSS.'),
               ),
               
            ),                                       
         );
         return $fields;
      }

      public static function render_content( $attr = array(), $content = '' ){
         global $base_url;
         extract(gavias_merge_atts(array(
            'title'          => 'Read more',
            'link'                  => '',
            'target'                => '',
            'el_class'              => ''
         ), $attr));
         $_id = 'button-' . self::gsc_button_id(12);
        
         // target
         if( $target =='on' ){
            $target = 'target="_blank"';
         } else {
            $target = false;
         }
         

         $classes = array();
         $classes[] = "{$el_class} ";

         ob_start();
         ?>
         <div class="clearfix"></div>
         <div class="<?php print implode('', $classes) ?> adl-button-body">
            <a href="<?php print $link ?>" <?php print $target ?> class="adl-button btn btn-primmary" id="<?php print $_id; ?>">
               <?php print $title ?>
            </a> 
         </div>

         <?php return ob_get_clean() ?>

         <?php       
      }

   }
endif;   




