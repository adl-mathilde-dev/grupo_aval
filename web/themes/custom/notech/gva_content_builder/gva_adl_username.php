<?php 
use Drupal\user\Entity\User;
if(!class_exists('element_gva_adl_username')):
   class element_gva_adl_username{
      
      public function render_form(){
         $fields =array(
            //'type' => 'gsc_image',
            'title' => ('Hi username'), 
            'size' => 3,
            'fields' => array(
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
            'text_alignment' => 'text-start',
            'el_class'        => ''
         ), $attr));

         $class_array = array();
         $class_array[] = $el_class;

        // Get the current user ID
        $uid = \Drupal::currentUser()->id();

        // Load the user entity
        $user = User::load($uid);

        // Get the username
        $username = $user->getAccountName();

         ob_start();
         ?>
            <div class="gsc-adl-username <?php print implode(' ', $class_array) ?>">
                <?php if ($username) { ?>
                <h3 class="<?php print $text_alignment ?>">
                    ¡Hola <?php print($username) ?>!
                </h3>
                <?php } else { ?>
                <h3 class="<?php print $text_alignment ?>">
                    ¡Hola!
                </h3>
                <?php } ?>
            </div>    
         <?php return ob_get_clean() ?>  
         <?php       
      }

   }
endif; 
