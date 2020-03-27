@if ($object->scene_type == 1)
switchScene = function(image, imageRealWidth, imageRealHeight, sceneId) {
    $('#pano').replaceWith('<div id="pano"></div>');
    $('#pano').height($('#pano').width() * 9 / 16);
    $('#pano .mark').remove();
    $('#pano').pano({img: image});
    var width = $('#pano').width();
    var imageHeight = $('#pano').height();
    var imageWidth = imageRealWidth / imageRealHeight * imageHeight;
    var markWidthOffset = $(window).width() > 600 ? 50 : 15;

    @foreach($object->scenes as $scene)
    @foreach ($scene->fromMarks as $mark)
    offset = {{ $mark->from_offset }} * imageWidth / 100 - markWidthOffset;
    offset2 = offset + imageWidth;
    offset3 = offset - imageWidth;
    mark = $('<div class="mark" title="{{ $mark->to_scene_name }}"></div>');
    mark2 = $('<div class="mark" title="{{ $mark->to_scene_name }}"></div>');
    mark3 = $('<div class="mark" title="{{ $mark->to_scene_name }}"></div>');
    mark.css('left', offset + 'px').attr('data-start', offset).attr('data-src', '{{ $mark->toScene->image_url }}').attr('data-width', '{{ $mark->toScene->image_width }}').attr('data-height', '{{ $mark->toScene->image_height }}').attr('data-id', {{ $mark->to_scene }});
    mark2.css('left', offset2 + 'px').attr('data-start', offset2).attr('data-src', '{{ $mark->toScene->image_url }}').attr('data-width', '{{ $mark->toScene->image_width }}').attr('data-height', '{{ $mark->toScene->image_height }}').attr('data-id', {{ $mark->to_scene }});
    mark3.css('left', offset3 + 'px').attr('data-start', offset3).attr('data-src', '{{ $mark->toScene->image_url }}').attr('data-width', '{{ $mark->toScene->image_width }}').attr('data-height', '{{ $mark->toScene->image_height }}').attr('data-id', {{ $mark->to_scene }});
    $('#pano').append(mark2);
    $('#pano').append(mark);
    $('#pano').append(mark3);
    @endforeach
    @foreach ($scene->toMarks as $mark)
    offset = {{ $mark->to_offset }} * imageWidth / 100 - markWidthOffset;
    console.log(offset);
    offset2 = offset + imageWidth;
    offset3 = offset - imageWidth;
    mark = $('<div class="mark" title="{{ $mark->from_scene_name }}"></div>');
    mark2 = $('<div class="mark" title="{{ $mark->from_scene_name }}"></div>');
    mark3 = $('<div class="mark" title="{{ $mark->from_scene_name }}"></div>');
    mark.css('left', offset + 'px').attr('data-start', offset).attr('data-src', '{{ $mark->fromScene->image_url }}').attr('data-width', '{{ $mark->fromScene->image_width }}').attr('data-height', '{{ $mark->fromScene->image_height }}').attr('data-id', {{ $mark->from_scene }});
    mark2.css('left', offset2 + 'px').attr('data-start', offset2).attr('data-src', '{{ $mark->fromScene->image_url }}').attr('data-width', '{{ $mark->fromScene->image_width }}').attr('data-height', '{{ $mark->fromScene->image_height }}').attr('data-id', {{ $mark->from_scene }});
    mark3.css('left', offset3 + 'px').attr('data-start', offset3).attr('data-src', '{{ $mark->fromScene->image_url }}').attr('data-width', '{{ $mark->fromScene->image_width }}').attr('data-height', '{{ $mark->fromScene->image_height }}').attr('data-id', {{ $mark->from_scene }});
    $('#pano').append(mark2);
    $('#pano').append(mark);
    $('#pano').append(mark3);
    @endforeach
    @endforeach

    $('#pano .mark[data-id="' + sceneId + '"]').hide();
    $('#pano .mark:not([data-id="' + sceneId + '"])').show();

    updateMarks = function() {
        pano = document.getElementById('pano');
        totalOffset = -parseInt(pano.style.backgroundPositionX.replace('px', ''));
        width = $('#pano').width();
        offset = totalOffset % imageWidth;
        $('#pano .mark:not([data-id="' + sceneId + '"])').each(function() {
            primalOffset = parseInt($(this).attr('data-start'));
            newOffset = primalOffset - offset;
            $(this).css('left', newOffset + 'px');
        });
    }
    updateMarks();

    observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutationRecord) {
            updateMarks();
        });
    });

    var target = document.getElementById('pano');
    observer.observe(target, { attributes : true, attributeFilter : ['style'] });
}

switchScene("{{ $object->scenes->first()->image_url }}", {{ $object->scenes->first()->image_width }}, {{ $object->scenes->first()->image_height }}, {{ $object->scenes->first()->id }});

$('.object').on('click touchend', '#pano .mark', function() {
    switchScene(this.dataset.src, this.dataset.width, this.dataset.height, this.dataset.id);
});

@else
$('#pano').height($('#pano').width() * 9 / 16);
pannellum.viewer('pano', {   
    "compass": false,
    "default": {
        "firstScene": "scene-{{ $object->scenes->first()->id }}",
        "autoLoad": true
    },
    "scenes": {
        @foreach ($object->scenes as $scene)
        "scene-{{ $scene->id }}": {
            "title": "{{ $scene->name }}",
            "panorama": "{{ $scene->image_url }}",
            "hotSpots": [
                @foreach ($scene->fromMarks as $mark)
                {
                    "pitch": {{ $mark->from_pitch }},
                    "yaw": {{ $mark->from_yaw }},
                    "type": "scene",
                    "text": "{{ $mark->to_scene_name }}",
                    "sceneId": "scene-{{ $mark->to_scene }}"
                },
                @endforeach
                @foreach ($scene->toMarks as $mark)
                {
                    "pitch": {{ $mark->to_pitch }},
                    "yaw": {{ $mark->to_yaw }},
                    "type": "scene",
                    "text": "{{ $mark->from_scene_name }}",
                    "sceneId": "scene-{{ $mark->from_scene }}"
                },
                @endforeach
            ]
        },
        @endforeach
    }
});
@endif