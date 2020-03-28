(function($) {
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('select').material_select();

        $('.new-objects .row').owlCarousel({
            responsive: {
                0: {
                    items: 2,
                    nav: false
                },
                600: {
                    items: 3,
                },
                1200: {
                    items: 6
                }
            },
            nav: true,
            navText: ['<i class="material-icons">keyboard_arrow_left</i>', '<i class="material-icons">keyboard_arrow_right</i>']
        });

        $('.filter .tabs a').click(function() {
            $(this).closest('form').attr('action', this.dataset.route);
            setTimeout(toggleDuration, 100);
        });

        $('.object .phone a').click(function(e) {
            e.preventDefault();
            link = $(this);
            $.post(this.dataset.url, {id: this.dataset.id}, function(response) {
                link.text(response);
            });
        });

        var toggleDuration = function() {
            if ($('.rent-tab a').hasClass('active')) {
                $('.filter [data-tab="rent"]').show();
            } else {
                $('.filter [data-tab="rent"]').hide();
            }
        };
        toggleDuration();

        var toggleRooms = function() {
            if ($('#type').val() == 2) $('.filter .rooms').hide();
            else  $('.filter .rooms').show();
        };
        $('#type').change(toggleRooms);
        toggleRooms();

        $(".button-collapse").sideNav({
            draggable: true
        });

        $('#tour .fullscreen').click(function() {
            var el = document.getElementById('tour');
            if (screenfull.enabled) {
                screenfull.toggle(el);
            }
        });

        screenfull.on('change', function() {
            if (screenfull.isFullscreen) $('body').addClass('is-fullscreen');
            else $('body').removeClass('is-fullscreen');
        });

        $('.admin-objects form').submit(function(e) {
            if (!confirm('Действительно удалить объект?')) e.preventDefault();
        });

        $('.object-card .image').height($('.object-card .image').width());
        $('.objects .image').each(function() {
            $(this).height($(this).parent().height());
        });
        $('.object-card, .objects .card').mouseenter(function() {
            card = this;
            if ($(this).find('.image').css('background-image').search('placeholder') == -1) {
                this.scroll = setInterval(function() {
                    pos = $(card).find('.image').css('background-position-x').replace('px', '');
                    pos++;
                    $(card).find('.image').css('background-position-x', pos + 'px');
                }, 10);
            }
        }).mouseleave(function() {
            this.scroll && clearInterval(this.scroll);
        });

        $(document).scroll(function() {
            $('.filter-wrapper').css('background-position-y', (-($(document).scrollTop() / 2) - 50) + 'px');
        });

        $('.filter [id="city"]').on('keyup', function() {
            var input = $(this);
            var value = input.val();
            var region = $('.filter select[name="region"]').val();
            $.post('/cities', {'string': value, 'region': region}, function(response) {
                input.autocomplete({
                    data: response,
                    limit: 10,
                    minLength: 1,
                });
            });
        });

        $('.admin-objects .show-embed').click(function(e) {
            e.preventDefault();
            $(this).closest('tr').find('.embed-code').modal('open');
        });

        $('.embed-code .close').click(function() {
            $(this).closest('.embed-code').modal('close');
        });

        $('.modal').modal({
            complete: function() {
                content = $('#tutorial .modal-content').html();
                $('#tutorial .modal-content').html(content);
            }
        });

        //Help
        $('.help .toggle').click(function() {
            $(this).next('.content').slideToggle(300);
        });
        //-----

        //Confirmation
        $('.actions form').submit(function(e) {
            if (!confirm('Подтвердить операцию?')) {
                e.preventDefault();
            }
        });
        //-----

        //Order form submit
        $('.ajax-form').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var data = { ajax: true };
            form.find('input, select, textarea').each(function() {
                data[this.name] = $(this).val();
            });
            form.find('.errors').remove();
            form.find('.message').remove();
            $.ajax({
                url: form.attr('action'), 
                data: data,
                method: 'POST',
                success: function(response) {
                    if (!response.success) {
                        form.prepend('<div class="errors card red white-text"><div class="card-content"><div class="error">' + response.message + '</div></div></div>');
                    } else {
                        form.prepend('<div class="messages card green darken-1 white-text"><div class="card-content"><div class="message">' + response.message + '</div></div></div>');
                    }
                },
                error: function(response) {
                    form.prepend('<div class="errors card red white-text"><div class="card-content"></div></div>');
                    $.each(response.responseJSON, function() {
                        form.find('.errors .card-content').append('<div class="error">' + this + '</div>');
                    });
                }
            });
        });
        //-----


		$('#documents').on('change', function(){
		  var total_images = $('#documents')[0].files.length;
		  var form_data = new FormData();
		   for (var i = 0; i < total_images; i++) {
		   	form_data.append("file"+i, document.getElementById('documents').files[i]);
		   }
		   	form_data.append("total_image", $('#documents')[0].files.length);
		   $.ajax({
			url:"http://360house.ru/upload-documents",
			headers: {
            	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	},
			method:"POST",
			data: form_data,
			contentType: false,
			cache: false,
			processData: false,
			beforeSend:function(){
			 $('#loading').html("Загрузка изображени");
			},    
			success:function(data)
			{
                var total_old_images = parseInt($("#total_images").val());
				var total_file = data.split(",");
				var HTML = '';
				for(i=(total_old_images); i<(total_file.length+total_old_images); i++){
					if(i != total_old_images){
					HTML += '<div class="product-images" id="image-'+i+'" style="float:left;">';
					HTML += '<img src="http://360house.ru/documents/'+total_file[i-total_old_images]+'" class="img-thumbnail" height="70" width="70" style="margin-right:10px; border:1px solid #ccc;">';
            		HTML += '<button class="btn-remove btn-success" type="button" value="'+total_file[i-total_old_images]+'" data-id="image-'+i+'">X</button>';
					HTML += '</div>';
                    $("#total_images").val(total_old_images+1);
					}
				}
                console.log(HTML);
				 $(".files_list_block").append(HTML);
                 $("#documents_hidden").val($("#documents_hidden").val()+''+data);
                 $("#documents").val("");
				 $('#loading').html("Изображение загружено");
			 
			}
			
		   });

		});

