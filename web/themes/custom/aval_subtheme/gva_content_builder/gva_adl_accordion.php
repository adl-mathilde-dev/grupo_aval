<?php
use Drupal\views\Views;
use Drupal\views\Element\View; 
if(!class_exists('element_gva_adl_accordion')):
   class element_gva_adl_accordion{
      public function render_form(){
         $view_options = Views::getViewsAsOptions(TRUE, 'all', NULL, FALSE, TRUE);
         $view_display = array();
         foreach ($view_options as $view_key => $view_name) {
            $view = Views::getView($view_key);
            $view_display[''] = '-- None --';
            foreach ($view->storage->get('display') as $name => $display) {
               if($display['display_plugin']=='block'){
                  $view_display[$view_key . '-----' . $name] = $view_name .' || '. $display['display_title'];
               }
            }
         }
         asort($view_display);
         $fields = array(
            'type'      => 'element_gva_adl_accordion',
            'title'  => t('Accordion View'), 
            'fields' => array(
               array(
                  'id'     => 'title',
                  'type'      => 'text',
                  'title'  => t('Title'),
                  'admin'     => true
               ),
               array(
                  'id'        => 'style',
                  'type'      => 'select',
                  'title'     => t('Style'),
                  'options'   => array( 
                     'skin-white'         => 'Background White',
                     'skin-dark'          => 'Background Dark',
                     'skin-white-border'  => 'Background White Border',
                  ),
               ),
               array(
                  'id'        => 'animate',
                  'type'      => 'select',
                  'title'     => t('Animation'),
                  'desc'      => t('Entrance animation for element'),
                  'options'   => gavias_content_builder_animate(),
                  'class'     => 'width-1-2'
               ), 
               array(
                  'id'        => 'animate_delay',
                  'type'      => 'select',
                  'title'     => t('Animation Delay'),
                  'options'   => gavias_content_builder_delay_wow(),
                  'desc'      => '0 = default',
                  'class'     => 'width-1-2'
               ), 
               array(
                  'id'     => 'el_class',
                  'type'      => 'text',
                  'title'  => t('Extra class name'),
                  'desc'      => t('Style particular content element differently - add a class name and refer to it in custom CSS.'),
               ),
            ),                                           
         );
         for($i=1; $i<=12; $i++){
            $blocks = gavias_content_builder_get_blocks_options();
            $blocks = ['' => '--No module--'] + $blocks;

            $fields['fields'][] = array(
               'id'     => "info_{$i}",
               'type'   => 'info',
               'desc'   => "Information for item {$i}",
            );
            $fields['fields'][] = array(
               'id'        => "title_{$i}",
               'type'      => 'text',
               'title'     => t("Title {$i}")
            );
            $fields['fields'][] = array(
               'id'           => "content_{$i}",
               'type'         => 'textarea',
               'title'        => t("Content {$i}")
            );
            $fields['fields'][] = array(
               'id'        => "view_{$i}",
               'type'      => 'select',
               'title'     => t("View Name {$i}"),
               'options'   => $view_display,
            );
            $fields['fields'][] = array(
                'id'        => "block_item_{$i}",
                'type'      => 'select',
                'title'     => t("Block Name {$i}"),
                'options'   => $blocks,
            );
         }
      return $fields;
      }

      public static function render_content( $attr = array(), $content = '' ){
         $default = array(
            'title'           => '',
            'style'           => '',
            'animate'         => '',
            'animate_delay'   => '',
            'el_class'        => ''
         );
         for($i=1; $i<=12; $i++){
            $default["title_{$i}"] = '';
            $default["content_{$i}"] = '';
            $default["view_{$i}"] = '-- None --';
            $default["block_item_{$i}"] = '';
         }
         extract(gavias_merge_atts($default, $attr));
         
         $_id = 'accordion-' . gavias_content_builder_makeid();
         $classes = $style;
         
         if($el_class) $classes .= ' ' . $el_class;

         if($animate) $classes .= ' wow ' . $animate; 
         ob_start();
         ?>
    
         <div class="gsc-accordion<?php print $el_class ?>" <?php print gavias_content_builder_print_animate_wow('', $animate_delay) ?>>
            <div class="panel-group <?php print $classes ?>" id="<?php print $_id; ?>">
              <?php for($i=1; $i<=12; $i++){ ?>
                  <?php 
                     $title = "title_{$i}";
                     $content = "content_{$i}";
                     $view = "view_{$i}";
                     $block_item = "block_item_{$i}";
                  ?>
                  <?php if($$title){ ?>
                     <div class="panel panel-default">
                        <div class="panel-heading">
                           <h4 class="panel-title">
                             <a role="button" data-bs-toggle="collapse" class="<?php print ($i == 1) ? '' : 'collapsed' ?>" data-bs-target="#<?php print ($_id . '-' . $i); ?>">
                               <?php print $$title ?>
                             </a>
                           </h4>
                        </div>
                        <div id="<?php print ($_id . '-' . $i) ?>" class="panel-collapse collapse <?php print($i==1 ? 'show' : '') ?>" data-bs-parent="#<?php print $_id; ?>">
                           <?php if($$content){ ?>
                            <div>
                                <?php print $$content ?>
                            </div>
                            <?php } ?>

                            <?php $output = ''; ?>

                           <?php if (!empty($$block_item)) {
                                    $output .= '<div class=" clearfix widget gsc-block-drupal" ' . gavias_content_builder_print_animate_wow('', $animate_delay) . '>';
                                    $output .= gavias_content_builder_render_block($$block_item);
                                    $output .= '</div>';
                                 } ?>

                           <?php

                           if($$view) {
                              
                              $view_tmp = $$view;
                              $_view =  preg_split("/-----/", $$view);

                              if(isset($_view[0]) && isset($_view[1])){
                                 $output .= '<div>';
                                    $output .= '<div class="widget block clearfix gsc-block-view  gsc-block-drupal block-view">';
                                    
                                    try{
                                       $view = Views::getView($_view[0]);
                                       if($view){
                                          $v_output = $view->buildRenderable($_view[1], [], FALSE);
                                          if($v_output){
                                             if($view->getTitle() && $show_title == 'title_view'){
                                                $output .= '<h2 class="block-title title-view"><span>' . $view->getTitle() . '</span></h2>';
                                             }
                                             $v_output['#view_id'] = $view->storage->id();
                                             $v_output['#view_display_show_admin_links'] = $view->getShowAdminLinks();
                                             $v_output['#view_display_plugin_id'] = $view->display_handler->getPluginId();
                                             views_add_contextual_links($v_output, 'block', $_view[1]);
                                             $v_output = View::preRenderViewElement($v_output);
                                             if (empty($v_output['view_build'])) {
                                               $v_output = ['#cache' => $v_output['#cache']];
                                             }
                                             if($v_output){
                                               $output .=  \Drupal::service('renderer')->render($v_output);
                                             }
                                          }
                                       }else{
                                          $output .= '<div>Missing view, block "'.$view_tmp.'"</div>';
                                       }
                                    }catch(PluginNotFoundException $e){
                                          $output .= '<div>Missing view, block "'.$view_tmp.'"</div>';
                                    }
                                 $output .= '</div></div>';
                                 
                                 $view = null;
                                 $v_output = null;
                              }
                           }
                           ?>

                           <?php print $output ?>

                        </div>
                     </div>
                  <?php } ?>   
               <?php } ?>  
            </div>
         </div>   
         <?php  return ob_get_clean() ?>
      <?php    
      }
   }

endif;