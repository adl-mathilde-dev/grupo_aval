<?php 
use Drupal\views\Views;
use Drupal\views\Element\View; 
if(!class_exists('element_gva_adl_tabs')){
   class element_gva_adl_tabs{
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
            'type'   => 'gsc_tabs',
            'title'  => t('Tabs views'), 
            'fields' => array(      
               array(
                  'id'        => 'title',
                  'type'      => 'text',
                  'title'     => t('Title for admin'),
                  'admin'     => true
               ),
               array(
                  'id'        => 'type',
                  'type'      => 'select',
                  'options'   => array(
                     'horizontal'   => 'Horizontal',
                     'horizontal_icon'   => 'Horizontal Icon',
                     'vertical'     => 'Vertical', 
                  ),
                  'title'  => t('Style'),
                  'desc'      => t('Vertical tabs works only for column widths: 1/2, 3/4 & 1/1'),
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
                  'id'        => 'el_class',
                  'type'      => 'text',
                  'title'     => t('Extra class name'),
                  'desc'      => t('Style particular content element differently - add a class name and refer to it in custom CSS.'),
               ),
            ),                                          
         );
         for($i=1; $i<=8; $i++){
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
         }
         return $fields;
      }

      public static function render_content( $attr = array(), $content = '' ){
         $default = array(
            'title'           => '',
            'uid'             => 'tab-',
            'type'            => '',
            'el_class'        => '',
            'animate'         => '',
            'animate_delay'   => ''
         );        
         for($i=1; $i<=8; $i++){
            $default["title_{$i}"] = '';
            $default["content_{$i}"] = '';
            $default["view_{$i}"] = '-- None --';
         }
         extract(gavias_merge_atts($default, $attr)); 
         
         $_id = gavias_content_builder_makeid();
         $uid .= $_id;

         if($animate) $el_class .= ' wow' . $animate;
         ob_start();
         ?>
         <div class="gsc-tabs <?php print $el_class ?>" <?php print gavias_content_builder_print_animate_wow('', $animate_delay) ?>>
            <div class="tabs_wrapper tabs_<?php print $type ?>">
               <ul class="nav nav-tabs">
                  <?php for($i=1; $i<=8; $i++){ ?>
                     <?php 
                        $title = "title_{$i}";
                        $content = "content_{$i}";
                        $view = "view_{$i}";
                     ?>
                     <?php if($$title){ ?>
                        <li><a <?php print($i==1?'class="active show"':'') ?> data-bs-toggle="tab" data-bs-target="#<?php print ($uid .'-'. $i) ?>">  <?php print $$title ?> </a></li>
                     <?php } ?>
                  <?php } ?>
               </ul>
               <div class="tab-content">
                  <?php for($i=1; $i<=8; $i++){ ?>
                     <?php 
                        $title = "title_{$i}";
                        $content = "content_{$i}";
                        $view = "view_{$i}";
                        
                     ?>
                     <?php if($$title){ ?>
                        <div id="<?php print($uid .'-'. $i) ?>" class="tab-pane fade in <?php print($i==1?'active show':'') ?>">
                            <div>
                                <?php print $$content ?>
                            </div>
                            <?php
                                if($$view) {
                                    $output = '';
                                    
                                    $view_tmp = $$view;
                                    $_view =  preg_split("/-----/", $$view);

                                    if(isset($_view[0]) && isset($_view[1])){
                                        $output .= '<div>';
                                            $output .= '<div class="widget block clearfix gsc-block-view  gsc-block-drupal adl-block-view">';
                                            
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
                     <?php } ?>
                  <?php } ?>
               </div>
            </div>
         </div>
         <?php return ob_get_clean();
      }
   }
}


