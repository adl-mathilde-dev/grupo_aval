<?php 

if(!class_exists('element_gva_adl_modal')):
   class element_gva_adl_modal{
      
      public function render_form(){
         $fields =array(
            'title' => ('Modal'), 
            'size' => 3,
            'fields' => array(
               array(
                  'id'     => 'id_modal',
                  'type'      => 'text',
                  'title'  => t('Modal id'),
               ),
               array(
                'id'        => 'auto_launch',
                'type'      => 'select',
                'title'     => t('Auto launch'),
                'options'   => array( 
                   'true'  => 'True', 
                   'false'  => 'False',
                ),
                'desc'      => t('En caso de false coloque las propiedades data-bs-toggle="modal" data-bs-target="#id" en el boton o enlace donde #id es el id del modal'),
                'class'     => 'width-1-2'
               ),
               array(
                  'id'        => 'image',
                  'type'      => 'upload',
                  'title'     => t('Image'),
                  'class'     => 'width-1-2'
               ),
               array(
                  'id'        => 'el_class',
                  'type'      => 'text',
                  'title'     => t('Extra class name'),
                  'desc'      => t('Style particular content element differently - add a class name and refer to it in custom CSS.'),
                  'class'     => 'width-1-2'
               ),
               array(
                'id'     => 'modal_content',
                'type'      => 'textarea',
                'title'  => t('Modal content')
               ),
            ),                                       
         );
         return $fields;
      }

      public static function render_content( $attr, $content = null ){
         global $base_url;
         extract(gavias_merge_atts(array(
            'id_modal'   => '',
            'auto_launch'        => 'false',
            'image'        => '',
            'modal_content'        => '',
            'el_class'        => ''
         ), $attr));

         $class_array = array();
         $class_array[] = $el_class;

         $uiid = uniqid();

         ob_start();
         ?>
            <div class="adl-modal <?php print implode(' ', $class_array) ?>">
                <div class="modal fade" id="<?php print($uiid) ?>" tabindex="-1" aria-labelledby="<?php print($uiid) ?>Label" aria-hidden="false">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                 <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                                    <img class="adl-modal-image " src="<?php echo ($base_url . $image) ?>" alt="Experiencias AVAL"/>
                                 </div>
                                 <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 adl-modal-content">
                                    <div class="adl-modal-html">
                                       <?php print $modal_content ?>
                                    </div>
                                 </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if($auto_launch == 'true'){ ?>
                <script>
                  document.addEventListener('DOMContentLoaded', function () {
                     var myModal<?php print($uiid) ?> = new bootstrap.Modal(document.getElementById('<?php print($uiid) ?>'));
                     myModal<?php print($uiid) ?>.show();
                  });
               </script>
               <?php } ?>
            </div>    
         <?php return ob_get_clean() ?>  
         <?php       
      }

   }
endif; 
