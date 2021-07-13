joint.setTheme('modern');
var graph = new joint.dia.Graph;
var paper = new joint.dia.Paper({
	width: 1800,
	height: 850,
	model: graph,
	gridSize: 10,
    drawGrid: true,
	background:{
		///image: 'img/default.svg',
		color: 'rgba(0,0,0,0.8)',
		//size: '100% 100%'
		size: {
			width:1800,
			height:850
		}
	}
});

var paperScroller = new joint.ui.PaperScroller({ autoResizePaper: true, paper: paper});
//paperScroller.lock();
$('#paper').append(paperScroller.render().el);
paper.on('blank:pointerdown', function (evt) {
	if(!evt.shiftKey){
		
		paperScroller.startPanning(evt)
	}
});
paperScroller.center();
var commandManager = new joint.dia.CommandManager({
    graph: graph
});

var clipboard = new joint.ui.Clipboard({ useLocalStorage: false });		
var keyboard = new joint.ui.Keyboard;

keyboard.on({
    'ctrl+c': function() {
        // Copy all selected elements and their associated links.
        clipboard.copyElements(selection.collection, graph);
    },

    'ctrl+v': function() {

        var pastedCells = clipboard.pasteCells(graph, {
            translate: { dx: 20, dy: 20 },
            useLocalStorage: true
        });

        var elements = _.filter(pastedCells, function(cell) {
            return cell.isElement();
        });

        // Make sure pasted elements get selected immediately. This makes the UX better as
        // the user can immediately manipulate the pasted elements.
        selection.collection.reset(elements);
    },

    'ctrl+x shift+delete': function() {
        clipboard.cutElements(selection.collection, graph);
    },

    'delete backspace': function(evt) {
        evt.preventDefault();
        graph.removeCells(selection.collection.toArray());
    },

    'ctrl+z': function() {
        commandManager.undo();
        selection.cancelSelection();
    },

    'ctrl+y': function() {
        commandManager.redo();
        selection.cancelSelection();
    },

    'ctrl+a': function() {
        selection.collection.reset(graph.getElements());
    },

    'ctrl+plus': function(evt) {
        evt.preventDefault();
        paperScroller.zoom(0.2, { max: 5, grid: 0.2 });
    },

    'ctrl+minus': function(evt) {
        evt.preventDefault();
        paperScroller.zoom(-0.2, { min: 0.2, grid: 0.2 });
    },

    'keydown:shift': function(evt) {
        paperScroller.setCursor('crosshair');
    },

    'keyup:shift': function() {
        paperScroller.setCursor('grab');
    }
});

///Snaplineess
var snaplines = new joint.ui.Snaplines({ paper: paper })
snaplines.startListening();

var toolbar = new joint.ui.Toolbar({
    // initialize tools with default settings
    tools: ['zoomIn', 'zoomOut', 'zoomToFit', 'zoomSlider', 'undo', 'redo', 
     { type: 'separator' },
     { type: 'label',  text: 'Mostrar imagen de fondo' },
     { type: 'toggle', name: 'showImage', value:false},
     { type: 'label',  text: 'Lineas de ayuda' },
     { type: 'toggle', name: 'snaplines', value:true},
     { type: 'separator' },
     { type: 'button', name: 'serialize', text: 'Guardar Mapa'}],
    references: {
        paperScroller: paperScroller,
        commandManager: commandManager
    }
});
$('.app-header').prepend(toolbar.render().el);
toolbar.on('serialize:pointerclick', function(event) {
   var jsonString = JSON.stringify(graph.toJSON());
	$.ajax({
        url : 'config/actualizarMapa.php',
        type : 'POST',
        dataType : 'html',
        data : { JSONModel: jsonString, IDEdificio: getParameterByName('IDEdificio'), noPiso: $("#noPiso").val()}
    }).done(function(resultado){
       console.log(resultado);
    });
   	$('#btnMapaCreado').click();
   	document.getElementById("txtJSONModel").value  = jsonString;
   /* download(jsonString, 'json.txt', 'text/plain');*/
});
toolbar.on('showImage:change', function(value, event) {
	cargarImagen(value);
});
toolbar.on('snaplines:change', function(value, event) {
	 if(value){
	 	snaplines.startListening();
	 }else{
	 	snaplines.stopListening();
	 }
});

var lightbox = new joint.ui.Lightbox({
	title: 'Image caption goes here.',
	image: 'img/escom.jpg'
});
toolbar.on('topng:pointerclick', function(event) {
	lightbox.open();
});

toolbar.on('selectimg:pointerclick', function(event) {
	btnForm.click();
});

var selection = new joint.ui.Selection({
	paper: paper,
	useModelGeometry: true
});
/*paper.on('blank:pointerdown', function(evt) {
	if (evt.shiftKey) selection.startSelecting(evt)	
		else paper.removeTools();
});*/
paper.on('blank:pointerdown', function(evt, x, y) {
	if (keyboard.isActive('shift', evt)) {
	    selection.startSelecting(evt);
	} else {
	    selection.cancelSelection();
	    paperScroller.startPanning(evt, x, y);
	    paper.removeTools();
	}

});

paper.on('element:pointerdown', function(elementView, evt) {
    if (keyboard.isActive('ctrl meta', evt)) {
        selection.collection.add(elementView.model);
    }
});

selection.on('selection-box:pointerdown', function(elementView, evt) {

    if (keyboard.isActive('ctrl meta', evt)) {
        evt.preventDefault();
        selection.collection.remove(elementView.model);
    }
});

