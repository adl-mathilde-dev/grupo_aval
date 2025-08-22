<?php 

if(!class_exists('element_gva_adl_main_banner')):
   class element_gva_adl_main_banner
   {
      public function render_form()
      {
         $fields =array(
            'title' => ('Banner principal'), 
            'size' => 3,
            'fields' => array(
               array(
                  'id'     => 'title',
                  'type'      => 'text',
                  'title'  => t('Banner title'),
               ),
               array(
                  'id'        => 'el_class',
                  'type'      => 'text',
                  'title'     => t('Extra class name'),
                  'desc'      => t('Style particular content element differently - add a class name and refer to it in custom CSS.'),
               ),
            ),                                       
         );
         for($i=1; $i<=3; $i++){
            $fields['fields'][] = array(
               'id'     => "info_{$i}",
               'type'   => 'info',
               'desc'   => "Information for item {$i}"
            );
            $fields['fields'][] = array(
               'id'           => "title_{$i}",
               'type'         => 'textarea',
               'title'        => t("Title {$i}")
            );
            $fields['fields'][] = array(
               'id'        => "image_{$i}",
               'type'      => 'upload',
               'title'     => t("Image {$i}"),
               'class'     => 'width-1-2',
               'desc'   => "Image resolution 1200x600"
             );
             $fields['fields'][] = array(
               'id'        => "linkb_{$i}",
               'type'      => 'text',
               'title'     => t("Link button {$i}"),
               'class'     => 'width-1-2'
            );
            $fields['fields'][] = array(
               'id'        => "textb_{$i}",
               'type'      => 'text',
               'title'     => t("Text button {$i}"),
               'class'     => 'width-1-2'
            );
            $fields['fields'][] = array(
               'id'        => "targetb_{$i}",
               'type'      => 'select',
               'title'     => t("Target button {$i}"),
               'options'   => array(
                  '_self'  => '_self',
                  '_blank'  => '_blank',
                  '_parent'  => '_parent',
                  '_top'  => '_top'
               ),
               'class'     => 'width-1-2'
            );
            $fields['fields'][] = array(
               'id'        => "colorb_{$i}",
               'type'      => 'text',
               'title'     => t("Color button {$i}"),
               'class'     => 'width-1-2'
            );
            $fields['fields'][] = array(
               'id'           => "dot_title_{$i}",
               'type'         => 'text',
               'title'        => t("Title for nav {$i}"),
               'class'     => 'width-1-2'
            );
            $fields['fields'][] = array(
               'id'        => "colord_{$i}",
               'type'      => 'text',
               'title'     => t("Color for nav {$i}"),
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

         for($i=1; $i<=3; $i++){
            $default["info_{$i}"] = '';
            $default["title_{$i}"] = '';
            $default["image_{$i}"] = '';
            $default["linkb_{$i}"] = '';
            $default["textb_{$i}"] = '';
            $default["targetb_{$i}"] = '_self';
            $default["colorb_{$i}"] = '';
            $default["dot_title_{$i}"] = '';
            $default["colord_{$i}"] = '';
         }

         extract(gavias_merge_atts($default, $attr));
         $uid = date("YmdHis") . mt_rand(1000, 9999);
         ob_start();
         ?>

            <div class="gva-adl-main-banner">
                <div id="owl-<?php print $uid ?>" class="owl-carousel owl-theme">
                <?php for($i=1; $i<=3; $i++){ ?>
                    <?php
                        $title_e = "title_{$i}";
                        $image_e = "image_{$i}";
                        $linkb_e = "linkb_{$i}";
                        $textb_e = "textb_{$i}";
                        $targetb_e = "targetb_{$i}";
                        $colorb_e = "colorb_{$i}";
                        $dot_title_e = "dot_title_{$i}";
                        $colord_e = "colord_{$i}";
                    ?>
                    <?php if($$title_e && $$image_e){ ?>
                    <div class="item" data-hash="owl-<?php print $uid ?>-<?php print $i ?>">
                     <div class="owl-main-gradient"></div>
                        <img src="<?php echo ($base_url . $$image_e) ?>" alt="<?php print strip_tags($$dot_title_e) ?>"/>
                        <div class="gva-adl-main-banner-content">
                            <h2><?php print $$title_e ?></h2>
                            <?php if($$textb_e && $$linkb_e){ ?>
                                <div>
                                    <a style="background-color: <?php print $$colorb_e ?>;" href="<?php print $$linkb_e ?>" target="<?php print $$targetb_e ?>" class="btn btn-primary" role="button"><?php print $$textb_e ?></a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
                <?php } ?>
                </div>
                <div id="owl-hash-<?php print $uid ?>" class="owl-hash">
                    <?php for($i=1; $i<=3; $i++){ 
                     $dot_title_e = "dot_title_{$i}";
                     $colord_e = "colord_{$i}";
                     $title_e = "title_{$i}";
                     $image_e = "image_{$i}";
                     if($$title_e && $$image_e){?>
                        <?php if($i == 1){ ?>
                           <a href="#owl-<?php print $uid ?>-<?php print $i ?>" class="active">
                           <div style="border-left: <?php print $$colord_e ?> 4px solid;" class="owl-hash-item">
                              <p><?php print $$dot_title_e ?></p>
                            </div>
                           </a>
                            <?php } else { ?>
                           <a href="#owl-<?php print $uid ?>-<?php print $i ?>">
                           <div style="border-left: <?php print $$colord_e ?> 4px solid;" class="owl-hash-item">
                              <p><?php print $$dot_title_e ?></p>
                            </div>   
                           </a>                     
                            <?php } ?>
                    <?php } ?>
                    <?php } ?>
                  </div>
                </div>
            </div>
            <script>
               (function ($, Drupal) {
                  Drupal.behaviors.owlInit = {
                     attach: function (context, settings) {
                        $(document).ready(function() {
                           $('#owl-<?php print $uid ?>').owlCarousel({
                                    loop:true,
                                    margin:10,
                                    nav:true,
                                    URLhashListener:true,
                                    animateOut: 'fadeOut',
                                    startPosition: 'URLHash',
                                    responsive:{
                                       0:{
                                             items:1
                                       },
                                       600:{
                                             items:1
                                       },
                                       1000:{
                                             items:1
                                       }
                                    }
                                 })

                                 $('#owl-hash-<?php print $uid ?> a').on('click', function(e){
                                    $('#owl-hash-<?php print $uid ?>  a').removeClass('active');
                                    $(this).addClass('active');
                                 });  
                           });
                        }
                     };
                  })(jQuery, Drupal);
            </script>

         <?php return ob_get_clean() ?>  
         <?php  
        }
    }
endif;
