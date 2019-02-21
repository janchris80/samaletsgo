function openModal(modal, title, form)
{
    $(form)[0].reset();
    $(form+'_method').val('POST');
    $(modal).modal('show');
    $(modal+'_title').text(title);
}

$('.editButton').livequery(function () {
    let $this = $(this);
    $this.off("click");

    $this.on("click", function () {
        let id = $(this).data('id');
        let editurl = $(this).data('editurl');
        let updateurl = $(this).data('updateurl');
        let modalname = $(this).data('modalname');
        let modalform = $(this).data('modalform');
        let title = $(this).data('title');

        $.ajax({
            url: editurl,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $(modalform).append(
                    '<input type="text" hidden id="_update" value="'+updateurl+'">\n'+
                    '<input type="text" hidden id="_method" name="_method" value="PUT">\n' +
                    '<input type="text" hidden id="_id" name="id" value="'+id+'">\n'
                );
                for (let i in data.data) {
                    $(modalform+'_'+i).val(data.data[i]);
                }

                $(modalname+'_title').text(title);
                $(modalname).modal('show');
            }
        });
        return false;
    });
});

$('').on('submit', function (e) {
    e.preventDefault();
    let $this = $(this), data = $this.serializeArray();

    $("#bedTable table tbody tr:not(:first-child)").each(function (row) {
        let $this = $(this);
        data.push({"name": "bedArray[" + row + "]", "value": $this.find('td.bed_no-col').text()});
    });

    $.ajax({
        url: $(this).data('url'),
        data: data,
        type: 'POST',
        dataType: 'JSON',
        success: function () {
            window.location.reload();
        }
    });
});


function openEditModal(tag,url,modal)
{
    $.ajax({
        url: url,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $(modal).modal('show');
            console.log(data.data);
            if(tag === 'entrance')
                entranceEditField(data);
            if(tag === 'amenity')
                amenityEditField(data);
            if(tag === 'rate')
                rateEditField(data);
            if(tag === 'cottage')
                cottageEditField(data);
            if(tag === 'room')
                roomEditField(data);
            if(tag === 'corkage')
                corkageEditField(data);
            if(tag === 'corkage')
                packageEditField(data);
            if(tag === 'tourist')
                touristEditField(data);
            if(tag === 'hotline')
                hotlineEditField(data);
            if(tag === 'event')
                eventEditField(data);
            if(tag === 'account')
                accountEditField(data);
            if(tag === 'location')
                locationEditField(data);
            if(tag === 'category')
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

function submit(form, modal, url, table)
{
    if ($(form).valid()) {
        $.ajax({
            url : url,
            type : "POST",
            data : $(form).serialize(),
            success : function(data) {
                if(data.success) {
                    $(modal).modal('hide');
                    table.api().ajax.reload(null, false);
                    swal({
                        title: 'Success!',
                        text: data.message,
                        icon: 'success',
                    });
                }
            },
            error : function(jqXHR, textStatus, errorThrown){
                console.log('jqXHR: ',jqXHR);
                swal({
                    title: 'Oops...' + textStatus +'!!!',
                    text: JSON.stringify(jqXHR.responseJSON.errors),
                    icon: 'error',
                });
            }
        });
    }
}

function entranceEditField(data) {
    $('#resort_entrance_form_id').val(data.data.id);
    $('#resort_entrance_form_description').val(data.data.description);
    $('#resort_entrance_form_age_type').selectpicker('val', data.data.age_type)
    $('#resort_entrance_form_method').val('PUT');
    $('#resort_entrance_form_pax').val(data.data.pax);
    $('#resort_entrance_form_rate').val(data.data.rate);
    $('#resort_entrance_form_tour').selectpicker('val', data.data.tour);
    $('#resort_entrance_modal_title').text('Edit ResortController Entrance Detail');
}

function rateEditField(data) {
    $('#resort_rate_form_id').val(data.data.id);
    $('#resort_rate_form_description').val(data.data.description);
    $('#resort_rate_form_method').val('PUT');
    $('#resort_rate_modal_title').text('Edit ResortController Rate Detail');
}

function amenityEditField(data) {
    $('#resort_amenity_form_id').val(data.data.id);
    $('#resort_amenity_form_description').val(data.data.description);
    $('#resort_amenity_form_method').val('PUT');
    $('#resort_amenity_modal_title').text('Edit ResortController Amenity Detail');
}

function cottageEditField(data) {
    $('#resort_cottage_form_id').val(data.data.id);
    $('#resort_cottage_form_description').val(data.data.description);
    $('#resort_cottage_form_rate').val(data.data.rate);
    $('#resort_cottage_form_pax').val(data.data.pax);
    $('#resort_cottage_form_method').val('PUT');
    $('#resort_cottage_modal_title').text('Edit ResortController Cottage Detail');
}

function roomEditField(data) {
    $('#resort_room_form_id').val(data.data.id);
    $('#resort_room_form_description').val(data.data.description);
    $('#resort_room_form_method').val('PUT');
    $('#resort_room_modal_title').text('Edit ResortController Cottage Detail');
}

function corkageEditField(data) {
    $('#resort_corkage_form_id').val(data.data.id);
    $('#resort_corkage_form_description').val(data.data.description);
    $('#resort_corkage_form_method').val('PUT');
    $('#resort_corkage_modal_title').text('Edit ResortController Cottage Detail');
}

function packageEditField(data) {
    $('#resort_package_form_id').val(data.data.id);
    $('#resort_package_form_package_name').val(data.data.package_name);
    $('#resort_package_form_description').val(data.data.description);
    $('#resort_package_form_rate').val(data.data.rate);
    $('#resort_package_form_pax').val(data.data.pax);
    $('#resort_package_form_method').val('PUT');
    $('#resort_package_modal_title').text('Edit ResortController Cottage Detail');
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
    $('#event_form_name').val(data.data.name);
    $('#event_form_address').val(data.data.address);
    $('#event_form_date').val(data.data.date);
    $('#event_form_description').val(data.data.description);
    $('#event_form_method').val('PUT');
    $('#event_modal_title').text('Edit Event Detail');
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
    $('#category_form_name').val(data.data.name);
    $('#category_form_method').val('PUT');
    $('#category_modal_title').text('Edit Category Detail');
}
