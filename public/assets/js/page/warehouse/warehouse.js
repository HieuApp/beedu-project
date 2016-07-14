/**
 * Created by ha on 07/05/2016.
 */
$(document).ready(function () {
    $(document).on("click", "#add-detail-ix", add_detail_ix);
    $(document).on("change", "#order-type-input", order_type_input);
    $(document).on("click", ".remCF", delete_line);
    $(".export-title").show();
    $(".import-title").hide();
    $(".import-receiver-unit").hide();
    $(".export-lot-code").show();
    function delete_line(e) {
        $(this).parent().parent().remove();
        var old_weight_count = parseInt($("#input_weight_count").val());
        $("#input_weight_count").val(old_weight_count - 1);
    }

    function add_detail_ix(e) {
        var old_weight_count = parseInt($("#input_weight_count").val());
        $("#input_weight_count").val(old_weight_count + 1);
        var add_detail_weight = $(".weight-detail-template .weight-detail-inner").clone();
        add_detail_weight.find(".select_name_input").attr("name", "material_name_" + old_weight_count);
        add_detail_weight.find(".num_quantity_input").attr("name", "quantity_" + old_weight_count);
        add_detail_weight.find(".text_note_input").attr("name", "item_note_" + old_weight_count);
        $(".add-detail-ix-place-holder").append(add_detail_weight);
    }

    function order_type_input(e) {
        var input = $('#order-type-input :selected').val();
        if (input == 1) {
            $(".export-title").hide();
            $(".import-title").show();
            $(".import-receiver-unit").show();
            $(".export-lot-code").hide();
        } else {
            $(".export-title").show();
            $(".import-title").hide();
            $(".import-receiver-unit").hide();
            $(".export-lot-code").show();
        }
    }
});