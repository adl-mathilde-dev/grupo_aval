<?php

if (!class_exists('element_gva_adl_progress_bar')):
   class element_gva_adl_progress_bar
   {

      public function render_form()
      {
         $fields = array(
            'title' => ('Progress bar'),
            'size' => 3,
            'fields' => array(
               array(
                  'id'     => 'title',
                  'type'      => 'text',
                  'title'  => t('Progress title'),
               ),
               array(
                  'id'        => 'el_class',
                  'type'      => 'text',
                  'title'     => t('Extra class name'),
                  'desc'      => t('Style particular content element differently - add a class name and refer to it in custom CSS.'),
               ),
            ),
         );
         for ($i = 1; $i <= 10; $i++) {
            $fields['fields'][] = array(
               'id'     => "info_{$i}",
               'type'   => 'info',
               'desc'   => "Information for item {$i}"
            );
            $fields['fields'][] = array(
               'id'        => "image_{$i}",
               'type'      => 'upload',
               'title'     => t("Image"),
               'class'     => 'width-1-2'
            );
             $fields['fields'][] = array(
               'id'        => "number_{$i}",
               'type'      => 'text',
               'title'     => t("Number"),
               'class'     => 'width-1-2'
            );
            $fields['fields'][] = array(
               'id'        => "label_{$i}",
               'type'      => 'text',
               'title'     => t("Label"),
               'class'     => 'width-1-2'
            );
            $fields['fields'][] = array(
               'id'        => "color_{$i}",
               'type'      => 'text',
               'title'     => t("Color"),
               'class'     => 'width-1-2'
            );
         }
         return $fields;
      }

      public static function render_content($attr, $content = null)
      {
         global $base_url;
         $default = array(
            'title'  => '',
            'el_class'  => ''
         );

         for ($i = 1; $i <= 10; $i++) {
            $default["info_{$i}"] = '';
            $default["image_{$i}"] = '';
            $default["number_{$i}"] = '';
            $default["label_{$i}"] = '';
            $default["color_{$i}"] = '';
         }

         extract(gavias_merge_atts($default, $attr));

         ob_start();
?>
         <div class="adl-progress-bar <?php print($el_class) ?>">
            <?php for ($i = 1; $i <= 10; $i++) { ?>
            <?php
                $image = "image_{$i}";
                $number = "number_{$i}";
                $label = "label_{$i}";
                $color = "color_{$i}";
            ?>
            <?php if ($$label) { ?>
               <div class="adl-progress-bar-item-<?php print $i ?> adl-progress-bar-item">
                  <?php if ($$image) { ?>
                  <div class="adl-progress-bar-image">
                     <img src="<?php echo ($base_url . $$image) ?>" alt="<?php print $$label ?>" />
                  </div>
                  <?php } ?>
                  <div class="progress progress-one__content adl-progress-bar-progress" role="progressbar" aria-label="<?php print($$label) ?>" aria-valuenow="<?php print($$number) ?>" aria-valuemin="0" aria-valuemax="100">
                     <div class="progress-bar progress-one__bar" style="width: <?php print($$number) ?>%; background-color: <?php print($$color)?> !important"></div>
                     <span class="percentage progress-one__percentage"><span></span><?php print($$number) ?>%</span>
                  </div>
               </div>
            <?php }
            } ?>
         </div>
         <?php return ob_get_clean() ?>
<?php
   }
}
endif;
