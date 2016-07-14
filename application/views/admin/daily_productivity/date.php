<div class="form-group ">
    <label class="col-sm-3 col-xs-12 control-label  no-padding-right"
           for="<?php echo $form_item['field'] . "_" . $form_id ?>">
        <?php echo $form_item['label'] ?>
    </label>
    <div class="col-sm-8 col-xs-12">
        <?php
        $type = isset($form_item['form']['type']) ? $form_item['form']['type'] : "text";
        $class = isset($form_item['form']['class']) ? $form_item['form']['class'] : "";
        $form_attr = " id='$form_item[field]_$form_id' placeholder='$form_item[label]' ";
        $form_attr .= isset($form_item['form']['attr']) ? $form_item['form']['attr'] : "";
        $form_item['rules'] = is_array($form_item['rules']) ? implode("|", $form_item['rules']) : $form_item['rules'];
        $form_attr .= " rules='$form_item[rules]' ";
        if (!$value) {
            $value = date("Y-m-d");
        }
        switch ($type) {
            case  "select":
            case "multiple_select":
                $multiple = $type == "multiple_select" ? "multiple" : "";
                echo "<div class='col-xs-12 no-padding'>";
                echo "<select value='$value' name='$form_item[field]' class='select2 col-xs-12 $class' $multiple $form_attr >";
                foreach ($form_item['form']['data_select'] as $s_key => $s_item) {
                    $selected = ($value != NULL && $value == $s_key) ? "selected" : "";
                    echo "<option value='$s_key' $selected>$s_item</option>";
                }
                echo "</select></div>";
                break;
            default:
                echo "<input value='$value' name='$form_item[field]' type='$type' class='col-xs-12 $class' $form_attr/>";
                break;

        } ?>
    </div>
</div>