paper.on('cell:pointerclick', function(cellView) {
    // We don't want a Halo for links.
    if (cellView.model instanceof joint.dia.Link) return;
    var halo = new joint.ui.Halo({ cellView: cellView });
    halo.removeHandle('link');
    halo.removeHandle('fork');
    halo.removeHandle('unlink');
    halo.render();
});
paper.on('element:pointerclick', function(cellView) {
    // open the inspector when the user interacts with an element
    if (cellView.model instanceof joint.dia.Link) return;
    joint.ui.Inspector.create('#inspector', {
        cell: cellView.model,
inputs: {
    attrs: {
        body: {
            fill: {
                type: 'color',
                label: 'Fill color',
                group: 'presentation',
                index: 1
            },
            stroke: {
                type: 'color',
                label: 'Outline color',
                group: 'presentation',
                index: 2
            },
            'stroke-width': {
                type: 'range',
                min: 0,
                max: 50,
                unit: 'px',
                label: 'Outline thickness',
                group: 'presentation',
                index: 3
            }
        },
        label: {
            text: {
                type: 'textarea',
                label: 'Text',
                group: 'text',
                index: 1
            },
            fontSize: {
                type: 'range',
                min: 10,
                max: 100,
                label: 'Font size',
                group: 'text',
                index: 2
            },
            fontFamily: {
                type: 'select',
                options: ['Arial', 'Times New Roman', 'Courier New'],
                label: 'Font family',
                group: 'text',
                index: 3
            }
        }
    }
},
groups: {
presentation: {
    label: 'Presentation',
    index: 1
},
text: {
    label: 'Text',
    index: 2
}
}
	    
    });
});
var stencil = new joint.ui.Stencil({
    paper: paper,
    height: 800,
	groups: {
	      edificio: { label: 'Edificio', index: 1 },
	      aula: { label: 'Aulas', index: 2, closed: true },
	      otras: { label: 'Otras formas', index: 3, closed: true }
	}
});$('#stencil').append(stencil.render().el);

var edificio = new joint.shapes.standard.Rectangle();
edificio.resize(100, 50);
edificio.position(10, 10);
edificio.attr('root/title', 'joint.shapes.standard.Rectangle');
edificio.attr('label/text', '');
edificio.attr('body/fill', '#c0c0c0');
edificio.attr('body/stroke-width', 0);

stencil.loadGroup([edificio], 'edificio');
var salon = new joint.shapes.standard.Rectangle();
salon.resize(26, 53);
salon.position(10, 10);
salon.attr('root/title', 'joint.shapes.standard.Rectangle');
salon.attr('label/text', '');
salon.attr('body/fill', '#ff8040');
salon.attr('body/stroke-width', 0);

stencil.loadGroup([salon], 'aula');
var nav = new joint.ui.Navigator({
    paperScroller: paperScroller,
    width: 300,
    height: 150,
    padding: 10,
    zoomOptions: { max: 2, min: 0.2 }
});
nav.$el.appendTo('#navigator');
nav.render();

paper.on('cell:pointerdblclick',function (elementview) {
    $('#atencion').hide();
	var model = elementview.model;
	document.getElementById("txtIDModel").value = model.id;
    document.getElementById("noPisoTxt").value = $("#noPiso").val();
    document.getElementById("IDEdificio").value = getParameterByName('IDEdificio');
	var btnForm = $('#btnForm');
     $.ajax({
        url : 'config/estaAsignado.php',
        type : 'POST',
        dataType : 'html',
        data : { IDElementModel: model.id}
    }).done(function(resultado){
        if(resultado == 'SI'){
            console.log('ya esta registrado ') ;
            $('#atencion').show();
            $("input[type=submit]").attr("disabled", "disabled");
        }
    });
	btnForm.click();
});

function download(content, fileName, contentType) {
	var a = document.createElement("a");
	var file = new Blob([content], {type: contentType});
	a.href = URL.createObjectURL(file);
	a.download = fileName;
	a.click();
}

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

function cargarImagen(value) {
    $.ajax({
        url : 'config/cargarImagen.php',
        type : 'POST',
        dataType : 'html',
        data : { IDEdificio: getParameterByName('IDEdificio')}
    }).done(function(resultado){
    	if(resultado == ''){
    		paper.drawBackground({
			color: 'rgba(0,0,0,0.8)',
			size: {
				width:1800,
				height:850
			},
	        image: value ? 'img/default.svg' : ''
			});
    	}else{
    		paper.drawBackground({
			color: 'rgba(0,0,0,0.8)',
			size: {
				width:1800,
				height:850
			},
	        image: value ? 'data:image/jpeg;base64,'+resultado+'' : ''
			});
    	}
    });
}

function cargarJSON(noPiso) {
    $.ajax({
        url : 'config/cargarJSON.php',
        type : 'POST',
        dataType : 'html',
        data : { IDEdificio: getParameterByName('IDEdificio'), noPiso: noPiso}
    }).done(function(resultado){
    	if(resultado != ''){
    		graph.fromJSON(JSON.parse(resultado));
    	}else{
           graph.fromJSON(JSON.parse('{"cells":[]}')); 
        }
    });
}

$(document).ready(function() {
    //$("#noPiso").val('1');
    $('#btnForm').hide();
    $('#btnMapaCreado').hide();
    $('#atencion').hide();
    cargarJSON(1);
    $("#noPiso").on("change", function() {
        var val = $(this).val();
        cargarJSON(val);
    });
});
