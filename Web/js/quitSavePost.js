var change = false;

window.addEventListener("beforeunload", function(e) {
    e = e || window.event;
    if (change) {
        if(e){
        	e.returnValue = " ";  
        }     
        return " ";
    }

    return false;
});

function changed($state){
	change = $state;
}