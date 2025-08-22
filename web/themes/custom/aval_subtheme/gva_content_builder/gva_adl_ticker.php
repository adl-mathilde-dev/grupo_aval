<?php 

if(!class_exists('element_gva_adl_ticker')):
   class element_gva_adl_ticker{
      
      public function render_form(){
         $fields =array(
            'title' => ('Ticker'), 
            'size' => 3,
            'fields' => array(
               array(
                  'id'     => 'title',
                  'type'      => 'text',
                  'title'  => t('Ticker title'),
               ),
               array(
                  'id'        => 'ticker_time',
                  'type'      => 'text',
                  'title'     => t('Tickertime'),
                  'desc'      => t('Example: 30s.'),
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
         for($i=1; $i<=10; $i++){
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

      public static function render_content( $attr, $content = null ){
         $default = array(
            'title'  => '',
            'ticker_time' => '30s',
            'el_class'  => ''
         );

         for($i=1; $i<=10; $i++){
            $default["title_{$i}"] = '';
            $default["link_{$i}"] = '';
            $default["target_{$i}"] = '_self';
         }

         extract(gavias_merge_atts($default, $attr));

         ob_start();
         ?>
            <div class="ticker-wrap <?php print($el_class) ?>">
               <div class="ticker" style="animation-duration: <?php print($ticker_time) ?>; -webkit-animation-duration: <?php print($ticker_time) ?>;">
               <?php for($i=1; $i<=10; $i++){ ?>
                     <?php 
                        $title = "title_{$i}";
                        $link = "link_{$i}";
                        $target = "target_{$i}";
                     ?>
                     <?php if($$title){ ?>
                        <div class="ticker__item">
                        <?php if($$link){ ?>
                           <a href="<?php print $$link ?>" target="<?php print $$target ?>">
                        <?php } ?>
                        <?php print $$title ?>
                        <?php if($$link){ ?>
                           </a>
                        <?php } ?>
                        </div>
                     <?php } ?>
                  <?php } ?>
               </div>
            </div>    
         <?php return ob_get_clean() ?>  
         <?php       
      }

   }
endif; 
