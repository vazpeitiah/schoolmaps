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
		color: '#eeeeee',
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
paper.setInteractivity(false);
var commandManager = new joint.dia.CommandManager({
    graph: graph
});


var toolbar = new joint.ui.Toolbar({
    // initialize tools with default settings
    tools: ['zoomIn', 'zoomOut', 'zoomToFit', 'zoomSlider', 
     { type: 'separator' }],
    references: {
        paperScroller: paperScroller,
        commandManager: commandManager
    }
});
$('.app-header').prepend(toolbar.render().el);


paper.on('cell:pointerdblclick',function (elementview) {
	var model = elementview.model;
	var btnForm = $('#btnForm');
     $.ajax({
        url : 'config/buscarGrupo.php',
        type : 'POST',
        dataType : 'html',
        data : { IDElementModel: model.id}
    }).done(function(resultado){
        if(resultado != "Nothing"){
            $('#myDiv').html(resultado);
        }
        else{
            $('#myDiv').html('<strong>No hay un grupo asignado a este salón</strong>');
        }
    });
	btnForm.click();
});


function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}


function cargarJSON(noPiso) {
    $.ajax({
        url : 'config/cargarJSON.php',
        type : 'POST',
        dataType : 'html',
        data : { IDEdificio: $('#IDEdificio').text() , noPiso: noPiso}
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
    console.log($('#IDEdificio').text());
    $('#btnMapaCreado').hide();
    $('#atencion').hide();
    cargarJSON(1);
    $("#noPiso").on("change", function() {
        var val = $(this).val();
        cargarJSON(val);
    });
});
