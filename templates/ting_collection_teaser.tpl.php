<?php 
$collection_fields = field_info_instances('ting_collection');
$object_fields = field_info_instances('ting_object');
$uri = entity_uri('ting_collection', $object);
$faust = $object->ting_primary_object['und'][0]['id'];
$primary_object = entity_load('ting_object',array(),array('ding_entity_id' => array($faust))); 
$primary_object = reset($primary_object);
?>
<div class="ting-object view-mode-teaser clearfix">

    <div class="ting-object view-mode-search-result imagestyle-ding-medium clearfix">
        <div class="heading"><h2><a href="<?php echo url($uri['path'], $uri['options']) ?>"><?php echo $object->title ?></a></h2></div>
       <?php 
        
        $cover = ting_covers_field_formatter_view('ting_object', $primary_object,array('type' => 'ting_cover'), $object_fields['ting_object']['ting_cover'], 'und', array('local_id' => $primary_object->id), $object_fields['ting_object']['ting_cover']['display']['teaser']);
        echo render($cover);
        ?>
        <div class="content">
        <?php 
        $return = ting_field_formatter_view('ting_object', $primary_object, array('type' => 'ting_author_default'), $object_fields['ting_object']['ting_author'], 'und', array('id' => $primary_object->id), $object_fields['ting_object']['ting_author']['display']['teaser']); 
        echo render($return);
        ?>    
        </div>
        <div class="content">
          <?php  
          $return = ting_field_formatter_view('ting_object', $primary_object, array('type' => 'ting_abstract_default'), $object_fields['ting_object']['ting_abstract'], 'und', array('id' => $primary_object->id), $object_fields['ting_object']['ting_abstract']['display']['teaser']);
          if(!empty($return['id']['#markup']))
          {
            echo  render($return);
          }
          ?>
        </div>
        <div>
            <?php 
            $return = ting_field_formatter_view('ting_object', $primary_object, array('type' => 'ting_series_default'), $object_fields['ting_object']['ting_series'], 'und', array('id' => $primary_object->id), $object_fields['ting_object']['ting_series']['display']['teaser']);
            if(sizeof($return))
            {
                echo "<span><b>Serie:</b> </span>";
            }
            echo render($return);
                    ?>
        </div>
        <div class="subjects content">
            
            <?php 
             if (count($primary_object->subjects) == TRUE) {
                echo "<span><b>Emneord: </b></span>";
                $subjects = array();
                foreach ($primary_object->subjects as $subject) {
                  $subjects[] = l($subject, 'search/ting/term.subject="' . $subject . '"', array('attributes' => array('class' => array('subject'))));
                }
                echo implode(' ', $subjects);
              }
            ?>
     </div>
    <div class="availability content">
        <?php
        $item = array('id' => $object->id);
        $display = $collection_fields['ting_collection']['ting_collection_types']['display']['teaser'];
        $avail_elem = ding_availability_field_formatter_view('ting_collection',$object,array('type' => 'ting_collection_types'),$collection_fields['ting_collection']['ting_collection_types'],'und',$item,$display);
        echo render($avail_elem);
        ?>
    </div>    
</div>

