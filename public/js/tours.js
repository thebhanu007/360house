(function($) {
    $(document).ready(function() {
        //Check empty fields before switching
        var checkEmptiness = function() {
            noError = true;
            if ($('.scene-edit.active').length) {
                if ($('.scene-edit.active input[name*="name"]').val().length == 0) noError = false;
                if ($('.scene-edit.active input[name*="scene_id"]').val().length == 0) noError = false;
            }
            if ($('.mark-edit.active').length) {
                if ($('.mark-edit.active select[name*="from"]').val().length == 0) noError = false;
                if ($('.mark-edit.active select[name*="to"]').val().length == 0) noError = false;
            }

            if (!noError) {
                if ($('.scene-edit.active, .mark-edit.active').find('.error').length) $('.scene-edit.active, .mark-edit.active').find('.error').show();
                else $('.scene-edit.active, .mark-edit.active').prepend('<div class="error card red white-text"><div class="card-content">Необходимо заполнить все поля</div></div>');
                $('html, body').animate({
                    scrollTop: $('.card.tour').offset().top - 20
                }, 500);
            } else $('.scene-edit, .mark-edit').find('.error').hide();

            return noError;
        }

        $('.objects-form').submit(function(e) {
            if (!checkEmptiness()) e.preventDefault();
        });

        //Add scene
        $('.objects-form .add-scene').click(function(e) {
            e.preventDefault();
            $('.type').removeAttr('for');
            if (checkEmptiness()) {
                unloadScenes();
                $('.objects-form .scene a.active, .objects-form .scene-edit.active, .objects-form .mark a.active, .objects-form .mark-edit.active').removeClass('active');
                index = parseInt($('.objects-form .scene a').last().attr('data-scene')) + 1;
                newSceneTab = $('.objects-form .scene.pattern').clone().removeClass('pattern').insertAfter($('.objects-form .scene').last());
                newSceneTab.find('a').attr('data-scene', index).addClass('active');
                newScene = $('.objects-form .scene-edit.pattern').clone().removeClass('pattern').addClass('active').insertAfter($('.objects-form .scene-edit').last());
                newScene.attr('data-id', index);
                newScene.find('input').each(function() {
                    this.name += '[' + index + ']';
                    this.id += '-' + index;
                    if ($(this).attr('type') == 'radio') {
                        $(this).next().attr('for', this.id);
                        if ($(this).attr('checked')) $(this).click();
                    }
                });
                if ($('.objects-form .tour .scene:not(.pattern)').length >= 2) $('.objects-form .add-mark').show();
            }
        });
        //-----

        //Add mark
        $('.objects-form .add-mark').click(function(e) {
            e.preventDefault();
            if (checkEmptiness()) {
                unloadScenes();
                $('.objects-form .scene a.active, .objects-form .scene-edit.active, .objects-form .mark a.active, .objects-form .mark-edit.active').removeClass('active');
                index = parseInt($('.objects-form .mark a').last().attr('data-mark')) + 1;
                newMarkTab = $('.objects-form .mark.pattern').clone().removeClass('pattern').insertAfter($('.objects-form .mark').last());
                newMarkTab.find('a').attr('data-mark', index).addClass('active');
                newMark = $('.objects-form .mark-edit.pattern').clone().removeClass('pattern').addClass('active').insertAfter($('.objects-form .mark-edit').last());
                newMark.attr('data-id', index);
                newMark.find('input, select').each(function() {
                    this.name += '[' + index + ']';
                    this.id += '-' + index;
                    if ($(this).attr('type') == 'radio') {
                        $(this).next().attr('for', this.id);
                        if ($(this).attr('checked')) $(this).click();
                    }
                });
                updateOptions();
            }
        });
        //-----

        //Switch scene
        $('.objects-form').on('click', '.scene a, .mark a', function(e) {
            e.preventDefault();
            if (checkEmptiness()) {
                unloadScenes();
                $('.objects-form .scene a.active, .objects-form .scene-edit.active, .objects-form .mark a.active, .objects-form .mark-edit.active').removeClass('active');
                $(this).addClass('active');
                if ($(this).parent().parent().hasClass('scene')) {
                    scene = $(this).attr('data-scene');
                    $('.objects-form .scene-edit[data-id="' + scene + '"]').addClass('active');
                } else {
                    mark = $(this).attr('data-mark');
                    $('.objects-form .mark-edit[data-id="' + mark + '"]').addClass('active');
                    updateOptions();
                }
            }
        });
        //-----

        //Scene AJAX
        $('.objects-form').on('change', '.scene-edit input[type="file"]', function() {
            if (this.files.length) {
                var fileField = $(this);
                var sceneEdit = fileField.closest('.scene-edit');
                var sceneId = 'scene-' + sceneEdit.attr('data-id');
                var objectIdField = $('.objects-form').find('input[name="object_id"]');
                var type = $('.objects-form input[name="scene_type"]:checked').val();
                formData = new FormData();
                formData.append('scene', this.files[0]);
                formData.append('name', sceneEdit.find('input[name^="name"]').val());
                formData.append('scene_type', type);
                if (sceneEdit.find('input[name^="scene_id"]').val().length) formData.append('scene_id', sceneEdit.find('input[name^="scene_id"]').val());
                if (objectIdField.val().length) formData.append('object_id', objectIdField.val());
                $('.ripple').fadeIn(300);
                $.ajax({
                    method: 'POST',
                    data: formData,
                    url: '/create/scene',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('.ripple').fadeOut(300);
                        sceneEdit.find('input[name^="scene_id"]').val(response.id);
                        objectIdField.val(response.object_id);
                        sceneEdit.find('.preview .pano').remove();
                        sceneEdit.find('.preview').append('<div data-src="' + response.image_url + '" data-width="' + response.image_width + '" data-height="' + response.image_height + '" class="pano" id="' + sceneId + '"></div>');
                        switchSceneType(type, sceneId);
                        calculateCost();
                    }
                });
            }
        });
        //-----

        //Update options
        var updateOptions = function() {
            $('.objects-form .scene a').each(function() {
                sceneId = $('.objects-form .scene-edit[data-id="' + this.dataset.scene + '"] input[name^="scene_id"]').val();
                if ($('.objects-form .mark-edit.active select option[value="' + sceneId + '"]').length == 0)
                    $('.objects-form .mark-edit.active select').append('<option value="' +  sceneId + '" data-id="' + this.dataset.scene + '">' + $(this).children('.name').text() + '</option>');
                else
                    $('.objects-form .mark-edit.active select option[value="' + sceneId + '"]').text($(this).children('.name').text()).attr('data-id', this.dataset.scene);
            });
            $('select').material_select();
        }
        //-----

        //Unload scenes
        var unloadScenes = function() {
            $('.scene-edit .pano, .mark-edit .pano').each(function() {
                if (!$(this).hasClass('simple')) {
                    $(this).html('').removeAttr('style');
                }
            });
        }
        //-----

        //Mark scene choose
        $('.objects-form').on('change', 'select[name^="from"], select[name^="to"]', function() {
            if ($(this).val()) {
                var scenePreviewId = this.id + '-preview';
                var image = $('.objects-form .scene-edit[data-id="' + $(this).find('option[value="' + $(this).val() + '"]').attr('data-id') + '"] .pano');
                var imgSrc = image.attr('data-src');
                var imgWidth = image.attr('data-width');
                var imgHeight = image.attr('data-height');
                var scenePreview = $('<div class="pano"></div>').attr('id', scenePreviewId).attr('data-src', imgSrc).attr('data-width', imgWidth).attr('data-height', imgHeight);
                if ($(this).closest('.input-field').next('.preview').children('.pano').length) {
                    currentPano = $(this).closest('.input-field').next('.preview').children('.pano');
                    if (imgSrc != currentPano.attr('data-src')) currentPano.replaceWith(scenePreview);
                } else $(this).closest('.input-field').next('.preview').append(scenePreview);
                var type = $('.objects-form input[name="scene_type"]:checked').val();
                switchSceneType(type, scenePreviewId);
            }
        });
        //-----

        $('.objects-form').on('click', '.type, .scene a, .mark a', function() {
            if ($(this).hasClass('type') && !$(this)[0].hasAttribute('for')) return;
            var sceneId = 'scene-' + $('.objects-form .scene-edit.active').attr('data-id');
            setTimeout(function() {
                var type = $('.objects-form input[name="scene_type"]:checked').val();
                switchSceneType(type, sceneId);
                $('.objects-form .mark-edit.active select[name^="from"], .objects-form .mark-edit.active select[name^="to"]').change();
            }, 100);
        });
        $('.objects-form .scene:not(.pattern) a').first().click();

        //Name update
        $('.objects-form').on('keyup', '.scene-edit input[name^="name"]', function() {
            var sceneEdit = $(this).closest('.scene-edit');
            var id = sceneEdit.attr('data-id');
            $('.objects-form .tour .scene a[data-scene="' + id + '"] .name').text($(this).val());
        });
        $('.objects-form').on('change', '.mark-edit select', function() {
            var sceneEdit = $(this).closest('.mark-edit');
            from = sceneEdit.find('select[name^="from"] option:selected').text();
            to = sceneEdit.find('select[name^="to"] option:selected').text();
            name = from + ' - ' + to;
            var id = sceneEdit.attr('data-id');
            $('.objects-form .tour .mark a[data-mark="' + id + '"] .name').text(name);
        });
        //-----

        var switchSceneType = function(type, id) {
            imgUrl = $('#' + id).attr('data-src');
            if (typeof imgUrl != 'undefined') {
                switch (type) {
                    case '1': 
                        if (!$('#' + id).hasClass('simple')) {
                            unloadScenes();
                            $('#' + id).addClass('simple').pano({img: imgUrl});
                            $('#' + id).height($('#' + id).width() * 9 / 16);
                            if ($('#' + id).closest('.mark-edit').length) {
                                width = $('#' + id).width();
                                realImgHeight = $('#' + id).height();
                                imgWidth = $('#' + id).attr('data-width');
                                imgHeight = $('#' + id).attr('data-height');
                                realImgWidth = imgWidth / imgHeight * realImgHeight;
                                percentOffset =  parseFloat($('#' + id).parent().prev().find('input[name*="offset"]').val());
                                centerOffset = percentOffset * realImgWidth / 100;
                                bgOffset = (width / 2) - centerOffset;
                                document.getElementById(id).style.backgroundPositionX = bgOffset + 'px';
                            }
                            if (typeof observers == 'undefined') observers = {};
                            observers[id] = new MutationObserver(function(mutations) {
                                mutations.forEach(function(mutationRecord) {
                                    width = $(mutationRecord.target).width();
                                    realImgHeight = $(mutationRecord.target).height();
                                    imgWidth = $(mutationRecord.target).attr('data-width');
                                    imgHeight = $(mutationRecord.target).attr('data-height');
                                    realImgWidth = imgWidth / imgHeight * realImgHeight;
                                    totalOffset = -parseFloat(mutationRecord.target.style.backgroundPositionX.replace('px', ''));
                                    centerOffset = totalOffset + (width / 2);
                                    pixelOffset = centerOffset % realImgWidth;
                                    offset = pixelOffset / realImgWidth * 100;
                                    if (offset < 0) offset = 100 + offset;
                                    $('#' + id).parent().prev().find('input[name*="offset"]').val(offset);
                                });
                            });

                            var target = document.getElementById(id);
                            observers[id].observe(target, { attributes : true, attributeFilter : ['style'] });
                        } else $('#' + id).height($('#' + id).width() * 9 / 16);
                        break;
                    case '2':
                    case '3':
                        $('#' + id).html('').removeAttr('style');
                        $('#' + id).removeClass('simple');
                        if (typeof viewers == 'undefined') viewers = {};
                        if ($('#' + id).closest('.mark-edit').length) {
                            pitch =  $('#' + id).parent().prev().find('input[name*="pitch"]').val();
                            yaw = $('#' + id).parent().prev().find('input[name*="yaw"]').val();
                        } else {
                            pitch = 0;
                            yaw = 0;
                        }
                        viewers[id] = pannellum.viewer(id, {
                            "type": "equirectangular",
                            "panorama": imgUrl,
                            "autoLoad": true,
                            'pitch': pitch,
                            'yaw': yaw
                        });
                        $('#' + id).height($('#' + id).width() * 9 / 16);
                        viewers[id].on('mouseup', function() {
                            $('#' + id).parent().prev().find('input[name*="pitch"]').val(viewers[id].getPitch());
                            $('#' + id).parent().prev().find('input[name*="yaw"]').val(viewers[id].getYaw());
                        });
                        break;
                }
            }
        }
        //-----

        $('.objects-form .scene:not(.pattern) a').first().click();

        //Delete scene
        $('.objects-form').on('click', '.tour .scene .delete', function(e) {
            if (confirm('Вы уверены?')) {
                e.stopPropagation();
                var id = $(this).next().attr('data-scene');
                var sceneId = $('.scene-edit[data-id="' + id + '"]').find('input[name*="scene_id"]').val();
                var item = $(this);
                $.ajax({
                    url: '/delete/scene/' + sceneId,
                    method: 'POST',
                    success: function()
                    {
                         calculateCost();
                    }
                });
                $('.scene-edit[data-id="' + id + '"]').remove();
                item.closest('.scene').remove();
                if ($('.scene:not(.pattern), .mark:not(.pattern)').length == 0) {
                    $('.type').each(function() {
                        $(this).attr('for', $(this).prev().attr('id'));
                    });
                }
            }
        });
        //-----

        //Delete mark
        $('.objects-form').on('click', '.tour .mark .delete', function(e) {
            if (confirm('Вы уверены?')) {
                e.stopPropagation();
                var id = $(this).next().attr('data-mark');
                var sceneId = $('.mark-edit[data-id="' + id + '"]').find('input[name*="mark_id"]').val();
                var item = $(this);
                $.ajax({
                    url: '/delete/mark/' + sceneId,
                    method: 'POST'
                });
                $('.mark-edit[data-id="' + id + '"]').remove();
                item.closest('.mark').remove();
            }
        });
        //-----

        //Object type switch
        var switchType = function() {
            $('.type').hide();
            $('.type-' + $('#type').val()).show();
        }
        switchType();
        $('#type').change(switchType);
        //-----

        //Calculate cost
        var calculateCost = function()
        {
            id = $('[name="object_id"]').val();
            $.ajax({
                url: '/cost/' + id,
                method: 'POST',
                success: function(cost) {
                    console.log(cost == 'бесплатно');
                    if (cost == 'бесплатно') $('.objects-form button[type="submit"]').text('Сохранить');
                    else $('.objects-form button[type="submit"]').text('Сохранить и перейти к оплате');
                    $('.cost').text(cost);
                }
            });
        }
        //-----

        //Clear images
        $('.objects-form button[type="submit"]').click(function() {
            $('.objects-form input[type="file"]').val('');
        });
        //-----
    });
})(jQuery)