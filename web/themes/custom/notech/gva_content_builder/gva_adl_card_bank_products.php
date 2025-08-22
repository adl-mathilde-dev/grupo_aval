<?php

if (!class_exists('element_gva_adl_card_bank_products')):
   class element_gva_adl_card_bank_products
   {

      public function render_form()
      {
         $fields = array(
            'title' => ('Card bank products'),
            'size' => 3,
            'fields' => array(
               array(
                  'id'     => 'title',
                  'type'      => 'text',
                  'title'  => t('Card title'),
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
         for ($i = 1; $i <= 25; $i++) {
            $fields['fields'][] = array(
               'id'     => "info_{$i}",
               'type'   => 'info',
               'desc'   => "Information for item {$i}"
            );
            $fields['fields'][] = array(
               'id'        => "id_tag_{$i}",
               'type'      => 'text',
               'title'     => t("Element id"),
               'class'     => 'width-1-2'
            );
            $fields['fields'][] = array(
               'id'        => "title_{$i}",
               'type'      => 'text',
               'title'     => t("Title"),
               'class'     => 'width-1-2'
            );
            $fields['fields'][] = array(
               'id'        => "image_{$i}",
               'type'      => 'upload',
               'title'     => t("Image"),
               'class'     => 'width-1-2'
            );
            $fields['fields'][] = array(
               'id'        => "content_{$i}",
               'type'      => 'textarea',
               'title'     => t("Content")
            );
            $fields['fields'][] = array(
               'id'        => "linkb1_{$i}",
               'type'      => 'text',
               'title'     => t("Link button 1"),
               'class'     => 'width-1-2'
            );
            $fields['fields'][] = array(
               'id'        => "textb1_{$i}",
               'type'      => 'text',
               'title'     => t("Text button 1"),
               'class'     => 'width-1-2'
            );
            $fields['fields'][] = array(
               'id'        => "targetb1_{$i}",
               'type'      => 'select',
               'title'     => t("Target button 1"),
               'options'   => array(
                  '_self'  => '_self',
                  '_blank'  => '_blank',
                  '_parent'  => '_parent',
                  '_top'  => '_top'
               )
            );
            $fields['fields'][] = array(
               'id'        => "linkb2_{$i}",
               'type'      => 'text',
               'title'     => t("Link button 2"),
               'class'     => 'width-1-2'
            );
            $fields['fields'][] = array(
               'id'        => "textb2_{$i}",
               'type'      => 'text',
               'title'     => t("Text button 2"),
               'class'     => 'width-1-2'
            );
            $fields['fields'][] = array(
               'id'        => "targetb2_{$i}",
               'type'      => 'select',
               'title'     => t("Target button 2"),
               'options'   => array(
                  '_self'  => '_self',
                  '_blank'  => '_blank',
                  '_parent'  => '_parent',
                  '_top'  => '_top'
               )
            );
         }
         return $fields;
      }

      public static function render_content($attr, $content = null)
      {
         global $base_url;
         $default = array(
            'title'  => '',
            'text_button' => '',
            'link' => '',
            'target' => '_self',
            'el_class'  => ''
         );

         for ($i = 1; $i <= 25; $i++) {
            $default["id_tag_{$i}"] = '';
            $default["title_{$i}"] = '';
            $default["image_{$i}"] = '';
            $default["content_{$i}"] = '';
            $default["textb1_{$i}"] = '';
            $default["linkb1_{$i}"] = '';
            $default["targetb1_{$i}"] = '_self';
            $default["textb2_{$i}"] = '';
            $default["linkb2_{$i}"] = '';
            $default["targetb2_{$i}"] = '_self';
         }

         extract(gavias_merge_atts($default, $attr));

         ob_start();
?>
         <div class="adl-card-bank_products <?php print($el_class) ?>">
            <div class="adl-card-bank_products-title">
               <?php if ($title) { ?>
                  <h2><span><?php print($title) ?></span></h2>
               <?php } ?>
            </div>
            <div class="adl-card-bank_products-main">
               <div class="row">
                  <?php for ($i = 1; $i <= 25; $i++) { ?>
                     <?php
                     $id_tag = "id_tag_{$i}";
                     $title_e = "title_{$i}";
                     $image_e = "image_{$i}";
                     $content_e = "content_{$i}";
                     $textb1_e = "textb1_{$i}";
                     $linkb1_e = "linkb1_{$i}";
                     $targetb1_e = "targetb1_{$i}";
                     $textb2_e = "textb2_{$i}";
                     $linkb2_e = "linkb2_{$i}";
                     $targetb2_e = "targetb2_{$i}";
                     ?>
                     <?php if ($$title_e) { ?>
                        <div id="<?php print($$id_tag) ?>" class="adl-card-bank_products-body-item col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-4">
                           <div>
                              <div class="adl-card-bank_products-body-item-image">
                                 <?php if ($$image_e) { ?>
                                    <img src="<?php echo ($base_url . $$image_e) ?>" alt="<?php print $$title_e ?>" />
                                 <?php } ?>
                              </div>
                              <div class="adl-card-bank_products-body">
                                 <?php if ($$title_e) { ?>
                                    <h3><span><?php print($$title_e) ?></span></h3>
                                 <?php } ?>
                                 <?php if ($$content_e) { ?>
                                    <div class="adl-card-bank_products-body-content"><?php print $$content_e ?></div>
                                 <?php } ?>
                                    <div class="adl-card-bank_products-body-buttons">
                                       <div>
                                          <?php if ($$linkb1_e && $$textb1_e) { ?>
                                             <a href="<?php print $$linkb1_e ?>" target="<?php print $$targetb1_e ?>" class="btn btn-primary btn-1-adl" role="button"><?php print $$textb1_e ?></a>
                                          <?php } ?>
                                       </div>
                                       <div>
                                          <?php if ($$linkb2_e && $$textb2_e) { ?>
                                             <a href="<?php print $$linkb2_e ?>" target="<?php print $$targetb2_e ?>" class="btn btn-primary btn-2-adl" role="button"><?php print $$textb2_e ?></a>
                                          <?php } ?>
                                       </div>
                                    </div>
                              </div>
                           </div>
                        </div>
                     <?php } ?>
                  <?php } ?>
               </div>
               <?php if ($text_button && $link) { ?>
                  <div class="adl-card-bank_products-button">
                     <a href="<?php print $link ?>" target="<?php print $target ?>" class="btn btn-primary" role="button"><?php print $text_button ?></a>
                  </div>
               <?php } ?>
            </div>
            <div class="adl-card-bank_products-foot"></div>
         </div>
         <?php return ob_get_clean() ?>
<?php
      }
   }
endif;
