<div class="form-group ">
    <label class="col-sm-3 col-xs-12 control-label  no-padding-right"
           for="<?php echo $form_item['field'] . "_" . $form_id ?>">
        <?php echo $form_item['label'] ?>
    </label>
    <div class="col-sm-8 col-xs-12">
        <?php
        //                foreach ($select_user_name as $item){echo $item["name"];}
        $type = isset($form_item['form']['type']) ? $form_item['form']['type'] : "text";
        $class = isset($form_item['form']['class']) ? $form_item['form']['class'] : "";
        $form_attr = " id='$form_item[field]_$form_id' placeholder='$form_item[label]' ";
        $form_attr .= isset($form_item['form']['attr']) ? $form_item['form']['attr'] : "";
        $form_item['rules'] = is_array($form_item['rules']) ? implode("|", $form_item['rules']) : $form_item['rules'];
        $form_attr .= " rules='$form_item[rules]' ";
        if ($value) {
            echo "<input value='$user_name' name='' type='$type' disabled class='col-xs-12 $class' $form_attr/>";
            echo "<select class='col-xs-12 $class' $form_attr>";
            foreach ($select_user_name as $item) {
                $name = $item['name'];
                echo "<option value='$name'>$name</option>";
            }
            echo "</select>";
        } else {
            echo "<input value='$user_id' name='$form_item[field]' type='hidden' class='col-xs-12 $class' $form_attr/>";
            echo "<input value='$user_name' name='' type='$type' disabled class='col-xs-12 $class' $form_attr/>";
        }
        ?>
    </div>

   