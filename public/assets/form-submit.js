
/*
 * Open Add Modal Form
 */
function addForm(modal_id, title, form_id)
{
    $(form_id)[0].reset();
    $('#tourist_form_cateogry').selectpicker('val', '');
    $('#resort_entrance_form_age_type').selectpicker('val', '');
    $('#resort_entrance_form_tour').selectpicker('val', '');
    $(form_id+'_method').val('POST');
    $(modal_id).modal('show');
    $(modal_id+'_title').text(title);
}

/*
 * Open Edit Modal Form
 */
function editForm(type, url, modal)
{
    $.ajax({
        url: url,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $(modal).modal('show');
            console.log(data.data.tour);
            if(type === 'entrance')
                entranceEditField(data);
            if(type === 'amenity')
                amenityEditField(data);
            if(type === 'rate')
                rateEditField(data);
            if(type === 'cottage')
                cottageEditField(data);
            if(type === 'room')
                roomEditField(data);
            if(type === 'corkage')
                corkageEditField(data);
            if(type === 'corkage')
                packageEditField(data);
            if(type === 'tourist')
                touristEditField(data);
            if(type === 'hotline')
                hotlineEditField(data);
            if(type === 'event')
                eventEditField(data);
            if(type === 'account')
                accountEditField(data);
            if(type === 'location')
                locationEditField(data);
            if(type === 'category')
                categoryEditField(data);
        },
        error: function(xhr, status, error){
            let message = xhr.responseJSON.message ? xhr.responseJSON.message : '';
            swal({
                title: message,
                icon: "error",
            });
        }
    });
}

/*
 * Submit Modal Form
 */
function submitResortForm(form, modal, url, tableData)
{
    event.preventDefault();

    if ($(form).valid()) {
        $.ajax({
            url : url,
            type : "POST",
            data : $(form).serialize(),
            success : function(data) {
                console.log('success data: ',data);
                if(data.success) {
                    $(modal).modal('hide');
                    tableData.api().ajax.reload(null, false);
                    swal({
                        title: 'Success!',
                        text: data.message,
                        icon: 'success',
                    });
                }
            },
            error : function(jqXHR, textStatus, errorThrown){
                let response = jqXHR.responseJSON.message;
                let email = jqXHR.responseJSON.errors.email ? jqXHR.responseJSON.errors.email[0] : '';

                console.log("response: ",jqXHR.responseJSON);
                console.log("textStatus: ",textStatus);
                console.log("errorThrown: ",errorThrown);

                swal({
                    title: 'Oops...' + textStatus +'!!!',
                    text: response + '\n' + email,
                    icon: 'error',
                });
            }
        });
    }
}

/*
 * Restore
 */

