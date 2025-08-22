<?php 

if(!class_exists('element_gva_adl_card_beneficios')):
   class element_gva_adl_card_beneficios{
      
      public function render_form(){
         $fields =array(
            'title' => ('Card Beneficios'), 
            'size' => 3,
            'fields' => array(
               array(
                  'id'     => 'title',
                  'type'      => 'text',
                  'title'  => t('Card title'),
               ),
               array(
                  'id'        => 'sub_title',
                  'type'      => 'text',
                  'title'     => t('Card subtitle')
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
         for($i=1; $i<=6; $i++){
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
               'id'        => "image_{$i}",
               'type'      => 'upload',
               'title'     => t("Image {$i}"),
               'class'     => 'width-1-2'
             );
            $fields['fields'][] = array(
               'id'        => "link_{$i}",
               'type'      => 'text',
               'title'     => t("Link {$i}"),
               'class'     => 'width-1-2'
            );
            $fields['fields'][] = array(
               'id'        => "target_{$i}",
               'type'      => 'select',
               'title'     => t("Target {$i}"),
               'options'   => array( 
                   '_self'  => '_self',
                   '_blank'  => '_blank',  
                   '_parent'  => '_parent', 
                   '_top'  => '_top'
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
            'sub_title' => '',
            'text_button' => '',
            'link' => '',
            'target' => '_self',
            'el_class'  => ''
         );

         for($i=1; $i<=6; $i++){
            $default["title_{$i}"] = '';
            $default["image_{$i}"] = '';
            $default["link_{$i}"] = '';
            $default["target_{$i}"] = '_self';
         }

         extract(gavias_merge_atts($default, $attr));

         ob_start();
         ?>
            <div class="adl-card-beneficios <?php print($el_class) ?>">
               <div class="adl-card-beneficios-title">
                  <?php if($title){ ?>
                        <h2><span><?php print($title) ?></span></h2>
                  <?php } ?>
                  <?php if($sub_title){ ?>
                        <h3><span><?php print($sub_title) ?></span></h3>
                  <?php } ?>
               </div>
               <div class="adl-card-beneficios-body">
                  <div class="row">
                     <?php for($i=1; $i<=6; $i++){ ?>
                        <?php 
                           $title_e = "title_{$i}";
                           $image_e = "image_{$i}";
                           $link_e = "link_{$i}";
                           $target_e = "target_{$i}";
                        ?>
                        <?php if($$title_e){ ?>
                           <div class="adl-card-beneficios-body-item col">
                              <div>
                                 <?php if($$link_e){ ?>
                                       <a href="<?php print $$link_e ?>" target="<?php print $$target_e ?>">
                                 <?php } ?>
                                          <img src="<?php echo ($base_url . $$image_e) ?>" alt="<?php print $$title_e ?>"/>
                                 <?php if($$link_e){ ?>
                                       </a>
                                 <?php } ?>
                              </div>
                              <div>
                                 <?php if($$link_e){ ?>
                                    <a href="<?php print $$link_e ?>" target="<?php print $$target_e ?>">
                                 <?php } ?>
                                          <span class="adl-card-beneficios-body-item-no-link"><?php print $$title_e ?></span>
                                 <?php if($$link_e){ ?>
                                    </a>
                                 <?php } ?>
                              </div>
                           </div>
                        <?php } ?>
                     <?php } ?>
                  </div>
                  <?php if($text_button && $link){ ?>
                     <div class="adl-card-beneficios-button">
                           <a href="<?php print $link ?>" target="<?php print $target ?>" class="btn btn-primary" role="button"><?php print $text_button ?></a>
                     </div>
                  <?php } ?>
               </div>
               <div class="adl-card-beneficios-foot"></div>
            </div>    
         <?php return ob_get_clean() ?>  
         <?php       
      }

   }
endif; 
