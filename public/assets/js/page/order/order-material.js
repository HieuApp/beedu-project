var units = {
    'ybs': 'ybs',
    'kg': 'kg',
    'm': 'm',
    'roll': 'cuộn',
}
var material_names = [];
var materials = [];

$(document).ready(function () {
    build_material_table();

    $(document).on("change", "#form-material-detail #txt-material-name", validate_material_name);
    $(document).on("click", "#add-size-material", add_size);
    $(document).on("click", "#btn-material-submit", submit_new_material);

    function add_size(e) {
        var old_size_count = parseInt($("#input_size_count").val());
        $("#input_size_count").val(old_size_count + 1);
        var add_size_content = $(".add-size-content-template .add-size-content-inner").clone();
        add_size_content.find(".txt-material-size-name").attr("name", "size_name_" + old_size_count);
        add_size_content.find(".num-material-size-cons").attr("name", "size_cons_" + old_size_count);
        add_size_content.find(".num-material-size-quantity").attr("name", "size_quantity_" + old_size_count);
        add_size_content.find(".num-material-size-quantity-issued").attr("name", "size_quantity_issued_" + old_size_count);
        add_size_content.find(".num-material-size-quantity-factual").attr("name", "size_quantity_factual_" + old_size_count);
        $(".add-size-content-placeholder").append(add_size_content);
    }

    function submit_new_material(e) {
        var material_name = $("#form-material-detail #txt-material-name").val().trim();
        if (is_unexpected_material_name(material_name)) return;
        material_names.push(material_name.toLowerCase());

        var sizes_html = $(".add-size-content-placeholder").children();
        var sizes = [];
        for (var i in sizes_html) {
            var each_size_html = sizes_html[i].children;
            if (!each_size_html) break;
            //TODO add properties 'quantity' and 'date'
            sizes.push({
                'name': each_size_html[0].children[0].value.trim(),
                'limit': each_size_html[1].children[0].value,
                'quantity': each_size_html[2].children[0].value,
                'quantity_needed': each_size_html[3].children[0].value,
                'quantity_provided': each_size_html[4].children[0].value,
                'date': each_size_html[4].children[0].value,
            });
        }

        materials.push({
            'name': $("#form-material-detail #txt-material-name").val().trim(),
            'unit': $("#form-material-detail #slt-material-unit").val(),
            'color': $("#form-material-detail #slt-material-color").val(),
            'description': $("#form-material-detail #txt-material-description").val().trim(),
            'note': $("#form-material-detail #txt-material-note").val().trim(),
            'sizes': sizes,
        });

        build_material_table();
    }

    function build_material_table() {
        var table = $("<table class='table table-striped table-bordered table-hover'>");
        table.append($('.material-table-template thead').clone());
        var tbody = $("<tbody>");

        //generate html for each material
        for (var material_index in materials) {
            var material = materials[material_index];

            var tr = $('.material-table-template tbody .material-normal-tr').clone();
            tr.attr("data-material-name", material.name);
            tr.find(".td-material-serial").html(parseInt(material_index) + 1);
            tr.find(".td-material-name").html(material.name);
            tr.find(".td-material-unit").html(units.hasOwnProperty(material.unit) ? units[material.unit] : material.unit);
            tr.find(".td-material-color").html(material.color);//TODO Write ?: like material.unit above
            tr.find(".td-material-note").html(material.note);
            tbody.append(tr);

            var sizes = material.sizes;
            for (var size_index in sizes) {
                var size = sizes[size_index];
                var sub_tr = $('.material-table-template tbody .material-sub-tr').clone();
                sub_tr.find(".td-material-size").html(size.name);
                sub_tr.find(".td-material-accessories-quantity").html(size.quantity);
                sub_tr.find(".td-material-accessories-offset").html(size.quantity_needed - size.quantity_provided);
                tbody.append(sub_tr);
            }
        }

        tbody.append($('.material-table-template tbody .material-command-tr').clone());
        table.append(tbody);
        $(".material-table-placeholder").html(table);
    }

    function validate_material_name(e) {
        is_unexpected_material_name(e.target.value);
    }

    function is_unexpected_material_name(name) {
        if (!name) {
            notify("Không được để trống tên nguyên liệu", "", "gritter-error");
            return true;
        }
        var material_name_index = material_names.indexOf(name.toLowerCase());
        if (material_name_index >= 0) {
            notify("Tên nguyên liệu đã tồn tại", "Nguyên liệu '" + name + "' đã có ở hàng thứ " + (material_name_index + 1), "gritter-error");
            return true;
        }
        return false;
    }

    function notify(title, text = "", class_name = "") {
        $.gritter.add({
            title: title,
            text: text,
            class_name: class_name
        });
    }
});