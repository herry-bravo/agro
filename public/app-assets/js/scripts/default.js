$(document).ready(function () {

    $(".search_supplier_name").on('keyup', function () {
        $(".search_supplier_name_empty").hide();
    });

    // Start Quotation Form Add ///
    /* Edited by Shindi - 27/04/2022*/

    $(document).on('click', '.add_quotation', function () {
        /* Original Code 20-04-2022*/
        var lastname_id = $('.tr_input input[type=text]:nth-child(1)').last().attr('id');
        var split_id = lastname_id.split('_');
        var index = Number(split_id[1]) + 1;
        // console.log(index);
        $('.quotation_container').append('<tr class="tr_input">\
                                    <td class="rownumber"></td>\
                                    <td width="30%">\
                                        <input type="text" class="form-control search_item_code validation" placeholder="Type here ..." name="item_code[]"  id="searchitem_'+ index + '" autocomplete="off" required" >\
                                        <span class="help-block search_item_code_empty glyphicon" style="display: none;"> No Results Found </span>\
                                        <input type="hidden" class="search_inventory_item_id"  id="id_'+ index + '" name="inventory_item_id[]"></td>\
                                        <input type="hidden" class="form-control"  id="description_'+ index + '" name="description_item[]" autocomplete="off">\
                                    <td width="15%">\
                                        <input type="text" class="form-control search_uom_conversion" name="po_uom_code[]" id="uom_'+ index + '" autocomplete="off">\
                                        <span class="help-block search_uom_code_empty glyphicon" style="display: none;"> No Results Found </span>\
                                    </td>\
                                    <td width="15%"><input type="text" class="form-control checkValidation  text-end" id="price_'+ index + '" name="unit_price[]"  required>\
                                    <td width="20%"><input type="date" class="form-control datepicker text-end" id="start_date_'+ index + '"  name="start_date[]" required></td>\
                                    <td width="20%"><input type="date" id="end_date_'+ index + '" name="end_date[]" class="form-control datepicker text-end" >\
                                    <td width="10px"><button type="button"  class="btn btn-ligth btn-sm remove_tr_quotation">X</button></td>\
                                </tr>');

        renumberRowsQuotation(index);
    });

    //Search UOM Conversion
    $(document).on('focus', '.search_uom_conversion', function () {
        var id = this.id;
        var index = id.split('_')[1];
    
        $('#' + id).autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: '/search/uom-conversion',
                    dataType: 'json',
                    type: 'GET',
                    data: {
                        term: request.term,  // Ambil input saat ini
                        term2: $('#id_' + index).val()  // ID item yang dipilih
                    },
                    success: function (data) {
                        response(data);
                        $('#'+id).siblings('.search_uom_code_empty').hide();
                    },
                    error: function () {
                        $('#'+id).parent().addClass('has-error');
                        $('#'+id).siblings('.search_uom_code_empty').show();
                    }
                });
            },
            minLength: 2,
            select: function (event, ui) {
                $(this).val(ui.item.value);  // Tampilkan hasil yang dipilih
                $('#id_' + index).val(ui.item.value1);  // Simpan ID konversi
            }
        });
    });
    

    $(document).on('keydown', '.search_item_code', function () {
        var id = this.id;
        console.log(id);
        var splitid = id.split('_');
        var index = splitid[1];
        $('#' + id).autocomplete({
            source: "/search/item_code",
            response: function (event, ui) {
                if (ui.content.length === 0) {
                    $(this).parent().addClass('has-error');
                    $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                    $(this).next().show();
                    $(".search_item_code_empty").show();
                    $('.form_submit').hide();
                } else {
                    $(this).next().hide()
                    $('.form_submit').show();
                }
            },
            select: function (event, ui) {
                $(this).next().next().val(ui.item.value1);
                $(this).val(ui.item.label); // display the selected text
                var id = ui.item.value1; // selected id to input
                // console.log(id);
                // AJAX
                $.ajax({
                    url: '/search/item_detail',
                    type: 'get',
                    data: { id: id, request: 2 },
                    dataType: 'json',
                    success: function (response) {
                        // console.log(response);
                        var len = response.length;
                        if (len > 0) {
                            var inv_id = response[0]['inv_id'];
                            var uom = response[0]['uom'];
                            var description = response[0]['description'];
                            var item_code = response[0]['item_code'];
                            var type_code = response[0]['type_code'];
                            var sub_category = response[0]['attribute2'];

                            // console.log(item_code);

                            document.getElementById('id_' + index).value = inv_id;
                            document.getElementById('uom_' + index).value = uom;
                            document.getElementById('description_' + index).value = description;
                            if (document.getElementById('sub_category_' + index)) {
                                document.getElementById('sub_category_' + index).value = sub_category;
                            }
                            document.getElementById('subcategory_' + index).value = sub_category;
                            if (document.getElementById('type_code_' + index)) {
                                document.getElementById('type_code_' + index).value = type_code;
                            }
                            if (document.getElementById('item_code_' + index)) {
                                document.getElementById('item_code_' + index).value = item_code;
                            }

                        }
                    }
                });
                return false;
            }
        });

    });

    function renumberRowsQuotation() {
        $(".quotation_container > tr").each(function (i, v) {
            $(this).find(".rownumber").text(i + 1);
        });
    }

    $(document).on('click', '.remove_tr_quotation', function () {
        $(this).closest('tr').remove();
    });
    // End Quotation Form Add ///

    $(document).on('click', '.add_sales_product', function () {

        $('.sales_container').append('<tr><td><input type="text" class="form-control search_purchase_category_name" placeholder="Type here ..." name="category_name[]" autocomplete="off"><span class="help-block search_purchase_category_name_empty glyphicon" style="display: none;"> No Results Found </span><input type="hidden" class="search_category_id" name="category_id[]"></td><td width="250px"><select class="form-control stock_id" name="stock_id[]"><option selected="" disabled="" value="">select</option></select><span class="search_stock_quantity"></span></td><td width="200px"><input type="text" class="form-control search_purchase_cost" name="purchase_cost[]" readonly=""></td><td width="150px"><input type="text" class="form-control search_selling_cost" name="selling_cost[]" ></td><td width="50px"><input type="hidden" class="search_stock_quantity" name="opening_stock[]"><input type="hidden" name="closing_stock[]" class="closing_stock"><input type="number" class="form-control change_sales_quantity" name="sales_quantity[]" min="1"><small class="help-block max_stock" style="display: none;">Insufficient Stock</small></td><td width="100px"><input type="text" class="form-control stock_total" name="sub_total[]" readonly=""></td><td><button type="button" class="btn btn-ligth btn-sm remove_tr">X</button></td></tr>');

        $(".search_purchase_category_name").autocomplete({

            source: "/search/purchase_category_name",
            minLength: 1,
            response: function (event, ui) {
                if (ui.content.length === 0) {

                    $(this).parent().addClass('has-error');
                    $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                    $(this).next().show();
                    $('.form_submit').hide();

                } else {
                    $(this).next().hide();
                    $('.form_submit').show();
                }
            },
            select: function (event, ui) {

                $(this).next().next().val(ui.item.id);

                var select = $(this).parent().next().children(':first-child');

                select.empty().append('<option selected="" disabled="" value="">- Select -</option>');

                $.each(ui.item.stocks, function (key, value) {
                    select.append('<option title="' + value.title + '" purchase_cost="' + value.purchase_cost + '" selling_cost="' + value.selling_cost + '" opening_stock="' + value.opening_stock + '" value=' + key + '>' + value.dimention + '</option>');
                });

            }
        });

        calculate_sales();
    });

    $(document).on('click', '.add_purchase_product', function () {
        var lastId = $('.tr_input input[type=text]').last().attr('id');
        var index = lastId ? parseInt(lastId.split('_')[1]) + 1 : 1;
    
        $('.purchase_container').append(`
            <tr class="tr_input">
                <td width="30%">
                    <input type="text" class="form-control search_purchase_item" placeholder="Type here ..." name="item_code[]" id="searchitem_${index}" autocomplete="off" required>
                    <span class="help-block search_item_code_empty" style="display: none;">No Results Found ...</span>
                    <input type="hidden" class="search_inventory_item_id" id="id_${index}" name="inventory_item_id[]">
                    <input type="hidden" class="form-control" value="" id="description_${index}" name="description_item[]" autocomplete="off">
                </td>
                <td width="10%">
                    <input type="text" class="form-control search_uom_conversion" name="po_uom_code[]" id="uom_${index}" autocomplete="off">
                    <span class="help-block search_uom_code_empty glyphicon" style="display: none;"> No Results Found </span>
                </td>
                <td width="10%">
                    <input type="text" class="form-control purchase_quantity" id="qty_${index}" name="purchase_quantity[]" required>
                </td>
                <td width="8%">
                    <input type="text" class="form-control purchase_cost" name="purchase_cost[]" id="price_${index}">
                </td>
                <td width="10%">
                    <input type="date" name="need_by_date[]" id="need_${index}" class="form-control datepicker">
                </td>
                <td width="15%">
                    <input type="text" class="form-control stock_total" name="sub_total[]" id="total_${index}" readonly>
                </td>
                <td width="5%">
                    <button type="button" class="btn btn-light btn-sm remove_tr">X</button>
                </td>
            </tr>
        `);
    });
    

    $(document).on('keydown', '.search_purchase_item', function () {
        var id = this.id;
        var splitid = id.split('_');
        var index = splitid[1];
        $('#' + id).autocomplete({
            source: "/search/purchase-item",
            minLength: 1,
            response: function (event, ui) {
                if (ui.content.length === 0) {

                    $(this).parent().addClass('has-error');
                    $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                    $('#search_item_code_empty_' + index).show();
                    $('.form_submit').hide();

                } else {
                    $('#search_item_code_empty_' + index).hide();
                    $('.form_submit').show();
                }
            },
            select: function (event, ui) {
                $(this).next().next().val(ui.item.value2);
                $(this).val(ui.item.value); // display the selected text
                var id = ui.item.value1; // selected id to input
                var itemId = ui.item.value2; // selected id to input
                // AJAX
                $.ajax({
                    url: '/search/purchase-item-det',
                    type: 'get',
                    data: { id: id, itemId: itemId, request: 2 },
                    dataType: 'json',
                    success: function (response) {
                        console.log(response)
                        var len = response.length;

                        if (len > 0) {
                            var id = response[0]['id'];
                            var price = response[0]['price'];
                            var uom = response[0]['uom'];
                            var pr_uom = response[0]['pr_uom'];
                            var description = response[0]['description'];
                            var sub_category = response[0]['sub_category'];

                            document.getElementById('price_' + index).value = price;
                            if (document.getElementById('pr_uom_' + index)) {
                                document.getElementById('pr_uom_' + index).value = pr_uom;
                            }

                            document.getElementById('description_' + index).value = description;
                            // document.getElementById('category_'+index).value = category;
                            if (document.getElementById('subcategory_' + index)) {
                                document.getElementById('subcategory_' + index).value = sub_category;
                            }
                            if (document.getElementById('uom_' + index)) {
                                document.getElementById('uom_' + index).value = uom;
                            }

                        }

                    }
                });

                return false;
            }
        });
        function cal(index) {
            var quantity = document.getElementById('qty_' + index).value;
            var price = document.getElementById('price_' + index).value;
        
            // Hapus titik pemisah ribuan sebelum konversi ke angka
            var qtyValue = quantity ? parseFloat(quantity) : 0;
            var priceValue = price ? parseFloat(price) : 0;
        
            // Menjumlahkan quantity + price
            var total = qtyValue * priceValue;
            document.getElementById('total_' + index).value = total;
        
            // (Opsional) Memanggil fungsi lain jika ada perhitungan tambahan
            calculate_purchase();
        }
        
        // Event Listener agar total otomatis diperbarui saat quantity atau price diubah
        $(document).on('input', '.purchase_quantity, .purchase_cost', function () {
            var id = this.id;
            var splitid = id.split('_');
            var index = splitid[1];
        
            cal(index);
        });
    });

    $(document).on('keyup', '.change_sales_quantity', function () {

        if (parseInt($(this).val()) > parseInt($(this).attr('max'))) {
            $(this).parent().addClass('has-error');
            $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
            $('.form_submit,.add_sales_product').hide();
            $('.max_stock').show();
        } else {
            $(this).parent().removeClass('has-error');
            $('.form_submit,.add_sales_product').show();
            $('.max_stock').hide();
        }

        var quantity = parseFloat($(this).val()).toFixed(2);

        var cost = parseFloat($(this).parent().prev().children(':first-child').val()).toFixed(2);

        var total = parseFloat(quantity * cost || 0).toFixed(2);

        $(this).parent().next().children(':first-child').val(total);

        var opening = parseInt($(this).prev().prev().val());

        $(this).prev().val(parseInt(opening - quantity));

        calculate_sales();

    });

    $(document).on('click', '.add_requisition_product', function () {
        var lastname_id = $('.tr_input input[type=text]:nth-child(1)').last().attr('id');
        var split_id = lastname_id.split('_');
        var index = Number(split_id[1]) + 1;
        console.log(lastname_id);

        $('.requisition_container').append('<tr class="tr_input">\
        <td width="15%"><input type="text" class="form-control search_purchase_item" placeholder="Type here ..." name="item_code[]" id="searchitem_' + index + '" autocomplete="off"  ><span class="help-block search_item_code_empty" style="display: none;" >No Results Found ...</span><input type="hidden" class="search_inventory_item_id" id="id_' + index + '"  name="inventory_item_id[]" autocomplete="off">  <input type="hidden" class="search_inventory_item_id" id="lineId_' + index + '" value="" name="lineId[]" autocomplete="off"> <input type="hidden" class="form-control" id="category_' + index + '" value="" name="category[]" autocomplete="off"></td>\
        <td width="35%"><input type="text" class="form-control" id="description_' + index + '" value="" name="description_item[]" autocomplete="off"></td>\
        <td width="10%"><input type="text" class="form-control search_subcategory_code_" name="sub_category[]" id="subcategory_' + index + '" autocomplete="off"><span class="help-block  glyphicon" style="display: none;"> No Results Found </span>\</td>\
        <td width="10%"><input type="text" class="form-control search_uom_conversion text-center" name="pr_uom_code[]" id="uom_' + index + '" autocomplete="off"><span class="help-block search_uom_code_empty glyphicon" style="display: none;"> No Results Found </span>\</td>\
        <td width="10%"><input type="text" class="form-control purchase_quantity float-end text-end" value="0" name="quantity[]" id="qty_' + index + '" autocomplete="off" required ></td>\
        <input type="hidden" class="form-control purchase_cost float-end text-end" name="estimated_cost[]" id="price_' + index + '" value="0" onblur="cal()" autocomplete="off" readonly>\
        <td width="15%"><input type="text" name="requested_date[]" class="form-control datepicker float-center text-center" id="date_' + index + '" autocomplete="off"></td>\
        <td  class="text-center">\
        <div class="input-group">\
        <label class="input-group-btn">\
          <span class="btn btn-default btn-file">\
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="15" fill="currentColor" class="bi bi-image-fill" viewBox="0 0 16 16">\
                                                                  <path d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12zm5-6.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z"></path>\
                                                              </svg>\
                                                              <input id="file-input_' + index + '" type="file" name="img_path[]"  style="display: none;"/>\
          </span>\
        </label>\
      </div>\
        </td>\
        <td  class="text-center"><button type="button" class="btn btn-ligth btn-sm remove_tr">X</button></td></tr>');
        $('.datepicker').datepicker({
            minDate: 1
        });
    });

    $(".search_supplier_name").autocomplete({
        source: "/search/vendor",
        minLength: 1,
        response: function (event, ui) {
            if (ui.content.length === 0) {

                $(this).parent().addClass('has-error');
                $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                $(".search_supplier_name_empty").show();
                $('.form_submit').hide();

            } else {
                $(".search_supplier_name_empty").hide();
                $('.form_submit').show();
            }
        },
        select: function (event, ui) {
            // $('.search_supplier_id').val(ui.item.id);
            $('.search_vendor_id').val(ui.item.vendor_id);
            $('.search_supplier_name').val(ui.item.value);
            $('.search_supplier_address').val(ui.item.supplier_address);
            $('.search_supplier_contact1').val(ui.item.supplier_contact1);
            $('.search_currency').val(ui.item.currency);

            $('.opening_balance').val(parseFloat(ui.item.balance).toFixed(2));
            $('.opening_due').val(parseFloat(ui.item.due).toFixed(2));

            $('.grand_total').val(parseFloat(ui.item.due - ui.item.balance).toFixed(2));

            // var e = $.Event('keyup'); $('.change_purchase_quantity,.sales_payment,.stock_id').trigger(e);

        }
    });
    $(".search_address1").autocomplete({
        source: "/search/site",
        minLength: 1,
        response: function (event, ui) {
            if (ui.content.length === 0) {

                $(this).parent().addClass('has-error');
                $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                $(".search_address1_empty").show();
                $('.form_submit').hide();

            } else {
                $(".search_address1_empty").hide();
                $('.form_submit').show();
            }
        },
        select: function (event, ui) {
            // $('.search_supplier_id').val(ui.item.id);
            $('.search_ship_to_location').val(ui.item.site_code);
            //  $('.search_supplier_address').val(ui.item.supplier_address);
            // $('.search_supplier_contact1').val(ui.item.supplier_contact1);
            // $('.search_currency').val(ui.item.currency);

            //  $('.opening_balance').val(parseFloat(ui.item.balance).toFixed(2));
            //  $('.opening_due').val(parseFloat(ui.item.due).toFixed(2));

            //   $('.grand_total').val(  parseFloat(ui.item.due-ui.item.balance).toFixed(2) );

            // var e = $.Event('keyup'); $('.change_purchase_quantity,.sales_payment,.stock_id').trigger(e);

        }
    }); $(".supplier_site_id").autocomplete({
        source: "/search/supplier-site",
        minLength: 1,
        response: function (event, ui) {
            if (ui.content.length === 0) {

                $(this).parent().addClass('has-error');
                $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                $(".supplier_site_id_empty").show();
                $('.form_submit').hide();

            } else {
                $(".supplier_site_id_empty").hide();
                $('.form_submit').show();
            }
        },
        select: function (event, ui) {
            // $('.search_supplier_id').val(ui.item.id);
            $('.search_vendor_site_id').val(ui.item.site_code);
            $('.vendor_site_id').val(ui.item.site_code);
        }
    });



    $(".search_item_code_r").autocomplete({
        source: "/search/item_code",
        minLength: 1,
        response: function (event, ui) {
            if (ui.content.length === 0) {

                $(this).parent().addClass('has-error');
                $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                $(".search_item_code_empty").show();
                $('.form_submit').hide();

            } else {
                $(".search_item_code_empty").hide();
                $('.form_submit').show();
            }
        },
        select: function (event, ui) {
            $('.search_inventory_item_id').val(ui.item.inventory_item_id);
            $('.search_item_code').val(ui.item.value);
            $('.inventory_item_id').val(ui.item.value1);
            $('.search_item_description').val(ui.item.description);
        }
    });
    function calculate_purchase() {

        var sum = 0;

        $(".stock_total").each(function () {
            sum += +$(this).val();
        });

        $('.purchase_total').val(sum);
    }
    $('.purchase_tax_amount').on('keyup', function () {

        var tax = parseFloat($(this).val()).toFixed(2);
        var sub_total = parseFloat($('.purchase_total').val()).toFixed(2);
        var discount = parseFloat($('.purchase_discount_amount').val()).toFixed(2);

        var tax_percent = ((tax * 100) / sub_total).toFixed(2);

        $('.purchase_tax_percent').val(tax_percent || 0);

        calculate_purchase();

    });

    $('#category_code').change(function () {
        var id = $(this).val();
        var url = '/search/acc_category';
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
            data: { term: id },
            success: function (response) {
                if (response != null) {
                    $('#account_inventory').val(response.inventory_account_code);
                    $('#account_payable').val(response.payable_account_code);
                    $('#account_receivable').val(response.receivable_account_code);
                    $('#account_consumption').val(response.consumption_account_code);
                    $('#attribute1').val(response.attribute1);
                }
            }
        });
    });

    $(".sub_category_code").autocomplete({
        source: "/search/sub-category",
        minLength: 1,
        response: function (event, ui) {
            if (ui.content.length === 0) {

                $(this).parent().addClass('has-error');
                $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                $(".search_address1_empty").show();
                $('.form_submit').hide();

            } else {
                $(".search_address1_empty").hide();
                $('.form_submit').show();
            }
        },
        select: function (event, ui) {
            $('.sub_category_code').val(ui.item.value1);
        }
    });

    $(document).on('click', '.remove_tr', function () {
        $(this).closest('tr').remove();
        calculate_sales();
        calculate_purchase();
    });


    // Price List
    $(document).on('click', '.add_pricelist', function () {
        // $('#add_pricelist').hide();
        var lastname_id = $('.tr_input input[type=text]:nth-child(1)').last().attr('id');
        var split_id = lastname_id.split('_');
        var index = Number(split_id[3]) + 1;
        // console.log(split_id);

        $('.pricelist_container').append(
            '<tr class="tr_input">\
            <td class="rownumber">\
            </td>\
            <td width="25%">\
            <input type="hidden" class="line_id" id="line_id_'+ index + '" name="line_id[]" value="' + index + '">\
            <input type="text" class="form-control search_list" placeholder="Type here ..." id="search_item_code_'+ index + '" name="item_code[]" autocomplete="off" required>\
            <span class="help-block search_item_code_empty'+ index + ' glyphicon" style="display: none;"> No Results Found </span>\
            <input type="hidden" class="search_item_code_id" id="id_'+ index + '" name="inventory_item_id[]" autocomplete="off">\
            <input type="hidden" class="form-control" name="description_item_code[]" id="description_item_code_'+ index + '" autocomplete="off">\
            <input type="hidden" class="form-control" name="uom[]" id="uom_'+ index + '" value="">\
            </td>\
            <td width="15%">\
                <input type="text" class="form-control" id="user_item_description_'+ index + '" name="user_item_description[]" readonly>\
                <span id="user_item_description_empty_'+ index + '"></span>\
            </td>\
            <td width="15%">\
                <input type="text" class="form-control unit_prices_list text-end" id="unit_prices_list_'+ index + '" name="unit_prices[]" autocomplete="off" required>\
                <input type="hidden" id="prices_list_'+ index + '" name="prices_list[]" >\
            </td>\
            <td width="5%">\
                <input type="number" class="form-control discount" id="discount_'+ index + '" name="discount[]" required>\
            </td>\
            <td width="10%">\
                <select class="form-control packing_type" id="packing_type_'+ index + '" name="packing_type[]" required>\
                <option value="2">Roll</option>\
                <option value="1">Pallet</option>\
                </select>\
            </td>\
            <td width="10%">\
                <input type="date" class="form-control datepicker effective_from" id="effective_from_'+ index + '"  name="effective_from[]" required>\
            </td>\
            <td width="10%">\
                <input type="date" name="effective_to[]" id="effective_to_'+ index + '" class="form-control datepicker effective_to">\
            </td>\
            <td>\
                <button type="button" class="btn btn-ligth btn-sm remove_tr_pricelist">X</button>\
            </td>\
        </tr>');
        rebuild_pricelist(index);
    });

    $('#terms_end').on('change', function () {

        const effective_from = $("#terms_start").val(); //2013-09-5
        const effective_to = $("#terms_end").val(); //2013-09-10

        if (Date.parse(effective_from) >= Date.parse(effective_to)) {

            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Last date (To) cant be less or empty',
                showConfirmButton: false,
                timer: 1500
            })
            $("#terms_end").val(effective_from);
        }
    });

    $(document).on('keydown', '.search_list', function () {
        var id = this.id;
        var splitid = id.split('_');
        var index = splitid[3];
        // console.log(id, splitid);
        $('#' + id).autocomplete({
            source: "/search/price_list",
            minLength: 1,
            response: function (event, ui) {
                if (ui.content.length === 0) {
                    $(this).parent().addClass('has-error');
                    $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                    $(this).next().show();
                    $(".search_item_code_empty" + index).show();
                    $('.form_submit').hide();
                } else {
                    $(this).next().hide()
                    $('.form_submit').show();
                }
            },

            select: function (event, ui) {
                $(this).next().next().val(ui.item.value1);
                $(this).val(ui.item.label); // display the selected text
                var id = ui.item.value1; // selected id to input
                // console.log(index);
                $('#effective_to_' + index).on('change', function () {

                    var effective_from = $("#effective_from_" + index).val(); //2013-09-5
                    var effective_to = $("#effective_to_" + index).val(); //2013-09-10

                    if (Date.parse(effective_from) >= Date.parse(effective_to)) {

                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Last date (To) cant be less or empty',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $("#effective_to_" + index).val(effective_from);
                    }
                    $('#add_pricelist').show();

                });

                $('#search_item_code_' + index).on('change', function () {
                    if (index > 1) {

                        var isi = Number(index);
                        var isi1 = isi - 1;
                        var isi2 = isi;

                        // console.log(isi1);
                        // console.log(isi2);

                        var inv = $("#id_" + isi1).val();
                        var inv2 = $("#id_" + isi2).val();

                        // console.log(inv, inv2);
                        if (inv === inv2) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Product Already Exist',
                                showConfirmButton: false,
                                timer: 1500
                            });

                            $("#search_item_code_" + (isi2)).val('');
                            $("#user_item_description_" + (isi2)).val('');
                            // console.log(isi, isi2);
                        };
                    }
                });


                $.ajax({
                    url: '/search/price_list_detail',
                    type: 'get',
                    data: { id: id, request: 2 },
                    dataType: 'json',
                    success: function (response) {
                        // console.log(response);
                        var len = response.length;
                        if (len > 0) {
                            // console.log(response[0]['description'])
                            var line_id = response[0]['line_id'];
                            var uom = response[0]['uom'];
                            var description = response[0]['description'];

                            document.getElementById('id_' + index).value = line_id;
                            document.getElementById('user_item_description_' + index).value = description;
                            document.getElementById('uom_' + index).value = uom;
                        }
                    }
                });

                $('#unit_prices_list_' + index).blur(function () {
                    const IDR = value => currency(value, { symbol: '', decimal: ',', separator: '.' });
                    var values = this.value;
                    var curen = values;
                    // console.log(values)
                    // console.log(curen)
                    $('#unit_prices_list_' + index).val(curen);
                    $('#prices_list_' + index).val(values);
                });

                // return false;
            }
        });
    });

    function rebuild_pricelist() {
        $(".pricelist_container > tr").each(function (i, v) {
            $(this).find(".rownumber").text(i + 1);
        });
    }

    $(document).on('click', '.remove_tr_pricelist', function () {
        $(this).closest('tr').remove();
    });
    // End of Price List

    // Start Sales Order Form Add ///
    // var key = 0;
    $(document).on('click', '.remove_tr_sales', function () {
        var identifier = $(this).closest('tr').attr('id');
        console.log(identifier);
        var split_id = identifier.split('_');
        var index = Number(split_id[1]);

        $("#rowTab1_" + index).remove();
        $("#rowTab2_" + index).remove();
        $("#rowTab3_" + index).remove();
        totalSales();
    });
    var index = 0;
    $(document).on('click', '.add_sales_order', function () {
        index++; // Tambahkan 1 setiap kali menambah baris baru

        var identifier = $('.line_id').last().attr('id');
        var split_id = identifier.split('_');
        var index = Number(split_id[2]) + 1;
        $.ajax({
            url: '/search/addtax',
            dataType: 'json',
            type: 'GET',
            cache: false,
            contentType: false,
            processData: true,
            success: function (response) {
                var options = response;
                var element = document.getElementById('pajak_' + index);

                options.forEach(function (option, i) {
                    element.options[i] = new Option(option.tax_code, option.tax_rate);
                    console.log(element);
                    console.log(element.options[i]);

                });
            }
        })
        
        $('.sales_order_container').append(
            '<tr class="tr_input" id="rowTab1_' + index + '">\
                <td width="auto"></td>\
                <td class="rownumber" style="width:3%"></td>\
                <td width="30%">\
                    <input type="hidden" class="line_id" id="line_id_'+ index + '" name="line_id[]" value="">\
                    <input type="text" id="item_sales_'+ index + '" class="form-control search_sales" placeholder="Type here ..." name="item_sales[]" autocomplete="off" >\
                    <span class="help-block search_item_code_empty'+ index + ' glyphicon" style="display: none;"> No Results Found </span>\
                    <input type="hidden" id="id_'+ index + '" class="search_inventory_item_id" name="inventory_item_id[]">\
                </td>\
                <td width="auto">\
                    <input type="number" id="jumlah_'+ index + '" class="form-control recount text-end" oninput=validity.valid||(value="") min=1 name="ordered_quantity[]" required>\
                </td>\
                <td width="auto">\
                    <input type="number" id="harga_'+ index + '" step=0.000001 required class="form-control harga text-end"  name="unit_selling_price[]" >\
                </td>\
               <td width="auto">\
                    <input type="number" id="discount_'+ index + '" min="1" class="form-control recount text-end" oninput=validity.valid||(value="") min=1 name="disc[]">\
                </td>\
                <td width="auto"><input type="date" id=""  name="schedule_ship_date[]" class="form-control text-end" required></td>\
                <td width="auto">\
                    <input type="text" readonly id="unitprice_'+ index + '" class="form-control text-end" name="unitprice_[]" >\
                </td>\
                <td width="auto">\
                    <input type="text" readonly id="sutot'+ index + '" class="form-control text-end" name="sutot[]" >\
                </td>\
                <td width="auto">\
                    <button type="button" class="btn btn-light remove_tr_sales btn-sm" data-index="' + index + '">X</button>\
                </td>\
            </tr>'
        );
            
        $(document).on('input', '[id^=jumlah_],[id^=discount_], [id^=harga_]', function() {
            // Ambil nilai jumlah dan harga dari input, hapus format ribuan jika ada
            var jumlah = parseFloat($('#jumlah_' + index).val().replace(/\./g, '').replace(',', '.')) || 0;
            var harga = parseFloat($('#harga_' + index).val().replace(/\./g, '').replace(',', '.')) || 0;
            var discount = parseFloat($('#discount_' + index).val().replace(/\./g, '').replace(',', '.')) || 0;
            var selectedTaxId = document.getElementById('select_tax').value;
        
           // Hitung subtotal dengan rumus yang benar
            // var disc =  discount/100;
            var disc =  discount;
            var unitprices1 =  jumlah * harga;
            // var unitprice =  unitprices1 - (unitprices1*disc); //untuk persen
            var unitprice =  unitprices1 - disc; //pengurangan biasa
            var sutot1 = (jumlah * harga)*(1 - selectedTaxId / 100);
            // var sutot = sutot1 - (sutot1*disc); //untuk persen
            var sutot = sutot1 - disc; //pengurangan biasa
            // console.log(sutot);
            // Jika subtotal negatif, set ke 0 (opsional, tergantung kebutuhan)
            // if (unitprice < 0) {
            //     unitprice = 0;
            // }
        
            // Format subtotal ke dalam format lokal Indonesia
            var formattedunitprice = unitprice.toLocaleString('id-ID', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            var formattedSubtotal = sutot.toLocaleString('id-ID', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        
            // Tampilkan subtotal yang sudah diformat ke input field
            $('#unitprice_' + index).val(formattedunitprice);
            $('#sutot' + index).val(formattedSubtotal);
        
            // Update total setiap kali subtotal diperbarui
            updateTotal();
        });
        
        // Function to update the total
        function updateTotal() {
            // console.log(selectedTaxId);
            var total = 0;
            var tax = 0;
            var ppn = 0
        
            // Iterasi semua elemen dengan id yang dimulai dengan 'subtotal_'
            $('[id^=unitprice_]').each(function() {
                // Ambil nilai subtotal, konversi dari format lokal ke angka float
                var unitprice = parseFloat($(this).val().replace(/\./g, '').replace(',', '.')) || 0;
                total += unitprice;
            });
            $('[id^=sutot]').each(function() {
                // Ambil nilai subtotal, konversi dari format lokal ke angka float
                var sutot = parseFloat($(this).val().replace(/\./g, '').replace(',', '.')) || 0;
                tax += sutot;
            });
            ppn = total-tax;
            // Format total dengan pemisah ribuan
            var formattedTotal = total.toLocaleString('id-ID', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            var formattedtax = tax.toLocaleString('id-ID', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            var formattedppn = ppn.toLocaleString('id-ID', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        
            // Update nilai total ke dalam input
            $('#total_').val(formattedTotal);
            $('#tax_amount').val(formattedtax);
            $('#ppn').val(formattedppn);
        }
        $(document).on('click', '.remove_tr_sales', function() {
            var index = $(this).data('index'); // Ambil index dari tombol yang diklik
            remove_tr_sales(index); // Panggil fungsi untuk menghapus baris
        });
        // Function to remove a row and update the total
        function remove_tr_sales(index) {
            // Remove the row
            $('#rowTab1_' + index).remove();
        
            // Update the total after removing the row
            updateTotal();
        }
            // Example usage of remove_tr_sales function
            // Assuming you have a button with class 'remove-btn' that triggers row removal
        $(document).on('click', '.remove-btn', function() {
            var index = $(this).data('index'); // Get the index from data attribute
            remove_tr_sales(index);
        });
            
            
        renumSales(index);

        $('.sales_order_detail_container').append(
            '<tr class="tr_input" id="rowTab2_' + index + '">\
                <td class="rownumber1" style="width:3%"></td>\
                <td width="5%">\
                <select class="form-control pajak select2"   name="tax_code[]" id="pajak_'+ index + '"required>\
                </select>\
                <input type="hidden" readonly id="pajak_hasil_'+ index + '" class="form-control pajak_hasil" name="pajak_hasil[]" >\
            </td>\
                <td width="20%">\
                    <input type="hidden" class="line_id" id="line_id_'+ index + '">\
                    <input type="text" class="form-control "  id="price_list_name_'+ index + '" name="price_list_name[]" autocomplete="off" required readonly>\
                    <input type="hidden" class="form-control "  id="price_list_id_'+ index + '" name="price_list_id[]" autocomplete="off" required readonly>\
                    <input type="hidden" class="form-control"  id="price_id_'+ index + '" name="pricing_attribute1[]" autocomplete="off" required readonly>\
                </td>\
                <td > <input type="number" id="harga2_'+ index + '" class="form-control harga" name="unit_selling_price[]" readonly></td>\
                <td ><input type="date" id="effective_date_'+ index + '" name="pricing_date[]" readonly class="form-control "></td>\
                <td width="auto">\
                    <input type="number" id="disc_'+ index + '" class="form-control disc text-end" name="disc[]" readonly>\
                </td>\<td width="5%">\
                    <button type="button" class="btn btn-ligth remove_tr_sales btn-sm">X</button>\
                </td>\
            </tr>');
        renumSalesDetail(index);


        $('.sales_order_shipment_container').append(
            '<tr class="tr_input2" id="rowTab3_' + index + '">\
                <td class="rownumber1" style="width:3%"></td>\
                <td width="10%";>\
                <input type="text" readonly id="uom_'+ index + '" class="form-control uom" name="uom[]">\
            </td>\
                <td width="auto">\
                    <input type="hidden" class="line_id" id="line_id_'+ index + '">\
                    <input type="text" class="form-control search_subinventory" value="" name="subinventory_from[]" id="subinventoryfrom_'+ index + '" required>\
                    <input type="hidden" class="form-control subinvfrom_'+ index + '" name="shipping_inventory[]" id="subinvfrom_' + index + '" autocomplete="off">\
                </td>\
                <td width="auto">\
                <select class="form-control" id="packingstyle_'+ index + '" name="packing_style[]" required>\
                <option value="Roll" selected>ROLL</option>\
                <option value="Pallet" >PALLET</option>\
                <option value="Pack" >PACK</option>\
                </select></td>\
                </td>\
                <td width="auto">\
                    <select class="form-control select2" id="flow_status_code_'+ index + '" name="flow_status[]"  required>\
                        <option value="5" selected>Entered</option>\
                    </select>\
                </td>\
                <td width="5%">\
                    <button type="button" class="btn btn-ligth remove_tr_sales btn-sm">X</button>\
                </td>\
            </tr>');
        renumSalesShipment(index);

    });

    $(document).on('keydown', '.search_sales', function () {
        var id = this.id;
        var splitid = id.split('_');
        var index = splitid[2];
        var currsales = document.getElementById("customer_currency").value;
        var test = document.getElementById('item_sales_' + index).value;
        var sellingPrice = document.getElementById("po_number").value;
        // console.log(test);
        if (sellingPrice == 0) {
            alert('Select Selling Price Number First');
        }


        $('#' + id).autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: '/search/sales_order',
                    dataType: 'json',
                    type: 'GET',
                    cache: false,
                    contentType: false,
                    processData: true,
                    data: {
                        test: test,
                        currsales: currsales,
                        sellingPrice: sellingPrice
                    },
                    success: function (data) {
                        response(data);
                        $('.search_item_code_empty' + index).hide();
                        $('.form_submit').show();
                    },
                    error: function (data) {
                        $(this).parent().addClass('has-error');
                        $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                        // $(this).next().show();
                        $(".search_item_code_empty" + index).show();
                        $('.form_submit').hide();
                    },
                });
            },
            minLength: 2,
            select: function (event, ui) {
                $(this).next().next().val(ui.item.value1);
                $(this).val(ui.item.label); // display the selected text
                var id = ui.item.value1; // selected id to input
                var priceL = ui.item.value2;
                var currencyL = ui.item.value3;
                // console.log(priceL, sellingPrice);
                // if(priceL == sellingPrice){
                // AJAX
                $.ajax({
                    url: '/search/sales_order_detail',
                    type: 'GET',
                    data: { id: id, currencyL: currencyL, priceL: priceL },
                    dataType: 'json',
                    success: function (response) {
                        var len = response.length;
                        // console.log(response)
                        if (len > 0) {
                            // console.log(response);
                            // console.log(response[0]['packingtype'])
                            var line_id = response[0]['line_id'];
                            var currency = response[0]['currency'];
                            var packingtype = response[0]['packingtype'];
                            // var uom = response[0]['uom'];
                            var unitprice = response[0]['unitprice'];
                            var harga = response[0]['unitprice'];
                            var discount = response[0]['discount'];
                            var description = response[0]['description'];
                            var effective_date = response[0]['effective_date'];
                            var price_list_name = response[0]['price_list_name'];
                            var shipping_inventory = response[0]['shipping_inventory'];
                            var subinventory = response[0]['subinventory'];
                            var header_id = response[0]['header_id'];
                            var id = response[0]['id'];
                            var uom = response[0]['uom'];
                            // console.log(uom);
                            // console.log(id);
                            // console.log(effective_from)
                            if (packingtype == 1)
                                var packingtype = 'PALLET';
                            else {
                                var packingtype = 'CONTAINER';
                            }
                            document.getElementById('id_' + index).value = line_id;
                            // document.getElementById('product_name_' + index).value = description;
                            // document.getElementById('uom_'+index).value = uom;
                            // document.getElementById('packingstyle_'+index).value = packingtype;
                            document.getElementById('harga_' + index).value = unitprice;
                            document.getElementById('harga2_' + index).value = unitprice;
                            document.getElementById('disc_' + index).value = discount;
                            document.getElementById('effective_date_' + index).value = effective_date;
                            document.getElementById('price_list_name_' + index).value = price_list_name;
                            document.getElementById('subinventoryfrom_' + index).value = shipping_inventory + " - " + subinventory;
                            document.getElementById('subinvfrom_' + index).value = shipping_inventory;
                            document.getElementById('price_list_id_' + index).value = header_id;
                            document.getElementById('price_id_' + index).value = id;
                            document.getElementById('uom_' + index).value = uom;
                            // $('#harga_' + index).val(unitprice);
                            // console.log(unitprice)
                        }
                    }
                });
                // }else{
                //     alert('Not Allow To Add This Product');
                // }


                $(document).on('input', '.recount', function (e) {
                    const IDR = value => currency(value, { symbol: '', decimal: ',', separator: '.' });
                    // var qty = document.getElementById('jumlah_' + index).value;
                    // var harga = document.getElementById('harga_' + index).value;
                    // var disc = document.getElementById('disc_' + index).value;
                    // var pajak = document.getElementById('pajak_' + index).value;

                    // disc = (disc / 100);
                    // var total = qty * harga;

                    // var potongan = total * disc;
                    // console.log(potongan)

                    // var sub_total = total - potongan;

                    // var pajakHasil = sub_total * pajak;
                    // sub_total = sub_total + pajakHasil;

                    // document.getElementById('subtotal_' + index).value = sub_total;
                    // document.getElementById('pajak_hasil_' + index).value = pajakHasil;
                    // totalSales();


                });

                $(document).on('change', '.pajak', function (e) {
                    const IDR = value => currency(value, { symbol: '', decimal: ',', separator: '.' });
                    var qty = document.getElementById('jumlah_' + index).value;
                    var harga = document.getElementById('harga_' + index).value;
                    var disc = document.getElementById('disc_' + index).value;
                    var pajak = document.getElementById('pajak_' + index).value;

                    disc = (disc / 100);

                    var total = qty * harga;

                    var potongan = total * disc;
                    console.log(potongan);

                    var sub_total = total - potongan;
                    var pajakHasil = sub_total * pajak;
                    sub_total = sub_total + pajakHasil;

                    document.getElementById('subtotal_' + index).value = sub_total;
                    document.getElementById('pajak_hasil_' + index).value = pajakHasil;
                    // totalSales();
                });

                // return false;
            }
        });
    });
    $(document).on('input', '.search_taxesmaster', function () {
        let inputElement = $(this);
        let query = inputElement.val();
        let index = inputElement.attr('id').split('_')[1]; // Ambil index dari ID
    
        if (query.length > 2) { // Jalankan pencarian jika input lebih dari 2 karakter
            $.ajax({
                url: '/search/taxesmaster', // URL API untuk pencarian
                type: 'GET',
                data: { keyword: query },
                success: function (response) {
                    // Hapus dropdown jika sudah ada
                    $('#taxesmaster_dropdown_' + index).remove();
    
                    // Tambahkan dropdown baru di bawah input
                    let dropdown = `<div id="taxesmaster_dropdown_${index}" class="dropdown-menu" style="display: block; position: absolute; z-index: 999; max-height: 200px; overflow-y: auto;">`;
                    if (response.length > 0) {
                        response.forEach(item => {
                            dropdown += `<button type="button" class="dropdown-item select_taxesmaster" data-index="${index}" data-id="${item.id}" data-name="${item.name}">${item.name}</button>`;
                        });
                    } else {
                        dropdown += `<span class="dropdown-item text-muted">No Results Found</span>`;
                    }
                    dropdown += `</div>`;
    
                    inputElement.after(dropdown);
                },
                error: function () {
                    alert('Error fetching data. Please try again.');
                }
            });
        } else {
            $('#taxesmaster_dropdown_' + index).remove();
        }
    });
    
    // Event untuk memilih hasil dari dropdown
    $(document).on('click', '.select_taxesmaster', function () {
        let button = $(this);
        let index = button.data('index');
        let taxName = button.data('name');
        let taxId = button.data('id');
    
        // Set nilai input dan hapus dropdown
        $('#taxesmaster_' + index).val(taxName);
        $('#id_' + index).val(taxId); // Contoh jika ingin menyimpan ID
        $('#taxesmaster_dropdown_' + index).remove();
    });
    
    // Tutup dropdown jika klik di luar
    $(document).on('click', function (e) {
        if (!$(e.target).closest('.search_taxesmaster, .dropdown-menu').length) {
            $('.dropdown-menu').remove();
        }
    });
    

    var subtotal = [];
    // function totalSales() {
    //     var subtotals = document.getElementsByClassName("subtotal123");
    //     console.log(subtotals);
    //     for (var i = 0; i < subtotals.length; ++i) {
    //         var b = subtotals[i].getAttribute("id");
    //         var split_id = b.split('_');
    //         var index = Number(split_id[1]);

    //         var data = $('#subtotal_' + index).val();
    //         var tax = $('#pajak_hasil_' + index).val();
    //         var pajak = 0;
    //         var total = 0;

    //         subtotal.push({
    //             data: data,
    //             tax: tax
    //         });
    //     }

    //     for (var i = 0; i < subtotal.length; ++i) {
    //         pajak += parseInt(subtotal[i].tax);
    //         total += parseInt(subtotal[i].data);
    //     }
    //     subtotal = [];
    //     document.getElementById("tax_amount").value = pajak.toLocaleString({ symbol: '', decimal: ',', separator: '' });
    //     document.getElementById("total").value = total.toLocaleString({ symbol: '', decimal: ',', separator: '' });
    // }


    function renumSales() {
        $(".sales_order_container > tr").each(function (i, v) {
            $(this).find(".rownumber").text(i + 1);
        });
    }
    function renumSalesDetail() {
        $(".sales_order_detail_container > tr").each(function (i, v) {
            $(this).find(".rownumber1").text(i + 1);
        });
    }
    function renumSalesShipment() {
        $(".sales_order_shipment_container > tr").each(function (i, v) {
            $(this).find(".rownumber1").text(i + 1);
        });
    }
    // End Sales Order Form Add ///

    // Function Delete Row
    $('.hapusdata').on('click', function (e) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        e.preventDefault();
        Swal.fire({
            title: `Are you sure you want to delete this record?`,
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#db2929',
            cancelButtonColor: '#1845eb',
            confirmButtonText: 'Yes, Trash !'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'error'
                )
                form.submit();
            } else {
                Swal.fire(
                    'Ok!',
                    'Your file has been ignored.',
                    'success'
                )
                e.preventDefault();
            }
        });
    });

    $('.adddata').on('click', function (e) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        e.preventDefault();
        Swal.fire({
            title: `Success, Data has been added`,
            text: "Thank you.",
            icon: "success",
            showCancelButton: true,
            confirmButtonColor: '#1845eb',
            cancelButtonColor: '#db2929',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'SUCCESS',
                    'Your file has been added.',
                    'success'
                )
                form.submit();
            } else {
                Swal.fire(
                    'Ok!',
                    'Your file has been ignored.',
                    'error'
                )
                e.preventDefault();
            }
        });
    });
    $('.shipconf').on('click', function (e) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        e.preventDefault();
        Swal.fire({
            title: `Success, Your Data has been shipped`,
            text: "Thank you.",
            icon: "success",
            showCancelButton: true,
            confirmButtonColor: '#1845eb',
            cancelButtonColor: '#db2929',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'SUCCESS',
                    'Your file has been updated.',
                    'success'
                )
                form.submit();
            } else {
                Swal.fire(
                    'Ok!',
                    'Your file has been ignored.',
                    'error'
                )
                e.preventDefault();
            }
        });
    });

    /* Added Script Return by Shindi 07 Mei 2022 */
    /* Start Ajax Return */
    let order = $("#order").val()
        , grn = $('#grn').val()

    const tableReturn = $('#tableReturn').DataTable({
        "bServerSide": true,
        "scrollY": 200,
        "scrollX": true,
        "pageLength": 10,
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'semua']],
        "bLengthChange": true,
        "bFilter": true,
        "bInfo": true,
        "processing": true,
        "bServerSide": true,
        "order": [[1, "desc"]],
        "autoWidth": false,
        "headers": { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        "dom": '<"card-header border-bottom"<"head-label"><"dt-action-buttons text-end">>\
        <"d-flex justify-content-between mx-0 mt-1 row"\
            <"d-flex justify-content-between mx-0 row"\
            >t>',
        "ajax": {
            url: "/search/data-return/",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: function (d) {
                d.grn = grn;
                d.order = order;
                return d
            }
        },
        "initComplete": function (settings, json) {
            const all_checkbox_view = $("#row-tampilan div input[type='checkbox']")
            $.each(all_checkbox_view, function (key, checkbox) {
                let kolom = $(checkbox).data('kolom')
                let is_checked = checkbox.checked
                table.column(kolom).visible(is_checked)
            })
            setTimeout(function () {
                table.columns.adjust().draw();
            }, 3000)
        },
        columnDefs: [
            {
                "targets": 0,
                "class": "text-center",
                "sortable": false,
                "render": function (data, type, row, meta) {
                    return `<input type="checkbox" class="form-check-input cb-child dt-checkboxes" name="line_number[]" id="${row.id}" value="${row.id}">
              <input type="hidden" name="po_header_id[]" value="${row.po_header_id}">
              <input type="hidden" name="po_line_id[]" value="${row.line_id}">
              <input type="hidden" name="uom_code[]" value="${row.uom_code}">
              <input type="hidden" name="shipment_unit_price[]" value="${row.unit_price}">
              <input type="hidden" name="item_id[]" value="${row.item_id}">
              <input type="hidden" name="item_description[]" value="${row.item_description}">
              <input type="hidden" name="transfer_cost[]" value="${row.transfer_cost}">
              <input type="hidden" name="secondary_uom_code[]" value="${row.secondary_uom_code}">
              <input type="hidden" name="product_category[]" value="${row.product_category}" >
              <input type="hidden" name="shipment_line_status_code[]" value="1">
              <input type="hidden" name="check[]" value="${row.id}"><input type="hidden" name="no_id[]" value="${row.id}">`;
                }
            },
            {
                "width": "10%",
                "targets": 1,
                "class": "text-nowrap",
                "render": function (data, type, row, meta) {
                    return `<input type="text" class="form-control text-center"  name="transaction_type[]"  autocomplete="off" required readonly  value="RETURN">`
                }
            },
            {
                "targets": 2,
                "class": "text-nowrap",
                "render": function (data, type, row, meta) {
                    return `<input type="number" class="form-control text-end"  min="0" max="${row.rcv - row.rtn}" name="quantity_returned[]"  autocomplete="off" required  oninput="this.value = Math.abs(this.value)" value="${row.rcv - row.rtn}">`
                }
            },
            {
                "targets": 3,
                "class": "text-nowrap text-center",
                "render": function (data, type, row, meta) {
                    return row.uom_code;
                }
            },
            {
                "targets": 4,
                "width": "30%",
                "class": "text-nowrap text-start",
                "render": function (data, type, row, meta) {
                    return row.item_code + '-' + row.item_description;
                }
            },
            {
                "targets": 5,
                "class": "text-nowrap text-end",
                "render": function (data, type, row, meta) {
                    return row.unit_price;
                }
            },
            {
                "targets": 6,
                "class": "text-nowrap text-end",
                "render": function (data, type, row, meta) {
                    return (row.rcv - row.rtn) * row.unit_price;
                }
            },
            {
                "targets": 7,
                "class": "text-nowrap text-center",
                "render": function (data, type, row, meta) {
                    return `<input type="text" class="form-control text-end"  name="to_subinventory[]"  autocomplete="off">`
                }
            }
        ],
        fixedColumns: true,
        searching: false
    })

    $(".filterReturn").on('change', function () {
        order = $("#order").val()
        grn = $("#grn").val()
        item = $("#item").val()
        tableReturn.ajax.reload(null, false)
    })

    /** Added Script MissTrans -- Shindi -- 07 Mei 2022*/
    // miscellaneous transaction -- Shindi
    $(document).on('click', '.add_misTransaction', function () {
        var lastname_id = $('.tr_input input[type=text]:nth-child(1)').last().attr('id');
        var split_id = lastname_id.split('_');
        var index = Number(split_id[1]) + 1;

        var coa = index - 1;
        var x = document.getElementById('reference_' + coa).value;
        // console.log(x)
        $('.miss_container').append('<tr class="tr_input"><td width="30%">\
                <input type="text" class="form-control search_item_code" placeholder="Type here ..." name="item_code[]" id="searchitem_'+ index + '" autocomplete="off" required><span class="help-block search_item_code_empty" style="display: none;" required>No Results Found ...</span> <input type="hidden" lass="search_inventory_item_id" id="id_' + index + '" name="inventory_item_id[]" autocomplete="off">   <input type="hidden" class="form-control" value="" id="description_' + index + '" name="description_item[]" autocomplete="off">\
            </td>\
            <td width="15%">\
                <input type="text" class="form-control search_subinventory" value="" name="subinventory_from[]" id="subinventoryfrom_'+ index + '"></td>\
                <input type="hidden" class="form-control subinvfrom_'+ index + '" name="subinvfrom[]" id="subinvfrom_' + index + '" autocomplete="off">\
            <td width="15%">\
                <input type="text" class="form-control text-end" name="quantity[]" id="quantity_'+ index + '" autocomplete="off">\
            </td>\
            <td width="10%">\
            <input type="text" class="form-control" name="uom[]" id="uom_'+ index + '" autocomplete="off" readonly required>\
            </td>\
            <td width="15%">\
                <input type="text" class="form-control search_subcategory_code_" name="sub_category[]" id="subcategory_'+ index + '" autocomplete="off">\
            </td>\
            <td width="15%">\
                    <input type="text" class="form-control search_ref_aju" name="reference[]"  id="reference_'+ index + '"  autocomplete="off">\
            </td>\
            <td>\
                <button type="button" class="btn btn-ligth btn-sm remove_tr" style="position: inherit;">X</button>\
            </td>\
        </tr>')
        document.getElementById('reference_' + index).value = x;
    })

    // Search Account
    $(document).on('keydown', '.search_coa', function () {
        var id = this.id;
        var splitid = id.split('_');
        var index = splitid[1];
        console.log(index);
        $('#' + id).autocomplete({
            source: "/search/search_coa",
            minLength: 1,
            response: function (event, ui) {
                if (ui.content.length === 0) {
                    $(this).parent().addClass('has-error');
                    $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                    $(this).next().show();
                    $(".search_coa_empty").show();
                    $('.form_submit').hide();
                } else {
                    $(this).next().hide()
                    $('.form_submit').show();
                }
            },
            select: function (event, ui) {
                $(this).val(ui.item.value1); // display the selected text
                var term = ui.item.coa; // selected id to input
                // AJAX
                $.ajax({
                    url: '/search/search_coa',
                    type: 'get',
                    data: { term: term },
                    dataType: 'json',
                    success: function (response) {

                        var len = response.length;
                        if (len > 0) {
                            var chart_of_account = response[0]['coa'];
                            document.getElementById('search_coa_' + index).value = chart_of_account;
                        }

                    }
                });
            }
        })
    });

    $('#pricelisttable').DataTable({

        searching: true,
        displayLength: 15,
        scrollY: true,
        dom: '<"card-header border-bottom"<"head-label"><"dt-action-buttons text-end">>\
            <"d-flex justify-content-between row mt-1"<"col-sm-12 col-md-6"Bl><"col-sm-12 col-md-2"f><"col-sm-12 col-md-2"p>t>',
        buttons: [{
            extend: 'print'
            , text: feather.icons['printer'].toSvg({
                class: 'font-small-4 me-50'
            }) + 'Print'
            , className: ''
            , exportOptions: {
                columns: ':visible'
            }
        }
            , {
            extend: 'csv'
            , text: feather.icons['file-text'].toSvg({
                class: 'font-small-4 me-50'
            }) + 'Csv'
            , className: ''
            , exportOptions: {
                columns: ':visible'
            }
        }
            , {
            extend: 'excel'
            , text: feather.icons['file'].toSvg({
                class: 'font-small-4 me-50'
            }) + 'Excel'
            , className: ''
            , exportOptions: {
                columns: ':visible'
            }
        }
            , {
            extend: 'pdf'
            , text: feather.icons['clipboard'].toSvg({
                class: 'font-small-4 me-50'
            }) + 'Pdf'
            , className: ''
            , exportOptions: {
                columns: ':visible'
            }
        }
            , {
            extend: 'copy'
            , text: feather.icons['copy'].toSvg({
                class: 'font-small-4 me-50'
            }) + 'Copy'
            , className: ''
            , exportOptions: {
                columns: ':visible'
            }
        }
            , {
            extend: 'colvis'
            , text: feather.icons['eye'].toSvg({
                class: 'font-small-4 me-50'
            }) + 'Colvis'
            , className: ''
            ,
        }
            ,],
        language: {
            paginate: {
                // remove previous & next text from pagination
                previous: '&nbsp;',
                next: '&nbsp;'
            }
        }
    });


    /** Added by shindi 10 Mei 2022, code by Pak Udin */
    // Receive
    let supplier = $("#supplier").val()
        , orderno = $("#orderno").val()
        , item = $("#item").val()

    const table = $('#table-rcv').DataTable({
        "bServerSide": true,
        "scrollY": 200,
        "scrollX": true,
        "pageLength": 10,
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'semua']],
        "bLengthChange": true,
        "bFilter": true,
        "bInfo": true,
        "processing": true,
        "bServerSide": true,
        "order": [[1, "desc"]],
        "autoWidth": false,
        "dom": '<"card-header border-bottom"<"head-label"><"dt-action-buttons text-end">>\
        <"d-flex justify-content-between mx-0 mt-1 row"\
            <"d-flex justify-content-between mx-0 row"\
            <"col-sm-12 col-md-2"f>\
            >t>',
        "ajax": {
            url: "/search/data-receive",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: function (d) {
                d.supplier = supplier;
                d.orderno = orderno;
                d.item = item;
                return d
            }
        },
        "initComplete": function (settings, json) {
            const all_checkbox_view = $("#row-tampilan div input[type='checkbox']")
            $.each(all_checkbox_view, function (key, checkbox) {
                let kolom = $(checkbox).data('kolom')
                let is_checked = checkbox.checked
                table.column(kolom).visible(is_checked)
            })
            setTimeout(function () {
                table.columns.adjust().draw();
            }, 3000)
        },
        columnDefs: [
            {
                "targets": 0,
                "class": "text-nowrap text-center",
                "sortable": false,
                "render": function (data, type, row, meta) {
                    return `<input type="checkbox" class="form-check-input cb-child dt-checkboxes" name="line_number[]" id="${row.id}" value="${row.id}">
                <input type="hidden" name="po_header_id[]" value="${row.po_header_id}">
                <input type="hidden" name="conversion_rate" value="${row.rate}" >
                <input type="hidden" name="conversion_date" value="${row.rate_date}" >
                <input type="hidden" name="po_line_id[]" value="${row.line_id}">
                <input type="hidden" name="attribute2[]" value="${row.attribute2}">
                <input type="hidden" name="po_uom_code[]" value="${row.po_uom_code}">
                <input type="hidden" name="inventory_item_id[]" value="${row.inventory_item_id}">
                <input type="hidden" name="item_description[]" value="${row.item_description}">
                <input type="hidden" name="tax_name[]" value="${row.tax_name}">
                <input type="hidden" name="check[]" value="${row.id}">
                <input type="hidden" name="no_id[]" value="${row.id}">
                <input type="hidden" name="unit_price[]" value="${row.unit_price}">`;
                }
            },
            {
                "width": "10%",
                "targets": 1,
                "class": "text-nowrap",
                "render": function (data, type, row, meta) {
                    return `<input type="number" class="form-control text-end"  min="0" max="${row.po_quantity - row.quantity_receive}" step="any" name="purchase_quantity[]"  autocomplete="off" required   value="${row.po_quantity - row.quantity_receive}">`
                }
            },
            {
                "targets": 2,
                "width": "15%",
                "class": "text-nowrap text-center",
                "render": function (data, type, row, meta) {
                    return row.po_uom_code;
                }
            },
            {
                "targets": 3,
                "width": "60%",
                "class": "text-nowrap text-start",
                "render": function (data, type, row, meta) {
                    return row.item_code + '-' + row.item_description;
                }
            },
            {
                "targets": 4,
                "width": "20%",
                "class": "text-center",
                "render": function (data, type, row, meta) {
                    return `
                    <input type="text" class="form-control search_subinventoryto text-center" name="" id="subinventoryto_${row.line_id}" value="${row.receiving_inventory}" autocomplete="off">
                    <input type="hidden" class="form-control subinvto_${row.line_id}" name="subinventory[]" id="subinvto_${row.line_id}" autocomplete="off">`
                }
            },
        ],
        fixedColumns: true,
        searching: false
    })

    // add row rcv direct

    $(document).on('click', '.add_rcv_direct', function () {
        var lastname_id = $('.tr_input input[type=text]:nth-child(1)').last().attr('id');
        var split_id = lastname_id.split('_');
        var index = Number(split_id[1]) + 1;
        console.log(lastname_id);
        $('.rcv_container').append('<tr class="tr_input" id="rowTab1_' + index + '">\
                            <td width="40%">\
                                <input type="text" class="form-control search_item_code" placeholder="Type here ..." name="item_code[]" id="searchitem_'+ index + '" autocomplete="off" required >\
                                <span class="help-block search_item_code_empty" style="display: none;" required>No Results Found ...</span>\
                                <input type="hidden" class="search_inventory_item_id" id="id_'+ index + '" value="1" name="inventory_item_id[]" autocomplete="off">  \
                                <input type="hidden" class="search_inventory_item_id" id="lineId_'+ index + '" value="" name="lineId[]" autocomplete="off"> \
                                <input type="hidden" class="form-control" value="" id="description_'+ index + '"  name="description_item[]" autocomplete="off">\
                                <input type="hidden" class="form-control" id="category_'+ index + '" value="" name="category[]" autocomplete="off">  \
                            </td>\
                            <td width="15%">\
                                <input type="text" class="form-control purchase_quantity float-end text-end" name="sub_category[]" id="sub_category_'+ index + '" autocomplete="off" readonly required>\
                            </td>\
                            <td width="15%">\
                                <input type="text" class="form-control search_uom_conversion" name="pr_uom_code[]" id="uom_'+ index + '" autocomplete="off">\
                                <span class="help-block search_uom_code_empty glyphicon" style="display: none;"> No Results Found </span>\
                            </td>\
                            <td width="15%"><input type="text" class="form-control purchase_quantity float-end text-end" value="0" name="quantity[]" id="qty_'+ index + '" autocomplete="off" required ></td>\
                            <td width="15%"><input type="text" name="subinventory[]" class="form-control search_subinventory"  id="subinvfrom_'+ index + '" autocomplete="off"></td>\
                            <td><button type="button" class="btn btn-secondary btn-sm btn-mod remove_tr_sales">X</button></td>\
                        </tr>');
        $('.rcv_detail_container').append(
            '<tr class="tr_input" id="rowTab2_' + index + '">\
                            <td><input type="number" class="form-control" value="0" id="attribute_integer1_1" name="attribute_integer1[]" autocomplete="off" required ></td>\
                            <td> <input type="number" value="0" id="attribute1_1" name="attribute1[]" class="form-control " ></td>\
                            <td> <input type="number" value="0" id="attribute2_1" name="attribute2[]" class="form-control " ></td>\
                            <td> <input type="number" value="0" id="attribute_integer2_1" name="attribute_integer2[]" class="form-control " ></td>\
                            <td> <input type="number" value="0" id="transfer_percentage_1" name="transfer_percentage[]" class="form-control " ></td>\
                            <td><input type="number" value="0" id="attribute_integer3_1" name="attribute_integer3[]"  class="form-control "></td>\
                            <td width="3px">\
                                <button type="button" class="btn  btn-sm btn-mod btn-secondary remove_tr_sales" >X</button>\
                            </td>\
                        </tr>');
    });


    // end Supplier Direct

    // Rcv Customer
    let vendor_id = $('#vendor_id').val(),
        ordernum = $('#orderno').val(),
        items = $('#item').val()

    const rcvcustomer = $('#rcvcustomerdetil').DataTable({
        "bServerSide": true,
        "scrollY": 200,
        "scrollX": true,
        "pageLength": 10,
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'semua']],
        "bLengthChange": true,
        "bFilter": true,
        "bInfo": true,
        "processing": true,
        "bServerSide": true,
        "order": [[1, "desc"]],
        "autoWidth": false,
        "ajax": {
            url: "/search/rcvcustomer/",
            type: "GET",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: function (d) {
                d.vendor_id = $('#vendor_id').val();
                d.items = $('#item').val();
                d.ordernum = $('#orderno').val();
                console.log('testo',);
                return d
            }
        },
        "initComplete": function (settings, json) {
            const all_checkbox_view = $("#row-tampilan div input[type='checkbox']")
            $.each(all_checkbox_view, function (key, checkbox) {
                let kolom = $(checkbox).data('kolom')
                let is_checked = checkbox.checked
                table.column(kolom).visible(is_checked)
            })
            setTimeout(function () {
                table.columns.adjust().draw();
            }, 3000)
        },
        columnDefs: [
            {
                targets: 0,
                width: "0%",
                class: "text-nowrap",
                orderable: false,
                render: function (data, type, row, meta) {
                    return (`
                            <input type="checkbox" class="form-check-input cb-child dt-checkboxes" name="line_number[]" id="${row.id}" value="${row.id}">
                            <input type="hidden" name="invoice_to_org_id[]" value="${row.invoice_to_org_id}">
                            <input type="hidden" name="header_id[]" value="${row.header_id}">
                            <input type="hidden" name="line_id[]" value="${row.line_id}">
                            <input type="hidden" name="inventory_item_id[]" value="${row.inventory_item_id}">
                            <input type="hidden" name="shipping_inventory[]" value="${row.shipping_inventory}">
                            <input type="hidden" name="order_quantity_uom[]" value="${row.order_quantity_uom}">
                            <input type="hidden" name="ordered_quantity[]" value="${row.ordered_quantity}">
                            <input type="hidden" name="flow_status_code[]" value="${row.flow_status_code}">
                            <input type="hidden" name="user_description_item[]" value="${row.user_description_item}">
                            <input type="hidden" name="order_number[]" value="${row.order_number}">
                            <input type="hidden" name="unit_selling_price[]" value="${row.unit_selling_price}">
                            <input type="hidden" name="party_name[]" value="${row.party_name}">
                            <input type="hidden" name="checkid[]" value="${row.id}">
                        `);
                },
            },
            {
                "targets": 1,
                "render": function (data, type, row, meta) {
                    return row.order_number;
                }
            },
            {
                "targets": 2,
                "render": function (data, type, row, meta) {
                    return row.ordered_quantity;
                }
            },
            {
                "targets": 3,
                "render": function (data, type, row, meta) {
                    return row.order_quantity_uom;
                }
            },
            {
                "targets": 4,
                "render": function (data, type, row, meta) {
                    return row.user_description_item;
                }
            },
            {
                "targets": 5,
                "render": function (data, type, row, meta) {
                    return row.unit_selling_price;
                }
            },
            {
                "targets": 6,
                "render": function (data, type, row, meta) {
                    return row.ordered_quantity * row.unit_selling_price;
                }
            },
        ],
        fixedColumns: true,
        searching: false
    })

    $(".filterrcvcustomer").on('change', function () {
        var vendor_id = $('#vendor_id').val();
        var ordernum = $('#orderno').val();
        var items = $('#item').val();
        var testo = 'test';
        // console.log('testo',ordernum);

        rcvcustomer.ajax.reload(null, false)
    })

    //Search Cost Center
    $(".search_cost_center").autocomplete({
        source: "/search/cost-center",
        minLength: 1,
        response: function (event, ui) {
            if (ui.content.length === 0) {

                $(this).parent().addClass('has-error');
                $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                $(".search_address1_empty").show();
                $('.form_submit').hide();

            } else {
                $(".search_address1_empty").hide();
                $('.form_submit').show();
            }
        },
        select: function (event, ui) {

            $('.search_cc_id').val(ui.item.value1);
        }
    });


    // Sub inventory transfer
    $(".btn-edit").click(function (event) {
        var index = $(this).data('index');
        var qty = $(this).data('qty');
        var item = $(this).data('item');
        var header = $(this).data('header');
        var line = $(this).data('line');
        var id = $(this).data('id');
        console.log(id);
        $("input[name=req_line_id]").val(index);
        $("input[name=split_quantity]").val(qty);
        $("input[name=item]").val(item);
        $("input[name=header]").val(header);
        $("input[name=line]").val(line);
        $("input[name=id]").val(id);
        $('#demoModal').modal('show');
    })
    $(".btn-close").click(function (event) {
        $("#demoModal").modal("hide");
    })
    // sales return
    $(".btn-salesreturn").click(function (event) {
        var index = $(this).data('index');
        var header = $(this).data('header');
        var pricelist = $(this).data('pricelist');
        var productname = $(this).data('productname');
        var qty = $(this).data('qty');
        var price = $(this).data('price');
        var inv_item = $(this).data('inv_item');
        var shp_inv = $(this).data('shp_inv');
        var id = $(this).data('id');
        console.log(id);
        $("input[name=index]").val(index);
        $("input[name=header]").val(header);
        $("input[name=pricelist]").val(pricelist);
        $("input[name=productname]").val(productname);
        $("input[name=qty]").val(qty);
        $("input[name=price]").val(price);
        $("input[name=inv_item]").val(inv_item);
        $("input[name=shp_inv]").val(shp_inv);
        $("input[name=id]").val(id);
        $('#returnModal').modal('show');
    })
    $(".btn-close").click(function (event) {
        $("#returnModal").modal("hide");
    })

    // delivey --Heryy-- updateed at --21-06-2022--
    // MODAL DELIVERY
    $(".btn-mod").click(function (event) {
        var id = $(this).data('id');
        var head_id = $(this).data('head_id');
        var panjang = $(this).data('panjang');
        var lebar = $(this).data('lebar');
        var xnet_weight = $(this).data('xnet_weight');
        var gsm = $(this).data('gsm');
        var source_header = $(this).data('source_header');
        var source_line = $(this).data('source_line');
        var inventory_item = $(this).data('inventory_item');

        var shipping_inventory = $(this).data('shipping_inventory');
        var subinventory_from = $(this).data('subinventory_from');
        var subinventoryfrom_1 = $(this).data('subinventoryfrom_1');
        //  console.log(id);
        $("input[name=id]").val(id);
        $("input[name=head_id]").val(head_id);
        $("input[name=panjang]").val(panjang);
        $("input[name=lebar]").val(lebar);
        $("input[name=xnet_weight]").val(xnet_weight);
        $("input[name=gsm]").val(gsm);
        $("input[name=source_header]").val(source_header);
        $("input[name=source_line]").val(source_line);
        $("input[name=inventory_item]").val(inventory_item);

        $("input[name=shipping_inventory]").val(shipping_inventory);
        $("input[name=subinventory_from]").val(subinventory_from);
        $("select[name=shipping_inventory]").val(shipping_inventory);
        $("select[name=subinventory_from]").val(subinventory_from);
        if (document.getElementById('subinventoryfrom_1')) {
            document.getElementById('subinventoryfrom_1').value = subinventoryfrom_1;
        }
        $('#modaladdinv').modal('show');
        // console.log(panjang);
    })

    $(".btn-delete").click(function (event) {
        var id = $(this).data('id');
        var header_id = $(this).data('header_id');
        var line_id = $(this).data('line_id');

        console.log(id);
        $("input[name=id]").val(id);
        $("input[name=header_id]").val(header_id);
        $("input[name=line_id]").val(line_id);

        $('#modaldelete').modal('show');
    })

    $(".btn-ship").click(function (event) {
        var idheader = $(this).data('idheader');
        var deliveryid = $(this).data('deliveryid');
        console.log(deliveryid);
        $("input[name=idheader]").val(idheader);
        $("input[name=deliveryid]").val(deliveryid);
        $('#shipconfm').modal('show');

    })
    $(".btn-close").click(function (event) {
        $("#modaladdinv").modal("hide");
    })
    // MODAL DELIVERY

    $(document).on('click', '.add_transfer', function () {
        var lastname_id = $('.tr_input input[type=text]:nth-child(1)').last().attr('id');
        var split_id = lastname_id.split('_');
        var index = Number(split_id[1]) + 1;
        var coa = index - 1;
        var x = document.getElementById('reference_' + coa).value;
        $('.transfer_container').append('<tr class="tr_input"><td width="30%">\
                <input type="text" class="form-control search_item_code" placeholder="Type here ..." name="item_code[]" id="searchitem_'+ index + '" autocomplete="off" required><span class="help-block search_item_code_empty_' + index + '" style="display: none;" required>No Results Found ...</span> <input type="hidden" lass="search_inventory_item_id" id="id_' + index + '" name="inventory_item_id[]" autocomplete="off">   <input type="hidden" class="form-control" value="" id="description_' + index + '" name="description_item[]" autocomplete="off">\
            </td>\
            <td width="10%">\
            <input type="text" class="form-control search_subcategory_code_" value="" name="category[]" id="subcategory_'+ index + '"  required autocomplete="off">\
         </td>\
            <td width="14%">\
                <input type="text" class="form-control search_subinventory" value="" name="subinventory_from[]" id="subinventoryfrom_'+ index + '" required></td>\
                <input type="hidden" class="form-control subinvfrom_'+ index + '" name="subinvfrom[]" id="subinvfrom_' + index + '" autocomplete="off">\
            <td width="14%">\
                <input type="text" class="form-control search_subinventoryto" name="subinventory_to[]" id="subinventoryto_'+ index + '" autocomplete="off" required>\
                <input type="hidden" class="form-control subinvto_'+ index + '" name="subinvto[]" id="subinvto_' + index + '" autocomplete="off">\
            </td>\
            <td width="11%">\
            <input type="text" class="form-control text-end" name="quantity[]" id="quantity_'+ index + '" autocomplete="off">\
            </td >\
            <td width="8%">\
                <input type="text" class="form-control text-center" name="uom[]" id="uom_'+ index + '" autocomplete="off" readonly required>\
            </td>\
            <td width="13%">\
                <input type="text" class="form-control search_ref_aju" name="reference[]" id="reference_'+ index + '">\
            </td>\
            <td>\
                <button type="button" class="btn btn-ligth btn-sm remove_tr" style="position: inherit;">X</button>\
            </td>\
        </tr > ')
        document.getElementById('reference_' + index).value = x;
    })

    $(document).on('keydown', '.search_subinventory', function () {
        var id = this.id;
        var splitid = id.split('_');
        var index = splitid[1];
        $('#' + id).autocomplete({
            source: "/search/subinventory",
            minLength: 1,
            response: function (event, ui) {
                if (ui.content.length === 0) {
                    $(this).parent().addClass('has-error');
                    $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                    $(this).next().show();
                    $(".search_subinventory_empty").show();
                    $('.form_submit').hide();
                } else {
                    $(this).next().hide()
                    $('.form_submit').show();
                }
            },
            select: function (event, ui) {
                $(this).val(ui.item.value); // display the selected text
                var term = ui.item.subinv_code; // selected id to input
                // AJAX
                $.ajax({
                    url: '/search/subinventory',
                    type: 'get',
                    data: { term: term },
                    dataType: 'json',
                    success: function (response) {

                        var len = response.length;

                        if (len > 0) {
                            var subinv_code = response[0]['value1'];
                            document.getElementById('subinvfrom_' + index).value = subinv_code;
                        }
                    }
                });
            }
        })
    });

    $(document).on('keydown', '.search_subinventoryto', function () {
        var id = this.id;
        var splitid = id.split('_');
        var index = splitid[1];
        $('#' + id).autocomplete({
            source: "/search/subinventory",
            minLength: 1,
            response: function (event, ui) {
                if (ui.content.length === 0) {
                    $(this).parent().addClass('has-error');
                    $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                    $(this).next().show();
                    $(".search_subinventory_empty").show();
                    $('.form_submit').hide();
                } else {
                    $(this).next().hide()
                    $('.form_submit').show();
                }
            },
            select: function (event, ui) {
                $(this).val(ui.item.value); // display the selected text
                var term = ui.item.subinv_code; // selected id to input
                // AJAX
                $.ajax({
                    url: '/search/subinventory',
                    type: 'get',
                    data: { term: term },
                    dataType: 'json',
                    success: function (response) {

                        var len = response.length;

                        if (len > 0) {
                            var subinv_code = response[0]['value1'];
                            console.log(subinv_code)
                            document.getElementById('subinvto_' + index).value = subinv_code;
                        }

                    }
                });
            }
        })
    });

    //Physical inventory
    $(document).on('click', '.add_physicalInventory', function () {
        var lastname_id = $('.tr_input input[type=text]:nth-child(1)').last().attr('id');
        console.log(lastname_id);
        var split_id = lastname_id.split('_');
        var index = Number(split_id[1]) + 1;

        $('.physical_container').append('<tr class="tr_input"><td width="30%">\
                    <input type="text" class="form-control search_item_code" placeholder="Type here ..." name="item_code[]" id="searchitem_'+ index + '" autocomplete="off" required><span class="help-block search_item_code_empty" style="display: none;" required>No Results Found ...</span> <input type="hidden" lass="search_inventory_item_id" id="id_' + index + '" name="inventory_item_id[]" autocomplete="off">   <input type="hidden" class="form-control" value="" id="description_' + index + '" name="description_item[]" autocomplete="off">\
                </td>\
                <td width="10%">\
                    <input type="text" class="form-control" name="tag_uom[]" id="uom_'+ index + '" autocomplete="off" readonly required>\
                </td>\
                <td width="10%">\
                    <input type="text" class="form-control" name="tag_quantity[]" id="tag_quantity_'+ index + '" autocomplete="off"  required>\
                </td>\
                <td width="15%">\
                    <input type="text" class="form-control search_subinventory" value="" name="subinventory1[]" id="subinventoryfrom_'+ index + '"></td>\
                    <input type="hidden" class="form-control subinvfrom_'+ index + '" name="subinventory[]" id="subinvfrom_' + index + '" autocomplete="off">\
                <td width="15%">\
                    <input type="text" name="locator_id[]" class="form-control" id="locator_'+ index + '" autocomplete="off" required>\
                </td>\
                <td width="15%">\
                    <input type="text" class="form-control" name="revision[]" id="reference_'+ index + '">\
                </td>\
                <td>\
                    <button type="button" class="btn btn-ligth btn-sm remove_tr" style="position: inherit;">X</button>\
                </td>\
            </tr>')
    })

    /** Bom List Start */
    //Bom List Component
    $(document).on('click', '.remove_tr_bom', function () {
        var identifier = $(this).closest('tr').attr('id');
        var split_id = identifier.split('_');
        var index = Number(split_id[1]);

        $("#rowTab1_" + index).remove();
        $("#rowTab2_" + index).remove();
        $("#rowTab3_" + index).remove();
        // key=index-1;
    });

    $(document).on('click', '.add_bomComponent', function () {
        var lastname_id = $('.tr_input input[type=text]:nth-child(1)').last().attr('id');
        console.log(lastname_id);
        var split_id = lastname_id.split('_');
        var index = Number(split_id[1]) + 1;

        $('.bomComponent_container').append('<tr class="tr_input" id="rowTab1_' + index + '">\
            <td class="rownumberBOM" value="" width="10%"></td>\
            <td width="30%">\
                <input type="text" class="form-control search_item_code" placeholder="Type here ..." name="item_code[]" id="searchitem_'+ index + '" autocomplete="off" required><span class="help-block search_item_code_empty" style="display: none;" required>No Results Found ...</span> \
                <input type="hidden" class="search_inventory_item_id"  id="id_'+ index + '" name="child_inventory_id[]">\
                <input type="hidden" class="form-control" value="" id="description_'+ index + '" name="child_description[]" >\
                <input type="hidden" class="form-control" value="" id="item_code_'+ index + '" name="child_item[]" >\
                <input type="hidden" class="form-control" value="" id="type_code_'+ index + '" name="child_item_type[]">\
                <input type="hidden" class="form-control" value=""  id="sub_category_'+ index + '" name="sub_category[]"">\
            </td>\
            <td width="10%">\
                <input type="text" class="form-control" name="uom[]" id="uom_'+ index + '" autocomplete="off" readonly>\
            </td>\
            <td width="10%">\
                <input type="text" class="form-control" name="usage[]" id="tag_quantity_'+ index + '" autocomplete="off"  required>\
            </td>\
            <td width="15%">\
                <input type="text" name="standard_cost[]" class="form-control" id="locator_'+ index + '" autocomplete="off" required>\
            </td>\
            <td width="15%">\
                <input type="text" class="form-control search_subinventoryto" name="subinventory_to[]" id="subinventoryto_'+ index + '" autocomplete="off">\
                <input type="hidden" class="form-control subinvto_'+ index + '" name="supply_subinventory[]" id="subinvto_' + index + '" autocomplete="off">\
            </td>\
            <td width="5%">\
                <div class="form-check form-switch form-check-primary">\
                    <input type="checkbox" class="form-check-input" name="organization_id" id="customSwitch10_'+ index + '" value="222" checked="">\
                    <label class="form-check-label" for="customSwitch10_'+ index + '">\
                        <span class="switch-icon-left"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">\
                                <polyline points="20 6 9 17 4 12"></polyline>\
                            </svg></span>\
                        <span class="switch-icon-right"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">\
                                <line x1="18" y1="6" x2="6" y2="18"></line>\
                                <line x1="6" y1="6" x2="18" y2="18"></line>\
                            </svg></span>\
                    </label>\
                </div>\
            </td>\
            <td>\
                <button type="button" class="btn btn-ligth btn-sm remove_tr_bom" style="position: inherit;">X</button>\
            </td>\
        </tr>')
        renumberComponent(index);

        $('.bomOperation_container').append('<tr class="tr_input" id="rowTab2_' + index + '">\
            <td class="rownumberBOM" value="" width="10%"></td>\
            <td class="rownumber" >\
                <input type="text" class="form-control"    id="uom_'+ index + '" autocomplete="off">\
            </td>\
            <td width="20%">\
                <input type="text" class="form-control  " placeholder="Type here ..."    id="searchitem_'+ index + '" autocomplete="off" required >\
                <span class="help-block search_item_code_empty glyphicon" style="display: none;"> No Results Found </span>\
                <input type="hidden" class="search_inventory_item_id"  id="id_'+ index + '"   ></td>\
                <input type="hidden" class="form-control" value="" id="description_'+ index + '"    autocomplete="off">\
            <td width="15%">\
                <input type="date"    class="form-control" autocomplete="off" required>\
            </td>\
            <td width="15%">\
                <input type="datetime-local"    class="form-control"  autocomplete="off" required>\
            </td>\
            <td width="15%">\
                <input type="datetime-local"    class="form-control" autocomplete="off" required>\
            </td>\
            <td width="5%">\
                <button type="button" class="btn btn-ligth btn-sm remove_tr_bom" style="position: inherit;">X</button>\
            </td>\
        </tr>')
        renumberOperation(index);

        $('.bomMicellaneous_container').append('<tr class="tr_input" id="rowTab3_' + index + '">\
            <td class="rownumberBOM" value="" width="10%"></td>\
            <td width="30%">\
                <input type="text" class="form-control search_item_code" placeholder="Type here ..."    id="searchitem_'+ index + '" autocomplete="off" required><span class="help-block search_item_code_empty" style="display: none;" required>No Results Found ...</span> \
                <input type="hidden" class="search_inventory_item_id"  id="id_'+ index + '"   >\
                <input type="hidden" class="form-control" value="" id="description_'+ index + '"    >\
                <input type="hidden" class="form-control" value="" id="item_code_'+ index + '"    >\
                <input type="hidden" class="form-control" value="" id="type_code_'+ index + '"   >\
            </td>\
            <td width="10%">\
                <input type="text" class="form-control"  autocomplete="off" readonly>\
            </td>\
            <td width="10%">\
                <input type="text" class="form-control"  autocomplete="off"  required>\
            </td>\
            <td width="15%">\
                <input type="text"  class="form-control" autocomplete="off" required>\
            </td>\
            <td width="5%">\
                <div class="form-check form-switch form-check-primary">\
                    <input type="checkbox" class="form-check-input" name="organization_id" id="customSwitch10_'+ index + '" value="222" checked="">\
                    <label class="form-check-label" for="customSwitch10_'+ index + '">\
                        <span class="switch-icon-left"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">\
                                <polyline points="20 6 9 17 4 12"></polyline>\
                            </svg></span>\
                        <span class="switch-icon-right"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">\
                                <line x1="18" y1="6" x2="6" y2="18"></line>\
                                <line x1="6" y1="6" x2="18" y2="18"></line>\
                            </svg></span>\
                    </label>\
                </div>\
            </td>\
            <td>\
                <button type="button" class="btn btn-ligth btn-sm remove_tr_bom" style="position: inherit;">X</button>\
            </td>\
        </tr>')
        renumberMicellaneous(index);
    })


    //search item code parent
    $(document).on('keydown', '.search_item_code_parent', function () {
        var id = this.id;
        var splitid = id.split('_');
        var index = splitid[1];
        $('#' + id).autocomplete({
            source: "/search/item_code",
            minLength: 1,
            response: function (event, ui) {
                if (ui.content.length === 0) {
                    $(this).parent().addClass('has-error');
                    $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                    $(this).next().show();
                    $(".search_item_code_empty").show();
                    $('.form_submit').hide();
                } else {
                    $(this).next().hide()
                    $('.form_submit').show();
                }
            },
            select: function (event, ui) {
                $(this).next().next().val(ui.item.value1);
                $(this).val(ui.item.label); // display the selected text
                var id = ui.item.value1; // selected id to input
                // AJAX
                $.ajax({
                    url: '/search/item_detail',
                    type: 'get',
                    data: { id: id, request: 2 },
                    dataType: 'json',
                    success: function (response) {
                        // console.log(response);
                        var len = response.length;
                        if (len > 0) {
                            var inv_id = response[0]['inv_id'];
                            //var price = response[0]['price'];
                            var uom = response[0]['uom'];
                            var description = response[0]['description'];
                            var item_code = response[0]['item_code'];
                            var type_code = response[0]['type_code'];
                            //var email = response[0]['email'];
                            // var age = response[0]['age'];
                            // var salary = response[0]['salary'];

                            document.getElementById('id').value = inv_id;
                            // document.getElementById('uom').value = uom;
                            document.getElementById('description').value = description;
                            document.getElementById('item_code').value = item_code;
                            document.getElementById('type_code').value = type_code;

                            //  document.getElementById('email_'+index).value = email;
                            // document.getElementById('salary_'+index).value = salary; */
                        }
                    }
                });
                return false;
            }
        });

    });

    function renumberComponent() {
        $(".bomComponent_container > tr").each(function (i, v) {
            $(this).find(".rownumberBOM").text(i + 1 + '0');
        });
    }

    function renumberOperation() {
        $(".bomOperation_container > tr").each(function (i, v) {
            $(this).find(".rownumberBOM").text(i + 1 + '0');
        });
    }

    function renumberMicellaneous() {
        $(".bomMicellaneous_container > tr").each(function (i, v) {
            $(this).find(".rownumberBOM").text(i + 1 + '0');
        });
    }
    /** Bom List End */

    /** Work Order Start */

    let parent = $("#parent").val()

    const tableWO = $('#tableWO').DataTable({
        "bServerSide": false,
        "pageLength": 10,
        "bLengthChange": false,
        "bFilter": false,
        "bInfo": false,
        "processing": true,
        "sScrollHeadInner": "1497.2px",
        "order": [[1, "desc"]],
        "autoWidth": false,
        "ajax": {
            url: "/search/work-order/",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: function (d) {
                d.parent = parent;
                console.log(d.parent);
                return d
            }
        },
        columnDefs: [
            {
                "targets": 0,
                "width": "20%",
                "class": "text-nowrap",
                "sortable": false,
                "render": function (data, type, row, meta) {
                    return row.child_item;
                }
            },
            {
                "targets": 1,
                "width": "35%",
                "class": "text-nowrap",
                "render": function (data, type, row, meta) {
                    return row.child_description;
                }
            },
            {
                "targets": 2,
                "width": "10%",
                "class": "text-nowrap text-center",
                "render": function (data, type, row, meta) {
                    return row.uom;
                }
            },
            {
                "targets": 3,
                "width": "15%",
                "class": "text-nowrap text-center",
                "render": function (data, type, row, meta) {
                    return `<input type="text" class="form-control text-center" id="usage_1" name="c_quantity[]" value="${row.usage}">
                    <input type="hidden" name="c_inventory_item_id[]" value="${row.child_inventory_id}">
                    <input type="hidden" name="c_uom_code[]" value="${row.uom}">
                    <input type="hidden" name="c_supply_subinventory[]" value="${row.supply_subinventory}">`;
                }
            },
            {
                "targets": 4,
                "width": "10%",
                "class": "text-nowrap text-start",
                "render": function (data, type, row, meta) {
                    return row.supply_subinventory;
                }
            },
            {
                "targets": 5,
                "width": "5%",
                "class": "text-nowrap text-start",
                "render": function (data, type, row, meta) {
                    return `<button type="button" class="btn btn-ligth btn-sm remove_tr_wo">X</button>`;
                }
            }
        ],
        fixedColumns: false,
        searching: false
    })

    $(document).on('click', '.remove_tr_wo', function () {
        $(this).closest('tr').remove();
        $('.tr_input1').remove();
        $('.add_row').remove();

        $('.workOrder_container').append('<tr class="tr_input1">\
                <td width="auto">\
                    <input type="text" class="form-control search_fg_item" placeholder="Type here ..." name="c_item_code[]" id="searchitem_1" autocomplete="off" required><span class="help-block search_item_code_empty" style="display: none;" required>No Results Found ...</span> \
                    <input type="hidden" class="search_inventory_item_id"  id="c_id_1" name="c_inventory_item_id[]">\
                    <input type="hidden" class="form-control" value="" id="c_item_code_1" name="c_child_item[]" >\
                    <input type="hidden" class="form-control" value="" id="c_sub_category_1" name="c_sub_category[]" >\
                    <input type="hidden" class="form-control" value="" id="c_type_code_1" name="c_type_code[]" >\
                    <input type="hidden" class="form-control" value="" id="c_roll_1" name="c_roll[]" >\
                </td>\
                <td width="auto">\
                    <input type="text" class="form-control" value="" id="c_description_1" readonly name="c_child_description[]" >\
                <td width="auto">\
                    <input type="text" class="form-control" name="c_uom_code[]" id="c_uom_1" autocomplete="off" readonly>\
                </td>\
                <td width="auto">\
                    <input type="text" class="form-control" name="c_quantity[]" id="tag_quantity_1" autocomplete="off"  required>\
                </td>\
                <td width="auto">\
                    <input type="text" class="form-control search_subinventoryto" name="c_subinventory_to[]" id="subinventoryto_1" autocomplete="off">\
                    <input type="hidden" class="form-control subinvto_1" name="c_supply_subinventory[]" id="subinvto_1" autocomplete="off">\
                </td>\
                <td width="5%">\
                    <button type="button" disabled class="btn btn-ligth btn-sm remove_tr" style="position: inherit;">X</button>\
                </td>\
            </tr>\
            <tr class="add_row"> <td><input type="hidden" name="revision[]" class="form-control " id="rev_1"  autocomplete="off">\
                <button type="button" class="btn btn-outline-success add_workOrder btn-sm" style="font-size: 12px;"><i data-feather="plus"></i> Add Rows</button></td>\
            </tr>')
    });

    $('#btn-sales').on('click', function (e) {
        var opval = $(this).val();
        const table_sales = $('#table_sales').DataTable({
            "bServerSide": true,
            "scrollY": 300,
            "scrollX": true,
            "pageLength": 10,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'semua']],
            "bLengthChange": true,
            "bFilter": true,
            "paging": true,
            "bInfo": true,
            "processing": true,
            "bServerSide": true,
            "order": [[1, "desc"]],
            "autoWidth": false,
            "ajax": {
                url: "/search/order-summary",
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: function (d) {
                    d.search = $('input[type="search"]').val();
                    return d
                }
            },
            columnDefs: [
                {
                    "targets": 0,
                    "class": "text-nowrap",
                    "sortable": false,
                    "render": function (data, type, row, meta) {
                        return `
                          <input type="checkbox" class="form-check-input cb-sales dt-checkboxes"
                            data-id="${row.order_number}" data-subinv="${row.shipping_inventory}" data-qty="${row.ordered_quantity}" data-po="${row.cust_po_number}"
                            data-code="${row.item_code}" data-gsm="${row.gsm}" data-l="${row.length}" data-w="${row.width}" data-cus="${row.invoice_to_org_id}"
                            data-seq="${row.roll}" data-sales="${row.sales_header_id}" name="line_number[]" id="idSales" value="${row.inventory_item_id}">`;
                    }
                },
                {
                    "targets": 1,
                    "class": "text-nowrap ",
                    "render": function (data, type, row, meta) {
                        return row.order_number;
                    }
                },
                {
                    "targets": 2,
                    "class": "text-nowrap ",
                    "render": function (data, type, row, meta) {
                        return row.customer_name;
                    }
                },
                {
                    "targets": 3,

                    "render": function (data, type, row, meta) {
                        return row.item_code + " " + row.gsm + " GSM " + row.width + " CM";
                    }
                },
                {
                    "targets": 4,
                    "class": "text-end",
                    "render": function (data, type, row, meta) {
                        return row.ordered_quantity;
                    }
                },
                {
                    "targets": 5,

                    "render": function (data, type, row, meta) {
                        return row.shipping_inventory;
                    }
                },
                {
                    "targets": 6,
                    "render": function (data, type, row, meta) {
                        return row.schedule_ship_date;

                    }
                }

            ],
            fixedColumns: false,
            destroy: true,
            searching: true
        })

    })

    $("#addSales-line").click(function () {
        $(".cb-sales:checked").each(function () {
            // console.log("masuk");
            var sales = $(this).attr('data-id');
            var item_id = $(this).attr('value');
            var item_qty = $(this).attr('data-qty');
            var item_code = $(this).attr('data-code');
            var subinventory = $(this).attr('data-subinv');
            var gsm = $(this).attr('data-gsm');
            var l = $(this).attr('data-l');
            var w = $(this).attr('data-w');
            var cust = $(this).attr('data-cus');
            var cust_po = $(this).attr('data-po');
            var seq = $(this).attr('data-seq');
            var sales_head = $(this).attr('data-sales');

            console.log(seq);
            $('#source').val(sales);
            $("#parent").val(item_id);
            $("#sales_qty").val(item_qty);
            $("#item_code").val(item_code);
            $("#parent-bom").val(item_code);
            $("#parent-des").val(item_code);
            $("#compl_subinventory_code").val(subinventory);
            $("#gsm").val(gsm);
            $("#l").val(l);
            $("#w").val(w);
            $("#cust_code").val(cust);
            $("#sales_seq").val(seq);
            $("#sales_head").val(sales_head);
            $("#cust_po").val(cust_po);

            $('#salesModal').modal('hide');
        })

        parent = $("#parent").val()
        tableWO.ajax.reload(null, false)

    });

    $(document).on('keydown', '.filter_WorkOrder', function () {
        var id = this.id;
        var splitid = id.split('_');
        var index = splitid[1];
        $('#' + id).autocomplete({
            source: "/search/bom-code",
            response: function (event, ui) {
                if (ui.content.length === 0) {
                    $(this).parent().addClass('has-error');
                    $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                    $(this).next().show();
                    $(".search_item_code_empty").show();
                    $('.form_submit').hide();
                } else {
                    $(this).next().hide()
                    $('.form_submit').show();
                }
            },
            select: function (event, ui) {
                $(this).next().next().val(ui.item.value1);
                $(this).val(ui.item.label); // display the selected text
                var id = ui.item.id; // selected id to input
                // console.log(id);
                // AJAX
                $.ajax({
                    url: '/search/bom-detail',
                    type: 'get',
                    data: { id: id },
                    dataType: 'json',
                    success: function (response) {
                        console.log(response);
                        var id = response[0]['id'];
                        var item_code = response[0]['item_code'];
                        var des = response[0]['des'];
                        var complection_subinventory = response[0]['completion_subinventory'];

                        $("#parent").val(id);
                        $("#item_code").val(item_code);
                        $("#parent-bom").val(item_code);
                        $("#parent-des").val(des);
                        $("#compl_subinventory_code").val(complection_subinventory);

                        parent = $("#parent").val()
                        tableWO.ajax.reload(null, false)
                    }
                });

                // return false;

            }
        });

    });

    $(document).on('click', '.add_workOrder', function () {
        // console.log("masuk")
        var lastname_id = $('.tr_input1 input[type=text]:nth-child(1)').last().attr('id');
        var split_id = lastname_id.split('_');
        var index = Number(split_id[1]) + 1;
        console.log(lastname_id);
        $('.add_row').remove();

        $('.workOrder_container').append('<tr class="tr_input1">\
                <td width="auto">\
                    <input type="text" class="form-control search_fg_item" placeholder="Type here ..." name="item_code[]" id="searchitem_'+ index + '" autocomplete="off" required><span class="help-block search_item_code_empty" style="display: none;" required>No Results Found ...</span> \
                    <input type="hidden" class="search_inventory_item_id"  id="c_id_'+ index + '" name="c_inventory_item_id[]">\
                    <input type="hidden" class="form-control" value="" id="c_item_code_'+ index + '" name="c_child_item[]" >\
                    <input type="hidden" class="form-control" value="" id="c_sub_category_'+ index + '" name="c_sub_category[]" >\
                    <input type="hidden" class="form-control" value="" id="c_type_code_'+ index + '" name="c_type_code[]" >\
                    <input type="hidden" class="form-control" value="" id="c_roll_'+ index + '" name="c_roll" >\
                </td>\
                <td width="auto">\
                    <input type="text" class="form-control" value="" id="c_description_'+ index + '" readonly name="child_description[]" >\
                <td width="10%">\
                    <input type="text" class="form-control" name="c_uom_code[]" id="c_uom_'+ index + '" autocomplete="off" readonly>\
                </td>\
                <td width="auto">\
                    <input type="text" class="form-control" name="c_quantity[]" id="c_tag_quantity_'+ index + '" autocomplete="off"  required>\
                </td>\
                <td width="auto">\
                    <input type="text" class="form-control search_subinventoryto" name="c_subinventory_to[]" id="subinventoryto_'+ index + '" autocomplete="off">\
                    <input type="hidden" class="form-control subinvto_'+ index + '" name="c_supply_subinventory[]" id="subinvto_' + index + '" autocomplete="off">\
                </td>\
                <td width="5%">\
                    <button type="button" class="btn btn-ligth btn-sm remove_tr" style="position: inherit;">X</button>\
                </td>\
            </tr>\
            <tr class="add_row" > <td><input type="hidden" name="revision[]" class="form-control " id="rev_1"  autocomplete="off">\
                <button type="button" class="btn btn-outline-success add_workOrder btn-sm" style="font-size: 12px;"><i data-feather="plus"></i> Add Rows</button></td>\
            </tr>')
    })

    $(document).on('click', '.add_expected_result', function () {
        var lastname_id = $('.tr_input input[type=text]:nth-child(1)').last().attr('id');
        console.log(lastname_id)
        var split_id = lastname_id.split('_');
        var index = Number(split_id[1]) + 1;
        console.log(lastname_id);

        $('.expected_container').append('<tr class="tr_input">\
                <td width="auto">\
                </td><td class="rownumber text-center" style="width:3%">'+ index + '</td>\
                <td width="30%">\
                    <input type="text" class="form-control search_item_code" id="item_'+ index + '" placeholder="Type here ..." name="item_sales[]" value="" autocomplete="off" required>\
                    <input type="hidden" class="search_inventory_item_id"  id="id_'+ index + '" name="inventory_item_id[]">\
                    <input type="hidden" class="form-control" value="" id="uom_'+ index + '" name="uom[]" >\
                    <input type="hidden" class="form-control" value="" id="description_'+ index + '" name="description[]" >\
                    <input type="hidden" class="form-control" value="" id="sub_category_'+ index + '" name="sub_category[]" >\
                    <input type="hidden" class="form-control" value="" id="type_code_'+ index + '" name="type_code[]" >\
                </td>\
                <td width="35%">\
                    <div class="col-xs-2">\
                        <input class="form-control text-center" id="gsm_'+ index + '" name="attribute_number_gsm[]" type="number"  value="" placeholder="GSM"   style="width: 30%;">/ \
                        <input class="form-control text-center" id="l_'+ index + '" name="attribute_number_l[]" type="number" value="" placeholder="L"  style="width: 30%;">/ \
                        <input class="form-control text-center" id="w_'+ index + '" name="attribute_number_w[]" type="number" value="" placeholder="W"  style="width: 30%;">\
                    </div>\
                </td>\
                <td width="auto">\
                    <input type="number" class="form-control recount text-end"  value="" id="jumlah_'+ index + '" name="qty_roll[]" required>\
                </td>\
                <td width="10%">\
                    <input class="form-control text-end" id="roll_'+ index + '"  value="" name="roll[]" type="number" >\
                </td>\
                <td width="auto">\
                    <input type="number" class="form-control recount text-end"  value="" id="jumlah_'+ index + '" name="ordered_quantity[]" required>\
                </td>\
                <td><button type="button" class="btn btn-ligth btn-sm remove_tr">X</button></td>\
            </tr>')
    })

    /**Work Order End */

    /*Search Category*/
    $(".search_category_code").autocomplete({
        source: "/search/product_category",
        minLength: 1,
        response: function (event, ui) {
            if (ui.content.length === 0) {

                $(this).parent().addClass('has-error');
                $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                $(".search_address1_empty").show();
                $('.form_submit').hide();

            } else {
                $(".search_address1_empty").hide();
                $('.form_submit').show();
            }
        },
        select: function (event, ui) {
            $('.id_cc').val(ui.item.value1);

        }
    });

    /*Search subCategory*/

    /*Search subCategory*/
    $(".search_subcategory_code").autocomplete({
        source: "/search/product_subcategory",
        minLength: 1,
        response: function (event, ui) {
            if (ui.content.length === 0) {

                $(this).parent().addClass('has-error');
                $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                $('.form_submit').hide();

            } else {
                $(".search_address1_empty").hide();
                $('.form_submit').show();
            }
        },
        select: function (event, ui) {
            $('.id_cc').val(ui.item.value1);

        }
    });

    $(document).on('keydown', '.search_subcategory_code_', function () {
        var id = this.id;
        var splitid = id.split('_');
        var index = splitid[1];
        var term = $('#subcategory_' + index).val();

        $('#' + id).autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: '/search/product_subcategory',
                    dataType: 'json',
                    type: 'GET',
                    cache: false,
                    contentType: false,
                    processData: true,
                    data: {
                        term: term
                    },
                    success: function (data) {
                        response(data);

                        $('.form_submit').show();
                    },
                    error: function (data) {
                        $(this).parent().addClass('has-error');
                        $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                        // $(this).next().show();

                        $('.form_submit').hide();
                    },
                });
            },
            minLength: 2,
            select: function (event, ui) {
                $(this).next().next().val(ui.item.value1);
                $(this).val(ui.item.label); // display the selected text
                var term = ui.item.value1; // selected id to input
                $.ajax({
                    url: '/search/product_subcategory_det',
                    type: 'GET',
                    data: { term: term },
                    dataType: 'json',
                    success: function (response) {
                        var len = response.length;
                        // console.log(response)
                        if (len > 0) {
                            var subcategory = response[0]['subcategory'];
                            var rate = response[0]['rate'];

                            document.getElementById('subcategory_' + index).value = subcategory;
                        }
                    }
                });

                // return false;
            }
        });

    });

    $(document).on('keydown', '.search_ref_aju', function () {
        var id = this.id;
        var splitid = id.split('_');
        var index = splitid[1];
        var term = $('#reference_' + index).val();

        $('#' + id).autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: '/search/ref-aju',
                    dataType: 'json',
                    type: 'GET',
                    cache: false,
                    contentType: false,
                    processData: true,
                    data: {
                        term: term
                    },
                    success: function (data) {
                        response(data);

                        $('.form_submit').show();
                    },
                    error: function (data) {
                        $(this).parent().addClass('has-error');
                        $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                        // $(this).next().show();

                        $('.form_submit').hide();
                    },
                });
            }
        });

    });

    $(".currency").on({
        click: function () {
            let input_val = $(this).val();
            input_val = input_val.replace(/\,/g, '');
            console.log(input_val)
            input_val = numberToCurrency(input_val);
            $(this).val(input_val);
        },
        blur: function () {
            let input_val = $(this).val();
            input_val = input_val.replace(/\,/g, '');
            input_val = numberToCurrency(input_val, true, true);
            $(this).val(input_val);
        }
    });

    var numberToCurrency = function (input_val, fixed = false, blur = false) {
        // don't validate empty input
        if (!input_val) {
            return "";
        }

        if (blur) {
            if (input_val === "" || input_val == 0) { return 0; }
        }

        if (input_val.length == 1) {
            return parseInt(input_val);
        }

        input_val = '' + input_val;

        let negative = '';
        if (input_val.substr(0, 1) == '-') {
            negative = '-';
        }
        // check for decimal
        if (input_val.indexOf(".") >= 0) {
            // get position of first decimal
            // this prevents multiple decimals from
            // being entered
            var decimal_pos = input_val.indexOf(".");

            // split number by decimal point
            var left_side = input_val.substring(0, decimal_pos);
            var right_side = input_val.substring(decimal_pos);

            // add commas to left side of number
            left_side = left_side.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            if (fixed && right_side.length > 3) {
                right_side = parseFloat(0 + right_side).toFixed(2);
                right_side = right_side.substr(1, right_side.length);
            }

            // validate right side
            right_side = right_side.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            // Limit decimal to only 2 digits
            if (right_side.length > 2) {
                right_side = right_side.substring(0, 2);
            }

            if (blur && parseInt(right_side) == 0) {
                right_side = '';
            }

            // join number by .
            // input_val = left_side + "." + right_side;

            if (blur && right_side.length < 1) {
                input_val = left_side;
            } else {
                input_val = left_side + "." + right_side;
            }
        } else {
            // no decimal entered
            // add commas to number
            // remove all non-digits
            input_val = input_val.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        if (input_val.length > 1 && input_val.substr(0, 1) == '0' && input_val.substr(0, 2) != '0.') {
            input_val = input_val.substr(1, input_val.length);
        } else if (input_val.substr(0, 2) == '0,') {
            input_val = input_val.substr(2, input_val.length);
        }

        return negative + input_val;
    };
    $(function () {
        $("#datepicker-3").datepicker({
            beforeShowDay: function (date) {
                var dayOfWeek = date.getDay();
                // 0 : Sunday, 1 : Monday, ...
                if (dayOfWeek == 0) return [false];
                else return [true];
            }
            ,
            dateFormat: 'dd-M-yy'
        });
    }); $(function () {
        $("#datepicker-2").datepicker({
            beforeShowDay: function (date) {
                var dayOfWeek = date.getDay();
                // 0 : Sunday, 1 : Monday, ...
                if (dayOfWeek == 0) return [false];
                else return [true];
            },
            dateFormat: 'dd-M-yy'
        });
    }); $(function () {
        $("#datepicker-1").datepicker({
            beforeShowDay: function (date) {
                var dayOfWeek = date.getDay();
                // 0 : Sunday, 1 : Monday, ...
                // if (dayOfWeek == 0) return [false];
                // else
                return [true];
            }
            ,
            dateFormat: 'dd-M-yy'
        });
    });
    var $ins = $('.currency, .value1').keyup(function () {
        $ins.not(this).val(this.value.replace(/,/g, ""));
    })

    $(document).on('click', '#select_vendor', function () {
        var vendor_id = $(this).data('id');
        var vendor_name = $(this).data('name');
        $('#vendor_id').val(vendor_id);
        $('#vendor_name').val(vendor_name);
        $('#demoModal').modal('hide');
    })

    $('#btn-grn').on('click', function (e) {

        const table_grn = $('#table_grn').DataTable({
            "bServerSide": true,
            "initComplete": function () {
                $('input[type="search"]').attr('id', 'grn');
            },
            "scrollY": 300,
            "scrollX": true,
            "pageLength": 10,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'semua']],
            "bLengthChange": true,
            "bFilter": true,
            "paging": true,
            "bInfo": true,
            "processing": true,
            "bServerSide": true,
            "order": [[1, "desc"]],
            "autoWidth": false,
            "ajax": {
                url: "/search/data-grn",
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: function (de) {
                    de.search = $('#grn').val();
                    return de
                }
            },
            columnDefs: [
                {
                    "targets": 0,
                    "class": "text-nowrap",
                    "sortable": false,
                    "render": function (data, type, row, meta) {
                        return `
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <input type="checkbox" class="form-check-input cb-child dt-checkboxes" data-id="${row.receipt_num}"  name="line_number[]" id="idGRN" value="${row.receipt_num}">`;
                    }
                },
                {
                    "targets": 1,
                    "class": "text-nowrap",
                    "render": function (data, type, row, meta) {
                        return row.receipt_num;
                    }
                },
                {
                    "targets": 2,

                    "render": function (data, type, row, meta) {
                        return row.segment1;
                    }
                },
                {
                    "targets": 3,
                    "render": function (data, type, row, meta) {
                        return row.vendor_id;
                    }
                }, {
                    "targets": 4,
                    "class": "text-start",
                    "render": function (data, type, row, meta) {
                        return row.vendor_name;
                    }
                },
                {
                    "targets": 5,

                    "render": function (data, type, row, meta) {
                        return row.packing_slip;
                    }
                },
                {
                    "targets": 6,
                    "class": "text-center"
                    , "render": function (data, type, row, meta) {
                        return row.currency_code;
                    }
                },
                {
                    "targets": 7,
                    "class": "text-end"
                    , "render": function (data, type, row, meta) {
                        return row.receive_amount;

                    }
                },
                {
                    "targets": 8,
                    "class": "text-end",
                    "render": function (data, type, row, meta) {
                        return row.gl_date;
                    }
                },


            ],
            fixedColumns: false,
            destroy: true,
            searching: true
        })

    })


    //Add row AR Calendar - Shindi 12 Juli 2022
    $(document).on('click', '.add_arCalendar', function () {
        var lastname_id = $('.tr_input input[type=text]:nth-child(1)').last().attr('id');
        var split_id = lastname_id.split('_');
        var index = Number(split_id[1]) + 1;
        // console.log(index);
        $('.arCalendar_container').append('<tr class="tr_input">\
                                    <td class="rownumber"></td>\
                                    <td width="5%"><input type="number" class="form-control" name="num[]" id="year_1" autocomplete="off"></td>\
                                    <td width="30%"><input type="text" class="form-control"  name="setname[]" id="name_1" autocomplete="off" required ></td>\
                                    <td width="20%"><input type="number" class="form-control" name="year[]" id="year_'+ index + '" autocomplete="off"></td>\
                                    <td width="20%"><input type="date" class="form-control datepicker" id="from_'+ index + '"  name="startdate[]" required></td>\
                                    <td width="20%"><input type="date" id="to_'+ index + '" name="enddate[]" class="form-control datepicker" >\
                                    <td width="5%"><button type="button"  class="btn btn-ligth btn-sm remove_tr_quotation">X</button></td>\
                                </tr>');

        renumberRowsARCalendar(index);
    });

    function renumberRowsARCalendar() {
        $(".arCalendar_container > tr").each(function (i, v) {
            $(this).find(".rownumber").text(i + 1);
        });
    }

    $(document).on('click', '.add_payable', function () {

        //Get Index
        var index = $('#tableAP tbody tr').length + 1; //row count

        // InvoiceNumber
        var invoice_num = $('#invoice_num').val();
        document.getElementById('invoice_num2').value = invoice_num;

        // Disable Button Po Match
        $('#poModal').remove();

        //Add Row
        $('.ap_container').append('<tr class="tr_input" id="rowTab1_' + index + '">\
                                <td width="">\
                                    <input type="text" class="form-control search_ap_item" placeholder="Typye here ..." name="item_code[]" id="searchitem_'+ index + '" autocomplete="off" required><span class="help-block search_item_code_empty" style="display: none;" required>No Results Found ...</span> \
                                    <input type="hidden" class="search_inventory_item_id"  id="id_'+ index + '" name="inventory_item_id[]">\
                                    <input type="hidden" class="form-control" value="" id="item_code_'+ index + '" name="child_item[]" >\
                                    <input type="hidden" class="form-control" value="" id="uom_'+ index + '" name="unit_meas_lookup_code[]" >\
                                    <input type="hidden" class="form-control" value="0" id="line_'+ index + '" name="line_type_lookup_code[]" >\
                                    <input type="hidden" name="account_segment[]" class="form-control datepicker" id="acc2_'+ index + '"  autocomplete="off">\
                                </td>\
                                <td width="">\
                                    <input type="text" class="form-control" value="" id="description_'+ index + '" readonly name="description[]" >\
                                </td>\
                                <td width="">\
                                    <input type="text" class="form-control search_acc"  id="accDes_'+ index + '"   name="item_code[]" autocomplete="off" required>\
                                    <input type="hidden" name="payable_account_code[]" class="form-control datepicker" id="acc_'+ index + '"  autocomplete="off">\
                                </td>\
                                <td width="">\
                                    <input type="text" class="form-control text-end recount_ap" id="qty_'+ index + '"  value="0" name="quantity_invoiced[]" autocomplete="off" required>\
                                </td>\
                                <td width="">\
                                    <input type="text" class="form-control text-end recount_ap"  id="price_'+ index + '" value="0" name="unit_price[]" autocomplete="off" required>\
                                </td>\
                                <td width="">\
                                    <input type="text" class="form-control text-end grandSub"  id="subtotalAdd_'+ index + '" value="0" name="stat_amount[]" autocomplete="off" required>\
                                </td>\
                                <td><button type="button"  class="btn btn-ligth btn-sm remove_ap" style="position: inherit;">X</button></td>\
                                </tr>\
                            </tr>')

        $('.journal_container').append('<tr class="tr_input" id="rowTab2_' + index + '">\
                            <td width="20%">\
                                <input type="text" class="form-control search_acc" name="quantity[]" id="accDes2_'+ index + '" autocomplete="off" required>\
                            </td>\
                            <td width="32%"><input type="text" class="form-control" value="" id="description2_'+ index + '" readonly name="item_description[]" >\</td>\
                            <td width="20%">\
                                <label class=" form-control text-end" id="price2_'+ index + '">0</label>\
                                <input type="hidden" class="form-control grandSub2" readonly name="total_rec_tax_amount[]" id="searchitem_'+ index + '" autocomplete="off" required>\
                            </td>\
                            <td width="25%">\
                                <label class=" form-control text-end" >0</label>\
                                <input type="hidden" name="total_nrec_tax_amount[]" class="form-control  float-center text-end" readonly  autocomplete="off">\
                            </td>\
                            <td><button type="button"  class="btn btn-ligth btn-sm remove_ap" style="position: inherit;">X</button></td>\
                            </tr>')
        $('.journal_creditMemo').append('<tr class="tr_input" id="rowTab2_' + index + '">\
                            <td width="20%">\
                                <input type="text" class="form-control search_acc" name="quantity[]" id="accDes2_'+ index + '" autocomplete="off" required>\
                            </td>\
                            <td width="32%"><input type="text" class="form-control" value="" id="description2_'+ index + '" readonly name="item_description[]" >\</td>\
                            <td width="20%">\
                                <label class=" form-control text-end" >0</label>\
                                <input type="hidden" class="form-control" readonly name="total_rec_tax_amount[]"  autocomplete="off" required>\
                            </td>\
                            <td width="25%">\
                                <label class=" form-control text-end" id="price2_'+ index + '">0</label>\
                                <input type="hidden" name="total_nrec_tax_amount[]" class="form-control grandSub2 float-center text-end" id="searchitem_'+ index + '" readonly  autocomplete="off">\
                            </td>\
                            <td><button type="button"  class="btn btn-ligth btn-sm remove_ap" style="position: inherit;">X</button></td>\
                            </tr>')


    })

    $(document).on('click', '.add_payable_creditMemo', function () {

        //Get Index
        var index = $('#tableAP tbody tr').length + 1; //row count

        // InvoiceNumber
        var invoice_num = $('#invoice_num').val();
        document.getElementById('invoice_num2').value = invoice_num;

        // Disable Button Po Match
        $('#poModal').remove();

        //Add Row
        $('.ap_container').append('<tr class="tr_input" id="rowTab1_' + index + '">\
                                <td width="">\
                                    <input type="text" class="form-control search_ap_item" placeholder="Typye here ..." name="item_code[]" id="searchitem_'+ index + '" autocomplete="off" required><span class="help-block search_item_code_empty" style="display: none;" required>No Results Found ...</span> \
                                    <input type="hidden" class="search_inventory_item_id"  id="id_'+ index + '" name="inventory_item_id[]">\
                                    <input type="hidden" class="form-control" value="" id="item_code_'+ index + '" name="child_item[]" >\
                                    <input type="hidden" class="form-control" value="" id="uom_'+ index + '" name="unit_meas_lookup_code[]" >\
                                    <input type="hidden" class="form-control" value="0" id="line_'+ index + '" name="line_type_lookup_code[]" >\
                                    <input type="hidden" name="account_segment[]" class="form-control datepicker" id="acc2_'+ index + '"  autocomplete="off">\
                                </td>\
                                <td width="">\
                                    <input type="text" class="form-control" value="" id="description_'+ index + '" readonly name="description[]" >\
                                </td>\
                                <td width="">\
                                    <input type="text" class="form-control search_acc"  id="accDes_'+ index + '"   name="item_code[]" autocomplete="off" required>\
                                    <input type="hidden" name="payable_account_code[]" class="form-control datepicker" id="acc_'+ index + '"  autocomplete="off">\
                                </td>\
                                <td width="">\
                                    <input type="text" class="form-control text-end recount_ap" id="qty_'+ index + '"  value="0" name="quantity_invoiced[]" autocomplete="off" required>\
                                </td>\
                                <td width="">\
                                    <input type="text" class="form-control text-end recount_ap"  id="price_'+ index + '" value="0" name="unit_price[]" autocomplete="off" required>\
                                </td>\
                                <td width="">\
                                    <input type="text" class="form-control text-end grandSub"  id="subtotalAdd_'+ index + '" value="0" name="stat_amount[]" autocomplete="off" required>\
                                </td>\
                                <td><button type="button"  class="btn btn-ligth btn-sm remove_ap" style="position: inherit;">X</button></td>\
                                </tr>\
                            </tr>')

        $('.journal_creditMemo').append('<tr class="tr_input" id="rowTab2_' + index + '">\
                            <td width="20%">\
                                <input type="text" class="form-control search_acc" name="quantity[]" id="accDes2_'+ index + '" autocomplete="off" required>\
                            </td>\
                            <td width="32%"><input type="text" class="form-control" value="" id="description2_'+ index + '" readonly name="item_description[]" >\</td>\
                            <td width="20%">\
                                <label class=" form-control text-end" >0</label>\
                                <input type="hidden" class="form-control" readonly name="total_rec_tax_amount[]"  autocomplete="off" required>\
                            </td>\
                            <td width="25%">\
                                <label class=" form-control text-end" id="price2_'+ index + '">0</label>\
                                <input type="hidden" name="total_nrec_tax_amount[]" class="form-control grandSub2 float-center text-end" id="searchitem_'+ index + '" readonly  autocomplete="off">\
                            </td>\
                            <td><button type="button"  class="btn btn-ligth btn-sm remove_ap" style="position: inherit;">X</button></td>\
                            </tr>')


    })
    
    $(document).on('click', '.remove_ap', function () {
        var identifier = $(this).closest('tr').attr('id');
        console.log(identifier);
        var split_id = identifier.split('_');
        var index = Number(split_id[1]);

        $("#rowTab1_" + index).remove();
        $("#rowTab2_" + index).remove();

        totalAp();
    })

    $(document).on('keydown', '.search_ap_item', function () {
        var id = this.id;
        var splitid = id.split('_');
        var index = splitid[1];
        console.log(id)
        $('#' + id).autocomplete({
            source: "/search/ap-item",
            minLength: 1,
            response: function (event, ui) {
                if (ui.content.length === 0) {
                    $(this).parent().addClass('has-error');
                    $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                    $(this).next().show();
                    $(".search_item_code_empty").show();
                    $('.form_submit').hide();
                } else {
                    $(this).next().hide()
                    $('.form_submit').show();
                }
            },
            select: function (event, ui) {
                $(this).next().next().val(ui.item.value1);
                $(this).val(ui.item.label); // display the selected text
                var id = ui.item.value1; // selected id to input
                // console.log(id);
                // AJAX
                $.ajax({
                    url: '/search/ap-itemDet',
                    type: 'get',
                    data: { id: id, request: 2 },
                    dataType: 'json',
                    success: function (response) {
                        console.log(response);
                        var len = response.length;
                        if (len > 0) {
                            var inv_id = response[0]['inv_id'];
                            var acc = response[0]['acc'];
                            var description = response[0]['description'];
                            var item_code = response[0]['item_code'];
                            var accDes = response[0]['acc'] + '  ' + response[0]['acc_des'];
                            var uom = response[0]['uom'];
                            var payable = response[0]['payable'];
                            var payable_des = response[0]['payable'] + '  ' + response[0]['payable_des'];

                            document.getElementById('id_' + index).value = inv_id;
                            document.getElementById('description_' + index).value = description;
                            document.getElementById('acc_' + index).value = acc;
                            document.getElementById('accDes_' + index).value = accDes;
                            document.getElementById('acc2_' + index).value = acc;
                            document.getElementById('accDes2_' + index).value = accDes;
                            document.getElementById('description2_' + index).value = description;
                            document.getElementById('item_code_' + index).value = item_code;
                            document.getElementById('uom_' + index).value = uom;
                            document.getElementById('acc4_').value = payable;
                            document.getElementById('accDes4_').value = payable_des;

                        }
                    }
                });
                return false;
            }

        });

    });

    $(document).on('input', '.recount_ap', function () {
        var identifier = $(this).closest('tr').attr('id');
        console.log(identifier);
        var split_id = identifier.split('_');
        var index = Number(split_id[1]);

        var qty = $("#qty_" + index).val();
        var price = $("#price_" + index).val();
        var subtotal_add = parseInt(qty) * parseInt(price);

        $("#subtotalAdd_" + index).val(subtotal_add);
        $("#price2_" + index).text(subtotal_add);
        $(".grandSub2").val(subtotal_add);

        totalAp();
    });

    function totalAp() {
        var subtotals = document.getElementsByClassName("grandSub");
        for (var i = 0; i < subtotals.length; ++i) {
            var b = subtotals[i].getAttribute("id");
            var split_id = b.split('_');
            var index = Number(split_id[1]);

            var data = $("#subtotalAdd_" + index).val();
            // var tax =$('#pajak_'+index).val();
            var pajak = 0;
            var total = 0;

            subtotal.push({
                data: data,
                // tax: tax
            });
        }

        for (var i = 0; i < subtotal.length; ++i) {
            // pajak += parseInt(subtotal[i].tax);
            total += parseInt(subtotal[i].data);
        }
        subtotal = [];
        var passing = $("#passing").val();
        pajak = $("#pajak").val();

        console.log(pajak)
        pajak = parseFloat(pajak);
        // total = total +  parseInt(passing);

        pajak = total * pajak;
        total = total + pajak;

        // console.log(subtotal);

        $(".calculate").val(total);
        $(".tax").val(pajak);

        total = total.toLocaleString({ symbol: '', decimal: ',', separator: '' });
        pajak = pajak.toLocaleString({ symbol: '', decimal: ',', separator: '' });
        $(".calculate2").text(total);
        $(".tax").text(pajak);
    }

    $(document).on('click', '.add_receivable', function () {
        var lastname_id = $('.tr_input input[type=text]:nth-child(1)').last().attr('id');
        console.log(lastname_id);
        var split_id = lastname_id.split('_');
        var index = Number(split_id[1]) + 1;
        $('.receivable_container').append('<tr class="tr_input" id="rowTab1_' + index + '">\
                                    <td width="15%">\
                                        <input type="text" class="form-control search_ar_item" placeholder="Typye here ..." name="item_code[]" id="searchitem_'+ index + '" autocomplete="off" required><span class="help-block search_item_code_empty" style="display: none;" required>No Results Found ...</span> \
                                    </td>\
                                    <td width="20%">\
                                        <input type="text" class="form-control" value="" id="description_'+ index + '" readonly name="description[]" >\
                                        <input type="hidden" class="form-control" value="" id="uom_'+ index + '" readonly name="uom_code[]" >\
                                    </td>\
                                    <td width="20%">\
                                        <input type="text" name="accountDess[]" class="form-control search_acc" id="accDes_'+ index + '"  autocomplete="off">\
                                        <input type="hidden" name="account[]" class="form-control datepicker" id="acc_'+ index + '"  autocomplete="off">\
                                    </td>\
                                    <td width="10%"><input type="text" name="quantity_ordered[]" class="form-control recount_ar text-end" id="qty_'+ index + '"  autocomplete="off"></td>\
                                    <td width="20%"><input type="text" name="unit_selling_price[]" class="form-control recount_ar float-center text-end" id="price_'+ index + '"  autocomplete="off"></td>\
                                    <td width="20%"><input type="text" name="amount_due_original[]" class="form-control subtotalAdd_'+ index + ' grandSub float-center text-end" id="subtotalAdd_' + index + '" readonly autocomplete="off"></td>\
                                    <td><button type="button" class="btn btn-ligth btn-sm remove_tr_ar" style="position: inherit;">X</button></td>\
                                </tr>');

        $('.journal_container').append('<tr class="tr_input" id="rowTab2_' + index + '">\
                                <td width="20%">\
                                    <input type="text" class="form-control search_acc" name="quantity[]" id="accDes2_'+ index + '" autocomplete="off" required>\
                                    <input type="hidden" name="code_combinations[]" class="form-control datepicker" id="acc2_'+ index + '"  autocomplete="off">\
                                    <input type="hidden" class="search_inventory_item_id"  id="id_'+ index + '" name="inventory_item_id[]">\
                                    <input type="hidden" class="form-control" value="" id="item_code_'+ index + '" name="child_item[]" >\
                                    <input type="hidden" class="form-control" value="" id="uom_'+ index + '" name="unit_meas_lookup_code[]" >\
                                    <input type="hidden" class="form-control" value="" id="lineId" name="lineId[]" >\
                                </td>\
                                <td width="32%"><input type="text" class="form-control" value="" id="description2_'+ index + '" readonly name="child_description[]" ></td>\
                                <td width="20%">\
                                    <label class=" form-control text-end">0</label>\
                                    <input type="hidden" class="form-control" readonly name="entered_dr[]" id="searchitem_'+ index + '" autocomplete="off" required>\
                                </td>\
                                <td width="25%">\
                                    <label class=" form-control text-end" id="price2_'+ index + '">0</label>\
                                    <input type="hidden" name="entered_cr[]" class="form-control subtotalAdd float-center text-end" readonly  autocomplete="off">\
                                </td>\
                                <td><button type="button" class="btn btn-ligth btn-sm remove_tr_ar" style="position: inherit;">X</button></td>\
                                </tr>');
        //    totalAr();
    })

    $(document).on('keydown', '.search_ar_item', function () {
        var id = this.id;
        var splitid = id.split('_');
        var index = splitid[1];
        console.log(id)
        $('#' + id).autocomplete({
            source: "/search/ar-item",
            minLength: 1,
            response: function (event, ui) {
                if (ui.content.length === 0) {
                    $(this).parent().addClass('has-error');
                    $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                    $(this).next().show();
                    $(".search_item_code_empty").show();
                    $('.form_submit').hide();
                } else {
                    $(this).next().hide()
                    $('.form_submit').show();
                }
            },
            select: function (event, ui) {
                $(this).next().next().val(ui.item.value1);
                $(this).val(ui.item.label); // display the selected text
                var id = ui.item.value1; // selected id to input
                // console.log(id);
                // AJAX
                $.ajax({
                    url: '/search/ar-itemDet',
                    type: 'get',
                    data: { id: id, request: 2 },
                    dataType: 'json',
                    success: function (response) {
                        console.log(response);
                        var len = response.length;
                        if (len > 0) {
                            var inv_id = response[0]['inv_id'];
                            var acc = response[0]['acc'];
                            var description = response[0]['description'];
                            var item_code = response[0]['item_code'];
                            var accDes = response[0]['accDes'];
                            var uom = response[0]['uom'];
                            var acc_ar = response[0]['acc_ar'];
                            var accDes_ar = response[0]['accDes_ar'];
                            var accDes_ar2 = response[0]['accDes_ar2'];

                            document.getElementById('id_' + index).value = inv_id;
                            document.getElementById('description_' + index).value = description;
                            document.getElementById('uom_' + index).value = uom;
                            document.getElementById('acc_' + index).value = acc;
                            document.getElementById('accDes_' + index).value = accDes;
                            document.getElementById('acc2_' + index).value = acc;
                            document.getElementById('accDes2_' + index).value = accDes;
                            document.getElementById('description2_' + index).value = description;
                            document.getElementById('item_code_' + index).value = item_code;
                            document.getElementById('ar_acc').value = acc_ar;
                            document.getElementById('ar_accDess').value = accDes_ar;
                            document.getElementById('ar_accDess2').value = accDes_ar2;

                        }
                    }
                });
                return false;
            }

        });

        $(document).on('input', '.recount_ar', function () {
            // console.log("masuk");
            var qty = $("#qty_" + index).val();
            var price = $("#price_" + index).val();
            var subtotal_add = qty * price;
            $("#subtotalAdd_" + index).val(subtotal_add);
            $(".subtotalAdd").val(subtotal_add);
            $("#price2_" + index).text(subtotal_add);

            totalAr();
        });


    });

    $(document).on('click', '.remove_tr_ar', function () {
        var identifier = $(this).closest('tr').attr('id');
        var split_id = identifier.split('_');
        var index = Number(split_id[1]);

        $("#rowTab1_" + index).remove();
        $("#rowTab2_" + index).remove();
        totalAr();
        // key=index-1;
    });

    $(document).on('click', '.remove_tax', function (e) {
        e.preventDefault();
        Swal.fire({
            title: `Are you sure you want to delete this record?`,
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#db2929',
            cancelButtonColor: '#1845eb',
            confirmButtonText: 'Yes, Trash !'
        }).then((result) => {
            if (result.isConfirmed) {
                var id = $(this).attr("data-id");
                var term = $(this).attr("data-term");
                remove_tax();
                if (id && term) {
                    var url = '/search/remove-' + term + 'Tax';

                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: { deleteId: id },
                        success: function (response) {
                            swal.fire("Info", response.message, "success");
                        }
                    });
                }

                $(this).closest('tr').remove();
            } else {
                Swal.fire(
                    'Ok!',
                    'Your file has been ignored.',
                    'success'
                )
                e.preventDefault();
            }
        });



    })

    function remove_tax() {
        var term = $("#amount").val();
        var total = term.replace(/[^0-9.-]+/g, "");
        console.log(total);
        var tax = $(".tax").val();
        var after = total - tax;
        console.log(after);
        $(".calculate").val(after);
        $("#passing").val(after);
        $("#pajak").val(0);
        $("#tax_main").val(0);
        $("#pajak_code").val("TAX-00");

        after = after.toLocaleString({ symbol: '', decimal: ',', separator: '' });
        $(".calculate").text(after);
        $(".calculate2").text(after);
        $("#tax_main2").text(0);
    }

    function totalAr() {
        var subtotals = document.getElementsByClassName("grandSub");
        console.log(subtotals)
        for (var i = 0; i < subtotals.length; ++i) {
            var b = subtotals[i].getAttribute("id");
            var split_id = b.split('_');
            var index = Number(split_id[1]);

            var data = $("#subtotalAdd_" + index).val();
            // var tax =$('#pajak_hasil_'+index).val();
            // var pajak = 0;
            var total = 0;

            subtotal.push({
                data: data
                // tax: tax
            });
        }
        console.log(subtotal)

        for (var i = 0; i < subtotal.length; ++i) {
            // pajak += parseInt(subtotal[i].tax);
            total += parseInt(subtotal[i].data);
        }
        subtotal = [];

        // old_total = $("#sales").val();
        pajak = $("#pajak").val();

        pajak = parseFloat(pajak);

        pajak = total * pajak;
        total = total + pajak;

        $(".calculate").val(total);
        $(".tax").val(pajak);

        total = total.toLocaleString({ symbol: '', decimal: ',', separator: '' });
        pajak = pajak.toLocaleString({ symbol: '', decimal: ',', separator: '' });
        $(".calculate").text(total);
        $(".tax").text(pajak);

    }

    $(document).on('keydown', '.search_acc', function () {
        var id = this.id;
        var splitid = id.split('_');
        var index = splitid[1];
        console.log(id)
        $('#' + id).autocomplete({
            source: "/search/acc-search",
            minLength: 1,
            response: function (event, ui) {
                if (ui.content.length === 0) {
                    $(this).parent().addClass('has-error');
                    $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                    $(this).next().show();
                    $(".search_item_code_empty").show();
                    $('.form_submit').hide();
                } else {
                    $(this).next().hide()
                    $('.form_submit').show();
                }
            },
            select: function (event, ui) {
                $(this).next().next().val(ui.item.value1);
                $(this).val(ui.item.label); // display the selected text
                var id = ui.item.value1; // selected id to input
                // console.log(id);
                // AJAX
                $.ajax({
                    url: '/search/acc-detail',
                    type: 'get',
                    data: { id: id, request: 2 },
                    dataType: 'json',
                    success: function (response) {
                        // console.log(response);
                        var len = response.length;
                        if (len > 0) {
                            var acc = response[0]['acc'];
                            var accDes = response[0]['accDes'];

                            document.getElementById('accDes_' + index).value = accDes;
                            document.getElementById('acc_' + index).value = acc;
                            document.getElementById('accDes2_' + index).value = accDes;
                            document.getElementById('acc2_' + index).value = acc;
                        }
                    }
                });
                return false;
            }
        });

    });

    $(document).on('keydown', '.search_acc2', function () {
        var id = this.id;
        $('#' + id).autocomplete({
            source: "/search/acc-search",
            minLength: 1,
            response: function (event, ui) {
                if (ui.content.length === 0) {
                    $(this).parent().addClass('has-error');
                    $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                    $(this).next().show();
                    $(".search_item_code_empty").show();
                    $('.form_submit').hide();
                } else {
                    $(this).next().hide()
                    $('.form_submit').show();
                }
            },
            select: function (event, ui) {
                $(this).next().next().val(ui.item.value1);
                $(this).val(ui.item.label); // display the selected text
                var id = ui.item.value1; // selected id to input
                // console.log(id);
                // AJAX
                $.ajax({
                    url: '/search/acc-detail',
                    type: 'get',
                    data: { id: id, request: 2 },
                    dataType: 'json',
                    success: function (response) {
                        // console.log(response);
                        var len = response.length;
                        if (len > 0) {
                            var acc = response[0]['acc'];
                            var accDes = response[0]['accDes'];
                            var des = response[0]['dess'];

                            document.getElementById('des3_').value = des;
                            document.getElementById('accDes3_').value = accDes;
                            document.getElementById('acc3_').value = acc;
                        }
                    }
                });
                return false;
            }
        });

    });

    $(document).on('keydown', '.search_acc3', function () {
        var id = this.id;
        $('#' + id).autocomplete({
            source: "/search/acc-search",
            minLength: 1,
            response: function (event, ui) {
                if (ui.content.length === 0) {
                    $(this).parent().addClass('has-error');
                    $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                    $(this).next().show();
                    $(".search_item_code_empty").show();
                    $('.form_submit').hide();
                } else {
                    $(this).next().hide()
                    $('.form_submit').show();
                }
            },
            select: function (event, ui) {
                $(this).next().next().val(ui.item.value1);
                $(this).val(ui.item.label); // display the selected text
                var id = ui.item.value1; // selected id to input
                // console.log(id);
                // AJAX
                $.ajax({
                    url: '/search/acc-detail',
                    type: 'get',
                    data: { id: id, request: 2 },
                    dataType: 'json',
                    success: function (response) {
                        // console.log(response);
                        var len = response.length;
                        if (len > 0) {
                            var acc = response[0]['acc'];
                            var accDes = response[0]['accDes'];

                            document.getElementById('accDes4_').value = accDes;
                            document.getElementById('acc4_').value = acc;
                        }
                    }
                });
                return false;
            }
        });

    });

    $(".filter").on('change', function () {
        supplier = $("#supplier").val()
        orderno = $("#orderno").val()
        grb = $("#grn").val()
        table.ajax.reload(null, false)
    })

    // ADD NEW SHIPMENT
    let xid = $('#masterckcbx').val(),
        xhead = $('#inputhead').val(),
        xlineid = $('#lineid').val(),
        xorderfrom = $('#orderfrom').val(),
        xorderto = $('#orderto').val(),
        xitemfrom = $('#itemfrom').val(),
        xitemto = $('#itemto').val();

    const filterdatadetail = $('#filterdatadetail').DataTable({
        "lengthMenu": [
            [10, 25,]
            , [10, 25]
        ],
        dom: '<"card-header border-bottom"<"head-label"><"dt-action-buttons text-end">><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-8"Bl><"col-sm-12 col-md-4"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        "ajax": {
            url: "/search/shipmentsearch/",
            type: "GET",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: function (d) {
                d.xhead = xhead;
                d.xlineid = xlineid;
                d.xorderfrom = xorderfrom;
                d.xorderto = xorderto;
                d.xitemfrom = xitemfrom;
                d.xitemto = xitemto;
                return d
            }
        },
        "initComplete": function (settings, json) {
            const all_checkbox_view = $("#row-tampilan div input[type='checkbox']")
            $.each(all_checkbox_view, function (key, checkbox) {
                let kolom = $(checkbox).data('kolom')
                let is_checked = checkbox.checked
                table.column(kolom).visible(is_checked)
            })
            setTimeout(function () {
                table.columns.adjust().draw();
            }, 3000)
        },
        buttons: [
            {
                extend: 'print'
                , text: feather.icons['printer'].toSvg({
                    class: 'font-small-4 me-50'
                }) + 'Print'
                , className: ''
                , exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'csv'
                , text: feather.icons['file-text'].toSvg({
                    class: 'font-small-4 me-50'
                }) + 'Csv'
                , className: ''
                , exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'excel'
                , text: feather.icons['file'].toSvg({
                    class: 'font-small-4 me-50'
                }) + 'Excel'
                , className: ''
                , exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdf'
                , text: feather.icons['clipboard'].toSvg({
                    class: 'font-small-4 me-50'
                }) + 'Pdf'
                , className: ''
                , exportOptions: {
                    columns: ':visible'
                }
            }
            , {
                extend: 'copy'
                , text: feather.icons['copy'].toSvg({
                    class: 'font-small-4 me-50'
                }) + 'Copy'
                , className: ''
                , exportOptions: {
                    columns: ':visible'
                }
            }
            , {
                extend: 'colvis'
                , text: feather.icons['eye'].toSvg({
                    class: 'font-small-4 me-50'
                }) + 'Colvis'
                , className: ''
                ,
            }
            ,],
        columnDefs: [
            {
                targets: 0,
                width: "0%",
                class: "text-nowrap",
                orderable: false,
                render: function (data, type, row, meta) {
                    return (`
                        <input type="checkbox" class="form-check-input cb-child item_check" name="id[]" id="${row.id}" value="${row.id}">
                        <input type="hidden" name="header_id[]" value="${row.header_id}">
                        <input type="hidden" name="line_id[]" value="${row.line_id}">
                        <input type="hidden" name="line_number[]" value="${row.line_number}">
                        <input type="hidden" name="split_line_id[]" value="${row.split_line_id}">
                        <input type="hidden" name="inventory_item_id[]" value="${row.inventory_item_id}">
                        <input type="hidden" name="user_description_item[]" value="${row.user_description_item}">
                        <input type="hidden" name="order_quantity_uom[]" value="${row.order_quantity_uom}">
                        <input type="hidden" name="shipped_quantity[]" value="${row.shipped_quantity}">
                        <input type="hidden" name="ordered_quantity[]" value="${row.ordered_quantity}">
                        <input type="hidden" name="tax_code[]" value="${row.tax_code}">
                        <input type="hidden" name="created_at[]" value="${row.created_at}">
                        <input type="hidden" name="updated_at[]" value="${row.updated_at}">
                        <input type="hidden" name="flow_status_code[]" value="${row.flow_status_code}">
                        <input type="hidden" name="order_number[]" value="${row.order_number}">
                        <input type="hidden" name="attribute1[]" value="${row.attribute1}">
                        <input type="hidden" name="attribute2[]" value="${row.attribute2}">
                        <input type="hidden" name="freight_terms_code[]" value="${row.freight_terms_code}">
                        <input type="hidden" name="cust_po_number[]" value="${row.cust_po_number}">
                        <input type="hidden" name="invoice_to_org_id[]" value="${row.invoice_to_org_id}">
                        <input type="hidden" name="deliver_to_org_id[]" value="${row.deliver_to_org_id}">
                        <input type="hidden" name="user_item_description[]" value="${row.user_item_description}">
                        <input type="hidden" name="unit_selling_price[]" value="${row.unit_selling_price}">
                        <input type="hidden" name="conversion_rate[]" value="${row.conversion_rate}">
                        <input type="hidden" name="conversion_date[]" value="${row.conversion_rate_date}">
                        <input type="hidden" name="shipping_inventory[]" value="${row.shipping_inventory}">
                        <input type="hidden" name="attribute_number_gsm[]" value="${row.attribute_number_gsm}">
                        <input type="hidden" name="attribute_number_w[]" value="${row.attribute_number_w}">
                        <input type="hidden" name="attribute_number_l[]" value="${row.attribute_number_l}">
                        <input type="hidden" name="packing_style[]" value="${row.packing_style}">
                        <input type="hidden" name="checkid[]" value="${row.id}">
                    `);
                },
            },
            {
                "targets": 1,
                "render": function (data, type, row, meta) {
                    return row.order_number;
                }
            },
            {
                "targets": 2,
                "render": function (data, type, row, meta) {
                    return row.line_id;
                }
            },
            {
                "targets": 3,
                "render": function (data, type, row, meta) {
                    return row.party_name;
                }
            },
            {
                "targets": 4,
                "render": function (data, type, row, meta) {
                    return row.item_code;
                }
            },
            {
                "targets": 5,
                "render": function (data, type, row, meta) {
                    return row.ordered_quantity;
                }
            },
            {
                "targets": 6,
                "render": function (data, type, row, meta) {
                    return row.cust_po_number;
                }
            },
            {
                "targets": 7
                , class: "text-nowrap text-end",
                render: function (data, type, row, meta) {
                    if (row.schedule_ship_date == null) {
                        return '<a class="text-white">-</a>'
                    } else {
                        return moment(row.schedule_ship_date).format('DD-MM-YYYY');
                    }
                }
                ,
            },
            {
                "targets": 8
                ,
                render: function (data, type, row, meta) {
                    return row.trx_name;
                    return '<a class="badge bg-primary text-white"value="${row.trx_name}"></a>'
                }
                ,
            }

        ],
        fixedColumns: true,
        searching: false
        , displayLength: 12,


    })
    $("#btnFiterSubmitSearchzz").click(function () {
        xid = $('#masterckcbx').val();
        xhead = $('#inputhead').val();
        xlineid = $('#lineid').val();
        xorderfrom = $('#orderfrom').val();
        xorderto = $('#orderto').val();
        xitemfrom = $('#itemfrom').val();
        xitemto = $('#itemto').val();
        filterdatadetail.ajax.reload(null, false)
    });
    $('#filtercheck').on('click', function (e) {
        if ($(this).is(':checked', true)) {
            $(".item_check").prop('checked', true);
        } else {
            $(".item_check").prop('checked', false);
        }
    });
    // END ADD NEW SHIPMENT
    // Add item shipment
    let party_name = $('#party_name').val(),
        site_code = $('#site_code').val(),
        order_numberfrom = $('#order_numberfrom').val(),
        order_numberto = $('#order_numberto').val()

    const itemshipment = $('#itemshipment').DataTable({
        "bServerSide": true,
        "lengthMenu": [
            [10, 25,]
            , [10, 25,]
        ],
        "bFilter": true,
        "bInfo": true,
        "processing": true,
        "bServerSide": true,
        "order": [[1, "desc"]],
        "autoWidth": false,
        dom: '<"card-header border-bottom"<"head-label"><"dt-action-buttons text-end">><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-8"Bl><"col-sm-12 col-md-4"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        "ajax": {
            url: "/search/shipmentsearchitem/",
            type: "GET",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: function (d) {
                d.party_name = party_name;
                d.site_code = site_code;
                d.order_numberfrom = order_numberfrom;
                d.order_numberto = order_numberto;
                return d
            }
        },
        "initComplete": function (settings, json) {
            const all_checkbox_view = $("#row-tampilan div input[type='checkbox']")
            $.each(all_checkbox_view, function (key, checkbox) {
                let kolom = $(checkbox).data('kolom')
                let is_checked = checkbox.checked
                table.column(kolom).visible(is_checked)
            })
            setTimeout(function () {
                table.columns.adjust().draw();
            }, 3000)
        },
        buttons: [
            {
                extend: 'print'
                , text: feather.icons['printer'].toSvg({
                    class: 'font-small-4 me-50'
                }) + 'Print'
                , className: ''
                , exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'csv'
                , text: feather.icons['file-text'].toSvg({
                    class: 'font-small-4 me-50'
                }) + 'Csv'
                , className: ''
                , exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'excel'
                , text: feather.icons['file'].toSvg({
                    class: 'font-small-4 me-50'
                }) + 'Excel'
                , className: ''
                , exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdf'
                , text: feather.icons['clipboard'].toSvg({
                    class: 'font-small-4 me-50'
                }) + 'Pdf'
                , className: ''
                , exportOptions: {
                    columns: ':visible'
                }
            }
            , {
                extend: 'copy'
                , text: feather.icons['copy'].toSvg({
                    class: 'font-small-4 me-50'
                }) + 'Copy'
                , className: ''
                , exportOptions: {
                    columns: ':visible'
                }
            }
            , {
                extend: 'colvis'
                , text: feather.icons['eye'].toSvg({
                    class: 'font-small-4 me-50'
                }) + 'Colvis'
                , className: ''
                ,
            }
            ,],
        columnDefs: [
            {
                targets: 0,
                width: "0%",
                class: "text-nowrap",
                orderable: false,
                render: function (data, type, row, meta) {
                    return (`
                        <input type="checkbox" class="form-check-input cb-child sub_chk" name="id[]" id="${row.id}" value="${row.id}">
                        <input type="hidden" name="header_id[]" value="${row.header_id}">
                        <input type="hidden" name="line_id[]" value="${row.line_id}">
                        <input type="hidden" name="line_number[]" value="${row.line_number}">
                        <input type="hidden" name="split_line_id[]" value="${row.split_line_id}">
                        <input type="hidden" name="inventory_item_id[]" value="${row.inventory_item_id}">
                        <input type="hidden" name="user_description_item[]" value="${row.user_description_item}">
                        <input type="hidden" name="order_quantity_uom[]" value="${row.order_quantity_uom}">
                        <input type="hidden" name="shipped_quantity[]" value="${row.shipped_quantity}">
                        <input type="hidden" name="ordered_quantity[]" value="${row.ordered_quantity}">
                        <input type="hidden" name="tax_code[]" value="${row.tax_code}">
                        <input type="hidden" name="created_at[]" value="${row.created_at}">
                        <input type="hidden" name="updated_at[]" value="${row.updated_at}">
                        <input type="hidden" name="flow_status_code[]" value="${row.flow_status_code}">
                        <input type="hidden" name="order_number[]" value="${row.order_number}">
                        <input type="hidden" name="attribute1[]" value="${row.attribute1}">
                        <input type="hidden" name="attribute2[]" value="${row.attribute2}">
                        <input type="hidden" name="freight_terms_code[]" value="${row.freight_terms_code}">
                        <input type="hidden" name="cust_po_number[]" value="${row.cust_po_number}">
                        <input type="hidden" name="invoice_to_org_id[]" value="${row.invoice_to_org_id}">
                        <input type="hidden" name="deliver_to_org_id[]" value="${row.deliver_to_org_id}">
                        <input type="hidden" name="conversion_rate[]" value="${row.conversion_rate}">
                        <input type="hidden" name="conversion_date[]" value="${row.conversion_rate_date}">
                        <input type="hidden" name="user_item_description[]" value="${row.user_item_description}">
                        <input type="hidden" name="unit_selling_price[]" value="${row.unit_selling_price}">
                        <input type="hidden" name="shipping_inventory[]" value="${row.shipping_inventory}">
                        <input type="hidden" name="attribute_number_gsm[]" value="${row.attribute_number_gsm}">
                        <input type="hidden" name="attribute_number_l[]" value="${row.attribute_number_l}">
                        <input type="hidden" name="attribute_number_w[]" value="${row.attribute_number_w}">
                        <input type="hidden" name="checkid[]" value="${row.id}">
                    `);
                },
            },
            {
                "targets": 1,
                "render": function (data, type, row, meta) {
                    return row.order_number;
                }
            },
            {
                "targets": 2,
                "render": function (data, type, row, meta) {
                    return row.line_id;
                }
            },
            {
                "targets": 3,
                "render": function (data, type, row, meta) {
                    return row.party_name;
                }
            },
            {
                "targets": 4,
                "render": function (data, type, row, meta) {
                    return row.item_code;
                }
            },
            {
                "targets": 5,
                "render": function (data, type, row, meta) {
                    return row.ordered_quantity;
                }
            },
            {
                "targets": 6,
                "render": function (data, type, row, meta) {
                    return row.cust_po_number;
                }
            },
            {
                "targets": 7
                , class: "text-nowrap text-end",
                render: function (data, type, row, meta) {
                    if (row.schedule_ship_date == null) {
                        return '<a class="text-white">-</a>'
                    } else {
                        return moment(row.schedule_ship_date).format('DD-MM-YYYY');
                    }
                }
                ,
            },
            {
                "targets": 8,
                render: function (data, type, row, meta) {
                    return row.trx_name;
                    return '<a class="badge bg-primary text-white"value="${row.trx_name}"></a>'
                }
                ,
            }

        ],
        fixedColumns: true,
        searching: false
        , displayLength: 5,


    })
    $("#btnFiterSubmitSearchSecondzz").click(function () {
        party_name = $('#party_name').val();
        site_code = $('#site_code').val();
        order_numberfrom = $('#order_numberfrom').val();
        order_numberto = $('#order_numberto').val();
        itemshipment.ajax.reload(null, false)
    });

    $('#masterckcbx').on('click', function (e) {
        if ($(this).is(':checked', true)) {
            $(".sub_chk").prop('checked', true);
        } else {
            $(".sub_chk").prop('checked', false);
        }
    });
    // INDEX SHIPMENT
    $('#shipmentIndextable').DataTable({
        dom: '<"card-header border-bottom"<"head-label"><"dt-action-buttons text-end">><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-8"Bl><"col-sm-12 col-md-4"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        lengthMenu: [
            [10, 25, 50, -1]
            , [10, 25, 50, "All"]
        ],
        buttons: [{
            extend: 'print'
            , text: feather.icons['printer'].toSvg({
                class: 'font-small-4 me-50'
            }) + 'Print'
            , className: ''
            , exportOptions: {
                columns: ':visible'
            }
        }
            , {
            extend: 'csv'
            , text: feather.icons['file-text'].toSvg({
                class: 'font-small-4 me-50'
            }) + 'Csv'
            , className: ''
            , exportOptions: {
                columns: ':visible'
            }
        }
            , {
            extend: 'excel'
            , text: feather.icons['file'].toSvg({
                class: 'font-small-4 me-50'
            }) + 'Excel'
            , className: ''
            , exportOptions: {
                columns: ':visible'
            }
        }
            , {
            extend: 'pdf'
            , text: feather.icons['clipboard'].toSvg({
                class: 'font-small-4 me-50'
            }) + 'Pdf'
            , className: ''
            , exportOptions: {
                columns: ':visible'
            }
        }
            , {
            extend: 'copy'
            , text: feather.icons['copy'].toSvg({
                class: 'font-small-4 me-50'
            }) + 'Copy'
            , className: ''
            , exportOptions: {
                columns: ':visible'
            }
        }
            , {
            extend: 'colvis'
            , text: feather.icons['eye'].toSvg({
                class: 'font-small-4 me-50'
            }) + 'Colvis'
            , className: ''
            ,
        }
            ,]
    });
    // INDEX DELIVERY
    $('#deliveryIndextable').DataTable({
        dom: '<"card-header border-bottom"<"head-label"><"dt-action-buttons text-end">><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-8"Bl><"col-sm-12 col-md-4"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        lengthMenu: [
            [10, 25, 50, -1]
            , [10, 25, 50, "All"]
        ],
        buttons: [{
            extend: 'print'
            , text: feather.icons['printer'].toSvg({
                class: 'font-small-4 me-50'
            }) + 'Print'
            , className: ''
            , exportOptions: {
                columns: ':visible'
            }
        }
            , {
            extend: 'csv'
            , text: feather.icons['file-text'].toSvg({
                class: 'font-small-4 me-50'
            }) + 'Csv'
            , className: ''
            , exportOptions: {
                columns: ':visible'
            }
        }
            , {
            extend: 'excel'
            , text: feather.icons['file'].toSvg({
                class: 'font-small-4 me-50'
            }) + 'Excel'
            , className: ''
            , exportOptions: {
                columns: ':visible'
            }
        }
            , {
            extend: 'pdf'
            , text: feather.icons['clipboard'].toSvg({
                class: 'font-small-4 me-50'
            }) + 'Pdf'
            , className: ''
            , exportOptions: {
                columns: ':visible'
            }
        }
            , {
            extend: 'copy'
            , text: feather.icons['copy'].toSvg({
                class: 'font-small-4 me-50'
            }) + 'Copy'
            , className: ''
            , exportOptions: {
                columns: ':visible'
            }
        }
            , {
            extend: 'colvis'
            , text: feather.icons['eye'].toSvg({
                class: 'font-small-4 me-50'
            }) + 'Colvis'
            , className: ''
            ,
        }
            ,]
    });
    var idReturn = [];
    $(".sub_chk:checked").each(function () {
        idReturn.push($(this).attr('data-id'));
    });

    var idSplit = [];
    $(".sub_chk:checked").each(function () {
        idSplit.push($(this).attr('data-id'));
    });

    // DATATABLE SALES RETURN
    $('#copyLines').DataTable({
        searching: false,
        paging: false,
        ordering: false,
        ajax: {
            url: "/search/copyLinesselected",
            type: "GET",
            data: function (d) {
                d.idReturn = idReturn;
                return d
            },
        },
        columnDefs: [
            {
                // data:"user_description_item"
                "targets": 0,
                "class": "text-nowrap",
                "sortable": false,
                "render": function (data, type, row, meta) {
                    return row.order_number
                }
            },

            {
                // data:"ordered_quantity"
                "targets": 1,
                "class": "text-nowrap",
                "sortable": false,
                "render": function (data, type, row, meta) {
                    // return row.user_description_item;
                    return (`
                        <input readonly class="form-control text-end" autocomplete="off" required  oninput="this.value = Math.abs(this.value)" value="${row.item_code} ${row.user_description_item}-${row.unit_selling_price}">
                    `);
                }
            },
            {
                "targets": 2,
                "class": "text-nowrap",
                "sortable": false,
                "render": function (data, type, row, meta) {
                    // return row.user_description_item;
                    return (`
                    <input class="form-control text-center" id="gsm_{{$key+1}}" name="attribute_number_gsm[]" value="${row.attribute_number_gsm ?? ''}" type="text" placeholder="GSM"   style="width: 30%;">
                    <input class="form-control text-center" id="l_{{$key+1}}" name='attribute_number_l[]' value="${row.attribute_number_l ?? ''}"  type="text" placeholder="L"  style="width: 30%;">
                    <input class="form-control text-center" id="w_{{$key+1}}" name='attribute_number_w[]' value="${row.attribute_number_w ?? ''}" type="text" placeholder="W"  style="width: 30%;">
                    `);
                }
            },
            {
                // data:"ordered_quantity"
                "targets": 3,
                "class": "text-nowrap",
                "sortable": false,
                "render": function (data, type, row, meta) {
                    return row.line_id;

                }
            },
            {
                // data:"order_quantity_uom"
                "targets": 4,
                "class": "text-nowrap",
                "sortable": false,
                "render": function (data, type, row, meta) {
                    return (`
                        <input type="number" name="qty[]" class="form-control" autocomplete="off" required  value="${row.ordered_quantity}">
                        <input type="hidden" name="id[]" value="${row.id}">
                        <input type="hidden" name="header_id[]" value="${row.header_id}">
                        <input type="hidden" name="line[]" value="${row.line_id}">
                        <input type="hidden" name="split[]" value="${row.split_line_id}">
                        <input type="hidden" name="inventory[]" value="${row.inventory_item_id}">
                        <input type="hidden" name="item_description[]" value="${row.user_description_item}">
                        <input type="hidden" name="usp[]" value="${row.unit_selling_price}">
                        <input type="hidden" name="paking[]" value="${row.packing_style}">
                        <input type="hidden" name="shipin[]" value="${row.shipping_inventory}">
                        <input type="hidden" name="praisid[]" value="${row.price_list_id}">
                        <input type="hidden" name="att1[]" value="${row.pricing_attribute1}">
                        <input type="hidden" name="skedul[]" value="${row.schedule_ship_date}">
                        <input type="hidden" name="takode[]" value="${row.tax_code}">
                        <input type="hidden" name="praisingdet[]" value="${row.pricing_date}">
                        <input type="hidden" name="orderqty[]" value="${row.ordered_quantity}">
                    `);
                }
            },
            {
                // data:"unit_selling_price"
                "targets": 5,
                "class": "text-nowrap",
                "sortable": false,
                "render": function (data, type, row, meta) {
                    return row.order_quantity_uom;
                }
            },
            {
                // data:"unit_selling_price"
                "targets": 6,
                "class": "text-nowrap",
                "sortable": false,
                "render": function (data, type, row, meta) {
                    return row.unit_selling_price;
                }
            },
            {
                // data:"unit_selling_price"
                "targets": 7,
                "class": "text-nowrap",
                "sortable": false,
                "render": function (data, type, row, meta) {
                    return row.shipping_inventory;
                }
            },
            {
                // data:"unit_selling_price"
                "targets": 8,
                "width": "0%",
                "class": "text-nowrap",
                "sortable": false,
                "render": function (data, type, row, meta) {
                    return moment(row.schedule_ship_date).format('D/M/Y');
                }
            },
        ]
    });
    // DATATABLE SALES RETURN
    // TOMBOL RETURN
    $("#btnCopyLines").click(function () {
        idReturn = [];
        $(".sub_chk:checked").each(function () {
            idReturn.push($(this).attr('data-id'));
        });
        $('#copyLines').DataTable().ajax.reload();
    });
    // TOMBOL RETURN
    // DATATABLE SPLIT LINE
    $('#splitLine').DataTable({
        searching: false,
        paging: false,
        ordering: false,
        ajax: {
            url: "/search/searchSplitLine",
            type: "GET",
            data: function (d) {
                d.idSplit = idSplit;
                return d
            },
        },
        columnDefs: [
            {
                // data:"user_description_item"
                "targets": 0,
                "class": "text-nowrap",
                "sortable": false,
                "render": function (data, type, row, meta) {
                    return row.id
                }
            },
            {
                // data:"order_quantity_uom"
                "targets": 1,
                "class": "text-nowrap",
                "sortable": false,
                "render": function (data, type, row, meta) {
                    return row.header_id;
                }
            },
            {
                // data:"unit_selling_price"
                "targets": 2,
                "class": "text-nowrap",
                "sortable": false,
                "render": function (data, type, row, meta) {
                    return row.line_id;
                }
            },
            {
                // data:"unit_selling_price"
                "targets": 3,
                "class": "text-nowrap",
                "sortable": false,
                "render": function (data, type, row, meta) {
                    return row.user_description_item;
                }
            },
            {
                // data:"ordered_quantity"
                "targets": 4,
                "class": "text-nowrap",
                "sortable": false,
                "render": function (data, type, row, meta) {
                    return `<input name="split_qty" type="number" class="form-control text-end" autocomplete="off" required  oninput="this.value = Math.abs(this.value)" value="${row.ordered_quantity}">
                    <input type="hidden" name="id" value="${row.id}">
                    <input type="hidden" name="qty" value="${row.ordered_quantity}">
                    <input type="hidden" name="linenya" value="${row.line_id}">
                    <input type="hidden" name="splitlinenya" value="${row.split_line_id}">
                    <input type="hidden" name="inv_item" value="${row.inventory_item_id}">
                    <input type="hidden" name="user_desc" value="${row.user_description_item}">
                    <input type="hidden" name="qty_uom" value="${row.order_quantity_uom}">
                    <input type="hidden" name="u_sellprice" value="${row.unit_selling_price}">
                    <input type="hidden" name="pricing" value="${row.price_list_id}">
                    <input type="hidden" name="pricing_attr1" value="${row.pricing_attribute1}">
                    <input type="hidden" name="schedule" value="${row.schedule_ship_date}">
                    <input type="hidden" name="statuscode" value="${row.flow_status_code}">
                    <input type="hidden" name="tax" value="${row.tax_code}">
                    <input type="hidden" name="packing" value="${row.packing_style}">
                    <input type="hidden" name="inv_ship" value="${row.shipping_inventory}">
                    `
                }
            },
        ]
    });
    // DATATABLE SPLIT LINE
    // TOMBOL SPLIT LINE
    $("#btnSplit").click(function () {
        idSplit = [];
        $(".sub_chk:checked").each(function () {
            idSplit.push($(this).attr('data-id'));
        });
        console.log(idSplit);
        $('#splitLine').DataTable().ajax.reload();
    });
    // TOMBOL SPLIT LINE


    //start function miss Expense
    $(document).on('click', '.head_expense', function () {

        var id = this.id;

        //Variabel declaration
        var withCont = 0;
        var one = 0;
        var subtotal_add = 0;
        var trucking = $("#trucking").val();
        trucking = trucking.replace(',', '');

        var doc_fee = $("#doc_fee").val();
        doc_fee = doc_fee.replace(',', '');

        var admin = $("#admin").val();
        admin = admin.replace(',', '');

        var service = $("#service").val();
        service = service.replace(',', '');

        var cleaning = $("#cleaning").val();
        cleaning = cleaning.replace(',', '');

        var chanel = $("#chanel").val();
        chanel = chanel.replace(',', '');

        var emkl = $("#emkl").val();
        emkl = emkl.replace(',', '');

        var lift = $("#lift").val();
        lift = lift.replace(',', '');

        var pib = $("#pib").val();
        pib = pib.replace(',', '');

        var miscellaneous = $("#miscellaneous").val();
        miscellaneous = miscellaneous.replace(',', '');

        var cont = $("#cont").val();

        //Tambahan X container
        var withCont = parseInt(trucking) + parseInt(admin) + parseInt(cleaning) + parseInt(chanel) + parseInt(lift);

        // Tambahan !X Container
        var one = parseInt(emkl) + parseInt(doc_fee) + parseInt(service) + parseInt(miscellaneous) + parseInt(pib);
        console.log(one);

        // Total
        var subtotal_add = (withCont * cont) + one;
        $(".logistic").val(subtotal_add);

        subtotal_add = subtotal_add.toLocaleString({ symbol: '', decimal: ',', separator: '' });
        $(".head_total").text(subtotal_add);

        //function kso
        kso();

        //Call Fuunction calculate each row
        missExpenseCalculate(id);

        //Function number format
        changeCurrency(trucking, doc_fee, admin, service, cleaning, chanel, emkl, lift, pib, miscellaneous);
    });

    function missExpenseCalculate(id) {
        var splitid = id.split('_');
        var index = splitid[1];

        var lineId = $("#lineId_" + index).val();
        var aju = $("#aju_" + index).val();
        var rate = $("#rate_" + index).val();
        var price = $("#price_" + index).val();
        var logistic = $("#logistic_" + index).val();
        var cont = $("#cont").val();
        var kso = $("#kso_" + index).val();
        // console.log(price);
        $.ajax({
            url: '/search/data-missExpense',
            type: 'GET',
            data: { lineId: lineId, aju: aju, rate: rate, price: price, logistic: logistic, cont: cont, kso: kso },
            dataType: 'json',
            success: function (response) {
                var len = response.length;
                // console.log(response)
                if (len > 0) {
                    for (var i = 0; i < len;) {
                        var lc = response[i]['lc'];
                        var asuransi = response[i]['asuransi'];
                        // var kso = response[i]['kso'];
                        var totalCost = response[i]['totalCost'];
                        var itemCost = response[i]['itemCost'];
                        var priceItem = response[i]['priceItem'];

                        $("#asuransi_" + index).val(asuransi);
                        $("#lc_" + index).val(lc);
                        $("#totalCost_" + index).val(totalCost);
                        $("#costItem_" + index).val(itemCost);
                        $("#priceItem_" + index).val(priceItem);
                        $("#priceItem1_" + index).val(priceItem);

                        lc = lc.toLocaleString({ symbol: '', decimal: ',', separator: '' });
                        asuransi = asuransi.toLocaleString({ symbol: '', decimal: ',', separator: '' });
                        totalCost = totalCost.toLocaleString({ symbol: '', decimal: ',', separator: '' });
                        // kso = kso.toLocaleString( { symbol: '', decimal: ',', separator: '' });
                        itemCost = itemCost.toLocaleString({ symbol: '', decimal: ',', separator: '' });
                        priceItem = priceItem.toLocaleString({ symbol: '', decimal: ',', separator: '' });

                        $("#asuransi2_" + index).text(asuransi);
                        $("#lc2_" + index).text(lc);
                        $("#totalCost2_" + index).text(totalCost);
                        $("#costItem2_" + index).text(itemCost);
                        $("#priceItem2_" + index).text(priceItem);

                        index++;
                        i++;
                    }

                }
            }
        });
    }

    function kso() {

        var cont = $("#cont").val();
        var rate = $("#rate").val();
        var ksoPrice = 0;

        //KSO Calculate year=2020
        if (cont < 5) {
            ksoPrice = 370 * rate;
        } else if (cont >= 20) {
            ksoPrice = 1300 * rate;
        } else {
            ksoPrice = 65 * cont * rate;
        }

        $(".kso").val(ksoPrice);
        var kso = ksoPrice.toLocaleString({ symbol: '', decimal: ',', separator: '' });
        $(".kso").text(kso);
        console.log(kso);

    }

    // end function missExpense


    //roll
    $(document).on('click', '.add_roll', function () {
        var identifier = $('.line_id').last().attr('id');
        var split_id = identifier.split('_');
        var index = Number(split_id[2]);

        var count = $("#count_" + index).val();
        var pm = $("#pm").val();
        var gsm = $("#gsm_1").val();
        var w = $("#w_1").val();
        console.log(identifier)

        index = index + 1;

        //Roll Code
        count++;
        var now = new Date();
        var year = now.getFullYear();
        var code = "V" + pm + " " + (year.toString().slice(-2)) + " " + (('0' + (now.getMonth() + 1)).slice(-2)) + " " + (('0' + (now.getDate())).slice(-2)) + " " + count;


        $('.roll_container').append(
            '<tr class="tr_input" id="rowTab1_' + index + '">\
                <td width="auto"></td>\
                <td width="30%">\
                    <input type="hidden" class="line_id" id="line_id_'+ index + '" name="line_id[]" value="">\
                    <input type="text" id="item_sales_'+ index + '" class="form-control search_sales" value="' + code + '" name="uniq_attribute_roll[]" autocomplete="off" >\
                    <input type="hidden" id="id_'+ index + '" class="search_inventory_item_id" name="item_sales[]">\
                    <input type="hidden" id="count_'+ index + '" class="form-control harga " name="unit_selling_price[]" value="' + count + '"  required>\
                </td>\
                <td width="auto">\
                    <input type="text" id="harga_'+ index + '" required class="form-control text-end" name="primary_uom[]" value = "KG">\
                </td>\
                <td width="auto">\
                    <input type="text" id="harga_'+ index + '" required class="form-control text-end" name="primary_quantity[]" value = "0">\
                </td>\
                <td width="25%">\
                    <div class="col-xs-2">\
                        <input class="form-control text-center" id="gsm_'+ index + '" name="attribute_number_gsm[]" type="text" placeholder="GSM"  value="' + gsm + '"   style="width: 30%;">/\
                        <input class="form-control text-center" id="l_'+ index + '" name="attribute_number_l[]" type="text" placeholder="L" value="0" style="width: 30%;">/\
                        <input class="form-control text-center" id="w_'+ index + '" name="attribute_number_w[]" type="text" placeholder="W" value="' + w + '" style="width: 30%;">\
                    </div>\
                </td>\
                <td width="auto">\
                    <input type="number" id="harga_1" class="form-control harga text-center" placeholder="Q1 / Q2 / Q3" name="attribute_num_quality[]"  required>\
                </td>\
                <td>\
                    <div class="form-check form-switch form-check-primary text-end">\
                        <input type="checkbox" class="form-check-input switchButton" id="customSwitch10_'+index+'" checked="">\
                        <input type="hidden" value="" name="action_status[]" id="action_'+index+'">\
                        <label class="form-check-label" for="customSwitch10_'+index+'">\
                            <span class="switch-icon-left"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">\
                                    <polyline points="20 6 9 17 4 12"></polyline>\
                                </svg></span>\
                            <span class="switch-icon-right"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">\
                                    <line x1="20" y1="6" x2="6" y2="18"></line>\
                                    <line x1="6" y1="6" x2="18" y2="18"></line>\
                                </svg></span>\
                        </label>\
                    </div>\
                </td>\
                <td width="auto">\
                    <button type="button" class="btn btn-ligth btn-sm remove_tr_sales">X</button>\
                </td>\
            </tr>');


    });

    //Add Quality Finish Good
    $(document).on('click', '.add_fg_quality', function () {
        // console.log("masuk");
        var identifier = $('.line_id').last().attr('id');
        var split_id = identifier.split('_');
        var index = Number(split_id[2]) + 1;
        console.log(index);

        $('.fg_quality_container').append(
            '<tr class="tr_input" >\
                <td class="rownumber text-center" style="width:3%">'+ index + '</td>\
                <td width="">\
                    <input type="hidden" class="line_id" id="line_id _'+ index + '" name="attribute_num_quality[]" value="' + index + '">\
                    <input type="text" class="gsm form-control  text-center" id="gsm_'+ index + '" placeholder="g/m2" name="attribute_number_1[]" autocomplete="off" required>\
                <td width="">\
                    <input type="number" class="form-control recount text-center" id="moizture_'+ index + '" placeholder="%" name="attribute_number_2[]" required>\
                </td>\
                <td width="auto">\
                    <input type="number" class="form-control recount text-center" id="thickness_'+ index + '" placeholder="mm" name="attribute_number_3[]" required>\
                </td>\
                <td width="auto">\
                    <input type="number" id="bursting_'+ index + '" class="form-control harga text-center" name="attribute_number_4[]" placeholder="Kgf/cm2" required>\
                </td>\
                <td width="auto" class="text-center"><input type="text" id="ringCrush_'+ index + '" name="attribute_number_5[]" placeholder="Newton" class="form-control text-center" required></td>\
                <td width="auto">\
                    <input type="text"  id="plyBonding_'+ index + '" class="form-control subtotal123 text-center"  name="attribute_number_6[]" placeholder="J/m2" name="subtotal[]">\
                </td>\
                <td width="auto" class="text-center"><input type="text" id="cobbTop_'+ index + '" name="attribute_number_7[]"  placeholder="g/m2"class="form-control text-center" required></td>\
                <td width="auto">\
                    <input type="text"  id="cobbBottom_'+ index + '" class="form-control subtotal123 text-center" name="attribute_number_8[]" placeholder="g/m2" name="subtotal[]">\
                </td>\
                <td width="auto">\
                    <button type="button" class="btn btn-ligth btn-sm remove_tr_sales">X</button>\
                </td>\
            </tr>');
    });

    $(document).on('click', '.add_summary', function () {
        var data = $(".gsm");
        var gsmArray = [];
        var moiztureArray = [];
        var thicknessArray = [];
        var burstingArray = [];
        var ringCrushArray = [];
        var plyBondingArray = [];
        var cobbTopArray = [];
        var cobbBottomArray = [];
        var dataArray = [];

        for (var i = 0; i < data.length; ++i) {
            var id = data[i].getAttribute("id");
            var split_id = id.split('_');
            var index = Number(split_id[1]);
            // console.log(index);

            let gsmData = parseInt($('#gsm_' + index).val());
            let moiztureData = parseInt($('#moizture_' + index).val());
            let thicknessData = parseInt($('#thickness_' + index).val());
            let burstingData = parseInt($('#bursting_' + index).val());
            let ringCrushData = parseInt($('#ringCrush_' + index).val());
            let plyBondingData = parseInt($('#plyBonding_' + index).val());
            let cobbTopData = parseInt($('#cobbTop_' + index).val());
            let cobbBottomData = parseInt($('#cobbBottom_' + index).val());

            gsmArray.push(gsmData);
            moiztureArray.push(moiztureData);
            thicknessArray.push(thicknessData);
            burstingArray.push(burstingData);
            ringCrushArray.push(ringCrushData);
            plyBondingArray.push(plyBondingData);
            cobbTopArray.push(cobbTopData);
            cobbBottomArray.push(cobbBottomData);
        }

        dataArray.push(gsmArray, moiztureArray, thicknessArray, burstingArray, ringCrushArray, plyBondingArray, cobbTopArray, cobbBottomArray);
        summary(dataArray);
    });

    function summary(...params) {
        for (var i = 0; i < params.length; ++i) { //row

            console.log(params)
            for (var j = 0; j < params[i].length; ++j) { //colomn
                const arrAvg = arr => arr.reduce((a, b) => a + b, 0) / arr.length;

                var min = Math.min.apply(null, params[i][j]);
                var max = Math.max.apply(null, params[i][j]);
                var avg = arrAvg(params[i][j]);

                $('#min_' + j).text(min);
                $('#max_' + j).text(max);
                $('#avg_' + j).text(avg.toFixed(2));
                console.log(j, params[i][j], "min :" + min, "max :" + max, "avg :" + avg);
            }
        }
    }
    $(document).on('click', '.add_gl_lines', function () {
        /* Original Code 20-04-2022*/
        var lastname_id = $('.tr_input input[type=text]:nth-child(1)').last().attr('id');
        var split_id = lastname_id.split('_');
        var index = Number(split_id[1]) + 1;
        // console.log(index);
        $('.jurnal_items_container').append('<tr class="tr_input">\
                                    <td width="15%">\
                                    <input type="hidden" name="je_line_number[]" value="" class="form-control " id="line_'+ index + '"  autocomplete="off">\
                                    <input type="text" class="form-control search_acc" value="" name="accDes_[]" id="accDes_'+ index + '" autocomplete="off" required>\
                                    <input type="hidden" name="code_combinations[]" value="" class="form-control datepicker" id="acc_'+ index + '"  autocomplete="off">\
                                        </td>\
                                        <td width="20%">\
                                            <input type="text" class="form-control " value="" name="party_name[]" name="party_name_'+ index + '" autocomplete="off" required>\
                                        </td>\
                                        <td width="30%">\
                                            <input type="text" class="form-control " value="" name="desc[]" id="desc_'+ index + '" autocomplete="off" required>\
                                        </td>\
                                        <td>\
                                            <input type="text" class="form-control text-end debit" value="0.00"  name="dr[]" id="dr_'+ index + '" placeholder="0.00" autocomplete="off" required>\
                                        </td>\
                                        <td >\
                                            <input type="text" class="form-control text-end credit" value="0.00"  name="cr[]" id="cr_'+ index + '" placeholder="0.00" autocomplete="off" required>\
                                        </td>\
                                        <td>\
                                            <select class="form-control pajak"  name="tax[]" id="tax_'+ index + '" required>\
                                               <option  value="TAX-00" selected></option>\
                                                <option value="TAX-11" >TAX11</option>\
                                                <option value="TAX-00">TAX00</option>\
                                            </select>\
                                        </td>\
                                        <td class="text-end"  width="0%">\
                                        <button type="button" class="btn btn-secondary btn-sm remove_tr" style="position: inherit;">X</button>\
                                        </td>\
                                </tr>');
    });
    $(document).on('keyup', '.debit', function () {
        var subtotals = document.getElementsByClassName("debit");
        subtotal = [];
        for (var i = 0; i < subtotals.length; ++i) {
            var b = subtotals[i].getAttribute("id");
            var split_id = b.split('_');
            var index = Number(split_id[1]);
            var total = 0
            var data = $("#dr_" + index).val();
            subtotal.push({
                data: data
            });
        }
        for (var i = 0; i < subtotal.length; ++i) {
            total += parseInt(subtotal[i].data);
        }
        document.getElementById('calculate_debit').value = total;
        document.getElementById('calculate_debit_label').innerHTML = total.toLocaleString("en-US");
    });

    $(document).on('keyup', '.credit', function () {
        var lines = document.getElementsByClassName("credit");
        line = [];
        for (var i = 0; i < lines.length; ++i) {
            var b = lines[i].getAttribute("id");
            var split_id = b.split('_');
            var index = Number(split_id[1]);
            var total_cr = 0
            var rows = $("#cr_" + index).val();
            line.push({
                rows: rows
            });
        }
        for (var i = 0; i < line.length; ++i) {
            total_cr += parseInt(line[i].rows);
        }
        document.getElementById('calculate_credit').value = total_cr;
        document.getElementById('calculate_credit_label').innerHTML = total_cr.toLocaleString("en-US");
    });

    $(document).on('keydown', '.search_work_order', function () {
        var id = this.id;
        var splitid = id.split('_');
        var index = splitid[1];
        $('#' + id).autocomplete({
            source: "/search/search_wo",
            response: function (event, ui) {
                if (ui.content.length === 0) {
                    $(this).parent().addClass('has-error');
                    $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                    $(this).next().show();
                    $(".search_item_code_empty").show();
                } else {
                    $(this).next().hide()
                    $('.form_submit').show();
                }
            },
            select: function (event, ui) {
                $(this).next().next().val(ui.item.value1);
                $(this).val(ui.item.label); // display the selected text
                var id = ui.item.value1;
                var type = ui.item.value2;
                $('#type').val(type);
                $('#code_id').val(id);

                return false;
            }
        });

    });

    $(document).on('keydown', '.search_fg_item', function () {
        var id = this.id;
        var splitid = id.split('_');
        var index = splitid[1];
        $('#' + id).autocomplete({
            source: "/search/fg_item",
            response: function (event, ui) {
                if (ui.content.length === 0) {
                    $(this).parent().addClass('has-error');
                    $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                    $(this).next().show();
                    $(".search_item_code_empty").show();
                } else {
                    $(this).next().hide()
                    $('.form_submit').show();
                }
            },
            select: function (event, ui) {
                $(this).next().next().val(ui.item.value1);
                $(this).val(ui.item.label); // display the selected text
                var code = ui.item.value;
                var id = ui.item.value1;
                var type = ui.item.value2;
                var uom = ui.item.uom;
                var roll = ui.item.roll;
                var des = ui.item.description;
                console.log(index)
                $('#c_type_code_' + index).val(type);
                $('#c_item_code_' + index).val(id);
                $('#c_searchitem_' + index).val(code);
                $('#c_roll_' + index).val(roll);
                $('#c_uom_' + index).val(uom);
                $('#c_description_' + index).val(des);

                return false;
            }
        });

    });


    $('.search_customer').autocomplete({
        source: "/search/customer_name",
        response: function (event, ui) {
            if (ui.content.length === 0) {
                $(this).parent().addClass('has-error');
                $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                $(this).next().show();
                $(".search_item_code_empty").show();
            } else {
                $(this).next().hide()
                $('.form_submit').show();
            }
        },
        select: function (event, ui) {
            $('.search_customer').val(ui.item.value);
            $('.cust_party_code').val(ui.item.value2);

            return false;
        }
    });


});