function alignModal(){
        var modalDialog = $(this).find(".modal-content");
        /* Applying the top margin on modal dialog to align it vertically center */
        modalDialog.css("margin-top", Math.max(0, ($(window).height() - modalDialog.height()) / 2));
        console.log('w');
    }
$(".modal").on("shown", alignModal);
$(window).on("resize", function(){
        $(".modal:visible").each(alignModal);
    });   
  		 $(document).on('click','.btn-remove',function(){
			var id = $(this).data('id');
			var img = $(this).val();
			var swipeid = $(this).data('swipeid');
			var img_to_remove = ","+img;
			var remove_from = $("#documents_hidden").val();
		   var remain_imgs =  remove_from.replace(img_to_remove,'');
            var total_old_images = parseInt($("#total_images").val());
            $("#total_images").val(total_old_images-1);
		   $("#documents_hidden").val(remain_imgs);
		   $("#"+id).remove();	
		});

		$('.popupimage').on('click', function(){
			// Get the image and insert it inside the modal - use its "alt" text as a caption
			var modalImg = document.getElementById("img01");
            $('#myImageModal').modal('open');
            $('#myImageModal').addClass('close');
		    modalImg.src = this.src;
			
			// Get the <span> element that closes the modal
			var span = document.getElementsByClassName("close")[0];
			$(".modal-content").click(function(){
                return false;
            });
			// When the user clicks on <span> (x), close the modal
			span.onclick = function() {
                $('#myImageModal').modal('close');
			}			
			
		});

    });
	
	
	
	
	
})(jQuery)

function add_document_click(){
	//console.log(12312312312);
	$('#documents').click();
}