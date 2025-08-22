<?php 

if(!class_exists('element_gva_adl_set_list')):
   class element_gva_adl_set_list{
      
      public function render_form(){
         $fields =array(
            'title' => ('Setlist'), 
            'size' => 3,
            'fields' => array(
               array(
                  'id'     => 'title',
                  'type'      => 'text',
                  'title'  => t('Card title'),
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
         for($i=1; $i<=25; $i++){
            $fields['fields'][] = array(
               'id'     => "info_{$i}",
               'type'   => 'info',
               'desc'   => "Information for item {$i}"
            );
            $fields['fields'][] = array(
               'id'        => "title_{$i}",
               'type'      => 'text',
               'title'     => t("Title {$i}")
            );
            $fields['fields'][] = array(
               'id'        => "time_{$i}",
               'type'      => 'text',
               'title'     => t("Time {$i}"),
               'class'     => 'width-1-2'
            );
            $fields['fields'][] = array(
               'id'        => "favorite_{$i}",
               'type'      => 'select',
               'title'     => t("Favorite {$i}"),
               'options'   => array( 
                   'true'  => 'true',
                   'false'  => 'false'
               ),
               'class'     => 'width-1-2'
            );
         }
         return $fields;
      }

      public static function render_content( $attr, $content = null ) {
        global $base_url;
         $default = array(
            'title'  => '',
            'el_class'  => ''
         );

         for($i=1; $i<=25; $i++){
            $default["title_{$i}"] = '';
            $default["time_{$i}"] = '';
            $default["favorite_{$i}"] = 'false';
         }

         extract(gavias_merge_atts($default, $attr));

         ob_start();
         ?>
            <div class="adl-set-list <?php print($el_class) ?>">
               <div class="dl-set-list-title">
                  <h3><?php print $title ?></h3>
               </div>
               <div class="adl-set-list-body">
                  <div>
                     <?php for($i=1; $i<=25; $i++){ ?>
                        <?php 
                           $title = "title_{$i}";
                           $time = "time_{$i}";
                           $favorite = "favorite_{$i}";
                        ?>
                        <?php if($$title){ ?>
                           <div class="adl-set-list-item">
                              <div>
                                 <span><?php print $i ?>.</span> <?php print $$title ?>
                              </div>
                              <div>
                                 <?php if($$favorite == 'true'){ ?>
                                    <i class="fas fa-star"></i>
                                 <?php } ?>
                              </div>
                              <div>
                                <?php print $$time ?>
                              </div>
                           </div>
                        <?php } ?>
                     <?php } ?>
                  </div>
               </div>
            </div>    
         <?php return ob_get_clean() ?>  
         <?php       
      }

   }
endif; 
