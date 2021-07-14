$(document).ready(function() {

    var canvasF = new fabric.Canvas('front-canvas');
    var canvasB = new fabric.Canvas('back-canvas');
    var canvasL = new fabric.Canvas('left-canvas');
    var canvasR = new fabric.Canvas('right-canvas');

    $('.bkg-file').on('change', addImg);
    $('.canvas').on('mouseup', location);
    $('.canvas').on('click', sizeSave);
    $('.canvas-img-top').on('keyup', topMove);
    $('.canvas-img-left').on('keyup', leftMove);

    $('.bkg-file').each(function() { 
        var id = $(this).data('id');
        var result = sortation(id);
        var canvas = result.canvas;
        var img = $(this).prev()[0];

        var top = $('#' + $(this).data('top')).val();
        var left = $('#' + $(this).data('left')).val();

        $('#' + $(this).data('input-top')).val(top);
        $('#' + $(this).data('input-left')).val(left);

        var x = $('#' + $(this).data('x')).val() / 100000;
        var y = $('#' + $(this).data('y')).val() / 100000;

        var angle = $('#' + $(this).data('angle')).val();

        img.onload = function(event) {
            var imgInstance = new fabric.Image(event.target, {
                left: Number(left),
                top: Number(top),
                scaleX: Number(x),
                scaleY: Number(y),
                angle: Number(angle)
            });
            
            if(canvas._objects.length < 1) {
                canvas.add(imgInstance);
                canvas.renderAll();
            } else {
                canvas.clear();
                canvas.add(imgInstance);
                canvas.renderAll();
            }
        }
    });

    function addImg(e) {
        var id = $(this).data('id');
        var img = new Image;
        var result = sortation(id);
        var canvas = result.canvas;
        var location = result.location;

        img.onload = function (event) {
            var imgInstance = new fabric.Image(event.target, {
                left: 0,
                top: 0,
                scaleX: .25,
                scaleY: .25
            });
            
            if(canvas._objects.length < 1) {
                canvas.add(imgInstance);
                canvas.renderAll();
            } else {
                canvas.clear();
                canvas.add(imgInstance);
                canvas.renderAll();
            }

            $('#' + location + '-top').val(Math.round(Number(canvas._objects[0].top)));
            $('#' + location + '-left').val(Math.round(Number(canvas._objects[0].left)));
        }

        img.src = URL.createObjectURL(e.target.files[0]);

        
    }

    function location(e){
        var id = $(this).prev().attr('id');
        var result = sortation(id);
        var canvas = result.canvas;
        var location = result.location;

        $('#' + location + '-top').val(Math.round(Number(canvas._objects[0].top)));
        $('#' + location + '-left').val(Math.round(Number(canvas._objects[0].left)));
        $('#' + location + '-angle').val(Number(canvas._objects[0].angle));

        console.log(canvas._objects[0]);
    }

    function topMove(e) {
        var id = $(this).data('id');
        var result = sortation(id);
        var canvas = result.canvas;
        
        if($(this).val()) {
            canvas._objects[0].top = Math.round(Number($(this).val()));
            canvas.renderAll();
        }
    }

    function leftMove(e) {
        var id = $(this).data('id');
        var result = sortation(id);
        var canvas = result.canvas;
        
        if($(this).val()) {
            canvas._objects[0].left = Math.round(Number($(this).val()));
            canvas.renderAll();
        }
    }

    function sizeSave(e) {
        var id = $(this).prev().attr('id');
        var result = sortation(id);
        var canvas = result.canvas;
        var location = result.location;

        $('#' + location + '-scaleX').val(canvas.item(0).scaleX);
        $('#' + location + '-scaleY').val(canvas.item(0).scaleY);
        
    }

    function sortation(id){
        var canvas;
        var location;

        switch(id) {
            case 'front-canvas': 
                canvas = canvasF;
                location = 'front';
                break;
            case 'back-canvas': 
                canvas = canvasB;
                location = 'back';
                break;
            case 'left-canvas': 
                canvas = canvasL;
                location = 'left';
                break;
            case 'right-canvas': 
                canvas = canvasR;
                location = 'right';
                break;
            default: break;
        }

        return {canvas, location};
    }
}); 