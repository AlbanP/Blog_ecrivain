
var change = false;

window.addEventListener("beforeunload", function(e) {
    if (change) {
        
        e.returnValue = " ";        
        //return " ";
    }

    return false;
});

function changed(){
	change = true;
}