function restoreForm(type, url, dataTable)
{
    let csrf_token = $('meta[name="csrf-token"]').attr('content');
    swal({
        title: "Are you sure?",
        text: "Your about to restore this deleted item.",
        icon: "warning",
        dangerMode: true,
        buttons: true,
    }).then((willRestore) => {
        if (willRestore) {
            $.ajax({
                url: url,
                type: "POST",
                data: {'_method': 'DELETE', '_token': csrf_token},
                success: function (data) {
                    swal("Your file has been restored!", {
                        icon: "success",
                    }).then(() => {
                        dataTable.api().ajax.reload(null, false);
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log("jqXHR: ",jqXHR);
                    console.log("textStatus: ",textStatus);
                    console.log("errorThrown: ",errorThrown);
                    swal("Error!", {
                    });
                }
            });
        }
        else {
            swal("Nothing changed!");
        }
    });
}

/*
 * Delete
 */
function deleteConfirmation(url, dataTable)
{
    let csrf_token = $('meta[name="csrf-token"]').attr('content');
    swal({
        title: "Are you sure?",
        text: "Once deleted, you can restore it through Archive.",
        icon: "warning",
        dangerMode: true,
        buttons: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: url,
                type: "POST",
                data: {'_method': 'DELETE', '_token': csrf_token},
                success: function (data) {
                    swal("Your file has been move to archive!", {
                        icon: "success",
                    }).then(() => {
                        dataTable.api().ajax.reload(null, false);
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log("jqXHR: ",jqXHR);
                    console.log("textStatus: ",textStatus);
                    console.log("errorThrown: ",errorThrown);
                    swal("Error!", {
                    });
                }
            });
        }
        else {
            swal("Nothing changed!");
        }
    });
}

/*
 * Entrance Field
 */

function entranceEditField(data) {
    $('#resort_entrance_form_id').val(data.data.id);
    $('#resort_entrance_form_description').val(data.data.description);
    $('#resort_entrance_form_age_type').selectpicker('val', data.data.age_type)
    $('#resort_entrance_form_method').val('PUT');
    $('#resort_entrance_form_pax').val(data.data.pax);
    $('#resort_entrance_form_rate').val(data.data.rate);
    $('#resort_entrance_form_tour').selectpicker('val', data.data.tour);
    $('#resort_entrance_modal_title').text('Edit Resort Entrance Detail');
}

function rateEditField(data) {
    $('#resort_rate_form_id').val(data.data.id);
    $('#resort_rate_form_description').val(data.data.description);
    $('#resort_rate_form_method').val('PUT');
    $('#resort_rate_modal_title').text('Edit Resort Rate Detail');
}

function amenityEditField(data) {
    $('#resort_amenity_form_id').val(data.data.id);
    $('#resort_amenity_form_description').val(data.data.description);
    $('#resort_amenity_form_method').val('PUT');
    $('#resort_amenity_modal_title').text('Edit Resort Amenity Detail');
}

function cottageEditField(data) {
    $('#resort_cottage_form_id').val(data.data.id);
    $('#resort_cottage_form_description').val(data.data.description);
    $('#resort_cottage_form_rate').val(data.data.rate);
    $('#resort_cottage_form_pax').val(data.data.pax);
    $('#resort_cottage_form_method').val('PUT');
    $('#resort_cottage_modal_title').text('Edit Resort Cottage Detail');
}

function roomEditField(data) {
    $('#resort_room_form_id').val(data.data.id);
    $('#resort_room_form_description').val(data.data.description);
    $('#resort_room_form_method').val('PUT');
    $('#resort_room_modal_title').text('Edit Resort Cottage Detail');
}

function corkageEditField(data) {
    $('#resort_corkage_form_id').val(data.data.id);
    $('#resort_corkage_form_description').val(data.data.description);
    $('#resort_corkage_form_method').val('PUT');
    $('#resort_corkage_modal_title').text('Edit Resort Cottage Detail');
}

function packageEditField(data) {
    $('#resort_package_form_id').val(data.data.id);
    $('#resort_package_form_package_name').val(data.data.package_name);
    $('#resort_package_form_description').val(data.data.description);
    $('#resort_package_form_rate').val(data.data.rate);
    $('#resort_package_form_pax').val(data.data.pax);
    $('#resort_package_form_method').val('PUT');
    $('#resort_package_modal_title').text('Edit Resort Cottage Detail');
}

function touristEditField(data) {
    $('#tourist_form_id').val(data.data.id);
    $('#tourist_form_tourist_name').val(data.data.tourist_name);
    $('#tourist_form_location').val(data.data.location);
    $('#tourist_form_cateogry').selectpicker('val', data.data.category);
    $('#tourist_form_method').val('PUT');
    $('#tourist_modal_title').text('Edit Tourist Detail');
}

function hotlineEditField(data) {
    $('#hotline_form_id').val(data.data.id);
    $('#hotline_form_contact').val(data.data.contact);
    $('#hotline_form_number').val(data.data.number);
    $('#hotline_form_method').val('PUT');
    $('#hotline_modal_title').text('Edit Hotline Detail');
}

function eventEditField(data) {
    $('#event_form_id').val(data.data.id);
    $('#event_form_event_name').val(data.data.event_name);
    $('#event_form_location').selectpicker('val', data.data.location);
    $('#event_form_date').val(data.data.date);
    $('#event_form_description').val(data.data.description);
    $('#event_form_method').val('PUT');
    $('#event_modal_title').text('Edit Hotline Detail');
}

function accountEditField(data) {
    $('#account_form_id').val(data.data.id);
    $('#account_form_name').val(data.data.name);
    $('#account_form_email').val(data.data.email);
    $('#account_form_type').val(data.data.type);
    $('#account_form_method').val('PUT');
    $('#account_modal_title').text('Edit Account Detail');
}
function locationEditField(data) {
    $('#location_form_id').val(data.data.id);
    $('#location_form_location_name').val(data.data.location_name);
    $('#location_form_method').val('PUT');
    $('#location_modal_title').text('Edit Location Detail');
}

function categoryEditField(data) {
    $('#category_form_id').val(data.data.id);
    $('#category_form_type').val(data.data.type);
    $('#category_form_method').val('PUT');
    $('#category_modal_title').text('Edit Category Detail');
}
