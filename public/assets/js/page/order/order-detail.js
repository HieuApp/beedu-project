/**
 * Created by miunh on 29-Jun-16.
 */

var order_detail = {
    'color': [],
    'mce': [],
    'mce_rate': [],
    'color_quantity': {}
};
var rate = {
    "xs": 0,
    "s": 0,
    "m": 0,
    "l": 0,
    "xl": 0,
    "xxl": 0
};

$(document).ready(function () {
    get_old_version_detail();
    // build_tag_input('#order-detail-color-input');
    // build_tag_input('#order-detail-mce-input');

    $(document).on("click", "#btn-update-color-mce", change_color_mce);
    $(document).on("change", '.color_quantity', change_color_quantity);
    $(document).on("change", '.form-mce-rate', change_mce_rate_quantity);

    function change_color_mce(e) {
        order_detail.color = $('#order-detail-color-input').data('tag').values;
        for (var color_item in order_detail.color) {
            var value = order_detail.mce[color_item];
            for (var i in order_detail.color_quantity) {
                order_detail.color_quantity[i][value] = 0;
            }
        }

        order_detail.mce = $('#order-detail-mce-input').data('tag').values;
        for (var mce_item in order_detail.mce) {
            var value = order_detail.mce[mce_item];
            if (!order_detail.mce_rate[value]) {
                order_detail.mce_rate[value] = {
                    "xs": 0,
                    "s": 0,
                    "m": 0,
                    "l": 0,
                    "xl": 0,
                    "xxl": 0
                };
            }
            if (!order_detail.color_quantity.hasOwnProperty(value)) {
                order_detail.color_quantity[value] = {};
                for (var i in order_detail.color) {
                    order_detail.color_quantity[value][order_detail.color[i]] = 0;
                }
            }
        }

        build_quantity_html();
        build_color_total_quantity_table();
    }

    function build_quantity_html() {
        var all = $("<div>");
        for (var i in order_detail.mce) {
            var mce = order_detail.mce[i];
            var mce_html = $('.mce-quantity-template .mce_container').clone();
            mce_html.find(".color_mce_input").remove();
            var mce_name = mce_html.find(".mce_name");
            mce_name.attr('name', 'mce_name_' + i);
            mce_name.val(mce);

            mce_html.find('.form-mce-rate[data-size="xs"]').attr('name', 'mce_rate_' + i + '_xs');
            mce_html.find('.form-mce-rate[data-size="s"]').attr('name', 'mce_rate_' + i + '_s');
            mce_html.find('.form-mce-rate[data-size="m"]').attr('name', 'mce_rate_' + i + '_m');
            mce_html.find('.form-mce-rate[data-size="l"]').attr('name', 'mce_rate_' + i + '_l');
            mce_html.find('.form-mce-rate[data-size="xl"]').attr('name', 'mce_rate_' + i + '_xl');
            mce_html.find('.form-mce-rate[data-size="xxl"]').attr('name', 'mce_rate_' + i + '_xxl');

            //Fill each input of #mce_input with each value in order_detail.mce_rate and calculate total_rate
            var mce_rate = order_detail.mce_rate[mce];
            var total_rate = 0;
            for (var x in mce_rate) {
                mce_html.find(".mce_input .form-mce-rate[data-size='" + x + "']").val(mce_rate[x]);
                total_rate += mce_rate[x];
            }
            mce_html.find(".mce_rate_total").html(total_rate);

            var total_color = 0;
            for (var j in order_detail.color) {
                var color = order_detail.color[j];
                var color_html = $('.mce-quantity-template .mce_container .color_mce_input').clone();
                color_html.attr("data-color", color);
                var color_name = color_html.find(".color_name")
                color_name.val(color);
                color_name.attr('name', 'color_name_' + i + '_' + j);
                var total = order_detail.color_quantity[mce][color];
                if (!total) total = 0;
                var color_quantity_html = color_html.find(".color_quantity");
                color_quantity_html.val(total);
                color_quantity_html.attr('name', 'color_quantity_' + i + '_' + j)
                total_color += total;
                var color_mce_one = total / total_rate;
                for (var x in mce_rate) {
                    var color_mce_size = color_mce_one * mce_rate[x];
                    if (color_mce_size - parseInt(color_mce_size) > 0) {
                        color_mce_size = color_mce_size.toFixed(1);
                    }
                    color_html.find(".color-mce-count[data-size='" + x + "']").html(color_mce_size);
                }
                mce_html.append(color_html);
            }
            mce_html.find(".color_total").html(total_color);
            all.append(mce_html);
        }
        $(".mce-quantity-real").html(all);

        $('#mce_count').val(order_detail.mce.length);
        $('#color_count').val(order_detail.color.length);
    }

    function build_color_total_quantity_table() {
        var table = $("<table class='table table-striped table-bordered table-hover'>");
        table.append($('.color-total-quantity-table-template .color-total-quantity-thead').clone());
        var tbody = $("<tbody>");
        for (var i in order_detail.color) {
            var color = order_detail.color[i];
            var tr = $('.color-total-quantity-table-template .color-total-quantity-tbody .color-total-quantity-tr').clone();
            tr.attr("data-color", color);
            tr.find(".color-total-name").html(color);

            //calculate quantity value of each size then display them
            for (var each_size in rate) {
                var quantity_of_each_size = 0;
                for (var mce_index in order_detail.mce) {
                    var each_mce = order_detail.mce[mce_index];
                    var each_mce_rate_array = order_detail.mce_rate[each_mce];
                    if (!each_mce_rate_array[each_size]) continue;
                    var each_mce_rate_total = 0;
                    for (var item in each_mce_rate_array) {
                        each_mce_rate_total += each_mce_rate_array[item];
                    }
                    if (order_detail.color_quantity[each_mce][color]) if (each_mce_rate_total) if (each_mce_rate_array[each_size]) {
                        quantity_of_each_size += each_mce_rate_array[each_size] / each_mce_rate_total * order_detail.color_quantity[each_mce][color];
                    }
                }
                if (quantity_of_each_size - parseInt(quantity_of_each_size) > 0) {
                    quantity_of_each_size = quantity_of_each_size.toFixed(1);
                }
                tr.find(".color-total-count[data-size='" + each_size + "']").html(quantity_of_each_size);
            }

            //calculate total quantity value then display it
            var color_total_quantity_value = 0;
            for (var j in order_detail.mce) {
                var mce_color_quantity = order_detail.color_quantity[order_detail.mce[j]][color];
                if (mce_color_quantity) {
                    color_total_quantity_value += parseInt(mce_color_quantity);
                }
            }
            tr.find(".color-total-quantity").html(color_total_quantity_value);

            tbody.append(tr);
        }
        table.append(tbody);
        $(".color-total-quantity-table-placeholder").html(table);
    }

    function change_color_quantity(e) {
        var value = $(this).val();
        var color = $(this).parents(".color_mce_input").find(".color_name").val();
        var mce = $(this).parents(".mce_container").find(".mce_name").val();
        order_detail.color_quantity[mce][color] = parseInt(value);
        var mce_html = $(this).parents(".mce_container");
        update_mce_color_quantity(mce, mce_html);
        update_color_total_quantity_table();

    }

    function change_mce_rate_quantity() {
        var mce_value = $(this).val();
        var size = $(this).data("size");
        var mce = $(this).parents(".mce_container").find(".mce_name").val();
        order_detail.mce_rate[mce][size] = parseInt(mce_value);
        var mce_html = $(this).parents(".mce_container");
        update_mce_color_quantity(mce, mce_html);
        update_color_total_quantity_table_without_total();
    }

    function update_mce_color_quantity(mce, mce_html) {
        var mce_rate = order_detail.mce_rate[mce];
        var total_rate = 0;
        for (var x in mce_rate) {
            mce_html.find(".mce_input .form-mce-rate[data-size='" + x + "']").val(mce_rate[x]);
            total_rate += mce_rate[x];
        }
        mce_html.find(".mce_rate_total").html(total_rate);
        var total_color = 0;
        for (var i in order_detail.color) {
            var color = order_detail.color[i];
            var total = order_detail.color_quantity[mce][color];
            total_color += total;
            for (var x in mce_rate) {
                var mce_color_count = total / total_rate * mce_rate[x];
                if (mce_color_count - parseInt(mce_color_count) > 0) {
                    mce_color_count = mce_color_count.toFixed(1);
                }
                mce_html.find(".color_mce_input[data-color='" + color + "']")
                    .find(".color-mce-count[data-size='" + x + "']")
                    .html(mce_color_count);
            }
        }
        mce_html.find(".color_total").html(total_color);
    }

    function update_color_total_quantity_table() {
        var total_color_quantity = 0;
        var table = $(".color-total-quantity-table-placeholder table");
        for (var i in order_detail.color) {
            var color = order_detail.color[i];
            for (var j in order_detail.mce) {
                var mce = order_detail.mce[j];
                var total = order_detail.color_quantity[mce][color];
                if (total) total_color_quantity += total;
            }
            table.find(".color-total-quantity-tr[data-color='" + color + "']")
                .find(".color-total-quantity")
                .html(total_color_quantity);// total_test = tong gia tri tung mau
            total_color_quantity = 0;
        }
        update_color_total_quantity_table_without_total();
    }

    function update_color_total_quantity_table_without_total() {
        var table = $('.color-total-quantity-table-placeholder table');
        for (var i in order_detail.color) {
            var color = order_detail.color[i];
            var tr = table.find(".color-total-quantity-tr[data-color='" + color + "']");
            for (var each_size in rate) {
                var quantity_of_each_size = 0;
                for (var mce_index in order_detail.mce) {
                    var each_mce = order_detail.mce[mce_index];
                    var each_mce_rate_array = order_detail.mce_rate[each_mce];
                    if (!each_mce_rate_array[each_size]) continue;
                    var each_mce_rate_total = 0;
                    for (var item in each_mce_rate_array) {
                        if (!each_mce_rate_array[item])continue;
                        each_mce_rate_total += parseInt(each_mce_rate_array[item]);
                    }
                    if (order_detail.color_quantity[each_mce][color]) if (each_mce_rate_total) if (each_mce_rate_array[each_size]) {
                        quantity_of_each_size += each_mce_rate_array[each_size] / each_mce_rate_total * order_detail.color_quantity[each_mce][color];
                    }
                }
                if (quantity_of_each_size - parseInt(quantity_of_each_size) > 0) {
                    quantity_of_each_size = quantity_of_each_size.toFixed(1);
                }
                tr.find(".color-total-count[data-size='" + each_size + "']").html(quantity_of_each_size);
            }
        }
    }

    function get_old_version_detail() {
        var count_color = $('#count_color').html();
        for (var i = 0; i < count_color; i++) {
            order_detail.color.push($('#color_name_' + i).html());
        }
        var count_mce = $('#count_mce').html();
        var order_detail_color = order_detail.color;
        for (var i = 0; i < count_mce; i++) {
            var mce_name = $('#mce_name_' + i).html();
            order_detail.mce.push(mce_name);
            for (var j = 0; j < count_color; j++) {
                if (!order_detail.color_quantity.hasOwnProperty(mce_name)) {
                    order_detail.color_quantity[mce_name] = {};
                }
                for (var j in order_detail_color) {
                    order_detail.color_quantity[mce_name][order_detail.color[j]] = parseInt($('#color_quantity_' + i + '_' + j).html());
                }
            }
            order_detail.mce_rate[mce_name] = {
                "xs": parseInt($('#size_rate_' + i + '_xs').html()),
                "s": parseInt($('#size_rate_' + i + '_s').html()),
                "m": parseInt($('#size_rate_' + i + '_m').html()),
                "l": parseInt($('#size_rate_' + i + '_l').html()),
                "xl": parseInt($('#size_rate_' + i + '_xl').html()),
                "xxl": parseInt($('#size_rate_' + i + '_xxl').html()),
            };
        }

        build_tag_input('#order-detail-color-input', order_detail_color);
        build_tag_input('#order-detail-mce-input', order_detail.mce);

        build_quantity_html();
        build_color_total_quantity_table();
    }

    /**
     * Generate tag input with the initial data 'init_tags' (such as order_detail.mce and order_detail.color)
     *
     * @param selector Selector of the input you want to insert tag input into
     * @param init_tags Initial data to generate
     */
    function build_tag_input(selector, init_tags = Array()) {
        var tag_input = $(selector);
        try {
            tag_input.tag(
                {
                    placeholder: tag_input.attr('placeholder'),
                }
            )
            var $tag_obj = $(selector).data('tag');
            for (var item in init_tags) {
                $tag_obj.add(init_tags[item]);
            }
        }
        catch (e) {
            //display a textarea for old IE, because it doesn't support this plugin or another one I tried!
            tag_input.after('<textarea id="' + tag_input.attr('id') + '" name="' + tag_input.attr('name') + '" rows="3">' + tag_input.val() + '</textarea>').remove();
            //$('#form-field-tags').autosize({append: "\n"});
        }
    }
});